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
        $focus = (string) request('focus', 'all');
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

            $meta = match ($training->slug) {
                'puppytraining' => [
                    'focus' => 'basis',
                    'level' => 'Starter',
                    'highlights' => ['Socialisatie', 'Basiscommando\'s'],
                ],
                'vuurwerkangst' => [
                    'focus' => 'zelfvertrouwen',
                    'level' => 'Rust',
                    'highlights' => ['Geluidstraining', 'Rustopbouw'],
                ],
                'gedragstraining' => [
                    'focus' => 'gedrag',
                    'level' => 'Begeleiding',
                    'highlights' => ['Uitvalgedrag', 'Prikkelcontrole'],
                ],
                'pubertraining' => [
                    'focus' => 'focus',
                    'level' => 'Midden',
                    'highlights' => ['Luisteren', 'Grenzen oefenen'],
                ],
                'sociale-wandeling' => [
                    'focus' => 'zelfvertrouwen',
                    'level' => 'Opbouw',
                    'highlights' => ['Rustig passeren', 'Samen wandelen'],
                ],
                'loslopen-en-terugroepen' => [
                    'focus' => 'focus',
                    'level' => 'Buitenwerk',
                    'highlights' => ['Terugroepen', 'Lijncontrole'],
                ],
                'rust-in-huis' => [
                    'focus' => 'gedrag',
                    'level' => 'Thuisrust',
                    'highlights' => ['Ontspanning', 'Prikkelreductie'],
                ],
                'zelfvertrouwen-op-straat' => [
                    'focus' => 'zelfvertrouwen',
                    'level' => 'Buitenrust',
                    'highlights' => ['Rustig observeren', 'Spanning verlagen'],
                ],
                'snuffel-en-focuswerk' => [
                    'focus' => 'focus',
                    'level' => 'Verrijking',
                    'highlights' => ['Neuswerk', 'Concentratie'],
                ],
                'basis-herstart' => [
                    'focus' => 'basis',
                    'level' => 'Herstart',
                    'highlights' => ['Opnieuw opbouwen', 'Dagelijkse structuur'],
                ],
                default => [
                    'focus' => 'basis',
                    'level' => 'Algemeen',
                    'highlights' => ['Praktische tips', 'Dagelijkse oefeningen'],
                ],
            };

            $training->focus = $meta['focus'];
            $training->level = $meta['level'];
            $training->highlights = $meta['highlights'];

            return $training;
        });

        // filter the collection by whether a training is still open or full
        $trainings = match ($availability) {
            'open' => $trainings->where('remaining_spots', '>', 0),
            'full' => $trainings->where('remaining_spots', 0),
            default => $trainings,
        };

        // filter by the kind of help the visitor is looking for
        $trainings = match ($focus) {
            'basis' => $trainings->where('focus', 'basis'),
            'gedrag' => $trainings->where('focus', 'gedrag'),
            'zelfvertrouwen' => $trainings->where('focus', 'zelfvertrouwen'),
            'focus' => $trainings->where('focus', 'focus'),
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
            'behaviour' => $trainings->where('focus', 'gedrag')->count(),
        ];

        $filters = [
            'availability' => $availability,
            'focus' => $focus,
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
            ['title' => 'Week 1: Focus en rust opbouwen', 'duration' => '18 min', 'level' => 'Start', 'status' => 'Nu bekijken', 'summary' => 'Leer hoe je sessies kort, duidelijk en rustig opbouwt zodat je hond beter kan schakelen.'],
            ['title' => 'Week 2: Wandelen zonder trekken', 'duration' => '24 min', 'level' => 'Basis', 'status' => 'Volgende stap', 'summary' => 'Werk aan tempo, aandacht en lijngevoel tijdens dagelijkse wandelmomenten.'],
            ['title' => 'Week 3: Prikkeltraining in de stad', 'duration' => '20 min', 'level' => 'Gevorderd', 'status' => 'Komt hierna', 'summary' => 'Gebruik afstand, timing en rustmomenten om beter om te gaan met drukte en afleiding.'],
            ['title' => 'Week 4: Bezoek ontvangen zonder chaos', 'duration' => '16 min', 'level' => 'Thuis', 'status' => 'Hierna vrij', 'summary' => 'Maak een duidelijk plan voor binnenkomen, begroeten en het bewaken van rust in huis.'],
            ['title' => 'Week 5: Snuffelwerk als herstelmoment', 'duration' => '14 min', 'level' => 'Herstel', 'status' => 'Bonusles', 'summary' => 'Ontdek hoe neuswerk helpt om spanning te zakken en focus op een rustige manier op te bouwen.'],
        ];

        return view('training.content', compact('lessons'));
    }
}
