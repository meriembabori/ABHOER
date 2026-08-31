@extends('layouts.responsable')

@section('title', 'Demandes de stage')
@section('page-title', 'Demandes de stage')
@section('page-subtitle', 'Recherchez, filtrez et traitez les demandes')

@section('content')

    <style>
        .filters-card { margin-bottom: 20px; }
        .filters-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr auto;
            gap: 12px;
            align-items: end;
        }
        .filters-grid label { margin-bottom: 5px; }
        @media (max-width: 1000px) { .filters-grid { grid-template-columns: 1fr 1fr; } }
    </style>

    <div class="card filters-card">
        <form method="GET" action="{{ route('responsable.demandes.index') }}" class="filters-grid">
            <div>
                <label>Recherche</label>
                <input type="text" name="recherche" placeholder="N° demande, nom, CIN..." value="{{ request('recherche') }}">
            </div>
            <div>
                <label>Statut</label>
                <select name="statut">
                    <option value="">Tous</option>
                    <option value="EN_ATTENTE" @selected(request('statut') === 'EN_ATTENTE')>En attente</option>
                    <option value="INFOS_DEMANDEES" @selected(request('statut') === 'INFOS_DEMANDEES')>Infos demandées</option>
                    <option value="ACCEPTEE" @selected(request('statut') === 'ACCEPTEE')>Acceptée</option>
                    <option value="REFUSEE" @selected(request('statut') === 'REFUSEE')>Refusée</option>
                </select>
            </div>
            <div>
                <label>Service</label>
                <select name="service">
                    <option value="">Tous</option>
                    @foreach ($services as $service)
                        <option value="{{ $service->idService }}" @selected((string) request('service') === (string) $service->idService)>
                            {{ $service->nomService }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Type de dépôt</label>
                <select name="typeDepot">
                    <option value="">Tous</option>
                    <option value="EN_LIGNE" @selected(request('typeDepot') === 'EN_LIGNE')>En ligne</option>
                    <option value="PHYSIQUE" @selected(request('typeDepot') === 'PHYSIQUE')>Physique</option>
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
                        <td style="font-weight:600;color:var(--c-navy);">{{ $demande->numeroDemande }}</td>
                        <td>{{ $demande->candidat->prenom ?? '' }} {{ $demande->candidat->nom ?? '' }}</td>
                        <td>{{ $demande->candidat->etablissement ?? '—' }}</td>
                        <td>{{ $demande->service->nomService ?? '—' }}</td>
                        <td>{{ $demande->typeDepot ?? '—' }}</td>
                        <td><span class="badge badge-{{ $demande->statut }}">{{ $demande->statut }}</span></td>
                        <td>{{ optional($demande->dateDepot)->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('responsable.demandes.show', $demande->idDemande) }}" class="btn btn-secondary" style="padding:7px 12px;">
                                <i class="bi bi-eye-fill"></i> Détails
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align:center;color:#94a3b8;padding:30px;">
                            Aucune demande ne correspond à ces critères.
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
