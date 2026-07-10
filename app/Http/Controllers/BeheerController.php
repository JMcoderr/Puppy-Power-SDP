<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\DaycareRegistration;
use App\Models\TrainingEnrollment;

// handles the admin dashboard: overview, filtering, sorting, CSV export
class BeheerController extends Controller
{
    public function index()
    {
        // parse filter + sort settings from the current request
        [$search, $from, $to, $sort, $filters] = $this->filters();

        // always show the global totals (not affected by filters)
        $totals = [
            'enrollments' => TrainingEnrollment::query()->count(),
            'daycare' => DaycareRegistration::query()->count(),
            'messages' => ContactMessage::query()->count(),
        ];

        // build base queries with the active filters applied
        $enrollmentsQuery = $this->enrollmentsQuery($search, $from, $to);
        $daycareQuery = $this->daycareQuery($search, $from, $to);
        $messagesQuery = $this->messagesQuery($search, $from, $to);

        // paginate each dataset separately so they can be paged independently
        $enrollments = $this->applySorting(clone $enrollmentsQuery, $sort, 'owner_name')
            ->paginate(10, ['*'], 'enrollments_page')
            ->withQueryString();

        $daycareRegistrations = $this->applySorting(clone $daycareQuery, $sort, 'owner_name')
            ->paginate(10, ['*'], 'daycare_page')
            ->withQueryString();

        $contactMessages = $this->applySorting(clone $messagesQuery, $sort, 'name')
            ->paginate(10, ['*'], 'messages_page')
            ->withQueryString();

        // filtered totals shown next to each table heading
        $filteredCounts = [
            'enrollments' => (clone $enrollmentsQuery)->count(),
            'daycare' => (clone $daycareQuery)->count(),
            'messages' => (clone $messagesQuery)->count(),
        ];

        $insights = [
            'today' => TrainingEnrollment::query()->whereDate('created_at', today())->count()
                + DaycareRegistration::query()->whereDate('created_at', today())->count()
                + ContactMessage::query()->whereDate('created_at', today())->count(),
            'latestActivity' => collect([
                TrainingEnrollment::query()->latest('created_at')->value('created_at'),
                DaycareRegistration::query()->latest('created_at')->value('created_at'),
                ContactMessage::query()->latest('created_at')->value('created_at'),
            ])->filter()->sortDesc()->first(),
            'attentionArea' => ContactMessage::query()
                ->select('subject')
                ->get()
                ->countBy('subject')
                ->sortDesc()
                ->keys()
                ->first() ?? 'Nog geen voorkeur zichtbaar',
        ];

        $breakdowns = [
            'subjects' => ContactMessage::query()->select('subject')->get()->countBy('subject')->sortDesc(),
            'daycareSlots' => DaycareRegistration::query()->select('time_slot')->get()->countBy('time_slot')->sortDesc(),
            'topTrainings' => TrainingEnrollment::query()
                ->with('training:id,title')
                ->get()
                ->countBy(fn ($item) => $item->training?->title ?? 'Onbekende training')
                ->sortDesc()
                ->take(3),
        ];

        return view('beheer.index', compact('totals', 'filteredCounts', 'filters', 'enrollments', 'daycareRegistrations', 'contactMessages', 'insights', 'breakdowns'));
    }

