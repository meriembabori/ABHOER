@extends('layouts.responsable')

@section('title', 'Demandes de stage')
@section('page-title', 'Demandes de stage')
@section('page-description', 'Recherchez, filtrez et traitez les demandes.')

@section('content')

<div class="card p-4 mb-4">
    <form method="GET" action="{{ route('responsable.demandes.index') }}" class="row g-3 align-items-end">
        <div class="col-md-4">
            <label class="form-label">Recherche</label>
            <input type="text" class="form-control" name="recherche" placeholder="N° demande, nom, CIN..." value="{{ request('recherche') }}">
        </div>
        <div class="col-md-2">
            <label class="form-label">Statut</label>
            <select name="statut" class="form-select">
                <option value="">Tous</option>
                <option value="EN_ATTENTE" @selected(request('statut') === 'EN_ATTENTE')>En attente</option>
                <option value="INFOS_DEMANDEES" @selected(request('statut') === 'INFOS_DEMANDEES')>Infos demandées</option>
                <option value="ACCEPTEE" @selected(request('statut') === 'ACCEPTEE')>Acceptée</option>
                <option value="REFUSEE" @selected(request('statut') === 'REFUSEE')>Refusée</option>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Service</label>
            <select name="service" class="form-select">
                <option value="">Tous</option>
                @foreach ($services as $service)
                    <option value="{{ $service->idService }}" @selected((string) request('service') === (string) $service->idService)>{{ $service->nomService }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label">Type de dépôt</label>
            <select name="typeDepot" class="form-select">
                <option value="">Tous</option>
                <option value="EN_LIGNE" @selected(request('typeDepot') === 'EN_LIGNE')>En ligne</option>
                <option value="PHYSIQUE" @selected(request('typeDepot') === 'PHYSIQUE')>Physique</option>
            </select>
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel-fill"></i></button>
        </div>
    </form>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>N° Demande</th>
                    <th>Candidat</th>
                    <th>Établissement</th>
                    <th>Service</th>
                    <th>Type</th>
                    <th>Statut</th>
                    <th>Date dépôt</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($demandes as $demande)
                    <tr>
                        <td class="fw-bold">{{ $demande->numeroDemande }}</td>
                        <td>{{ $demande->candidat->prenom ?? '' }} {{ $demande->candidat->nom ?? '' }}</td>
                        <td>{{ $demande->candidat->etablissement ?? '—' }}</td>
                        <td>{{ $demande->service->nomService ?? '—' }}</td>
                        <td>{{ $demande->typeDepot ?? '—' }}</td>
                        <td><span class="badge bg-secondary-subtle text-dark">{{ $demande->statut }}</span></td>
                        <td>{{ optional($demande->dateDepot)->format('d/m/Y') }}</td>
                        <td><a href="{{ route('responsable.demandes.show', $demande->idDemande) }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-eye"></i> Détails</a></td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center text-muted py-5">Aucune demande ne correspond à ces critères.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white py-3">
        {{ $demandes->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection
