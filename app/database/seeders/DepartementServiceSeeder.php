<?php

namespace Database\Seeders;

use App\Models\Departement;
use App\Models\Service;
use Illuminate\Database\Seeder;

class DepartementServiceSeeder extends Seeder
{
    /**
     * Départements et services d'après l'organigramme des Agences de Bassins Hydrauliques.
     */
    public function run(): void
    {
        $structure = [
            'Secrétariat Général' => [
                'description' => 'Rattaché directement à la Direction.',
                'services' => [
                    'Service Informatique et Systèmes d\'Information',
                    'Service de Communication et de Coopération',
                    'Service Contrôle de Gestion et Audit Interne',
                ],
            ],
            'Division Administrative et Financière' => [
                'description' => 'Gestion administrative, financière et des ressources humaines.',
                'services' => [
                    'Service Ressources Humaines et Moyens Généraux',
                    'Service Finances et Programmation',
                    'Service Administratif et Financier',
                    'Service Aides et Redevance',
                    'Service Comptabilité et Marchés',
                ],
            ],
            'Division Évaluation et Planification des Ressources en Eau' => [
                'description' => 'Évaluation, planification et qualité des ressources en eau.',
                'services' => [
                    'Service Évaluation, Planification et Gestion de l\'Eau',
                    'Service Planification des Ressources en Eau et Études',
                    'Service Qualité des Ressources en Eau',
                ],
            ],
            'Division Gestion Durable des Ressources en Eau' => [
                'description' => 'Suivi, gestion et développement durable des ressources en eau.',
                'services' => [
                    'Service Suivi et Évaluation des Ressources en Eau',
                    'Service Gestion et Développement des Ressources en Eau',
                    'Service Travaux et Aménagements Hydrauliques',
                ],
            ],
            'Division Domaine Public Hydraulique' => [
                'description' => 'Gestion, contrôle et affaires juridiques du Domaine Public Hydraulique (DPH).',
                'services' => [
                    'Service Gestion du DPH',
                    'Service Gestion et Contrôle du DPH',
                    'Service des Affaires Juridiques et Contentieux',
                ],
            ],
            'Délégation' => [
                'description' => 'Représentation provinciale de l\'agence.',
                'services' => [
                    'Service Administratif et Financier (Délégation)',
                ],
            ],
        ];

        foreach ($structure as $nomDepartement => $data) {
            $departement = Departement::firstOrCreate(
                ['nomDepartement' => $nomDepartement],
                ['description' => $data['description']]
            );

            foreach ($data['services'] as $nomService) {
                Service::firstOrCreate(
                    [
                        'idDepartement' => $departement->idDepartement,
                        'nomService' => $nomService,
                    ],
                    [
                        'capaciteAccueil' => 3,
                        'description' => null,
                    ]
                );
            }
        }
    }
}
