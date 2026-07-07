<?php

namespace App\Http\Controllers;

use App\Models\DaycareRegistration;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DaycareController extends Controller
{
    public function index()
    {
        $schedule = collect(range(1, 5))->map(function (int $offset) {
            $date = Carbon::today()->addDays($offset);

            return [
                'date' => $date->format('d-m-Y'),
                'available' => $offset % 2 === 0 ? 'Middag plekken vrij' : 'Ochtend plekken vrij',
            ];
        });

        return view('daycare.index', compact('schedule'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'owner_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'dog_name' => ['required', 'string', 'max:255'],
            'drop_off_date' => ['required', 'date', 'after_or_equal:today'],
            'time_slot' => ['required', 'in:Ochtend,Middag,Hele dag'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        DaycareRegistration::query()->create($validated);

        return back()->with('status', 'Aanmelding voor dagopvang is opgeslagen.');
    }
}
