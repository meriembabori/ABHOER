@extends('layouts.responsable')

@section('title', 'Historique')
@section('page-title', 'Historique des actions')
@section('page-description', 'Journal complet, toutes demandes confondues.')

@section('content')

<div class="card p-4 mb-4">
    <form method="GET" action="{{ route('responsable.historique.index') }}" class="row g-3 align-items-end">
        <div class="col-md-3">
            <label class="form-label">N° de demande</label>
            <input type="text" name="recherche" placeholder="STG-2026-..." value="{{ request('recherche') }}" class="form-control">
        </div>
        <div class="col-md-3">
            <label class="form-label">Type d'action</label>
            <select name="action" class="form-select">
                <option value="">Toutes</option>
                @foreach ($actionsDisponibles as $action)
                    <option value="{{ $action }}" @selected(request('action') === $action)>{{ $action }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Utilisateur</label>
            <select name="idUtilisateur" class="form-select">
                <option value="">Tous</option>
                @foreach ($utilisateurs as $utilisateur)
                    <option value="{{ $utilisateur->idUtilisateur }}" @selected((string) request('idUtilisateur') === (string) $utilisateur->idUtilisateur)>{{ $utilisateur->prenom }} {{ $utilisateur->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel-fill"></i> Filtrer</button>
        </div>
    </form>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Utilisateur</th>
                    <th>Action</th>
                    <th>Demande</th>
                    <th>Détail</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($historiques as $item)
                    <tr>
                        <td>{{ optional($item->dateAction)->format('d/m/Y H:i') }}</td>
                        <td>{{ optional($item->utilisateur)->prenom }} {{ optional($item->utilisateur)->nom }}</td>
                        <td><span class="badge bg-primary-subtle text-primary">{{ $item->action }}</span></td>
                        <td>
                            @if ($item->demande)
                                <a href="{{ route('responsable.demandes.show', $item->demande->idDemande) }}" class="fw-bold text-primary">{{ $item->demande->numeroDemande }}</a><br>
                                <span class="text-muted small">{{ optional($item->demande->candidat)->prenom }} {{ optional($item->demande->candidat)->nom }}</span>
                            @else — @endif
                        </td>
                        <td>{{ $item->nouvelleValeur }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted py-5">Aucune action enregistrée.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white py-3">
        {{ $historiques->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection
