@extends('layouts.responsable')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')
@section('page-subtitle', 'Vue d\'ensemble des demandes de stage et des affectations')

@section('content')

    @php
        $statutData = [
            ['label' => 'En attente', 'value' => $demandesEnAttente, 'color' => '#f59e0b'],
            ['label' => 'Infos demandées', 'value' => $demandesInfosDemandees, 'color' => '#8b5cf6'],
            ['label' => 'Acceptées', 'value' => $demandesAcceptees, 'color' => '#10b981'],
            ['label' => 'Refusées', 'value' => $demandesRefusees, 'color' => '#ef4444'],
        ];
        $statutTotal = max(1, array_sum(array_column($statutData, 'value')));

        $cumul = 0;
        $gradientParts = [];
        foreach ($statutData as $s) {
            $start = $cumul / $statutTotal * 360;
            $cumul += $s['value'];
            $end = $cumul / $statutTotal * 360;
            $gradientParts[] = "{$s['color']} {$start}deg {$end}deg";
        }
        $conicGradient = 'conic-gradient(' . implode(', ', $gradientParts) . ')';
    @endphp

    <style>
        .stat-cards {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 18px 20px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-lg); }

        .stat-card .icon {
            width: 38px; height: 38px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; margin-bottom: 12px;
        }
        .stat-card .label { font-size: 12px; color: #64748b; margin-bottom: 4px; }
        .stat-card .value { font-size: 24px; font-weight: 700; color: var(--c-navy); }

        .icon-blue { background: #dbeafe; color: #1e40af; }
        .icon-amber { background: #fef3c7; color: #92400e; }
        .icon-purple { background: #ede9fe; color: #5b21b6; }
        .icon-green { background: #d1fae5; color: #065f46; }
        .icon-red { background: #fee2e2; color: #991b1b; }
        .icon-teal { background: var(--c-teal-pale); color: var(--c-teal-dark); }

        .grid-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 18px;
            margin-bottom: 24px;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1.3fr 1fr;
            gap: 18px;
        }

        .card h3 { font-size: 14.5px; color: var(--c-navy); margin-bottom: 16px; }

        .donut-wrap { display: flex; align-items: center; gap: 20px; }

        .donut {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: {{ $conicGradient }};
            position: relative;
            flex-shrink: 0;
        }
        .donut::after {
            content: '';
            position: absolute;
            inset: 18px;
            background: white;
            border-radius: 50%;
        }

        .legend-item { display: flex; align-items: center; gap: 8px; font-size: 12.5px; margin-bottom: 8px; }
        .legend-dot { width: 9px; height: 9px; border-radius: 50%; flex-shrink: 0; }

        .bar-row { margin-bottom: 14px; }
        .bar-row .bar-label { display: flex; justify-content: space-between; font-size: 12.5px; margin-bottom: 5px; color: #475569; }
        .bar-track { height: 8px; background: #f1f5f9; border-radius: 6px; overflow: hidden; }
        .bar-fill { height: 100%; background: linear-gradient(90deg, var(--c-teal), var(--c-teal-dark)); border-radius: 6px; }

        .quick-actions { display: flex; gap: 12px; flex-wrap: wrap; margin-top: 20px; }

        @media (max-width: 1100px) {
            .stat-cards { grid-template-columns: repeat(2, 1fr); }
            .grid-3, .grid-2 { grid-template-columns: 1fr; }
        }
    </style>

    <div class="stat-cards">
        <div class="stat-card">
            <div class="icon icon-blue"><i class="bi bi-file-earmark-text-fill"></i></div>
            <div class="label">Total demandes</div>
            <div class="value">{{ $totalDemandes }}</div>
        </div>
        <div class="stat-card">
            <div class="icon icon-amber"><i class="bi bi-hourglass-split"></i></div>
            <div class="label">En attente</div>
            <div class="value">{{ $demandesEnAttente }}</div>
        </div>
        <div class="stat-card">
            <div class="icon icon-purple"><i class="bi bi-question-circle-fill"></i></div>
            <div class="label">Infos demandées</div>
            <div class="value">{{ $demandesInfosDemandees }}</div>
        </div>
        <div class="stat-card">
            <div class="icon icon-green"><i class="bi bi-check-circle-fill"></i></div>
            <div class="label">Acceptées</div>
            <div class="value">{{ $demandesAcceptees }}</div>
        </div>
        <div class="stat-card">
            <div class="icon icon-red"><i class="bi bi-x-circle-fill"></i></div>
            <div class="label">Refusées</div>
            <div class="value">{{ $demandesRefusees }}</div>
        </div>
    </div>

    <div class="grid-3">
        <div class="card">
            <h3>Stages en cours</h3>
            <div style="display:flex;align-items:center;gap:14px;">
                <div class="icon icon-teal" style="width:48px;height:48px;font-size:22px;"><i class="bi bi-play-circle-fill"></i></div>
                <div>
                    <div class="value" style="font-size:28px;">{{ $stagesEnCours }}</div>
                    <div class="label">stagiaires actuellement en poste</div>
                </div>
            </div>
        </div>
        <div class="card">
            <h3>Attestations</h3>
            <div style="display:flex;justify-content:space-between;text-align:center;">
                <div>
                    <div class="value" style="font-size:20px;color:#92400e;">{{ $attestationsEnPreparation }}</div>
                    <div class="label">En préparation</div>
                </div>
                <div>
                    <div class="value" style="font-size:20px;color:#1e40af;">{{ $attestationsPretes }}</div>
                    <div class="label">Prêtes</div>
                </div>
                <div>
                    <div class="value" style="font-size:20px;color:#065f46;">{{ $attestationsRemises }}</div>
                    <div class="label">Remises</div>
                </div>
            </div>
        </div>
        <div class="card" style="display:flex;flex-direction:column;justify-content:center;">
            <a href="{{ route('responsable.attestations.index') }}" class="btn btn-secondary" style="justify-content:center;margin-bottom:10px;">
                <i class="bi bi-award-fill"></i> Gérer les attestations
            </a>
            <a href="{{ route('responsable.demandes.index') }}" class="btn btn-outline" style="justify-content:center;">
                <i class="bi bi-search"></i> Voir toutes les demandes
            </a>
        </div>
    </div>

    <div class="grid-2">
        <div class="card">
            <h3>Répartition par statut</h3>
            <div class="donut-wrap">
                <div class="donut"></div>
                <div>
                    @foreach ($statutData as $s)
                        <div class="legend-item">
                            <span class="legend-dot" style="background:{{ $s['color'] }};"></span>
                            {{ $s['label'] }} — <strong>{{ $s['value'] }}</strong>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="card">
            <h3>Demandes par service</h3>
            @forelse ($demandesParService as $service)
                <div class="bar-row">
                    <div class="bar-label">
                        <span>{{ $service->nomService }}</span>
                        <span>{{ $service->demandes_count }}</span>
                    </div>
                    <div class="bar-track">
                        <div class="bar-fill" style="width: {{ round($service->demandes_count / $maxParService * 100) }}%;"></div>
                    </div>
                </div>
            @empty
                <p style="color:#94a3b8;font-size:13px;">Aucune demande enregistrée pour le moment.</p>
            @endforelse
        </div>
    </div>

    <div class="card" style="margin-top:18px;">
        <h3>Dernières demandes déposées</h3>
        <table>
            <thead>
                <tr>
                    <th>N° Demande</th>
                    <th>Candidat</th>
                    <th>Service</th>
                    <th>Statut</th>
                    <th>Date dépôt</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dernieresDemandes as $demande)
                    <tr>
                        <td style="font-weight:600;color:var(--c-navy);">{{ $demande->numeroDemande }}</td>
                        <td>{{ $demande->candidat->prenom ?? '' }} {{ $demande->candidat->nom ?? '' }}</td>
                        <td>{{ $demande->service->nomService ?? '—' }}</td>
                        <td><span class="badge badge-{{ $demande->statut }}">{{ $demande->statut }}</span></td>
                        <td>{{ optional($demande->dateDepot)->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('responsable.demandes.show', $demande->idDemande) }}" style="color:var(--c-teal-dark);font-weight:600;">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="text-align:center;color:#94a3b8;padding:24px;">Aucune demande pour le moment.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div style="text-align:center;margin-top:16px;">
            <a href="{{ route('responsable.demandes.index') }}" class="btn btn-outline">Voir toutes les demandes <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>

@endsection
