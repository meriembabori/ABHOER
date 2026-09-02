@extends('layouts.etudiant')

@section('page-title', 'Nouvelle demande de stage')

@section('content')

<div class="container-fluid py-4">

    <div class="mb-4">
        <h2 class="fw-bold mb-1">
            Nouvelle demande de stage
        </h2>

        <p class="text-muted mb-0">
            Étape 1 sur 3 — Informations du stage
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

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <div class="mb-4">
                <div class="progress" style="height: 8px;">
                    <div
                        class="progress-bar"
                        role="progressbar"
                        style="width: 33%;"
                    ></div>
                </div>
            </div>

            <form
                method="POST"
                action="{{ route('etudiant.demandes.informations.store') }}"
            >

                @csrf

                <div class="row g-4">

                    <div class="col-md-6">

                        <label
                            for="idService"
                            class="form-label fw-semibold"
                        >
                            Service demandé
                        </label>

                        <select
                            name="idService"
                            id="idService"
                            class="form-select @error('idService') is-invalid @enderror"
                            required
                        >

                            <option value="">
                                -- Sélectionner un service --
                            </option>

                            @foreach($services as $service)

                                <option
                                    value="{{ $service->idService }}"
                                    {{ old('idService') == $service->idService ? 'selected' : '' }}
                                >
                                    {{ $service->nomService }}
                                </option>

                            @endforeach

                        </select>

                        @error('idService')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="col-md-6">

                        <label
                            for="typeStage"
                            class="form-label fw-semibold"
                        >
                            Type de stage
                        </label>

                        <select
                            name="typeStage"
                            id="typeStage"
                            class="form-select @error('typeStage') is-invalid @enderror"
                            required
                        >

                            <option value="">
                                -- Sélectionner --
                            </option>

                            <option
                                value="Stage d'observation"
                                {{ old('typeStage') === "Stage d'observation" ? 'selected' : '' }}
                            >
                                Stage d'observation
                            </option>

                            <option
                                value="Stage d'initiation"
                                {{ old('typeStage') === "Stage d'initiation" ? 'selected' : '' }}
                            >
                                Stage d'initiation
                            </option>

                            <option
                                value="Stage technique"
                                {{ old('typeStage') === 'Stage technique' ? 'selected' : '' }}
                            >
                                Stage technique
                            </option>

                            <option
                                value="Stage de fin d'études (PFE)"
                                {{ old('typeStage') === "Stage de fin d'études (PFE)" ? 'selected' : '' }}
                            >
                                Stage de fin d'études (PFE)
                            </option>

                        </select>

                        @error('typeStage')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="col-md-6">

                        <label
                            for="dateDebut"
                            class="form-label fw-semibold"
                        >
                            Date de début
                        </label>

                        <input
                            type="date"
                            name="dateDebut"
                            id="dateDebut"
                            value="{{ old('dateDebut') }}"
                            class="form-control @error('dateDebut') is-invalid @enderror"
                            required
                        >

                        @error('dateDebut')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="col-md-6">

                        <label
                            for="dateFin"
                            class="form-label fw-semibold"
                        >
                            Date de fin
                        </label>

                        <input
                            type="date"
                            name="dateFin"
                            id="dateFin"
                            value="{{ old('dateFin') }}"
                            class="form-control @error('dateFin') is-invalid @enderror"
                            required
                        >

                        @error('dateFin')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="col-12">

                        <label
                            for="theme"
                            class="form-label fw-semibold"
                        >
                            Thème du stage
                        </label>

                        <input
                            type="text"
                            name="theme"
                            id="theme"
                            value="{{ old('theme') }}"
                            class="form-control @error('theme') is-invalid @enderror"
                            placeholder="Exemple : Développement d'une application web"
                            required
                        >

                        @error('theme')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="col-12">

                        <label
                            for="motivation"
                            class="form-label fw-semibold"
                        >
                            Motivation
                        </label>

                        <textarea
                            name="motivation"
                            id="motivation"
                            rows="6"
                            class="form-control @error('motivation') is-invalid @enderror"
                            placeholder="Expliquez votre motivation pour effectuer ce stage..."
                            required
                        >{{ old('motivation') }}</textarea>

                        @error('motivation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

                <div class="d-flex justify-content-between mt-5">

                    <a
                        href="{{ route('etudiant.demandes.index') }}"
                        class="btn btn-light"
                    >
                        Annuler
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary px-4"
                    >
                        Continuer
                        <i class="bi bi-arrow-right ms-1"></i>
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection