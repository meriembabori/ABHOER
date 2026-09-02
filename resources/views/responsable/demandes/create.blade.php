@extends('layouts.responsable')

@section('title', 'Nouvelle demande physique')
@section('page-title', 'Nouvelle demande physique')
@section('page-description', "Enregistrer une demande déposée directement au bureau.")

@section('content')

<a href="{{ route('responsable.demandes.index') }}" class="btn btn-outline-primary btn-sm mb-3"><i class="bi bi-arrow-left"></i> Retour à la liste</a>

<div class="card p-4" style="max-width:820px;">
    <form method="POST" action="{{ route('responsable.demandes.store') }}" enctype="multipart/form-data">
        @csrf

        <h6 class="text-primary text-uppercase small fw-bold border-bottom pb-2 mb-3"><i class="bi bi-person-fill me-1"></i> Informations du candidat</h6>

        <div class="row g-3 mb-2">
            <div class="col-md-6">
                <label class="form-label">Nom *</label>
                <input type="text" name="nom" value="{{ old('nom') }}" required class="form-control">
                @error('nom')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Prénom *</label>
                <input type="text" name="prenom" value="{{ old('prenom') }}" required class="form-control">
                @error('prenom')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row g-3 mb-2">
            <div class="col-md-6">
                <label class="form-label">CIN *</label>
                <input type="text" name="cin" value="{{ old('cin') }}" required class="form-control">
                @error('cin')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Téléphone</label>
                <input type="text" name="telephone" value="{{ old('telephone') }}" class="form-control">
            </div>
        </div>

        <div class="mb-2">
            <label class="form-label">Email *</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="form-control">
            @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>

        <div class="row g-3 mb-2">
            <div class="col-md-6">
                <label class="form-label">Établissement</label>
                <input type="text" name="etablissement" value="{{ old('etablissement') }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Formation</label>
                <input type="text" name="formation" value="{{ old('formation') }}" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Niveau d'étude</label>
            <input type="text" name="niveauEtude" value="{{ old('niveauEtude') }}" class="form-control">
        </div>

        <h6 class="text-primary text-uppercase small fw-bold border-bottom pb-2 mb-3 mt-4"><i class="bi bi-file-earmark-text-fill me-1"></i> Détails de la demande</h6>

        <div class="mb-3">
            <label class="form-label">Service demandé *</label>
            <select name="idService" required class="form-select">
                <option value="">-- Choisir un service --</option>
                @foreach ($services->groupBy(fn($s) => optional($s->departement)->nomDepartement ?? 'Autres') as $nomDepartement => $servicesDuDepartement)
                    <optgroup label="{{ $nomDepartement }}">
                        @foreach ($servicesDuDepartement as $service)
                            <option value="{{ $service->idService }}" @selected(old('idService') == $service->idService)>{{ $service->nomService }}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
            @error('idService')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>

        <div class="row g-3 mb-2">
            <div class="col-md-6">
                <label class="form-label">Type de stage *</label>
                <select name="typeStage" required class="form-select">
                    <option value="">-- Choisir --</option>
                    <option value="Stage d'observation" @selected(old('typeStage') === "Stage d'observation")>Stage d'observation</option>
                    <option value="Stage d'initiation" @selected(old('typeStage') === "Stage d'initiation")>Stage d'initiation</option>
                    <option value="Stage technique" @selected(old('typeStage') === 'Stage technique')>Stage technique</option>
                    <option value="Stage de fin d'études (PFE)" @selected(old('typeStage') === "Stage de fin d'études (PFE)")>Stage de fin d'études (PFE)</option>
                </select>
                @error('typeStage')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Thème / Sujet du stage</label>
                <input type="text" name="theme" value="{{ old('theme') }}" placeholder="Ex: Suivi des ressources en eau" class="form-control">
            </div>
        </div>

        <div class="row g-3 mb-2">
            <div class="col-md-6">
                <label class="form-label">Date de début souhaitée</label>
                <input type="date" name="dateDebut" value="{{ old('dateDebut') }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Date de fin souhaitée</label>
                <input type="date" name="dateFin" value="{{ old('dateFin') }}" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Observation</label>
            <textarea name="observation" rows="3" class="form-control">{{ old('observation') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="form-label">Documents (CV, lettre, convention, assurance...)</label>
            <input type="file" name="documents[]" multiple class="form-control">
        </div>

        <button type="submit" class="btn btn-primary w-100"><i class="bi bi-save-fill me-1"></i> Enregistrer la demande</button>

    </form>
</div>

@endsection
