@extends('layouts.admin')

@section('title', 'Tableau de bord administrateur')

@section('content')

<style>
    .ad-hero { position: relative; border-radius: 20px; overflow: hidden; margin-bottom: 24px; background: linear-gradient(120deg, #F4FAF9, #E4F5F2); min-height: 170px; padding: 28px 34px; display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap; }
    .ad-hero-photo { position: absolute; top: 0; right: 0; bottom: 0; width: 46%; background: url('{{ asset("images/bassin/arriere-plan-etudiant.png") }}') center/cover no-repeat; -webkit-mask-image: linear-gradient(90deg, transparent 0%, black 22%); mask-image: linear-gradient(90deg, transparent 0%, black 22%); z-index: 0; }
    .ad-hero-text { position: relative; z-index: 2; max-width: 560px; display: flex; align-items: center; gap: 16px; }
    .ad-hero-icon { width: 46px; height: 46px; border-radius: 14px; background: var(--ad-teal); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
    .ad-hero-text h1 { font-size: 24px; font-weight: 800; color: var(--ad-text); margin-bottom: 6px; }
    .ad-hero-text p { font-size: 13.5px; color: var(--ad-muted); margin: 0; }
    .ad-hero-quote { position: relative; z-index: 2; flex-shrink: 0; align-self: flex-start; font-family: 'Segoe Script', cursive; font-style: italic; color: var(--ad-teal-dark); font-size: 14.5px; line-height: 1.4; text-align: right; max-width: 220px; margin-left: auto; }

    .ad-stat-card { padding: 22px; position: relative; overflow: hidden; transition: transform .2s ease; }
    .ad-stat-card:hover { transform: translateY(-3px); }
    .ad-stat-card.c-teal { background: linear-gradient(135deg, #ffffff 55%, #DCF1EE 100%); }
    .ad-stat-card.c-amber { background: linear-gradient(135deg, #ffffff 55%, #FBEFD3 100%); }
    .ad-stat-card.c-green { background: linear-gradient(135deg, #ffffff 55%, #E8F3D8 100%); }
    .ad-stat-card.c-red { background: linear-gradient(135deg, #ffffff 55%, #FBE3E4 100%); }
    .ad-stat-top { display: flex; align-items: center; justify-content: space-between; position: relative; z-index: 1; }
    .ad-stat-icon-circle { width: 46px; height: 46px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 19px; color: #fff; flex-shrink: 0; }
    .ad-stat-icon-circle.bg-teal { background: linear-gradient(135deg, var(--ad-teal), var(--ad-teal-dark)); }
    .ad-stat-icon-circle.bg-amber { background: linear-gradient(135deg, #F3B94E, #DB9422); }
    .ad-stat-icon-circle.bg-green { background: linear-gradient(135deg, #6FBF5A, #4E9A3B); }
    .ad-stat-icon-circle.bg-red { background: linear-gradient(135deg, #EF5F63, #D8383D); }
    .ad-stat-chevron-circle { width: 28px; height: 28px; border-radius: 50%; background: rgba(255,255,255,.7); display: flex; align-items: center; justify-content: center; color: var(--ad-text); font-size: 13px; }
    .ad-stat-title { font-size: 14px; font-weight: 700; color: var(--ad-text); margin: 14px 0 2px; position: relative; z-index: 1; }
    .ad-stat-num { font-size: 28px; font-weight: 800; color: var(--ad-text); position: relative; z-index: 1; line-height: 1; }
    .ad-stat-label { font-size: 12px; color: var(--ad-muted); margin-top: 6px; position: relative; z-index: 1; }

    .ad-info-card { padding: 22px; background: linear-gradient(135deg, #ffffff 55%, #E8F3F1 100%); position: relative; overflow: hidden; }
    .ad-info-icon { width: 42px; height: 42px; border-radius: 50%; background: var(--ad-teal-pale); color: var(--ad-teal-dark); display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0; }
    .ad-info-title { font-size: 14.5px; font-weight: 750; color: var(--ad-text); margin-bottom: 2px; }
    .ad-info-text { font-size: 12px; color: var(--ad-muted); }
    .ad-info-value { font-size: 32px; font-weight: 800; color: var(--ad-teal-dark); margin: 18px 0 8px; position: relative; z-index: 1; }
    .ad-info-footer { display: flex; justify-content: space-between; align-items: center; font-size: 12.5px; color: var(--ad-muted); position: relative; z-index: 1; }
    .ad-info-footer a { color: var(--ad-teal-dark); font-weight: 700; }
    .ad-info-pill { border-radius: 999px; padding: 4px 11px; font-size: 11px; font-weight: 700; background: var(--ad-teal-pale); color: var(--ad-teal-dark); }
    .ad-info-deco { position: absolute; right: -6px; bottom: -6px; font-size: 78px; color: rgba(14,156,143,.09); }

    .ad-section-card { padding: 24px; }
    .ad-section-title { font-size: 16px; font-weight: 750; color: var(--ad-text); }
    .ad-section-description { color: var(--ad-muted); font-size: 12.5px; margin: 3px 0 18px; }
    .ad-action { display: flex; align-items: center; gap: 14px; width: 100%; padding: 15px 16px; background: var(--ad-teal-pale); border: 1px solid var(--ad-border); border-radius: 12px; text-decoration: none; color: var(--ad-text); transition: transform .2s ease; }
    .ad-action:hover { transform: translateX(2px); color: var(--ad-text); }
    .ad-action-icon { width: 40px; height: 40px; border-radius: 11px; background: #fff; color: var(--ad-teal-dark); display: flex; align-items: center; justify-content: center; font-size: 17px; flex-shrink: 0; }
    .ad-action-title { font-size: 13px; font-weight: 750; }
    .ad-action-text { font-size: 11px; color: var(--ad-muted); }
    .ad-action > .bi-chevron-right { color: var(--ad-muted); margin-left: auto; }
</style>

<div class="ad-hero">
    <div class="ad-hero-photo"></div>
    <div class="ad-hero-text">
        <div class="ad-hero-icon"><i class="bi bi-bar-chart-fill"></i></div>
        <div>
            <h1>Tableau de bord administrateur</h1>
            <p>Bienvenue dans votre espace d'administration de l'ABHOER.</p>
        </div>
    </div>
    <div class="ad-hero-quote">« Ensemble pour<br>une gestion durable<br>de l'eau »</div>
</div>

@if(session('success'))
    <div class="alert ad-alert mb-4"><i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}</div>
@endif

<div class="row g-3 mb-4">
    <div class="col-xl-3 col-md-6">
        <a href="{{ route('admin.demandes.index') }}" class="card ad-stat-card c-teal text-decoration-none d-block">
            <div class="ad-stat-top">
                <div class="ad-stat-icon-circle bg-teal"><i class="bi bi-file-earmark-text-fill"></i></div>
                <div class="ad-stat-chevron-circle"><i class="bi bi-chevron-right"></i></div>
            </div>
            <div class="ad-stat-title">Total demandes</div>
            <div class="ad-stat-num">{{ $totalDemandes }}</div>
            <div class="ad-stat-label">Demandes enregistrées</div>
        </a>
    </div>
    <div class="col-xl-3 col-md-6">
        <a href="{{ route('admin.demandes.index') }}?statut=EN_ATTENTE" class="card ad-stat-card c-amber text-decoration-none d-block">
            <div class="ad-stat-top">
                <div class="ad-stat-icon-circle bg-amber"><i class="bi bi-hourglass-split"></i></div>
                <div class="ad-stat-chevron-circle"><i class="bi bi-chevron-right"></i></div>
            </div>
            <div class="ad-stat-title">En attente</div>
            <div class="ad-stat-num">{{ $demandesEnAttente }}</div>
            <div class="ad-stat-label">À traiter</div>
        </a>
    </div>
    <div class="col-xl-3 col-md-6">
        <a href="{{ route('admin.demandes.index') }}?statut=ACCEPTEE" class="card ad-stat-card c-green text-decoration-none d-block">
            <div class="ad-stat-top">
                <div class="ad-stat-icon-circle bg-green"><i class="bi bi-check-circle-fill"></i></div>
                <div class="ad-stat-chevron-circle"><i class="bi bi-chevron-right"></i></div>
            </div>
            <div class="ad-stat-title">Acceptées</div>
            <div class="ad-stat-num">{{ $demandesAcceptees }}</div>
            <div class="ad-stat-label">Demandes acceptées</div>
        </a>
    </div>
    <div class="col-xl-3 col-md-6">
        <a href="{{ route('admin.demandes.index') }}?statut=REFUSEE" class="card ad-stat-card c-red text-decoration-none d-block">
            <div class="ad-stat-top">
                <div class="ad-stat-icon-circle bg-red"><i class="bi bi-x-circle-fill"></i></div>
                <div class="ad-stat-chevron-circle"><i class="bi bi-chevron-right"></i></div>
            </div>
            <div class="ad-stat-title">Refusées</div>
            <div class="ad-stat-num">{{ $demandesRefusees }}</div>
            <div class="ad-stat-label">Demandes refusées</div>
        </a>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-xl-4 col-md-6">
        <div class="card ad-info-card">
            <i class="bi bi-people-fill ad-info-deco"></i>
            <div class="d-flex align-items-center gap-3">
                <div class="ad-info-icon"><i class="bi bi-people-fill"></i></div>
                <div>
                    <div class="ad-info-title">Utilisateurs</div>
                    <div class="ad-info-text">Comptes enregistrés sur la plateforme</div>
                </div>
            </div>
            <div class="ad-info-value">{{ $totalUtilisateurs }}</div>
            <div class="ad-info-footer">
                <span>Utilisateur(s)</span>
                <a href="{{ route('admin.utilisateurs.index') }}">Gérer <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="card ad-info-card">
            <i class="bi bi-person-badge-fill ad-info-deco"></i>
            <div class="d-flex align-items-center gap-3">
                <div class="ad-info-icon"><i class="bi bi-person-badge-fill"></i></div>
                <div>
                    <div class="ad-info-title">Candidats</div>
                    <div class="ad-info-text">Étudiants inscrits dans la plateforme</div>
                </div>
            </div>
            <div class="ad-info-value">{{ $totalCandidats }}</div>
            <div class="ad-info-footer">
                <span>Candidat(s)</span>
                <span class="ad-info-pill"><i class="bi bi-check-circle-fill me-1"></i> Actifs</span>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="card ad-info-card">
            <i class="bi bi-buildings-fill ad-info-deco"></i>
            <div class="d-flex align-items-center gap-3">
                <div class="ad-info-icon"><i class="bi bi-diagram-3-fill"></i></div>
                <div>
                    <div class="ad-info-title">Services</div>
                    <div class="ad-info-text">Services disponibles pour les stages</div>
                </div>
            </div>
            <div class="ad-info-value">{{ $totalServices }}</div>
            <div class="ad-info-footer">
                <span>Service(s)</span>
                <span class="ad-info-pill"><i class="bi bi-buildings me-1"></i> ABHOER</span>
            </div>
        </div>
    </div>
</div>

<div class="card ad-section-card">
    <div class="ad-section-title"><i class="bi bi-lightning-charge-fill me-2" style="color:var(--ad-teal-dark);"></i>Actions rapides</div>
    <div class="ad-section-description">Accédez rapidement aux principales fonctions d'administration.</div>

    <div class="row g-3">
        <div class="col-xl-4 col-md-6">
            <a href="{{ route('admin.utilisateurs.index') }}" class="ad-action">
                <div class="ad-action-icon"><i class="bi bi-people-fill"></i></div>
                <div><div class="ad-action-title">Gérer les utilisateurs</div><div class="ad-action-text">Consulter et gérer les comptes</div></div>
                <i class="bi bi-chevron-right"></i>
            </a>
        </div>
        <div class="col-xl-4 col-md-6">
            <a href="{{ route('admin.utilisateurs.create') }}" class="ad-action">
                <div class="ad-action-icon"><i class="bi bi-person-plus-fill"></i></div>
                <div><div class="ad-action-title">Ajouter un utilisateur</div><div class="ad-action-text">Créer un nouveau compte</div></div>
                <i class="bi bi-chevron-right"></i>
            </a>
        </div>
        <div class="col-xl-4 col-md-6">
            <a href="{{ route('admin.demandes.index') }}" class="ad-action">
                <div class="ad-action-icon"><i class="bi bi-file-earmark-text-fill"></i></div>
                <div><div class="ad-action-title">Voir les demandes</div><div class="ad-action-text">Consulter les demandes de stage</div></div>
                <i class="bi bi-chevron-right"></i>
            </a>
        </div>
    </div>
</div>

@endsection
