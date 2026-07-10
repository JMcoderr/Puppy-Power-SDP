<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\DaycareRegistration;
use App\Models\TrainingEnrollment;

class BeheerController extends Controller
{
    public function index()
    {
        $search = trim((string) request('q', ''));
        $from = request('from');
        $to = request('to');

        // simple latest lists for admin overview
        $totals = [
            'enrollments' => TrainingEnrollment::query()->count(),
            'daycare' => DaycareRegistration::query()->count(),
            'messages' => ContactMessage::query()->count(),
        ];

        $enrollmentsQuery = TrainingEnrollment::query()
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

        $daycareQuery = DaycareRegistration::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($nested) use ($search) {
                    $nested->where('owner_name', 'like', "%{$search}%")
                        ->orWhere('dog_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($from, fn ($query) => $query->whereDate('created_at', '>=', $from))
            ->when($to, fn ($query) => $query->whereDate('created_at', '<=', $to));

        $messagesQuery = ContactMessage::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($nested) use ($search) {
                    $nested->where('name', 'like', "%{$search}%")
                        ->orWhere('subject', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($from, fn ($query) => $query->whereDate('created_at', '>=', $from))
            ->when($to, fn ($query) => $query->whereDate('created_at', '<=', $to));

        $enrollments = (clone $enrollmentsQuery)
            ->latest()
            ->take(10)
            ->get();

        $daycareRegistrations = (clone $daycareQuery)
            ->latest()
            ->take(10)
            ->get();

        $contactMessages = (clone $messagesQuery)
            ->latest()
            ->take(10)
            ->get();

        $filteredCounts = [
            'enrollments' => (clone $enrollmentsQuery)->count(),
            'daycare' => (clone $daycareQuery)->count(),
            'messages' => (clone $messagesQuery)->count(),
        ];

        $filters = [
            'q' => $search,
            'from' => $from,
            'to' => $to,
        ];

        return view('beheer.index', compact('totals', 'filteredCounts', 'filters', 'enrollments', 'daycareRegistrations', 'contactMessages'));
    }
}
