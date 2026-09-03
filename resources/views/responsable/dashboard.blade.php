@extends('layouts.responsable')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')
@section('page-description', 'Vue d\'ensemble des demandes de stage et des affectations.')

@section('content')

@php
    $statutData = [
        ['label' => 'En attente', 'value' => $demandesEnAttente, 'color' => '#F5A623'],
        ['label' => 'Infos demandées', 'value' => $demandesInfosDemandees, 'color' => '#008FD5'],
        ['label' => 'Acceptées', 'value' => $demandesAcceptees, 'color' => '#8BD63C'],
        ['label' => 'Refusées', 'value' => $demandesRefusees, 'color' => '#FF5C7A'],
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

    $badgeColors = [
        'EN_ATTENTE' => ['bg' => 'rgba(245,166,35,.16)', 'text' => '#F5A623'],
        'INFOS_DEMANDEES' => ['bg' => 'rgba(0,143,213,.16)', 'text' => '#4DB8F0'],
        'ACCEPTEE' => ['bg' => 'rgba(139,214,60,.16)', 'text' => '#8BD63C'],
        'REFUSEE' => ['bg' => 'rgba(255,92,122,.16)', 'text' => '#FF8FA3'],
        'STAGE_EN_COURS' => ['bg' => 'rgba(0,217,208,.16)', 'text' => '#00D9D0'],
        'TERMINE' => ['bg' => 'rgba(139,92,246,.16)', 'text' => '#B79CFB'],
    ];
@endphp

<style>
    .donut { width: 120px; height: 120px; border-radius: 50%; background: {{ $conicGradient }}; position: relative; flex-shrink: 0; }
    .donut::after { content: ''; position: absolute; inset: 18px; background: #061622; border-radius: 50%; }
    .legend-item { display: flex; align-items: center; gap: 8px; font-size: 12.5px; margin-bottom: 8px; color: var(--resp-text); }
    .legend-dot { width: 9px; height: 9px; border-radius: 50%; flex-shrink: 0; }
    .bar-row { margin-bottom: 14px; }
    .bar-row .bar-label { display: flex; justify-content: space-between; font-size: 12.5px; margin-bottom: 5px; color: var(--resp-text); }
    .bar-track { height: 8px; background: rgba(255,255,255,.06); border-radius: 6px; overflow: hidden; }
    .bar-fill { height: 100%; background: linear-gradient(90deg, var(--resp-blue), var(--resp-blue-dark)); border-radius: 6px; }
    .status-badge { border-radius: 7px; padding: 6px 10px; font-size: 10.5px; font-weight: 700; letter-spacing: .3px; text-transform: uppercase; display: inline-block; }
    .docs-illustration {
        width: 80px; height: 80px; border-radius: 16px; margin: 0 auto 18px;
        background: linear-gradient(135deg, rgba(0,217,208,.18), rgba(0,143,213,.18));
        border: 1px solid var(--resp-border);
        display: flex; align-items: center; justify-content: center; font-size: 30px; color: var(--aqua-cyan);
    }
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
                        <div class="resp-stat-number" style="color:var(--resp-warning);">{{ $demandesEnAttente }}</div>
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
                        <div class="resp-stat-number" style="color:var(--resp-success);">{{ $demandesAcceptees }}</div>
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
                        <div class="resp-stat-number" style="color:var(--resp-danger);">{{ $demandesRefusees }}</div>
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
                    <div class="resp-stat-icon icon-primary" style="width:52px;height:52px;font-size:22px;"><i class="bi bi-mortarboard-fill"></i></div>
                    <div>
                        <div class="resp-stat-number" style="font-size:28px;">{{ $stagesEnCours }}</div>
                        <div class="resp-stat-description">stagiaire(s) actuellement en poste</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card p-4 h-100 d-flex flex-column">
                <h6 class="mb-3">Attestations</h6>
                <div class="d-flex justify-content-between text-center mb-3">
                    <div>
                        <div class="resp-stat-number" style="font-size:20px;color:var(--resp-warning);">{{ $attestationsEnPreparation }}</div>
                        <div class="resp-stat-description">En préparation</div>
                    </div>
                    <div>
                        <div class="resp-stat-number" style="font-size:20px;color:var(--aqua-blue-water);">{{ $attestationsPretes }}</div>
                        <div class="resp-stat-description">Prêtes</div>
                    </div>
                    <div>
                        <div class="resp-stat-number" style="font-size:20px;color:var(--resp-success);">{{ $attestationsRemises }}</div>
                        <div class="resp-stat-description">Remises</div>
                    </div>
                </div>
                <a href="{{ route('responsable.attestations.index') }}" class="btn btn-outline-primary mt-auto">
                    <i class="bi bi-award-fill me-1"></i> Gérer les attestations
                </a>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card p-4 h-100 d-flex flex-column justify-content-center align-items-center text-center">
                <div class="docs-illustration"><i class="bi bi-files"></i></div>
                <a href="{{ route('responsable.demandes.index') }}" class="btn btn-primary w-100">
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
                    <p class="small" style="color:var(--resp-muted);">Aucune demande enregistrée pour le moment.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header py-3 px-4" style="background:transparent;border-bottom:1px solid var(--resp-border);"><h6 class="mb-0">Dernières demandes déposées</h6></div>
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
                        @php $bc = $badgeColors[$demande->statut] ?? ['bg' => 'rgba(255,255,255,.08)', 'text' => 'var(--resp-muted)']; @endphp
                        <tr>
                            <td class="fw-bold">{{ $demande->numeroDemande }}</td>
                            <td>{{ $demande->candidat->prenom ?? '' }} {{ $demande->candidat->nom ?? '' }}</td>
                            <td>{{ $demande->service->nomService ?? '—' }}</td>
                            <td><span class="status-badge" style="background:{{ $bc['bg'] }};color:{{ $bc['text'] }};">{{ str_replace('_', ' ', $demande->statut) }}</span></td>
                            <td>{{ optional($demande->dateDepot)->format('d/m/Y') }}</td>
                            <td><a href="{{ route('responsable.demandes.show', $demande->idDemande) }}" style="color:var(--aqua-cyan);"><i class="bi bi-eye"></i></a></td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-4" style="color:var(--resp-muted);">Aucune demande pour le moment.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer text-center py-3" style="background:transparent;border-top:1px solid var(--resp-border);">
            <a href="{{ route('responsable.demandes.index') }}" class="btn btn-outline-primary btn-sm">Voir toutes les demandes <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>

</div>

@endsection
