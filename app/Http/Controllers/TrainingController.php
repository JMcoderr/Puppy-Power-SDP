<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\TrainingEnrollment;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index()
    {
        $trainings = Training::query()
            ->where('is_active', true)
            ->orderBy('starts_on')
            ->get();

        return view('training.index', compact('trainings'));
    }

    public function enroll(Request $request)
    {
        $validated = $request->validate([
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
        $lessons = [
            ['title' => 'Week 1: Focus en rust opbouwen', 'duration' => '18 min'],
            ['title' => 'Week 2: Wandelen zonder trekken', 'duration' => '24 min'],
            ['title' => 'Week 3: Prikkeltraining in de stad', 'duration' => '20 min'],
        ];

        return view('training.content', compact('lessons'));
    }
}
