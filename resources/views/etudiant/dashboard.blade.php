@extends('layouts.etudiant')

@section('title', 'Tableau de bord')
@section('page-title', 'Bonjour ' . ($utilisateur->prenom ?? ''))
@section('page-subtitle', 'Suivez l\'état de vos demandes de stage')

@section('content')

    <style>
        .stat-cards { display: grid; grid-template-columns: repeat(4,1fr); gap: 16px; margin-bottom: 24px; }
        .stat-card { background: white; border-radius: var(--radius); box-shadow: var(--shadow); padding: 20px; }
        .stat-card .icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 19px; margin-bottom: 12px; }
        .stat-card .label { font-size: 12px; color: #64748b; margin-bottom: 4px; }
        .stat-card .value { font-size: 25px; font-weight: 700; color: var(--c-navy); }
        .icon-teal { background: var(--c-teal-pale); color: var(--c-teal-dark); }
        .icon-amber { background: #fef3c7; color: #92400e; }
        .icon-green { background: #d1fae5; color: #065f46; }
        .icon-red { background: #fee2e2; color: #991b1b; }

        .empty-state { text-align: center; padding: 50px 20px; }
        .empty-state .ico { font-size: 44px; color: var(--c-teal); margin-bottom: 14px; }
        .empty-state p { color: #64748b; font-size: 14px; margin-bottom: 18px; }

        .current-demande { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
        .cd-item { padding: 10px 0; border-bottom: 1px solid #f8fafc; font-size: 13.5px; }
        .cd-item span:first-child { color: #64748b; display: block; font-size: 11.5px; margin-bottom: 3px; }
        .cd-item span:last-child { font-weight: 600; color: var(--c-navy); }

        @media (max-width: 900px) { .stat-cards { grid-template-columns: repeat(2,1fr); } .current-demande { grid-template-columns: 1fr; } }
    </style>

    <div class="stat-cards">
        <div class="stat-card">
            <div class="icon icon-teal"><i class="bi bi-file-earmark-text-fill"></i></div>
            <div class="label">Mes demandes</div>
            <div class="value">{{ $totalDemandes }}</div>
        </div>
        <div class="stat-card">
            <div class="icon icon-amber"><i class="bi bi-hourglass-split"></i></div>
            <div class="label">En cours</div>
            <div class="value">{{ $enCours }}</div>
        </div>
        <div class="stat-card">
            <div class="icon icon-green"><i class="bi bi-check-circle-fill"></i></div>
            <div class="label">Acceptées</div>
            <div class="value">{{ $acceptees }}</div>
        </div>
        <div class="stat-card">
            <div class="icon icon-red"><i class="bi bi-x-circle-fill"></i></div>
            <div class="label">Refusées</div>
            <div class="value">{{ $refusees }}</div>
        </div>
    </div>

    @if ($derniereDemande)
        <div class="card" style="margin-bottom:22px;">
            <h3 style="font-size:14.5px;color:var(--c-navy);margin-bottom:16px;display:flex;justify-content:space-between;align-items:center;">
                Ma demande actuelle — {{ $derniereDemande->numeroDemande }}
                <span class="badge badge-{{ $derniereDemande->statut }}">{{ $derniereDemande->statut }}</span>
            </h3>
            <div class="current-demande">
                <div class="cd-item"><span>Service</span><span>{{ $derniereDemande->service->nomService ?? '—' }}</span></div>
                <div class="cd-item"><span>Type de stage</span><span>{{ $derniereDemande->typeStage ?? '—' }}</span></div>
                <div class="cd-item"><span>Date de début</span><span>{{ $derniereDemande->dateDebut ? $derniereDemande->dateDebut->format('d/m/Y') : '—' }}</span></div>
                <div class="cd-item"><span>Date de fin</span><span>{{ $derniereDemande->dateFin ? $derniereDemande->dateFin->format('d/m/Y') : '—' }}</span></div>
            </div>
            <a href="{{ route('etudiant.demande.index') }}" class="btn btn-outline" style="margin-top:16px;">Voir toutes mes demandes <i class="bi bi-arrow-right"></i></a>
        </div>
    @else
        <div class="card empty-state">
            <div class="ico"><i class="bi bi-file-earmark-x"></i></div>
            <p>Vous n'avez encore déposé aucune demande de stage.</p>
            <a href="{{ route('etudiant.demande.create') }}" class="btn btn-primary"><i class="bi bi-file-earmark-plus-fill"></i> Déposer ma première demande</a>
        </div>
    @endif

@endsection
