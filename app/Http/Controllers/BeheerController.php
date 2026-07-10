<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\DaycareRegistration;
use App\Models\TrainingEnrollment;

class BeheerController extends Controller
{
    public function index()
    {
        // simple latest lists for admin overview
        $totals = [
            'enrollments' => TrainingEnrollment::query()->count(),
            'daycare' => DaycareRegistration::query()->count(),
            'messages' => ContactMessage::query()->count(),
        ];

        $enrollments = TrainingEnrollment::query()
            ->with('training')
            ->latest()
            ->take(10)
            ->get();

        $daycareRegistrations = DaycareRegistration::query()
            ->latest()
            ->take(10)
            ->get();

        $contactMessages = ContactMessage::query()
            ->latest()
            ->take(10)
            ->get();

        return view('beheer.index', compact('totals', 'enrollments', 'daycareRegistrations', 'contactMessages'));
    }
}
