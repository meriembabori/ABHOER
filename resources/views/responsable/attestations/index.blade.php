@extends('layouts.responsable')

@section('title', 'Attestations')
@section('page-title', 'Attestations de stage')
@section('page-description', 'Suivi de la préparation et de la remise des attestations.')

@section('content')

<div class="card p-4 mb-4">
    <form method="GET" action="{{ route('responsable.attestations.index') }}" class="row g-3 align-items-end">
        <div class="col-md-5">
            <label class="form-label">Recherche</label>
            <input type="text" name="recherche" placeholder="N° demande, nom..." value="{{ request('recherche') }}" class="form-control">
        </div>
        <div class="col-md-4">
            <label class="form-label">État de l'attestation</label>
            <select name="statut" class="form-select">
                <option value="">Tous</option>
                <option value="NON_DEMANDEE" @selected(request('statut') === 'NON_DEMANDEE')>Non demandée</option>
                <option value="EN_PREPARATION" @selected(request('statut') === 'EN_PREPARATION')>En préparation</option>
                <option value="PRETE" @selected(request('statut') === 'PRETE')>Prête à récupérer</option>
                <option value="REMISE" @selected(request('statut') === 'REMISE')>Remise</option>
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
                    <th>N° Demande</th>
                    <th>Stagiaire</th>
                    <th>Service</th>
                    <th>Période de stage</th>
                    <th>État attestation</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($demandes as $demande)
                    @php $etatAttestation = optional($demande->attestation)->statut ?? 'NON_DEMANDEE'; @endphp
                    <tr>
                        <td class="fw-bold">{{ $demande->numeroDemande }}</td>
                        <td>{{ $demande->candidat->prenom ?? '' }} {{ $demande->candidat->nom ?? '' }}</td>
                        <td>{{ $demande->service->nomService ?? '—' }}</td>
                        <td>{{ $demande->dateDebut ? $demande->dateDebut->format('d/m/Y') : '—' }} &rarr; {{ $demande->dateFin ? $demande->dateFin->format('d/m/Y') : '—' }}</td>
                        <td><span class="badge bg-secondary-subtle text-dark">{{ $etatAttestation }}</span></td>
                        <td>
                            @if ($etatAttestation === 'NON_DEMANDEE')
                                <form method="POST" action="{{ route('responsable.attestations.demarrer', $demande->idDemande) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary btn-sm">Démarrer</button>
                                </form>
                            @elseif ($etatAttestation === 'EN_PREPARATION')
                                <form method="POST" action="{{ route('responsable.attestations.prete', $demande->attestation->idAttestation) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm text-white">Marquer prête</button>
                                </form>
                            @elseif ($etatAttestation === 'PRETE')
                                <form method="POST" action="{{ route('responsable.attestations.remise', $demande->attestation->idAttestation) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">Marquer remise</button>
                                </form>
                            @else
                                <span class="text-muted small">Remise le {{ optional($demande->attestation->dateRemise)->format('d/m/Y') }}</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-5">Aucune demande acceptée pour le moment (les attestations concernent uniquement les demandes acceptées).</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white py-3">
        {{ $demandes->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection
