@extends('layouts.admin')

@section('page-title', 'Gestion des demandes de stage')

@section('page-description')
    Consultez, recherchez et suivez toutes les demandes de stage déposées sur la plateforme.
@endsection

@section('content')

<div class="container-fluid px-0">

    {{-- Statistiques --}}
    <div class="row g-4 mb-4">

        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-muted small mb-2">
                                Total demandes
                            </div>

                            <h3 class="fw-bold mb-0">
                                {{ $totalDemandes }}
                            </h3>
                        </div>

                        <div class="rounded-3 bg-primary bg-opacity-10 text-primary p-3">
                            <i class="bi bi-file-earmark-text fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-muted small mb-2">
                                En attente
                            </div>

                            <h3 class="fw-bold mb-0">
                                {{ $demandesEnAttente }}
                            </h3>
                        </div>

                        <div class="rounded-3 bg-warning bg-opacity-10 text-warning p-3">
                            <i class="bi bi-hourglass-split fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-muted small mb-2">
                                Acceptées
                            </div>

                            <h3 class="fw-bold mb-0">
                                {{ $demandesAcceptees }}
                            </h3>
                        </div>

                        <div class="rounded-3 bg-success bg-opacity-10 text-success p-3">
                            <i class="bi bi-check-circle fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-muted small mb-2">
                                Refusées
                            </div>

                            <h3 class="fw-bold mb-0">
                                {{ $demandesRefusees }}
                            </h3>
                        </div>

                        <div class="rounded-3 bg-danger bg-opacity-10 text-danger p-3">
                            <i class="bi bi-x-circle fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    {{-- Recherche et filtres --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form
                method="GET"
                action="{{ route('admin.demandes.index') }}"
            >

                <div class="row g-3 align-items-end">

                    <div class="col-lg-5">

                        <label class="form-label fw-semibold">
                            Rechercher
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">
                                <i class="bi bi-search"></i>
                            </span>

                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                placeholder="N° demande, candidat, email, service..."
                                value="{{ request('search') }}"
                            >

                        </div>

                    </div>


                    <div class="col-lg-3">

                        <label class="form-label fw-semibold">
                            Statut
                        </label>

                        <select
                            name="statut"
                            class="form-select"
                        >

                            <option value="">
                                Tous les statuts
                            </option>

                            <option
                                value="EN_ATTENTE"
                                {{ request('statut') === 'EN_ATTENTE' ? 'selected' : '' }}
                            >
                                En attente
                            </option>

                            <option
                                value="EN_COURS"
                                {{ request('statut') === 'EN_COURS' ? 'selected' : '' }}
                            >
                                En cours d'étude
                            </option>

                            <option
                                value="ACCEPTEE"
                                {{ request('statut') === 'ACCEPTEE' ? 'selected' : '' }}
                            >
                                Acceptée
                            </option>

                            <option
                                value="REFUSEE"
                                {{ request('statut') === 'REFUSEE' ? 'selected' : '' }}
                            >
                                Refusée
                            </option>

                            <option
                                value="STAGE_EN_COURS"
                                {{ request('statut') === 'STAGE_EN_COURS' ? 'selected' : '' }}
                            >
                                Stage en cours
                            </option>

                            <option
                                value="TERMINEE"
                                {{ request('statut') === 'TERMINEE' ? 'selected' : '' }}
                            >
                                Terminée
                            </option>

                        </select>

                    </div>


                    <div class="col-lg-2">

                        <label class="form-label fw-semibold">
                            Type de stage
                        </label>

                        <select
                            name="typeStage"
                            class="form-select"
                        >

                            <option value="">
                                Tous
                            </option>

                            <option
                                value="Stage d'observation"
                                {{ request('typeStage') === "Stage d'observation" ? 'selected' : '' }}
                            >
                                Stage d'observation
                            </option>

                            <option
                                value="Stage d'initiation"
                                {{ request('typeStage') === "Stage d'initiation" ? 'selected' : '' }}
                            >
                                Stage d'initiation
                            </option>

                            <option
                                value="Stage technique"
                                {{ request('typeStage') === 'Stage technique' ? 'selected' : '' }}
                            >
                                Stage technique
                            </option>

                            <option
                                value="Stage de fin d'études (PFE)"
                                {{ request('typeStage') === "Stage de fin d'études (PFE)" ? 'selected' : '' }}
                            >
                                Stage de fin d'études (PFE)
                            </option>

                        </select>

                    </div>


                    <div class="col-lg-2 d-flex gap-2">

                        <button
                            type="submit"
                            class="btn btn-primary flex-grow-1"
                        >
                            <i class="bi bi-funnel me-1"></i>
                            Filtrer
                        </button>

                        <a
                            href="{{ route('admin.demandes.index') }}"
                            class="btn btn-light border"
                            title="Réinitialiser"
                        >
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- Liste --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 py-3">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <h5 class="fw-bold mb-1">
                        Liste des demandes
                    </h5>

                    <p class="text-muted small mb-0">
                        {{ $demandes->total() }} demande(s) trouvée(s)
                    </p>
                </div>

            </div>

        </div>


        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th class="px-4">
                            Demande
                        </th>

                        <th>
                            Candidat
                        </th>

                        <th>
                            Service
                        </th>

                        <th>
                            Dépôt
                        </th>

                        <th>
                            Période
                        </th>

                        <th>
                            Statut
                        </th>

                        <th class="text-end px-4">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($demandes as $demande)

                        <tr>

                            {{-- Numéro --}}
                            <td class="px-4">

                                <div class="fw-semibold">
                                    {{ $demande->numeroDemande }}
                                </div>

                                <div class="text-muted small">
                                    #{{ $demande->idDemande }}
                                </div>

                            </td>


                            {{-- Candidat --}}
                            <td>

                                @if($demande->candidat)

                                    <div class="fw-semibold">
                                        {{ $demande->candidat->prenom }}
                                        {{ $demande->candidat->nom }}
                                    </div>

                                    <div class="text-muted small">
                                        {{ $demande->candidat->email }}
                                    </div>

                                @else

                                    <span class="text-muted">
                                        Candidat introuvable
                                    </span>

                                @endif

                            </td>


                            {{-- Service --}}
                            <td>

                                @if($demande->service)

                                    <div class="fw-semibold">
                                        {{ $demande->service->nomService }}
                                    </div>

                                    @if($demande->service->departement)

                                        <div class="text-muted small">
                                            {{ $demande->service->departement->nomDepartement }}
                                        </div>

                                    @endif

                                @else

                                    <span class="text-muted">
                                        Service introuvable
                                    </span>

                                @endif

                            </td>


                            {{-- Date dépôt --}}
                            <td>

                                @if($demande->dateDepot)

                                    {{ \Carbon\Carbon::parse($demande->dateDepot)->format('d/m/Y') }}

                                @else

                                    <span class="text-muted">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- Période --}}
                            <td>

                                <div class="small">

                                    @if($demande->dateDebut)
                                        Du
                                        <strong>
                                            {{ \Carbon\Carbon::parse($demande->dateDebut)->format('d/m/Y') }}
                                        </strong>
                                    @endif

                                </div>

                                <div class="small text-muted">

                                    @if($demande->dateFin)
                                        au
                                        {{ \Carbon\Carbon::parse($demande->dateFin)->format('d/m/Y') }}
                                    @endif

                                </div>

                            </td>


                            {{-- Statut --}}
                            <td>

                                @switch($demande->statut)

                                    @case('EN_ATTENTE')

                                        <span class="badge bg-warning-subtle text-warning-emphasis">
                                            <i class="bi bi-hourglass-split me-1"></i>
                                            En attente
                                        </span>

                                        @break

                                    @case('EN_COURS')

                                        <span class="badge bg-info-subtle text-info-emphasis">
                                            <i class="bi bi-arrow-repeat me-1"></i>
                                            En cours
                                        </span>

                                        @break

                                    @case('ACCEPTEE')

                                        <span class="badge bg-success-subtle text-success-emphasis">
                                            <i class="bi bi-check-circle me-1"></i>
                                            Acceptée
                                        </span>

                                        @break

                                    @case('REFUSEE')

                                        <span class="badge bg-danger-subtle text-danger-emphasis">
                                            <i class="bi bi-x-circle me-1"></i>
                                            Refusée
                                        </span>

                                        @break

                                    @case('STAGE_EN_COURS')

                                        <span class="badge bg-primary-subtle text-primary-emphasis">
                                            <i class="bi bi-play-circle me-1"></i>
                                            Stage en cours
                                        </span>

                                        @break

                                    @case('TERMINEE')

                                        <span class="badge bg-secondary-subtle text-secondary-emphasis">
                                            <i class="bi bi-check2-all me-1"></i>
                                            Terminée
                                        </span>

                                        @break

                                    @default

                                        <span class="badge bg-light text-dark border">
                                            {{ $demande->statut ?? 'Non défini' }}
                                        </span>

                                @endswitch

                            </td>


                            {{-- Action --}}
                            <td class="text-end px-4">

                                <a
                                    href="{{ route('admin.demandes.show', $demande->idDemande) }}"
                                    class="btn btn-sm btn-outline-primary"
                                    title="Voir le détail"
                                >
                                    <i class="bi bi-eye me-1"></i>
                                    Détails
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="text-center py-5"
                            >

                                <div class="mb-3">

                                    <i class="bi bi-inbox fs-1 text-muted"></i>

                                </div>

                                <h6 class="fw-bold">
                                    Aucune demande trouvée
                                </h6>

                                <p class="text-muted mb-0">
                                    Aucune demande ne correspond aux critères sélectionnés.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($demandes->hasPages())

            <div class="card-footer bg-white border-0 py-3">

                {{ $demandes->links() }}

            </div>

        @endif

    </div>

</div>

@endsection