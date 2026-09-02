@extends('layouts.responsable')

@section('title', 'Suivi des stages')
@section('page-title', 'Suivi des stages')
@section('page-description', 'Stages à venir, en cours et terminés.')

@section('content')

<ul class="nav nav-pills mb-4">
    <li class="nav-item">
        <a href="{{ route('responsable.stages.index', ['statut' => 'a_venir']) }}" class="nav-link {{ $onglet === 'a_venir' ? 'active' : '' }}">
            <i class="bi bi-clock me-1"></i> À venir <span class="badge bg-light text-dark ms-1">{{ $compteurs['a_venir'] }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('responsable.stages.index', ['statut' => 'en_cours']) }}" class="nav-link {{ $onglet === 'en_cours' ? 'active' : '' }}">
            <i class="bi bi-play-circle me-1"></i> En cours <span class="badge bg-light text-dark ms-1">{{ $compteurs['en_cours'] }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('responsable.stages.index', ['statut' => 'termine']) }}" class="nav-link {{ $onglet === 'termine' ? 'active' : '' }}">
            <i class="bi bi-check-circle me-1"></i> Terminés <span class="badge bg-light text-dark ms-1">{{ $compteurs['termine'] }}</span>
        </a>
    </li>
</ul>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
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
                        <td class="fw-bold">{{ optional($affectation->demande)->numeroDemande }}</td>
                        <td>{{ optional(optional($affectation->demande)->candidat)->prenom }} {{ optional(optional($affectation->demande)->candidat)->nom }}</td>
                        <td>{{ optional($affectation->service)->nomService ?? '—' }}</td>
                        <td>{{ optional($affectation->dateDebut)->format('d/m/Y') }}</td>
                        <td>{{ optional($affectation->dateFin)->format('d/m/Y') }}</td>
                        <td>
                            @if ($affectation->demande)
                                <a href="{{ route('responsable.demandes.show', $affectation->demande->idDemande) }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-eye"></i> Détails</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-5">Aucun stage dans cette catégorie.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white py-3">
        {{ $affectations->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection
