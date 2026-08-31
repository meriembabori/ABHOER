@extends('layouts.responsable')

@section('title', 'Attestations')
@section('page-title', 'Attestations de stage')
@section('page-subtitle', 'Suivi de la préparation et de la remise des attestations')

@section('content')

    <style>
        .filters-grid { display: grid; grid-template-columns: 2fr 1.5fr auto; gap: 12px; align-items: end; }
        .filters-grid label { margin-bottom: 5px; }
        @media (max-width: 700px) { .filters-grid { grid-template-columns: 1fr; } }
    </style>

    <div class="card" style="margin-bottom:20px;">
        <form method="GET" action="{{ route('responsable.attestations.index') }}" class="filters-grid">
            <div>
                <label>Recherche</label>
                <input type="text" name="recherche" placeholder="N° demande, nom..." value="{{ request('recherche') }}">
            </div>
            <div>
                <label>État de l'attestation</label>
                <select name="statut">
                    <option value="">Tous</option>
                    <option value="NON_DEMANDEE" @selected(request('statut') === 'NON_DEMANDEE')>Non demandée</option>
                    <option value="EN_PREPARATION" @selected(request('statut') === 'EN_PREPARATION')>En préparation</option>
                    <option value="PRETE" @selected(request('statut') === 'PRETE')>Prête à récupérer</option>
                    <option value="REMISE" @selected(request('statut') === 'REMISE')>Remise</option>
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary"><i class="bi bi-funnel-fill"></i> Filtrer</button>
            </div>
        </form>
    </div>

    <div class="card">
        <table>
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
                        <td style="font-weight:600;color:var(--c-navy);">{{ $demande->numeroDemande }}</td>
                        <td>{{ $demande->candidat->prenom ?? '' }} {{ $demande->candidat->nom ?? '' }}</td>
                        <td>{{ $demande->service->nomService ?? '—' }}</td>
                        <td>
                            {{ $demande->dateDebut ? $demande->dateDebut->format('d/m/Y') : '—' }}
                            &rarr;
                            {{ $demande->dateFin ? $demande->dateFin->format('d/m/Y') : '—' }}
                        </td>
                        <td><span class="badge badge-{{ $etatAttestation }}">{{ $etatAttestation }}</span></td>
                        <td>
                            @if ($etatAttestation === 'NON_DEMANDEE')
                                <form method="POST" action="{{ route('responsable.attestations.demarrer', $demande->idDemande) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary" style="padding:7px 12px;">Démarrer</button>
                                </form>
                            @elseif ($etatAttestation === 'EN_PREPARATION')
                                <form method="POST" action="{{ route('responsable.attestations.prete', $demande->attestation->idAttestation) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary" style="padding:7px 12px;background:#dbeafe;color:#1e40af;">Marquer prête</button>
                                </form>
                            @elseif ($etatAttestation === 'PRETE')
                                <form method="POST" action="{{ route('responsable.attestations.remise', $demande->attestation->idAttestation) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" style="padding:7px 12px;">Marquer remise</button>
                                </form>
                            @else
                                <span style="color:#94a3b8;font-size:12px;">
                                    Remise le {{ optional($demande->attestation->dateRemise)->format('d/m/Y') }}
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center;color:#94a3b8;padding:30px;">
                            Aucune demande acceptée pour le moment (les attestations concernent uniquement les demandes acceptées).
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top:18px;">
            {{ $demandes->links('vendor.pagination.abhoer') }}
        </div>
    </div>

@endsection
