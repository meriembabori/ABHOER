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
                'detail' => "Le Secrétariat Général assure la coordination générale de l'ensemble des divisions de l'ABHOER. Il pilote les systèmes d'information de l'agence, gère la communication institutionnelle interne et externe, et supervise les missions d'audit interne afin de garantir la transparence et la bonne gouvernance de l'établissement.",
                'icone' => 'bi-bank2',
            ],
            [
                'nom' => 'Division Administrative et Financière',
                'description' => 'Ressources humaines, finances, programmation budgétaire et marchés publics.',
                'detail' => "La Division Administrative et Financière gère l'ensemble des ressources humaines de l'agence, élabore et suit la programmation budgétaire annuelle, et supervise la passation et l'exécution des marchés publics dans le respect de la réglementation en vigueur.",
                'icone' => 'bi-cash-coin',
            ],
            [
                'nom' => 'Division Évaluation et Planification des Ressources en Eau',
                'description' => "Évaluation, planification et suivi de la qualité des ressources en eau du bassin.",
                'detail' => "Cette division évalue quantitativement et qualitativement les ressources en eau du bassin de l'Oum Er-Rbia. Elle élabore les plans directeurs d'aménagement des eaux, assure le suivi piézométrique et hydrométrique, et surveille en continu la qualité des eaux superficielles et souterraines.",
                'icone' => 'bi-bar-chart-fill',
            ],
            [
                'nom' => 'Division Gestion Durable des Ressources en Eau',
                'description' => 'Suivi, développement durable, travaux et aménagements hydrauliques.',
                'detail' => "La Division Gestion Durable des Ressources en Eau conçoit et supervise les travaux et aménagements hydrauliques du bassin. Elle promeut une gestion durable et intégrée de l'eau, en veillant à concilier les besoins en eau potable, agricole et industriel avec la préservation de la ressource.",
                'icone' => 'bi-droplet-fill',
            ],
            [
                'nom' => 'Division Domaine Public Hydraulique',
                'description' => 'Gestion, contrôle et affaires juridiques du domaine public hydraulique (DPH).',
                'detail' => "Cette division gère et protège le Domaine Public Hydraulique (DPH). Elle délivre les autorisations et concessions d'occupation, contrôle les prélèvements et rejets, et traite les affaires juridiques et le contentieux liés à la protection du domaine public hydraulique.",
                'icone' => 'bi-shield-check',
            ],
            [
                'nom' => 'Délégation Provinciale',
                'description' => "Représentation de l'agence au niveau provincial.",
                'detail' => "La Délégation Provinciale représente l'ABHOER au plus près des usagers et des acteurs locaux. Elle assure l'accueil du public, l'instruction des dossiers de proximité et la coordination avec les autorités et collectivités territoriales des provinces du bassin.",
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
