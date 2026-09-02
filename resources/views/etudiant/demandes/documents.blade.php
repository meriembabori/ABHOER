@extends('layouts.etudiant')

@section('page-title', 'Documents de la demande')

@section('content')

<div class="container-fluid py-4">


    {{-- ============================================================
         EN-TÊTE
    ============================================================ --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">

                Documents de la demande

            </h2>

            <p class="text-muted mb-0">

                Demande :

                <strong>

                    {{ $demande->numeroDemande }}

                </strong>

            </p>

        </div>


        <a
            href="{{ route('etudiant.demandes.show', [
                'idDemande' => $demande->idDemande
            ]) }}"
            class="btn btn-outline-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Retour

        </a>

    </div>


    {{-- ============================================================
         MESSAGES
    ============================================================ --}}

    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show"
            role="alert"
        >

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    @if(session('error'))

        <div
            class="alert alert-danger alert-dismissible fade show"
            role="alert"
        >

            <i class="bi bi-exclamation-triangle me-2"></i>

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- ============================================================
         INFORMATIONS DEMANDE
    ============================================================ --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <div class="row g-3">


                {{-- NUMERO --}}

                <div class="col-md-4">

                    <small class="text-muted">
                        Numéro de demande
                    </small>

                    <div class="fw-semibold">

                        {{ $demande->numeroDemande }}

                    </div>

                </div>


                {{-- SERVICE --}}

                <div class="col-md-4">

                    <small class="text-muted">
                        Service
                    </small>

                    <div class="fw-semibold">

                        {{ $demande->service->nomService ?? '—' }}

                    </div>

                </div>


                {{-- NOMBRE DOCUMENTS --}}

                <div class="col-md-4">

                    <small class="text-muted">
                        Nombre de documents
                    </small>

                    <div class="fw-semibold">

                        {{ $documents->count() }} / 4

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================
         AJOUTER / METTRE À JOUR LES DOCUMENTS
    ============================================================ --}}

    @php
        $statutDemande = strtoupper((string) $demande->statut);

        $peutModifier = in_array(
            $statutDemande,
            ['EN_ATTENTE', 'BROUILLON'],
            true
        );

        $typesDocuments = [
            'CIN' => "Copie de la CIN",
            'CV' => "CV",
            'Assurance' => "Assurance de stage",
            'Demande de stage' => "Demande / Lettre de motivation",
        ];
    @endphp

    @if($peutModifier)

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white py-3">

                <h5 class="mb-0 fw-bold">

                    <i class="bi bi-cloud-upload me-2"></i>

                    Ajouter les documents

                </h5>

                <small class="text-muted">
                    Les 4 documents suivants sont obligatoires : CIN, CV, Assurance de stage et Demande / Lettre de motivation (PDF, JPG, JPEG ou PNG, 5 Mo max).
                </small>

            </div>

            <div class="card-body">

                <form
                    action="{{ route('etudiant.demandes.documents.store', ['idDemande' => $demande->idDemande]) }}"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @csrf

                    <div class="row g-3">

                        @foreach($typesDocuments as $type => $label)

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    {{ $label }}
                                </label>

                                <input
                                    type="hidden"
                                    name="documents[{{ $loop->index }}][type]"
                                    value="{{ $type }}"
                                >

                                <input
                                    type="file"
                                    name="documents[{{ $loop->index }}][fichier]"
                                    accept=".pdf,.jpg,.jpeg,.png"
                                    class="form-control @error('documents.' . $loop->index . '.fichier') is-invalid @enderror"
                                >

                                @error('documents.' . $loop->index . '.fichier')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        @endforeach

                    </div>

                    <div class="mt-4 d-flex justify-content-end">

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-upload me-1"></i>
                            Enregistrer les documents
                        </button>

                    </div>

                </form>

            </div>

        </div>

    @endif


    {{-- ============================================================
         DOCUMENTS
    ============================================================ --}}

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">

            <h5 class="mb-0 fw-bold">

                <i class="bi bi-files me-2"></i>

                Documents déposés

            </h5>

        </div>


        <div class="card-body">


            {{-- ====================================================
                 AUCUN DOCUMENT
            ===================================================== --}}

            @if($documents->isEmpty())

                <div class="text-center py-5">

                    <i
                        class="bi bi-file-earmark-x display-4 text-muted"
                    ></i>

                    <h5 class="mt-3">

                        Aucun document

                    </h5>

                    <p class="text-muted">

                        Aucun document n'a encore été ajouté à cette demande.

                    </p>

                </div>


            @else


                {{-- =================================================
                     TABLEAU
                ================================================== --}}

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">

                            <tr>

                                <th>
                                    Type
                                </th>

                                <th>
                                    Nom du fichier
                                </th>

                                <th>
                                    Date d'ajout
                                </th>

                                <th class="text-end">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                            @foreach($documents as $document)

                                <tr>


                                    {{-- =================================
                                         TYPE
                                    ================================== --}}

                                    <td>

                                        <span class="badge text-bg-primary">

                                            <i
                                                class="bi bi-file-earmark me-1"
                                            ></i>

                                            {{ $document->typeDocument }}

                                        </span>

                                    </td>


                                    {{-- =================================
                                         NOM FICHIER
                                    ================================== --}}

                                    <td>

                                        <div class="fw-semibold">

                                            {{ $document->nomFichier }}

                                        </div>

                                    </td>


                                    {{-- =================================
                                         DATE
                                    ================================== --}}

                                    <td>

                                        @if(!empty($document->dateAjout))

                                            {{ \Carbon\Carbon::parse($document->dateAjout)->format('d/m/Y H:i') }}

                                        @else

                                            —

                                        @endif

                                    </td>


                                    {{-- =================================
                                         ACTIONS
                                    ================================== --}}

                                    <td class="text-end">

                                        <div class="btn-group">


                                            {{-- =================================
                                                 VOIR
                                            ================================== --}}

                                            <a
                                                href="{{ route(
                                                    'etudiant.demandes.documents.voir',
                                                    [
                                                        'idDemande' =>
                                                            $demande->idDemande,

                                                        'idDocument' =>
                                                            $document->idDocument
                                                    ]
                                                ) }}"
                                                target="_blank"
                                                class="btn btn-sm btn-outline-primary"
                                                title="Voir le document"
                                            >

                                                <i class="bi bi-eye"></i>

                                                Voir

                                            </a>


                                            {{-- =================================
                                                 TELECHARGER
                                            ================================== --}}

                                            <a
                                                href="{{ route(
                                                    'etudiant.demandes.documents.telecharger',
                                                    [
                                                        'idDemande' =>
                                                            $demande->idDemande,

                                                        'idDocument' =>
                                                            $document->idDocument
                                                    ]
                                                ) }}"
                                                class="btn btn-sm btn-outline-success"
                                                title="Télécharger"
                                            >

                                                <i class="bi bi-download"></i>

                                            </a>


                                            {{-- =================================
                                                 CALCUL STATUT
                                            ================================== --}}

                                            @php

                                                $statut = strtoupper(
                                                    (string) $demande->statut
                                                );

                                                $peutSupprimer = in_array(
                                                    $statut,
                                                    [
                                                        'EN_ATTENTE',
                                                        'BROUILLON'
                                                    ],
                                                    true
                                                );

                                            @endphp


                                            {{-- =================================
                                                 SUPPRIMER
                                            ================================== --}}

                                            @if($peutSupprimer)

                                                <form
                                                    action="{{ route(
                                                        'etudiant.demandes.documents.destroy',
                                                        [
                                                            'idDemande' =>
                                                                $demande->idDemande,

                                                            'idDocument' =>
                                                                $document->idDocument
                                                        ]
                                                    ) }}"
                                                    method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Voulez-vous vraiment supprimer ce document ?');"
                                                >

                                                    @csrf

                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="btn btn-sm btn-outline-danger"
                                                        title="Supprimer"
                                                    >

                                                        <i
                                                            class="bi bi-trash"
                                                        ></i>

                                                    </button>

                                                </form>

                                            @endif


                                        </div>

                                    </td>

                                </tr>

                            @endforeach


                        </tbody>

                    </table>

                </div>

            @endif


        </div>

    </div>

</div>

@endsection