@extends('layouts.etudiant')

@section('page-title', 'Confirmation de la demande')

@section('content')

<div class="container-fluid py-4">

    <div class="mb-4">

        <h2 class="fw-bold mb-1">
            Confirmation de votre demande
        </h2>

        <p class="text-muted mb-0">
            Étape 3 sur 3 — Vérifiez les informations avant l'envoi
        </p>

    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <div class="mb-4">

                <div class="progress" style="height: 8px;">
                    <div
                        class="progress-bar"
                        role="progressbar"
                        style="width: 100%;"
                    ></div>
                </div>

            </div>

            <div class="alert alert-success">

                <i class="bi bi-check-circle me-2"></i>

                Les quatre documents ont été ajoutés.
                Vérifiez maintenant votre demande avant de la confirmer.

            </div>

            <h5 class="fw-bold mb-3">
                Informations générales
            </h5>

            <div class="table-responsive">

                <table class="table table-bordered">

                    <tbody>

                        <tr>
                            <th width="35%">
                                Numéro de demande
                            </th>

                            <td>
                                {{ $demande->numeroDemande }}
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Service
                            </th>

                            <td>
                                {{ $demande->service->nomService ?? 'Non renseigné' }}
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Type de stage
                            </th>

                            <td>
                                {{ $demande->typeStage ?? '—' }}
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Date de début
                            </th>

                            <td>
                                {{ $demande->dateDebut }}
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Date de fin
                            </th>

                            <td>
                                {{ $demande->dateFin }}
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Thème
                            </th>

                            <td>
                                {{ $demande->theme }}
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Motivation
                            </th>

                            <td>
                                {{ $demande->motivation }}
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

            <h5 class="fw-bold mt-5 mb-3">
                Documents
            </h5>

            <div class="row g-3">

                @foreach($demande->documents as $document)

                    <div class="col-md-6">

                        <div class="border rounded-3 p-3">

                            <div class="d-flex align-items-center">

                                <i class="bi bi-file-earmark-check fs-3 me-3"></i>

                                <div>

                                    <div class="fw-semibold">
                                        {{ $document->typeDocument }}
                                    </div>

                                    <small class="text-muted">
                                        {{ $document->nomFichier }}
                                    </small>

                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

            <div class="d-flex justify-content-between mt-5">

                <a
                    href="{{ route('etudiant.demandes.documents', ['idDemande' => $demande->idDemande]) }}"
                    class="btn btn-light"
                >
                    <i class="bi bi-arrow-left me-1"></i>
                    Modifier les documents
                </a>

                <form
                    method="POST"
                    action="{{ route('etudiant.demandes.confirmer', ['idDemande' => $demande->idDemande]) }}"
                >

                    @csrf

                    <button
                        type="submit"
                        class="btn btn-success px-4"
                    >
                        <i class="bi bi-send me-1"></i>
                        Confirmer et envoyer
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection