@extends('layouts.etudiant')

@section('title', 'Tableau de bord')
@section('page-title', 'Bonjour ' . ($user->prenom ?? $user->nom ?? '') . ' 👋')
@section('page-description', 'Bienvenue dans votre espace étudiant ABHOER. Suivez vos demandes et gérez vos stages facilement.')

@section('content')

@php
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
    .status-badge { border-radius: 7px; padding: 6px 10px; font-size: 10.5px; font-weight: 700; letter-spacing: .3px; text-transform: uppercase; display: inline-block; }
</style>

<div class="container-fluid px-0">

    @if ($candidat)
        <div class="card p-4 mb-4 d-flex flex-row justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="etud-stat-icon icon-primary" style="width:52px;height:52px;font-size:22px;"><i class="bi bi-person-fill"></i></div>
                <div>
                    <div class="fw-bold" style="color:var(--etud-text);">{{ $candidat->prenom ?? '' }} {{ $candidat->nom ?? '' }}</div>
                    <div class="small" style="color:var(--etud-muted);">{{ $candidat->formation ?? 'Étudiant(e)' }}</div>
                </div>
            </div>
            <a href="{{ route('etudiant.profil') }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-person-vcard-fill me-1"></i> Mon profil</a>
        </div>
    @endif

    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="etud-stat-card">
                <div class="etud-stat-content">
                    <div>
                        <div class="etud-stat-label">Mes demandes</div>
                        <div class="etud-stat-number">{{ $totalDemandes }}</div>
                        <div class="etud-stat-description">Demande(s) déposée(s)</div>
                    </div>
                    <div class="etud-stat-icon icon-primary"><i class="bi bi-file-earmark-text"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="etud-stat-card">
                <div class="etud-stat-content">
                    <div>
                        <div class="etud-stat-label">En attente</div>
                        <div class="etud-stat-number" style="color:var(--etud-warning);">{{ $demandesEnAttente }}</div>
                        <div class="etud-stat-description">En attente de traitement</div>
                    </div>
                    <div class="etud-stat-icon icon-warning"><i class="bi bi-hourglass-split"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="etud-stat-card">
                <div class="etud-stat-content">
                    <div>
                        <div class="etud-stat-label">Acceptées</div>
                        <div class="etud-stat-number" style="color:var(--etud-success);">{{ $demandesAcceptees }}</div>
                        <div class="etud-stat-description">Demande(s) acceptée(s)</div>
                    </div>
                    <div class="etud-stat-icon icon-success"><i class="bi bi-check-circle"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="etud-stat-card">
                <div class="etud-stat-content">
                    <div>
                        <div class="etud-stat-label">Refusées</div>
                        <div class="etud-stat-number" style="color:var(--etud-danger);">{{ $demandesRefusees }}</div>
                        <div class="etud-stat-description">Demande(s) refusée(s)</div>
                    </div>
                    <div class="etud-stat-icon icon-danger"><i class="bi bi-x-circle"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card p-4 mb-4 text-white" style="background: linear-gradient(135deg, #063142, #0d9488); border-color: rgba(0,217,208,.25);">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h6 class="mb-1 text-white">Vous souhaitez effectuer un stage ?</h6>
                <p class="mb-0 small" style="opacity:.85;">Déposez une nouvelle demande de stage auprès de l'ABHOER et suivez son traitement depuis votre espace étudiant.</p>
            </div>
            <a href="{{ route('etudiant.demandes.create') }}" class="btn btn-sm" style="background:#fff;color:#063142;font-weight:700;"><i class="bi bi-plus-lg me-1"></i> Nouvelle demande</a>
        </div>
    </div>

    @if ($stagesEnCours > 0)
        <div class="alert alert-success etud-alert mb-4 d-flex align-items-center gap-2">
            <i class="bi bi-briefcase-fill fs-5"></i>
            <div>
                <strong>Stage en cours</strong><br>
                <span class="small">Vous avez actuellement {{ $stagesEnCours }} stage(s) en cours.</span>
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-header py-3 px-4 d-flex justify-content-between align-items-center" style="background:transparent;border-bottom:1px solid var(--etud-border);">
            <div>
                <h6 class="mb-1">Mes dernières demandes</h6>
                <span class="small" style="color:var(--etud-muted);">Consultez l'état de vos demandes de stage.</span>
            </div>
            <a href="{{ route('etudiant.demandes.index') }}" class="btn btn-outline-primary btn-sm">Voir tout <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>N° Demande</th>
                        <th>Service</th>
                        <th>Date de dépôt</th>
                        <th>Statut</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dernieresDemandes as $demande)
                        @php $bc = $badgeColors[$demande->statut] ?? ['bg' => 'rgba(255,255,255,.08)', 'text' => 'var(--etud-muted)']; @endphp
                        <tr>
                            <td class="fw-bold">{{ $demande->numeroDemande }}</td>
                            <td>{{ $demande->service->nomService ?? '—' }}</td>
                            <td>{{ optional($demande->dateDepot)->format('d/m/Y') }}</td>
                            <td><span class="status-badge" style="background:{{ $bc['bg'] }};color:{{ $bc['text'] }};">{{ str_replace('_', ' ', $demande->statut) }}</span></td>
                            <td><a href="{{ route('etudiant.demandes.show', $demande->idDemande) }}" style="color:var(--aqua-cyan);"><i class="bi bi-eye"></i></a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5" style="color:var(--etud-muted);">
                                Vous n'avez encore déposé aucune demande.<br>
                                <a href="{{ route('etudiant.demandes.create') }}" class="btn btn-primary btn-sm mt-3"><i class="bi bi-file-earmark-plus-fill me-1"></i> Déposer ma première demande</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
