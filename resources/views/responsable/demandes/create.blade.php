@extends('layouts.responsable')

@section('title', 'Nouvelle demande physique')
@section('page-title', 'Nouvelle demande physique')
@section('page-subtitle', "Enregistrer une demande déposée directement au bureau")

@section('content')

    <style>
        .form-card { max-width: 760px; }
        .form-card h4 {
            font-size: 13.5px; color: var(--c-teal-dark); text-transform: uppercase; letter-spacing: 0.4px;
            border-bottom: 1px solid #f1f5f9; padding-bottom: 10px; margin: 26px 0 16px;
        }
        .form-card h4:first-child { margin-top: 0; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .form-group { margin-bottom: 16px; }
        .error-text { color: #ef4444; font-size: 11.5px; margin-top: 4px; }
        @media (max-width: 640px) { .form-row { grid-template-columns: 1fr; } }
    </style>

    <a href="{{ route('responsable.demandes.index') }}" style="color:var(--c-teal-dark);font-size:13px;font-weight:600;display:inline-block;margin-bottom:18px;">
        <i class="bi bi-arrow-left"></i> Retour à la liste
    </a>

    <div class="card form-card">
        <form method="POST" action="{{ route('responsable.demandes.store') }}" enctype="multipart/form-data">
            @csrf

            <h4><i class="bi bi-person-fill"></i> Informations du candidat</h4>

            <div class="form-row">
                <div class="form-group">
                    <label>Nom *</label>
                    <input type="text" name="nom" value="{{ old('nom') }}" required>
                    @error('nom')<div class="error-text">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Prénom *</label>
                    <input type="text" name="prenom" value="{{ old('prenom') }}" required>
                    @error('prenom')<div class="error-text">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>CIN *</label>
                    <input type="text" name="cin" value="{{ old('cin') }}" required>
                    @error('cin')<div class="error-text">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Téléphone</label>
                    <input type="text" name="telephone" value="{{ old('telephone') }}">
                </div>
            </div>

            <div class="form-group">
                <label>Email *</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
                @error('email')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Établissement</label>
                    <input type="text" name="etablissement" value="{{ old('etablissement') }}">
                </div>
                <div class="form-group">
                    <label>Formation</label>
                    <input type="text" name="formation" value="{{ old('formation') }}">
                </div>
            </div>

            <div class="form-group">
                <label>Niveau d'étude</label>
                <input type="text" name="niveauEtude" value="{{ old('niveauEtude') }}">
            </div>

            <h4><i class="bi bi-file-earmark-text-fill"></i> Détails de la demande</h4>

            <div class="form-group">
                <label>Service demandé *</label>
                <select name="idService" required>
                    <option value="">-- Choisir un service --</option>
                    @foreach ($services->groupBy(fn($s) => optional($s->departement)->nomDepartement ?? 'Autres') as $nomDepartement => $servicesDuDepartement)
                        <optgroup label="{{ $nomDepartement }}">
                            @foreach ($servicesDuDepartement as $service)
                                <option value="{{ $service->idService }}" @selected(old('idService') == $service->idService)>
                                    {{ $service->nomService }}
                                </option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
                @error('idService')<div class="error-text">{{ $message }}</div>@enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Type de stage *</label>
                    <select name="typeStage" required>
                        <option value="">-- Choisir --</option>
                        <option value="Stage d'observation" @selected(old('typeStage') === "Stage d'observation")>Stage d'observation</option>
                        <option value="Stage d'initiation" @selected(old('typeStage') === "Stage d'initiation")>Stage d'initiation</option>
                        <option value="Stage technique" @selected(old('typeStage') === 'Stage technique')>Stage technique</option>
                        <option value="Stage de fin d'études (PFE)" @selected(old('typeStage') === "Stage de fin d'études (PFE)")>Stage de fin d'études (PFE)</option>
                    </select>
                    @error('typeStage')<div class="error-text">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Thème / Sujet du stage</label>
                    <input type="text" name="theme" value="{{ old('theme') }}" placeholder="Ex: Suivi des ressources en eau">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Date de début souhaitée</label>
                    <input type="date" name="dateDebut" value="{{ old('dateDebut') }}">
                </div>
                <div class="form-group">
                    <label>Date de fin souhaitée</label>
                    <input type="date" name="dateFin" value="{{ old('dateFin') }}">
                </div>
            </div>

            <div class="form-group">
                <label>Observation</label>
                <textarea name="observation" rows="3">{{ old('observation') }}</textarea>
            </div>

            <div class="form-group">
                <label>Documents (CV, lettre, convention, assurance...)</label>
                <input type="file" name="documents[]" multiple>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:13px;margin-top:8px;">
                <i class="bi bi-save-fill"></i> Enregistrer la demande
            </button>

        </form>
    </div>

@endsection
