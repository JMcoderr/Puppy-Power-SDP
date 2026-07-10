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
        $availability = (string) request('availability', 'all');
        $sort = (string) request('sort', 'start_date');

        // only show active trainings, sorted by start date
        // withCount attaches enrollment_count to each training model
        $trainings = Training::query()
            ->withCount('enrollments')
            ->where('is_active', true)
            ->get();

        // add remaining spots so the view and filters can use the same number
        $trainings = $trainings->map(function (Training $training) {
            $training->remaining_spots = max(0, $training->capacity - ($training->enrollments_count ?? 0));

            return $training;
        });

        // filter the collection by whether a training is still open or full
        $trainings = match ($availability) {
            'open' => $trainings->where('remaining_spots', '>', 0),
            'full' => $trainings->where('remaining_spots', 0),
            default => $trainings,
        };

        // sort the collection based on the selected browse mode
        $trainings = (match ($sort) {
            'spots' => $trainings->sortByDesc('remaining_spots'),
            'capacity' => $trainings->sortByDesc('capacity'),
            'name' => $trainings->sortBy('title'),
            default => $trainings->sortBy('starts_on'),
        })->values();

        // summary cards shown above the training grid
        $summary = [
            'active' => $trainings->count(),
            'open' => $trainings->where('remaining_spots', '>', 0)->count(),
            'nextStart' => optional($trainings->sortBy('starts_on')->first()?->starts_on)->format('d-m-Y'),
        ];

        $filters = [
            'availability' => $availability,
            'sort' => $sort,
        ];

        return view('training.index', compact('trainings', 'summary', 'filters'));
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
