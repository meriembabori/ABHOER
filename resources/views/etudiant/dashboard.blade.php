@extends('layouts.etudiant')

@section('title', 'Tableau de bord')
@section('page-title', 'Bonjour ' . ($user->prenom ?? $user->nom ?? '') . ' 👋')
@section('page-description', 'Bienvenue dans votre espace étudiant ABHOER. Suivez vos demandes et gérez vos stages facilement.')

@section('content')

<div class="container-fluid px-0">

    @if ($candidat)
        <div class="card p-4 mb-4 d-flex flex-row justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="etud-stat-icon icon-primary" style="width:52px;height:52px;font-size:22px;"><i class="bi bi-person-fill"></i></div>
                <div>
                    <div class="fw-bold" style="color:var(--etud-text);">{{ $candidat->prenom ?? '' }} {{ $candidat->nom ?? '' }}</div>
                    <div class="small text-muted">{{ $candidat->formation ?? 'Étudiant(e)' }}</div>
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
                        <div class="etud-stat-number text-warning">{{ $demandesEnAttente }}</div>
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
                        <div class="etud-stat-number text-success">{{ $demandesAcceptees }}</div>
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
                        <div class="etud-stat-number text-danger">{{ $demandesRefusees }}</div>
                        <div class="etud-stat-description">Demande(s) refusée(s)</div>
                    </div>
                    <div class="etud-stat-icon icon-danger"><i class="bi bi-x-circle"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card p-4 mb-4 text-white" style="background: linear-gradient(135deg, #14213d, #1d4ed8);">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h6 class="mb-1 text-white">Vous souhaitez effectuer un stage ?</h6>
                <p class="mb-0 small" style="opacity:.85;">Déposez une nouvelle demande de stage auprès de l'ABHOER et suivez son traitement depuis votre espace étudiant.</p>
            </div>
            <a href="{{ route('etudiant.demandes.create') }}" class="btn btn-light btn-sm"><i class="bi bi-plus-lg me-1"></i> Nouvelle demande</a>
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
        <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center">
            <div>
                <h6 class="mb-1">Mes dernières demandes</h6>
                <span class="small text-muted">Consultez l'état de vos demandes de stage.</span>
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
                        <tr>
                            <td class="fw-bold">{{ $demande->numeroDemande }}</td>
                            <td>{{ $demande->service->nomService ?? '—' }}</td>
                            <td>{{ optional($demande->dateDepot)->format('d/m/Y') }}</td>
                            <td><span class="badge bg-secondary-subtle text-dark">{{ $demande->statut }}</span></td>
                            <td><a href="{{ route('etudiant.demandes.show', $demande->idDemande) }}" class="text-primary"><i class="bi bi-eye"></i></a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
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
