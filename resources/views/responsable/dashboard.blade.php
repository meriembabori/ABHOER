@extends('layouts.responsable')

@section('title', 'Tableau de bord')

@section('content')

@php
    $statutData = [
        ['label' => 'En attente', 'value' => $demandesEnAttente, 'color' => '#F5A623'],
        ['label' => 'Infos demandées', 'value' => $demandesInfosDemandees, 'color' => '#0B6DAB'],
        ['label' => 'Acceptées', 'value' => $demandesAcceptees, 'color' => '#3F8F2A'],
        ['label' => 'Refusées', 'value' => $demandesRefusees, 'color' => '#E5484D'],
    ];
    $statutTotal = max(1, array_sum(array_column($statutData, 'value')));
    $cumul = 0; $gradientParts = [];
    foreach ($statutData as $s) {
        $start = $cumul / $statutTotal * 360;
        $cumul += $s['value'];
        $end = $cumul / $statutTotal * 360;
        $gradientParts[] = "{$s['color']} {$start}deg {$end}deg";
    }
    $conicGradient = 'conic-gradient(' . implode(', ', $gradientParts) . ')';

    $badgeColors = [
        'EN_ATTENTE' => ['bg' => '#FEF3E2', 'text' => '#B4720A'],
        'INFOS_DEMANDEES' => ['bg' => '#E6F2FB', 'text' => '#0B6DAB'],
        'ACCEPTEE' => ['bg' => '#E9F7E3', 'text' => '#3F8F2A'],
        'REFUSEE' => ['bg' => '#FDEDED', 'text' => '#B42318'],
        'STAGE_EN_COURS' => ['bg' => '#E4F5F2', 'text' => '#0B7F75'],
        'TERMINE' => ['bg' => '#F1EBFC', 'text' => '#6D3FBE'],
    ];
@endphp

