@extends('layouts.etudiant')

@section('title', 'Tableau de bord')

@section('content')

@php
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
    .et-hero {
        position: relative; border-radius: 20px; overflow: hidden; margin-bottom: 24px;
        background: linear-gradient(120deg, #F4FAF9, #E4F5F2);
        min-height: 170px; padding: 28px 34px;
        display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap;
    }
    .et-hero-photo {
        position: absolute; top: 0; right: 0; bottom: 0; width: 46%;
        background: url('{{ asset("images/bassin/arriere-plan-etudiant.png") }}') center/cover no-repeat;
        -webkit-mask-image: linear-gradient(90deg, transparent 0%, black 22%);
        mask-image: linear-gradient(90deg, transparent 0%, black 22%);
        z-index: 0;
    }
    .et-hero-text { position: relative; z-index: 2; max-width: 560px; }
    .et-hero-text h1 { font-size: 26px; font-weight: 800; color: var(--et-text); margin-bottom: 8px; }
    .et-hero-text p { font-size: 13.5px; color: var(--et-muted); margin: 0; }
    .et-hero-quote {
        position: relative; z-index: 2; flex-shrink: 0; align-self: flex-start;
        font-family: 'Segoe Script', cursive; font-style: italic; color: var(--et-teal-dark);
        font-size: 14.5px; line-height: 1.4; text-align: right; max-width: 220px; margin-left: auto;
    }

    .et-profile-banner {
        position: relative; overflow: hidden;
        display: flex; align-items: center; justify-content: space-between;
        padding: 22px 28px; margin-bottom: 24px; flex-wrap: wrap; gap: 14px;
        background: linear-gradient(120deg, #ffffff 45%, #E4F5F2 100%);
    }
    .et-profile-banner-leaf { position: absolute; left: -18px; bottom: -18px; font-size: 110px; color: rgba(14,156,143,.10); transform: rotate(-15deg); z-index: 0; }
    .et-profile-banner-left { display: flex; align-items: center; gap: 16px; position: relative; z-index: 1; }
    .et-profile-banner-icon { width: 64px; height: 64px; border-radius: 50%; background: var(--et-teal-pale); color: var(--et-teal); display: flex; align-items: center; justify-content: center; font-size: 26px; overflow: hidden; flex-shrink: 0; border: 3px solid #fff; box-shadow: 0 4px 14px rgba(14,156,143,.18); }
    .et-profile-banner-icon img { width: 100%; height: 100%; object-fit: cover; }
    .et-profile-banner-name { font-size: 17px; font-weight: 800; color: var(--et-text); }
    .et-profile-banner-meta { display: flex; align-items: center; flex-wrap: wrap; gap: 14px; margin-top: 5px; }
    .et-profile-banner-role { font-size: 12.5px; color: var(--et-muted); display: flex; align-items: center; gap: 5px; }
    .et-profile-banner-badge { background: var(--et-teal-pale); color: var(--et-teal-dark); font-size: 11px; font-weight: 700; border-radius: 999px; padding: 4px 12px; display: inline-flex; align-items: center; gap: 5px; }
    .et-profile-banner-email { font-size: 12.5px; color: var(--et-muted); display: flex; align-items: center; gap: 5px; }

    .et-stat-card { padding: 22px; position: relative; overflow: hidden; transition: transform .2s ease; }
    .et-stat-card:hover { transform: translateY(-3px); }
    .et-stat-card::before { content:''; position:absolute; inset:0; opacity:.5; z-index:0; }
    .et-stat-card.c-teal { background: linear-gradient(135deg, #ffffff 55%, #DCF1EE 100%); }
    .et-stat-card.c-green { background: linear-gradient(135deg, #ffffff 55%, #E8F3D8 100%); }
    .et-stat-card.c-red { background: linear-gradient(135deg, #ffffff 55%, #FBE3E4 100%); }
    .et-stat-top { display: flex; align-items: flex-start; justify-content: space-between; position: relative; z-index: 1; margin-bottom: 22px; }
    .et-stat-icon-circle { width: 46px; height: 46px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 19px; color: #fff; }
    .et-stat-icon-circle.bg-teal { background: linear-gradient(135deg, var(--et-teal), var(--et-teal-dark)); }
    .et-stat-icon-circle.bg-green { background: linear-gradient(135deg, #9CCB4E, #78A93A); }
    .et-stat-icon-circle.bg-red { background: linear-gradient(135deg, #EF5F63, #D8383D); }
    .et-stat-chevron-circle { width: 30px; height: 30px; border-radius: 50%; background: rgba(255,255,255,.7); display: flex; align-items: center; justify-content: center; color: var(--et-text); font-size: 13px; box-shadow: 0 2px 8px rgba(0,0,0,.06); }
    .et-stat-title { font-size: 14px; font-weight: 700; color: var(--et-text); position: relative; z-index: 1; }
    .et-stat-num { font-size: 30px; font-weight: 800; color: var(--et-text); position: relative; z-index: 1; line-height: 1; }
    .et-stat-label { font-size: 12px; color: var(--et-muted); margin-top: 6px; position: relative; z-index: 1; }

    .et-cta-banner {
        border-radius: 18px; padding: 22px 28px; margin-bottom: 22px; color: #fff;
        background: linear-gradient(120deg, var(--et-teal-dark), var(--et-teal));
        display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap;
    }
    .et-cta-banner-left { display: flex; align-items: center; gap: 16px; }
    .et-cta-icon { width: 46px; height: 46px; border-radius: 50%; background: rgba(255,255,255,.18); display: flex; align-items: center; justify-content: center; font-size: 19px; flex-shrink: 0; }
    .et-cta-banner h5 { margin: 0 0 4px; font-size: 15.5px; font-weight: 750; }
    .et-cta-banner p { margin: 0; font-size: 12.5px; opacity: .92; max-width: 480px; }
    .btn-et-white { background: #fff; color: var(--et-teal-dark); border: none; border-radius: 999px; padding: 10px 20px; font-size: 13px; font-weight: 750; white-space: nowrap; }

    .et-mini-row { display: flex; align-items: center; gap: 14px; padding: 16px 22px; margin-bottom: 16px; }
    .et-mini-icon-circle { width: 42px; height: 42px; border-radius: 12px; background: var(--et-teal-pale); color: var(--et-teal-dark); display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0; }
    .et-mini-title { font-size: 13.5px; font-weight: 700; color: var(--et-text); }
    .et-mini-text { font-size: 12px; color: var(--et-muted); margin-top: 1px; }
    .et-stat-chevron { color: var(--et-muted); }
</style>

<div class="et-hero">
    <div class="et-hero-photo"></div>
    <div class="et-hero-text">
        <h1>Bonjour {{ trim(($user->prenom ?? '') . ' ' . ($user->nom ?? '')) ?: 'Étudiant(e)' }} 👋</h1>
        <p>Bienvenue dans votre espace étudiant ABHOER. Suivez vos demandes et gérez vos stages facilement.</p>
    </div>
    <div class="et-hero-quote">« Ensemble pour<br>une gestion durable<br>de l'eau »</div>
</div>

@if ($candidat)
<div class="card et-profile-banner">
    <i class="bi bi-flower2 et-profile-banner-leaf"></i>

    <div class="et-profile-banner-left">
        <div class="et-profile-banner-icon">
            @if ($candidat->photo)
                <img src="{{ asset('storage/' . $candidat->photo) }}" alt="Photo de profil">
            @else
                <i class="bi bi-person-fill"></i>
            @endif
        </div>
        <div>
            <div class="et-profile-banner-name">{{ $candidat->prenom ?? '' }} {{ $candidat->nom ?? '' }}</div>
            <div class="et-profile-banner-meta">
                <span class="et-profile-banner-role"><i class="bi bi-mortarboard-fill"></i> {{ $candidat->formation ?? 'Étudiant(e)' }}</span>
                <span class="et-profile-banner-badge"><i class="bi bi-patch-check-fill"></i> Étudiant(e)</span>
                @if ($candidat->email ?? false)
                    <span class="et-profile-banner-email"><i class="bi bi-envelope-fill"></i> {{ $candidat->email }}</span>
                @endif
            </div>
        </div>
    </div>

    <a href="{{ route('etudiant.profil') }}" class="btn btn-outline-primary btn-sm" style="position:relative;z-index:1;"><i class="bi bi-person-vcard-fill me-1"></i> Mon profil</a>
</div>
@endif

<div class="row g-3 mb-4">
    <div class="col-xl-3 col-md-6">
        <a href="{{ route('etudiant.demandes.index') }}" class="card et-stat-card c-teal text-decoration-none d-block">
            <div class="et-stat-top">
                <div class="et-stat-icon-circle bg-teal"><i class="bi bi-file-earmark-text-fill"></i></div>
                <div class="et-stat-chevron-circle"><i class="bi bi-chevron-right"></i></div>
            </div>
            <div class="et-stat-title mb-2">Mes demandes</div>
            <div class="et-stat-num">{{ $totalDemandes }}</div>
            <div class="et-stat-label">Demande(s) déposée(s)</div>
        </a>
    </div>
    <div class="col-xl-3 col-md-6">
        <a href="{{ route('etudiant.demandes.index') }}?statut=EN_ATTENTE" class="card et-stat-card c-green text-decoration-none d-block">
            <div class="et-stat-top">
                <div class="et-stat-icon-circle bg-green"><i class="bi bi-hourglass-split"></i></div>
                <div class="et-stat-chevron-circle"><i class="bi bi-chevron-right"></i></div>
            </div>
            <div class="et-stat-title mb-2">En attente</div>
            <div class="et-stat-num">{{ $demandesEnAttente }}</div>
            <div class="et-stat-label">En attente de traitement</div>
        </a>
    </div>
    <div class="col-xl-3 col-md-6">
        <a href="{{ route('etudiant.demandes.index') }}?statut=ACCEPTEE" class="card et-stat-card c-teal text-decoration-none d-block">
            <div class="et-stat-top">
                <div class="et-stat-icon-circle bg-teal"><i class="bi bi-check-circle-fill"></i></div>
                <div class="et-stat-chevron-circle"><i class="bi bi-chevron-right"></i></div>
            </div>
            <div class="et-stat-title mb-2">Acceptées</div>
            <div class="et-stat-num">{{ $demandesAcceptees }}</div>
            <div class="et-stat-label">Demande(s) acceptée(s)</div>
        </a>
    </div>
    <div class="col-xl-3 col-md-6">
        <a href="{{ route('etudiant.demandes.index') }}?statut=REFUSEE" class="card et-stat-card c-red text-decoration-none d-block">
            <div class="et-stat-top">
                <div class="et-stat-icon-circle bg-red"><i class="bi bi-x-circle-fill"></i></div>
                <div class="et-stat-chevron-circle"><i class="bi bi-chevron-right"></i></div>
            </div>
            <div class="et-stat-title mb-2">Refusées</div>
            <div class="et-stat-num">{{ $demandesRefusees }}</div>
            <div class="et-stat-label">Demande(s) refusée(s)</div>
        </a>
    </div>
</div>

<div class="et-cta-banner">
    <div class="et-cta-banner-left">
        <div class="et-cta-icon"><i class="bi bi-send-fill"></i></div>
        <div>
            <h5>Vous souhaitez effectuer un stage ?</h5>
            <p>Déposez une nouvelle demande de stage auprès de l'ABHOER et suivez son traitement depuis votre espace étudiant.</p>
        </div>
    </div>
    <a href="{{ route('etudiant.demandes.create') }}" class="btn-et-white"><i class="bi bi-plus-lg me-1"></i> Nouvelle demande</a>
</div>

@if ($stagesEnCours > 0)
<a href="{{ route('etudiant.demandes.index') }}" class="card et-mini-row text-decoration-none">
    <div class="et-mini-icon-circle"><i class="bi bi-calendar-check-fill"></i></div>
    <div>
        <div class="et-mini-title">Stage en cours</div>
        <div class="et-mini-text">Vous avez actuellement {{ $stagesEnCours }} stage(s) en cours.</div>
    </div>
    <i class="bi bi-chevron-right et-stat-chevron ms-auto"></i>
</a>
@endif

<div class="card">
    <div class="et-mini-row mb-0" style="border-bottom:1px solid var(--et-border);">
        <div class="et-mini-icon-circle"><i class="bi bi-list-ul"></i></div>
        <div>
            <div class="et-mini-title">Mes dernières demandes</div>
            <div class="et-mini-text">Consultez l'état de vos demandes de stage.</div>
        </div>
        <a href="{{ route('etudiant.demandes.index') }}" class="btn btn-outline-primary btn-sm ms-auto">Voir tout <i class="bi bi-arrow-right"></i></a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr><th>N° Demande</th><th>Service</th><th>Date de dépôt</th><th>Statut</th><th></th></tr>
            </thead>
            <tbody>
                @forelse ($dernieresDemandes as $demande)
                    @php $bc = $badgeColors[$demande->statut] ?? ['bg' => '#F1F5F4', 'text' => '#6B8582']; @endphp
                    <tr>
                        <td class="fw-bold">{{ $demande->numeroDemande }}</td>
                        <td>{{ $demande->service->nomService ?? '—' }}</td>
                        <td>{{ optional($demande->dateDepot)->format('d/m/Y') }}</td>
                        <td><span class="badge" style="background:{{ $bc['bg'] }};color:{{ $bc['text'] }};">{{ str_replace('_', ' ', $demande->statut) }}</span></td>
                        <td><a href="{{ route('etudiant.demandes.show', $demande->idDemande) }}" style="color:var(--et-teal-dark);"><i class="bi bi-eye"></i></a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5" style="color:var(--et-muted);">
                            Vous n'avez encore déposé aucune demande.<br>
                            <a href="{{ route('etudiant.demandes.create') }}" class="btn-et-primary d-inline-flex mt-3"><i class="bi bi-file-earmark-plus-fill me-1"></i> Déposer ma première demande</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