    // streams all filtered data as a CSV download (respects current filters)
    public function export()
    {
        [$search, $from, $to, $sort] = $this->filters();

        $enrollments = $this->applySorting($this->enrollmentsQuery($search, $from, $to), $sort, 'owner_name')->get();
        $daycareRegistrations = $this->applySorting($this->daycareQuery($search, $from, $to), $sort, 'owner_name')->get();
        $contactMessages = $this->applySorting($this->messagesQuery($search, $from, $to), $sort, 'name')->get();

        $filename = 'beheer-export-' . now()->format('Ymd-His') . '.csv';

        return response()->streamDownload(function () use ($enrollments, $daycareRegistrations, $contactMessages) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['Training inschrijvingen']);
            fputcsv($handle, ['Eigenaar', 'Hond', 'Training', 'E-mail', 'Aangemaakt op']);
            foreach ($enrollments as $item) {
                fputcsv($handle, [
                    $item->owner_name,
                    $item->dog_name,
                    $item->training?->title ?? '-',
                    $item->email,
                    optional($item->created_at)->format('Y-m-d H:i:s'),
                ]);
            }

            fputcsv($handle, []);
            fputcsv($handle, ['Dagopvang aanmeldingen']);
            fputcsv($handle, ['Eigenaar', 'Hond', 'Datum opvang', 'Dagdeel', 'E-mail', 'Aangemaakt op']);
            foreach ($daycareRegistrations as $item) {
                fputcsv($handle, [
                    $item->owner_name,
                    $item->dog_name,
                    optional($item->drop_off_date)->format('Y-m-d'),
                    $item->time_slot,
                    $item->email,
                    optional($item->created_at)->format('Y-m-d H:i:s'),
                ]);
            }

            fputcsv($handle, []);
            fputcsv($handle, ['Contactberichten']);
            fputcsv($handle, ['Naam', 'Onderwerp', 'E-mail', 'Aangemaakt op']);
            foreach ($contactMessages as $item) {
                fputcsv($handle, [
                    $item->name,
                    $item->subject,
                    $item->email,
                    optional($item->created_at)->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    // collect and sanitize filter parameters from the request
    private function filters(): array
    {
        $search = trim((string) request('q', ''));
        $from = request('from');
        $to = request('to');
        $sort = (string) request('sort', 'newest');
        $adjusted = false;

        // if user enters reversed dates, we flip them so the filter still works
        if ($from && $to && $from > $to) {
            [$from, $to] = [$to, $from];
            $adjusted = true;
        }

        $allowedSorts = ['newest', 'oldest', 'name_az', 'name_za'];
        if (! in_array($sort, $allowedSorts, true)) {
            $sort = 'newest';
        }

        return [
            $search,
            $from,
            $to,
            $sort,
            [
                'q' => $search,
                'from' => $from,
                'to' => $to,
                'sort' => $sort,
                'adjusted' => $adjusted,
            ],
        ];
    }

    // apply a named sort preset to any Eloquent query builder
    private function applySorting($query, string $sort, string $nameColumn)
    {
        return match ($sort) {
            'oldest' => $query->orderBy('created_at'),
            'name_az' => $query->orderBy($nameColumn)->orderByDesc('created_at'),
            'name_za' => $query->orderByDesc($nameColumn)->orderByDesc('created_at'),
            default => $query->orderByDesc('created_at'),
        };
    }

    // base query for training enrollments with optional search + date filters
    private function enrollmentsQuery(string $search, ?string $from, ?string $to)
    {
        return TrainingEnrollment::query()
            ->with('training')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($nested) use ($search) {
                    $nested->where('owner_name', 'like', "%{$search}%")
                        ->orWhere('dog_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($from, fn ($query) => $query->whereDate('created_at', '>=', $from))
            ->when($to, fn ($query) => $query->whereDate('created_at', '<=', $to));
    }

    // base query for daycare registrations with optional search + date filters
    private function daycareQuery(string $search, ?string $from, ?string $to)
    {
        return DaycareRegistration::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($nested) use ($search) {
                    $nested->where('owner_name', 'like', "%{$search}%")
                        ->orWhere('dog_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($from, fn ($query) => $query->whereDate('created_at', '>=', $from))
            ->when($to, fn ($query) => $query->whereDate('created_at', '<=', $to));
    }

    // base query for contact messages with optional search + date filters
    private function messagesQuery(string $search, ?string $from, ?string $to)
    {
        return ContactMessage::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($nested) use ($search) {
                    $nested->where('name', 'like', "%{$search}%")
                        ->orWhere('subject', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($from, fn ($query) => $query->whereDate('created_at', '>=', $from))
            ->when($to, fn ($query) => $query->whereDate('created_at', '<=', $to));
    }
}
