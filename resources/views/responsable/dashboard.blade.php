@extends('layouts.responsable')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')
@section('page-description', 'Vue d\'ensemble des demandes de stage et des affectations.')

@section('content')

@php
    $statutData = [
        ['label' => 'En attente', 'value' => $demandesEnAttente, 'color' => '#d97706'],
        ['label' => 'Infos demandées', 'value' => $demandesInfosDemandees, 'color' => '#7c3aed'],
        ['label' => 'Acceptées', 'value' => $demandesAcceptees, 'color' => '#16a34a'],
        ['label' => 'Refusées', 'value' => $demandesRefusees, 'color' => '#dc2626'],
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
    .donut { width: 120px; height: 120px; border-radius: 50%; background: {{ $conicGradient }}; position: relative; flex-shrink: 0; }
    .donut::after { content: ''; position: absolute; inset: 18px; background: white; border-radius: 50%; }
    .legend-item { display: flex; align-items: center; gap: 8px; font-size: 12.5px; margin-bottom: 8px; color: var(--resp-text); }
    .legend-dot { width: 9px; height: 9px; border-radius: 50%; flex-shrink: 0; }
    .bar-row { margin-bottom: 14px; }
    .bar-row .bar-label { display: flex; justify-content: space-between; font-size: 12.5px; margin-bottom: 5px; color: #475569; }
    .bar-track { height: 8px; background: #f1f5f9; border-radius: 6px; overflow: hidden; }
    .bar-fill { height: 100%; background: linear-gradient(90deg, var(--resp-blue), var(--resp-blue-dark)); border-radius: 6px; }
</style>

<div class="container-fluid px-0">

    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="resp-stat-card">
                <div class="resp-stat-content">
                    <div>
                        <div class="resp-stat-label">Total demandes</div>
                        <div class="resp-stat-number">{{ $totalDemandes }}</div>
                        <div class="resp-stat-description">Demandes enregistrées</div>
                    </div>
                    <div class="resp-stat-icon icon-primary"><i class="bi bi-file-earmark-text"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="resp-stat-card">
                <div class="resp-stat-content">
                    <div>
                        <div class="resp-stat-label">En attente</div>
                        <div class="resp-stat-number text-warning">{{ $demandesEnAttente }}</div>
                        <div class="resp-stat-description">À traiter</div>
                    </div>
                    <div class="resp-stat-icon icon-warning"><i class="bi bi-hourglass-split"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="resp-stat-card">
                <div class="resp-stat-content">
                    <div>
                        <div class="resp-stat-label">Acceptées</div>
                        <div class="resp-stat-number text-success">{{ $demandesAcceptees }}</div>
                        <div class="resp-stat-description">Demandes acceptées</div>
                    </div>
                    <div class="resp-stat-icon icon-success"><i class="bi bi-check-circle"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="resp-stat-card">
                <div class="resp-stat-content">
                    <div>
                        <div class="resp-stat-label">Refusées</div>
                        <div class="resp-stat-number text-danger">{{ $demandesRefusees }}</div>
                        <div class="resp-stat-description">Demandes refusées</div>
                    </div>
                    <div class="resp-stat-icon icon-danger"><i class="bi bi-x-circle"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-4">
            <div class="card p-4 h-100">
                <h6 class="mb-3">Stages en cours</h6>
                <div class="d-flex align-items-center gap-3">
                    <div class="resp-stat-icon icon-primary" style="width:52px;height:52px;font-size:22px;"><i class="bi bi-play-circle-fill"></i></div>
                    <div>
                        <div class="resp-stat-number" style="font-size:28px;">{{ $stagesEnCours }}</div>
                        <div class="resp-stat-description">stagiaires actuellement en poste</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card p-4 h-100">
                <h6 class="mb-3">Attestations</h6>
                <div class="d-flex justify-content-between text-center">
                    <div>
                        <div class="resp-stat-number text-warning" style="font-size:20px;">{{ $attestationsEnPreparation }}</div>
                        <div class="resp-stat-description">En préparation</div>
                    </div>
                    <div>
                        <div class="resp-stat-number text-primary" style="font-size:20px;">{{ $attestationsPretes }}</div>
                        <div class="resp-stat-description">Prêtes</div>
                    </div>
                    <div>
                        <div class="resp-stat-number text-success" style="font-size:20px;">{{ $attestationsRemises }}</div>
                        <div class="resp-stat-description">Remises</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card p-4 h-100 d-flex flex-column justify-content-center gap-2">
                <a href="{{ route('responsable.attestations.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-award-fill me-1"></i> Gérer les attestations
                </a>
                <a href="{{ route('responsable.demandes.index') }}" class="btn btn-primary">
                    <i class="bi bi-search me-1"></i> Voir toutes les demandes
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-5">
            <div class="card p-4 h-100">
                <h6 class="mb-3">Répartition par statut</h6>
                <div class="d-flex align-items-center gap-4">
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
        </div>

        <div class="col-lg-7">
            <div class="card p-4 h-100">
                <h6 class="mb-3">Demandes par service</h6>
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
                    <p class="text-muted small">Aucune demande enregistrée pour le moment.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-white py-3 px-4"><h6 class="mb-0">Dernières demandes déposées</h6></div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
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
                            <td class="fw-bold">{{ $demande->numeroDemande }}</td>
                            <td>{{ $demande->candidat->prenom ?? '' }} {{ $demande->candidat->nom ?? '' }}</td>
                            <td>{{ $demande->service->nomService ?? '—' }}</td>
                            <td><span class="badge bg-secondary-subtle text-dark">{{ $demande->statut }}</span></td>
                            <td>{{ optional($demande->dateDepot)->format('d/m/Y') }}</td>
                            <td><a href="{{ route('responsable.demandes.show', $demande->idDemande) }}" class="text-primary"><i class="bi bi-eye"></i></a></td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">Aucune demande pour le moment.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white text-center py-3">
            <a href="{{ route('responsable.demandes.index') }}" class="btn btn-outline-primary btn-sm">Voir toutes les demandes <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>

</div>

@endsection
