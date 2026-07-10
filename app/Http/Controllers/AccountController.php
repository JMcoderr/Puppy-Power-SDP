<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Training;

// simple member dashboard with quick actions and account overview
class AccountController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $checklist = [
            'Kies een training die past bij het gedrag of niveau van je hond.',
            'Gebruik de dagopvang voor extra structuur of sociale oefenmomenten.',
            'Stel via contact een gerichte vraag als je nog twijfelt over de juiste route.',
        ];

        $nextSteps = [
            [
                'title' => 'Verdiep je in trainingscontent',
                'copy' => 'Logisch als je al bent ingelogd en meteen zelfstandig verder wilt.',
                'route' => route('training.content'),
                'label' => 'Open content',
            ],
            [
                'title' => 'Plan een praktische volgende stap',
                'copy' => 'Bekijk trainingen of plan dagopvang als je graag ritme wilt opbouwen.',
                'route' => route('training.index'),
                'label' => 'Bekijk trainingen',
            ],
            [
                'title' => 'Vraag persoonlijk advies',
                'copy' => 'Gebruik contact voor twijfelgevallen, gedragssituaties of productadvies.',
                'route' => route('contact.index'),
                'label' => 'Neem contact op',
            ],
        ];

        $summary = [
            'products' => Product::query()->where('is_active', true)->count(),
            'trainings' => Training::query()->where('is_active', true)->count(),
            'role' => $user->is_admin ? 'Administrator' : 'Lid',
            'memberSince' => optional($user->created_at)->format('d-m-Y'),
        ];

        return view('account.index', compact('user', 'summary', 'checklist', 'nextSteps'));
    }
}