<style>
    .rt-hero { position: relative; border-radius: 20px; overflow: hidden; margin-bottom: 24px; background: linear-gradient(120deg, #F4FAF9, #E4F5F2); min-height: 170px; padding: 28px 34px; display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap; }
    .rt-hero-photo { position: absolute; top: 0; right: 0; bottom: 0; width: 46%; background: url('{{ asset("images/bassin/arriere-plan-etudiant.png") }}') center/cover no-repeat; -webkit-mask-image: linear-gradient(90deg, transparent 0%, black 22%); mask-image: linear-gradient(90deg, transparent 0%, black 22%); z-index: 0; }
    .rt-hero-text { position: relative; z-index: 2; max-width: 560px; }
    .rt-hero-text h1 { font-size: 26px; font-weight: 800; color: var(--rt-text); margin-bottom: 8px; }
    .rt-hero-text p { font-size: 13.5px; color: var(--rt-muted); margin: 0; }
    .rt-hero-quote { position: relative; z-index: 2; flex-shrink: 0; align-self: flex-start; font-family: 'Segoe Script', cursive; font-style: italic; color: var(--rt-teal-dark); font-size: 14.5px; line-height: 1.4; text-align: right; max-width: 220px; margin-left: auto; }

    .rt-stat-card { padding: 22px; position: relative; overflow: hidden; transition: transform .2s ease; }
    .rt-stat-card:hover { transform: translateY(-3px); }
    .rt-stat-card.c-teal { background: linear-gradient(135deg, #ffffff 55%, #DCF1EE 100%); }
    .rt-stat-card.c-amber { background: linear-gradient(135deg, #ffffff 55%, #FBEFD3 100%); }
    .rt-stat-card.c-green { background: linear-gradient(135deg, #ffffff 55%, #E8F3D8 100%); }
    .rt-stat-card.c-red { background: linear-gradient(135deg, #ffffff 55%, #FBE3E4 100%); }
    .rt-stat-top { display: flex; align-items: center; justify-content: space-between; position: relative; z-index: 1; }
    .rt-stat-icon-circle { width: 46px; height: 46px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 19px; color: #fff; flex-shrink: 0; }
    .rt-stat-icon-circle.bg-teal { background: linear-gradient(135deg, var(--rt-teal), var(--rt-teal-dark)); }
    .rt-stat-icon-circle.bg-amber { background: linear-gradient(135deg, #F3B94E, #DB9422); }
    .rt-stat-icon-circle.bg-green { background: linear-gradient(135deg, #6FBF5A, #4E9A3B); }
    .rt-stat-icon-circle.bg-red { background: linear-gradient(135deg, #EF5F63, #D8383D); }
    .rt-stat-chevron-circle { width: 28px; height: 28px; border-radius: 50%; background: rgba(255,255,255,.7); display: flex; align-items: center; justify-content: center; color: var(--rt-text); font-size: 13px; }
    .rt-stat-title { font-size: 14px; font-weight: 700; color: var(--rt-text); margin: 14px 0 2px; position: relative; z-index: 1; }
    .rt-stat-num { font-size: 28px; font-weight: 800; color: var(--rt-text); position: relative; z-index: 1; line-height: 1; }
    .rt-stat-label { font-size: 12px; color: var(--rt-muted); margin-top: 6px; position: relative; z-index: 1; }

    .rt-panel { padding: 22px; height: 100%; }
    .rt-panel-title { display: flex; align-items: center; gap: 12px; font-size: 15px; font-weight: 750; color: var(--rt-text); margin-bottom: 18px; }
    .rt-panel-icon { width: 38px; height: 38px; border-radius: 50%; background: var(--rt-teal-pale); color: var(--rt-teal-dark); display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }

    .donut { width: 105px; height: 105px; border-radius: 50%; background: {{ $conicGradient }}; position: relative; flex-shrink: 0; display: flex; align-items: center; justify-content: center; }
    .donut::after { content: ''; position: absolute; inset: 16px; background: #fff; border-radius: 50%; }
    .donut-center { position: relative; z-index: 1; text-align: center; }
    .donut-center .n { font-size: 20px; font-weight: 800; color: var(--rt-text); line-height: 1; }
    .donut-center .l { font-size: 9.5px; color: var(--rt-muted); }
    .legend-item { display: flex; align-items: center; gap: 8px; font-size: 12.5px; margin-bottom: 8px; color: var(--rt-text); }
    .legend-dot { width: 9px; height: 9px; border-radius: 50%; flex-shrink: 0; }

    .attest-numbers { display: flex; justify-content: space-between; text-align: center; margin-bottom: 18px; }
    .attest-numbers .n { font-size: 20px; font-weight: 800; }
    .attest-numbers .l { font-size: 11px; color: var(--rt-muted); margin-top: 2px; }

    .rt-cta-card { background: linear-gradient(135deg, #ffffff, #E4F5F2); position: relative; overflow: hidden; }
    .rt-cta-leaf { position: absolute; right: -10px; bottom: -10px; font-size: 90px; color: rgba(14,156,143,.10); }

    .rt-status-badge { border-radius: 7px; padding: 5px 9px; font-size: 10.5px; font-weight: 700; display: inline-flex; align-items: center; gap: 4px; }
</style>

<div class="rt-hero">
    <div class="rt-hero-photo"></div>
    <div class="rt-hero-text">
        <h1>Bonjour Responsable 👋</h1>
        <p>Bienvenue dans votre espace de gestion des demandes de stage à l'ABHOER.</p>
    </div>
    <div class="rt-hero-quote">« Ensemble pour<br>une gestion durable<br>de l'eau »</div>
</div>

@if ($demandesEnAttente > 0)
<div class="alert rt-alert mb-4"><i class="bi bi-check-circle-fill me-2"></i>Vous avez <strong>{{ $demandesEnAttente }}</strong> nouvelle(s) demande(s) de stage à traiter.</div>
@endif

<div class="row g-3 mb-4">
    <div class="col-xl-3 col-md-6">
        <a href="{{ route('responsable.demandes.index') }}" class="card rt-stat-card c-teal text-decoration-none d-block">
            <div class="rt-stat-top">
                <div class="rt-stat-icon-circle bg-teal"><i class="bi bi-file-earmark-text-fill"></i></div>
                <div class="rt-stat-chevron-circle"><i class="bi bi-chevron-right"></i></div>
            </div>
            <div class="rt-stat-title">Total demandes</div>
            <div class="rt-stat-num">{{ $totalDemandes }}</div>
            <div class="rt-stat-label">Demandes enregistrées</div>
        </a>
    </div>
    <div class="col-xl-3 col-md-6">
        <a href="{{ route('responsable.demandes.index') }}?statut=EN_ATTENTE" class="card rt-stat-card c-amber text-decoration-none d-block">
            <div class="rt-stat-top">
                <div class="rt-stat-icon-circle bg-amber"><i class="bi bi-hourglass-split"></i></div>
                <div class="rt-stat-chevron-circle"><i class="bi bi-chevron-right"></i></div>
            </div>
            <div class="rt-stat-title">En attente</div>
            <div class="rt-stat-num">{{ $demandesEnAttente }}</div>
            <div class="rt-stat-label">À traiter</div>
        </a>
    </div>
    <div class="col-xl-3 col-md-6">
        <a href="{{ route('responsable.demandes.index') }}?statut=ACCEPTEE" class="card rt-stat-card c-green text-decoration-none d-block">
            <div class="rt-stat-top">
                <div class="rt-stat-icon-circle bg-green"><i class="bi bi-check-circle-fill"></i></div>
                <div class="rt-stat-chevron-circle"><i class="bi bi-chevron-right"></i></div>
            </div>
            <div class="rt-stat-title">Acceptées</div>
            <div class="rt-stat-num">{{ $demandesAcceptees }}</div>
            <div class="rt-stat-label">Demandes acceptées</div>
        </a>
    </div>
    <div class="col-xl-3 col-md-6">
        <a href="{{ route('responsable.demandes.index') }}?statut=REFUSEE" class="card rt-stat-card c-red text-decoration-none d-block">
            <div class="rt-stat-top">
                <div class="rt-stat-icon-circle bg-red"><i class="bi bi-x-circle-fill"></i></div>
                <div class="rt-stat-chevron-circle"><i class="bi bi-chevron-right"></i></div>
            </div>
            <div class="rt-stat-title">Refusées</div>
            <div class="rt-stat-num">{{ $demandesRefusees }}</div>
            <div class="rt-stat-label">Demandes refusées</div>
        </a>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-lg-4">
        <div class="card rt-panel">
            <div class="rt-panel-title"><div class="rt-panel-icon"><i class="bi bi-pie-chart-fill"></i></div> Répartition par statut</div>
            <div class="d-flex align-items-center gap-3">
                <div class="donut"><div class="donut-center"><div class="n">{{ $statutTotal }}</div><div class="l">Total</div></div></div>
                <div>
                    @foreach ($statutData as $s)
                        <div class="legend-item"><span class="legend-dot" style="background:{{ $s['color'] }};"></span>{{ $s['label'] }} — <strong>{{ $s['value'] }}</strong></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card rt-panel d-flex flex-column">
            <div class="rt-panel-title"><div class="rt-panel-icon"><i class="bi bi-award-fill"></i></div> Attestations</div>
            <div class="attest-numbers">
                <div><div class="n" style="color:#B4720A;">{{ $attestationsEnPreparation }}</div><div class="l">En préparation</div></div>
                <div><div class="n" style="color:#0B6DAB;">{{ $attestationsPretes }}</div><div class="l">Prêtes</div></div>
                <div><div class="n" style="color:#3F8F2A;">{{ $attestationsRemises }}</div><div class="l">Remises</div></div>
            </div>
            <a href="{{ route('responsable.attestations.index') }}" class="btn btn-outline-primary mt-auto"><i class="bi bi-person-fill me-1"></i> Gérer les attestations</a>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card rt-panel rt-cta-card d-flex flex-column justify-content-center">
            <i class="bi bi-file-earmark-text-fill rt-cta-leaf"></i>
            <div class="rt-panel-title mb-2"><div class="rt-panel-icon"><i class="bi bi-file-earmark-text-fill"></i></div> Voir toutes les demandes</div>
            <p class="small mb-3" style="color:var(--rt-muted); position:relative; z-index:1;">Consultez et suivez l'ensemble des demandes de stage reçues.</p>
            <a href="{{ route('responsable.demandes.index') }}" class="btn-rt-primary d-inline-flex align-items-center justify-content-center" style="position:relative; z-index:1;"><i class="bi bi-search me-1"></i> Voir toutes les demandes</a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header py-3 px-4 d-flex align-items-center gap-2">
        <div class="rt-panel-icon"><i class="bi bi-clock-history"></i></div>
        <h6 class="mb-0">Dernières demandes déposées</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead><tr><th>N° Demande</th><th>Candidat</th><th>Service</th><th>Statut</th><th>Date dépôt</th><th></th></tr></thead>
            <tbody>
                @forelse ($dernieresDemandes as $demande)
                    @php $bc = $badgeColors[$demande->statut] ?? ['bg' => '#F1F5F4', 'text' => '#6B8582']; @endphp
                    <tr>
                        <td class="fw-bold">{{ $demande->numeroDemande }}</td>
                        <td>{{ $demande->candidat->prenom ?? '' }} {{ $demande->candidat->nom ?? '' }}</td>
                        <td>{{ $demande->service->nomService ?? '—' }}</td>
                        <td><span class="rt-status-badge" style="background:{{ $bc['bg'] }};color:{{ $bc['text'] }};">{{ str_replace('_', ' ', $demande->statut) }}</span></td>
                        <td>{{ optional($demande->dateDepot)->format('d/m/Y') }}</td>
                        <td><a href="{{ route('responsable.demandes.show', $demande->idDemande) }}" style="color:var(--rt-teal-dark);"><i class="bi bi-chevron-right"></i></a></td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-4" style="color:var(--rt-muted);">Aucune demande pour le moment.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer text-center py-3" style="background:transparent;">
        <a href="{{ route('responsable.demandes.index') }}" class="btn btn-outline-primary btn-sm">Voir toutes les demandes <i class="bi bi-arrow-right"></i></a>
    </div>
</div>

@endsection
