<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\DaycareRegistration;
use App\Models\TrainingEnrollment;

class BeheerController extends Controller
{
    public function index()
    {
        [$search, $from, $to, $filters] = $this->filters();

        // simple latest lists for admin overview
        $totals = [
            'enrollments' => TrainingEnrollment::query()->count(),
            'daycare' => DaycareRegistration::query()->count(),
            'messages' => ContactMessage::query()->count(),
        ];

        $enrollmentsQuery = $this->enrollmentsQuery($search, $from, $to);
        $daycareQuery = $this->daycareQuery($search, $from, $to);
        $messagesQuery = $this->messagesQuery($search, $from, $to);

        $enrollments = (clone $enrollmentsQuery)
            ->latest()
            ->paginate(10, ['*'], 'enrollments_page')
            ->withQueryString();

        $daycareRegistrations = (clone $daycareQuery)
            ->latest()
            ->paginate(10, ['*'], 'daycare_page')
            ->withQueryString();

        $contactMessages = (clone $messagesQuery)
            ->latest()
            ->paginate(10, ['*'], 'messages_page')
            ->withQueryString();

        $filteredCounts = [
            'enrollments' => (clone $enrollmentsQuery)->count(),
            'daycare' => (clone $daycareQuery)->count(),
            'messages' => (clone $messagesQuery)->count(),
        ];

        return view('beheer.index', compact('totals', 'filteredCounts', 'filters', 'enrollments', 'daycareRegistrations', 'contactMessages'));
    }

    public function export()
    {
        [$search, $from, $to] = $this->filters();

        $enrollments = $this->enrollmentsQuery($search, $from, $to)->latest()->get();
        $daycareRegistrations = $this->daycareQuery($search, $from, $to)->latest()->get();
        $contactMessages = $this->messagesQuery($search, $from, $to)->latest()->get();

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

    private function filters(): array
    {
        $search = trim((string) request('q', ''));
        $from = request('from');
        $to = request('to');

        return [
            $search,
            $from,
            $to,
            [
                'q' => $search,
                'from' => $from,
                'to' => $to,
            ],
        ];
    }

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
