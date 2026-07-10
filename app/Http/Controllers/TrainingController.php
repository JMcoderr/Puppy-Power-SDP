<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\TrainingEnrollment;
use Illuminate\Http\Request;

// handles the public training overview page, enrollment, and protected content
class TrainingController extends Controller
{
    public function index()
    {
        // only show active trainings, sorted by start date
        // withCount attaches enrollment_count to each training model
        $trainings = Training::query()
            ->withCount('enrollments')
            ->where('is_active', true)
            ->orderBy('starts_on')
            ->get();

        return view('training.index', compact('trainings'));
    }

    public function enroll(Request $request)
    {
        // validate the enrollment form fields
        $validated = $request->validate([
            // training_id must exist in the trainings table
            'training_id' => ['required', 'exists:trainings,id'],
            'owner_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'dog_name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        TrainingEnrollment::query()->create($validated);

        return back()->with('status', 'Inschrijving ontvangen! We nemen snel contact op.');
    }

    public function content()
    {
        // static lesson list shown to authenticated users only
        $lessons = [
            ['title' => 'Week 1: Focus en rust opbouwen', 'duration' => '18 min', 'level' => 'Start', 'status' => 'Nu bekijken'],
            ['title' => 'Week 2: Wandelen zonder trekken', 'duration' => '24 min', 'level' => 'Basis', 'status' => 'Volgende stap'],
            ['title' => 'Week 3: Prikkeltraining in de stad', 'duration' => '20 min', 'level' => 'Gevorderd', 'status' => 'Komt hierna'],
        ];

        return view('training.content', compact('lessons'));
    }
}
