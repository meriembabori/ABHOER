@extends('layouts.etudiant')

@section('page-title', 'Détails de la demande')

@section('content')

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                Détails de la demande
            </h2>

            <p class="text-muted mb-0">
                {{ $demande->numeroDemande }}
            </p>

        </div>

        <a
            href="{{ route('etudiant.demandes.index') }}"
            class="btn btn-light"
        >
            <i class="bi bi-arrow-left me-1"></i>
            Retour
        </a>

    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <div class="row g-4">

                <div class="col-md-6">

                    <strong>Numéro de demande</strong>

                    <p class="text-muted">
                        {{ $demande->numeroDemande }}
                    </p>

                </div>

                <div class="col-md-6">

                    <strong>Statut</strong>

                    <p>

                        <span class="badge text-bg-secondary">
                            {{ str_replace('_', ' ', $demande->statut) }}
                        </span>

                    </p>

                </div>

                <div class="col-md-6">

                    <strong>Service</strong>

                    <p class="text-muted">
                        {{ $demande->service->nomService ?? '—' }}
                    </p>

                </div>

                <div class="col-md-6">

                    <strong>Type de stage</strong>

                    <p class="text-muted">
                        {{ $demande->typeStage ?? '—' }}
                    </p>

                </div>

                <div class="col-md-6">

                    <strong>Date de début</strong>

                    <p class="text-muted">
                        {{ $demande->dateDebut }}
                    </p>

                </div>

                <div class="col-md-6">

                    <strong>Date de fin</strong>

                    <p class="text-muted">
                        {{ $demande->dateFin }}
                    </p>

                </div>

                <div class="col-12">

                    <strong>Thème</strong>

                    <p class="text-muted">
                        {{ $demande->theme }}
                    </p>

                </div>

                <div class="col-12">

                    <strong>Motivation</strong>

                    <p class="text-muted">
                        {{ $demande->motivation }}
                    </p>

                </div>

                @if($demande->observation)

                    <div class="col-12">

                        <div class="alert alert-warning">

                            <strong>
                                Observation :
                            </strong>

                            {{ $demande->observation }}

                        </div>

                    </div>

                @endif

            </div>

            <hr class="my-4">

            <h5 class="fw-bold mb-3">
                Documents
            </h5>

            <div class="row g-3">

                @forelse($demande->documents as $document)

                    <div class="col-md-6">

                        <div class="border rounded p-3">

                            <div class="fw-semibold">
                                {{ $document->typeDocument }}
                            </div>

                            <small class="text-muted">
                                {{ $document->nomFichier }}
                            </small>

                        </div>

                    </div>

                @empty

                    <div class="col-12">

                        <div class="alert alert-secondary">
                            Aucun document enregistré.
                        </div>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection