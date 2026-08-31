@extends('layouts.responsable')

@section('title', 'Suivi des stages')
@section('page-title', 'Suivi des stages')
@section('page-subtitle', 'Stages à venir, en cours et terminés')

@section('content')

    <style>
        .tabs { display: flex; gap: 10px; margin-bottom: 20px; }
        .tab {
            padding: 11px 20px; border-radius: 10px; font-weight: 600; font-size: 13.5px;
            background: white; color: var(--c-navy); box-shadow: var(--shadow);
        }
        .tab.active { background: linear-gradient(135deg, var(--c-teal), var(--c-teal-dark)); color: white; }
        .tab .count { margin-left: 5px; font-size: 11.5px; opacity: 0.85; }
        @media (max-width: 600px) { .tabs { flex-direction: column; } }
    </style>

    <div class="tabs">
        <a href="{{ route('responsable.stages.index', ['statut' => 'a_venir']) }}" class="tab @if($onglet === 'a_venir') active @endif">
            <i class="bi bi-clock-fill"></i> À venir <span class="count">({{ $compteurs['a_venir'] }})</span>
        </a>
        <a href="{{ route('responsable.stages.index', ['statut' => 'en_cours']) }}" class="tab @if($onglet === 'en_cours') active @endif">
            <i class="bi bi-play-circle-fill"></i> En cours <span class="count">({{ $compteurs['en_cours'] }})</span>
        </a>
        <a href="{{ route('responsable.stages.index', ['statut' => 'termine']) }}" class="tab @if($onglet === 'termine') active @endif">
            <i class="bi bi-check-circle-fill"></i> Terminés <span class="count">({{ $compteurs['termine'] }})</span>
        </a>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>N° Demande</th>
                    <th>Stagiaire</th>
                    <th>Service</th>
                    <th>Début</th>
                    <th>Fin</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($affectations as $affectation)
                    <tr>
                        <td style="font-weight:600;color:var(--c-navy);">{{ optional($affectation->demande)->numeroDemande }}</td>
                        <td>
                            {{ optional(optional($affectation->demande)->candidat)->prenom }}
                            {{ optional(optional($affectation->demande)->candidat)->nom }}
                        </td>
                        <td>{{ optional($affectation->service)->nomService ?? '—' }}</td>
                        <td>{{ optional($affectation->dateDebut)->format('d/m/Y') }}</td>
                        <td>{{ optional($affectation->dateFin)->format('d/m/Y') }}</td>
                        <td>
                            @if ($affectation->demande)
                                <a href="{{ route('responsable.demandes.show', $affectation->demande->idDemande) }}" class="btn btn-secondary" style="padding:7px 12px;">
                                    <i class="bi bi-eye-fill"></i> Détails
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="text-align:center;color:#94a3b8;padding:30px;">Aucun stage dans cette catégorie.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top:18px;">
            {{ $affectations->links('vendor.pagination.abhoer') }}
        </div>
    </div>

@endsection
