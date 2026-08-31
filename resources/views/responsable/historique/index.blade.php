@extends('layouts.responsable')

@section('title', 'Historique')
@section('page-title', 'Historique des actions')
@section('page-subtitle', 'Journal complet, toutes demandes confondues')

@section('content')

    <style>
        .filters-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1fr 1fr auto;
            gap: 12px;
            align-items: end;
        }
        .filters-grid label { margin-bottom: 5px; }
        .action-tag { padding: 4px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 700; background: var(--c-teal-pale); color: var(--c-teal-dark); }
        @media (max-width: 1000px) { .filters-grid { grid-template-columns: 1fr 1fr; } }
    </style>

    <div class="card" style="margin-bottom:20px;">
        <form method="GET" action="{{ route('responsable.historique.index') }}" class="filters-grid">
            <div>
                <label>N° de demande</label>
                <input type="text" name="recherche" placeholder="STG-2026-..." value="{{ request('recherche') }}">
            </div>
            <div>
                <label>Type d'action</label>
                <select name="action">
                    <option value="">Toutes</option>
                    @foreach ($actionsDisponibles as $action)
                        <option value="{{ $action }}" @selected(request('action') === $action)>{{ $action }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Utilisateur</label>
                <select name="idUtilisateur">
                    <option value="">Tous</option>
                    @foreach ($utilisateurs as $utilisateur)
                        <option value="{{ $utilisateur->idUtilisateur }}" @selected((string) request('idUtilisateur') === (string) $utilisateur->idUtilisateur)>
                            {{ $utilisateur->prenom }} {{ $utilisateur->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Du</label>
                <input type="date" name="dateDebut" value="{{ request('dateDebut') }}">
            </div>
            <div>
                <label>Au</label>
                <input type="date" name="dateFin" value="{{ request('dateFin') }}">
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
                        <td><span class="action-tag">{{ $item->action }}</span></td>
                        <td>
                            @if ($item->demande)
                                <a href="{{ route('responsable.demandes.show', $item->demande->idDemande) }}" style="color:var(--c-teal-dark);font-weight:600;">
                                    {{ $item->demande->numeroDemande }}
                                </a>
                                <br>
                                <span style="color:#94a3b8;font-size:11.5px;">
                                    {{ optional($item->demande->candidat)->prenom }} {{ optional($item->demande->candidat)->nom }}
                                </span>
                            @else
                                —
                            @endif
                        </td>
                        <td>{{ $item->nouvelleValeur }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" style="text-align:center;color:#94a3b8;padding:30px;">Aucune action enregistrée.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top:18px;">
            {{ $historiques->links('vendor.pagination.abhoer') }}
        </div>
    </div>

@endsection
