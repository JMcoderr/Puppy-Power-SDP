<?php

namespace App\Http\Controllers;

// public advice guide with practical help for choosing the right route
class AdviceGuideController extends Controller
{
    public function index()
    {
        $steps = [
            [
                'title' => 'Breng je startsituatie in kaart',
                'copy' => 'Kijk eerst waar je hond vooral op vastloopt: rust, focus, spanning, trekken of dagelijkse structuur.',
            ],
            [
                'title' => 'Kies de route die daarbij past',
                'copy' => 'Gebruik de shop voor thuisoefeningen, training voor begeleiding en dagopvang voor ritme en sociale ondersteuning.',
            ],
            [
                'title' => 'Werk klein maar consequent',
                'copy' => 'Korte herhaalbare stappen werken meestal beter dan te veel tegelijk willen aanpakken.',
            ],
        ];

        $situations = [
            [
                'title' => 'Onrust in huis',
                'copy' => 'Denk aan een combinatie van rustopbouw, korte focusoefeningen en een duidelijk dagritme.',
            ],
            [
                'title' => 'Trekt aan de lijn',
                'copy' => 'Kies een training of cursus die buiten aandacht, tempo en terugschakelen centraal zet.',
            ],
            [
                'title' => 'Snel overprikkeld',
                'copy' => 'Werk met minder prikkels tegelijk en gebruik snuffel- of herstelmomenten tussen actieve stukken door.',
            ],
            [
                'title' => 'Nog jonge puppy',
                'copy' => 'Begin met een zachte basisroute waarin vertrouwen, socialisatie en heldere routines centraal staan.',
            ],
        ];

        $faqs = [
            [
                'question' => 'Waar begin ik als ik nog niet weet wat het probleem precies is?',
                'answer' => 'Gebruik deze gids om je situatie eerst kleiner te maken: waar zie je het gedrag, wanneer gebeurt het en wat wil je als eerste verbeteren? Daarna wordt kiezen veel makkelijker.',
            ],
            [
                'question' => 'Moet ik meteen een training boeken?',
                'answer' => 'Niet altijd. Soms is een cursus of praktisch thuispakket al een goede eerste stap. Als je hond veel spanning of lastig gedrag laat zien, is training vaak sneller passend.',
            ],
            [
                'question' => 'Kan ik shop, training en dagopvang combineren?',
                'answer' => 'Ja. Juist die combinatie maakt het platform sterk: thuis oefenen, professionele begeleiding en extra structuur kunnen elkaar goed aanvullen.',
            ],
        ];

        return view('guide.index', compact('steps', 'situations', 'faqs'));
    }
}