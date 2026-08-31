<?php

namespace App\Http\Controllers;

class AccueilController extends Controller
{
    private function listeServices(): array
    {
        return [
            [
                'nom' => 'Secrétariat Général',
                'description' => "Coordination générale, systèmes d'information, communication et audit interne.",
                'icone' => 'bi-bank2',
            ],
            [
                'nom' => 'Division Administrative et Financière',
                'description' => 'Ressources humaines, finances, programmation budgétaire et marchés publics.',
                'icone' => 'bi-cash-coin',
            ],
            [
                'nom' => 'Division Évaluation et Planification des Ressources en Eau',
                'description' => "Évaluation, planification et suivi de la qualité des ressources en eau du bassin.",
                'icone' => 'bi-bar-chart-fill',
            ],
            [
                'nom' => 'Division Gestion Durable des Ressources en Eau',
                'description' => 'Suivi, développement durable, travaux et aménagements hydrauliques.',
                'icone' => 'bi-droplet-fill',
            ],
            [
                'nom' => 'Division Domaine Public Hydraulique',
                'description' => 'Gestion, contrôle et affaires juridiques du domaine public hydraulique (DPH).',
                'icone' => 'bi-shield-check',
            ],
            [
                'nom' => 'Délégation Provinciale',
                'description' => "Représentation de l'agence au niveau provincial.",
                'icone' => 'bi-geo-alt-fill',
            ],
        ];
    }

    private function listeGalerie(): array
    {
        return [
            ['src' => 'images/bassin/barrage-al-massira.jpeg', 'legende' => "Barrage Al Massira, lâcher d'eau"],
            ['src' => 'images/bassin/barrage-1.jpeg', 'legende' => "Vue aérienne du barrage et de la retenue d'eau"],
            ['src' => 'images/bassin/barrage-2.jpeg', 'legende' => "Ouvrage hydraulique surplombant la vallée de l'Oum Er-Rbia"],
            ['src' => 'images/bassin/montage-barrages.png', 'legende' => 'Ouvrages hydrauliques du bassin'],
            ['src' => 'images/bassin/carte-bassin.png', 'legende' => "Le bassin de l'Oum Er-Rbia — zone d'action de l'agence"],
        ];
    }

    public function index()
    {
        return view('accueil.index', [
            'services' => $this->listeServices(),
            'galerie' => $this->listeGalerie(),
            'latitude' => 32.3394444,
            'longitude' => -6.3608333,
        ]);
    }

    public function services()
    {
        return view('accueil.services', [
            'services' => $this->listeServices(),
        ]);
    }

    public function localisation()
    {
        return view('accueil.localisation', [
            'galerie' => $this->listeGalerie(),
            'latitude' => 32.3394444,
            'longitude' => -6.3608333,
        ]);
    }
}
