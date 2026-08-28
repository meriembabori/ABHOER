<?php

namespace App\Http\Controllers;

class AccueilController extends Controller
{
    public function index()
    {
        $services = [
            [
                'nom' => 'Secrétariat Général',
                'description' => "Coordination générale, systèmes d'information, communication et audit interne.",
                'icone' => 'ti-building-bank',
            ],
            [
                'nom' => 'Division Administrative et Financière',
                'description' => 'Ressources humaines, finances, programmation budgétaire et marchés publics.',
                'icone' => 'ti-report-money',
            ],
            [
                'nom' => 'Division Évaluation et Planification des Ressources en Eau',
                'description' => "Évaluation, planification et suivi de la qualité des ressources en eau du bassin.",
                'icone' => 'ti-chart-histogram',
            ],
            [
                'nom' => 'Division Gestion Durable des Ressources en Eau',
                'description' => 'Suivi, développement durable, travaux et aménagements hydrauliques.',
                'icone' => 'ti-droplet',
            ],
            [
                'nom' => 'Division Domaine Public Hydraulique',
                'description' => 'Gestion, contrôle et affaires juridiques du domaine public hydraulique (DPH).',
                'icone' => 'ti-gavel',
            ],
            [
                'nom' => 'Délégation Provinciale',
                'description' => "Représentation de l'agence au niveau provincial.",
                'icone' => 'ti-map-pin',
            ],
        ];

        $galerie = [
            ['src' => 'images/bassin/barrage-1.jpeg', 'legende' => "Vue aérienne du barrage et de la retenue d'eau"],
            ['src' => 'images/bassin/barrage-2.jpeg', 'legende' => "Ouvrage hydraulique surplombant la vallée de l'Oum Er-Rbia"],
            ['src' => 'images/bassin/montage-barrages.png', 'legende' => 'Ouvrages hydrauliques du bassin'],
            ['src' => 'images/bassin/carte-bassin.png', 'legende' => "Le bassin de l'Oum Er-Rbia — zone d'action de l'agence"],
            ['src' => 'images/bassin/carte-precipitation.png', 'legende' => 'Carte de précipitation du bassin versant'],
        ];

        return view('accueil', [
            'services' => $services,
            'galerie' => $galerie,
            'latitude' => 32.3394444,
            'longitude' => -6.3608333,
        ]);
    }
}
