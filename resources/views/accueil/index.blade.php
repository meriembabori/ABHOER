@extends('layouts.public')

@section('title', 'Accueil')

@push('styles')
    .hero {
        position: relative;
        min-height: 640px;
        display: flex;
        align-items: center;
        overflow: hidden;
        background: url('{{ asset("images/bassin/barrage-2.jpeg") }}') center/cover no-repeat;
        border-radius: 0 0 40px 40px;
    }
    .hero::before {
        content: '';
        position: absolute; inset: 0;
        background: linear-gradient(100deg, rgba(15,23,42,0.72) 0%, rgba(15,23,42,0.35) 55%, rgba(15,23,42,0.15) 100%);
    }
    .hero-inner {
        position: relative; z-index: 2;
        max-width: 1280px; margin: 0 auto; padding: 0 48px;
        display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 30px; align-items: center;
        width: 100%;
    }
    .hero-text { color: white; animation: fadeUp 1s ease both; }
    .hero-text h1 { font-size: 42px; line-height: 1.2; margin-bottom: 18px; font-weight: 700; }
    .hero-text h1 span { color: #5eead4; }
    .hero-text p { font-size: 15.5px; opacity: 0.92; line-height: 1.7; margin-bottom: 30px; max-width: 520px; }
    .hero-buttons { display: flex; gap: 14px; flex-wrap: wrap; }
    @keyframes fadeUp { from { opacity: 0; transform: translateY(26px); } to { opacity: 1; transform: translateY(0); } }

    .engagements-card {
        background: rgba(15,23,42,0.72);
        backdrop-filter: blur(8px);
        border-radius: 18px;
        padding: 26px;
        color: white;
        animation: slideIn 1.1s ease both;
        border: 1px solid rgba(255,255,255,0.12);
    }
    @keyframes slideIn { from { opacity: 0; transform: translateX(30px); } to { opacity: 1; transform: translateX(0); } }
    .engagements-card h3 { font-size: 14px; margin-bottom: 16px; }
    .engagement-item { display: flex; align-items: center; gap: 12px; margin-bottom: 14px; font-size: 13.5px; }
    .engagement-item .ico {
        width: 32px; height: 32px; border-radius: 9px; background: rgba(94,234,212,0.15);
        color: #5eead4; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .engagements-card .btn { width: 100%; justify-content: center; margin-top: 6px; }

    .wave-decor { position: absolute; bottom: -1px; left: 0; width: 100%; z-index: 2; line-height: 0; }
    .wave-decor svg { width: 100%; height: 60px; display: block; }

    .intro-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 55px; align-items: center; }
    .intro-text p { color: #475569; line-height: 1.85; font-size: 15px; margin-bottom: 16px; }
    .intro-media {
        position: relative; border-radius: 20px; overflow: hidden;
        box-shadow: 0 25px 60px rgba(15,23,42,0.18);
    }
    .intro-media img { width: 100%; display: block; transition: transform 0.5s; }
    .intro-media:hover img { transform: scale(1.04); }
    .play-btn {
        position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%);
        width: 62px; height: 62px; border-radius: 50%; background: rgba(255,255,255,0.92);
        display: flex; align-items: center; justify-content: center; font-size: 24px; color: var(--c-teal-dark);
        box-shadow: 0 10px 25px rgba(0,0,0,0.25);
    }

    .stats-row { display: grid; grid-template-columns: repeat(4,1fr); gap: 18px; margin-top: 40px; }
    .stat-box { background: var(--c-teal-pale); border-radius: 16px; padding: 22px; text-align: center; }
    .stat-box .num { font-size: 26px; font-weight: 700; color: var(--c-teal-dark); }
    .stat-box .label { font-size: 12px; color: #475569; margin-top: 4px; }

    .domaines-section { background: var(--c-bg); border-radius: 30px; margin: 0 24px; }
    .domaines-grid { display: grid; grid-template-columns: repeat(5,1fr); gap: 18px; margin-top: 36px; }
    .domaine-card {
        background: white; border-radius: 16px; padding: 26px 16px; text-align: center;
        box-shadow: 0 6px 18px rgba(15,23,42,0.05); transition: transform 0.3s;
    }
    .domaine-card:hover { transform: translateY(-6px); }
    .domaine-card .ico {
        width: 52px; height: 52px; border-radius: 14px; margin: 0 auto 14px;
        background: linear-gradient(135deg, var(--c-teal), var(--c-teal-dark));
        display: flex; align-items: center; justify-content: center; color: white; font-size: 22px;
    }
    .domaine-card p { font-size: 13px; font-weight: 600; color: var(--c-navy); line-height: 1.4; }

    .gallery-carousel { display: grid; grid-template-columns: repeat(3,1fr); gap: 18px; margin-top: 36px; }
    .gallery-item { position: relative; border-radius: 16px; overflow: hidden; aspect-ratio: 4/3; box-shadow: 0 8px 22px rgba(15,23,42,0.08); }
    .gallery-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
    .gallery-item:hover img { transform: scale(1.08); }
    .gallery-caption {
        position: absolute; inset: auto 0 0 0; padding: 14px 16px 12px;
        background: linear-gradient(0deg, rgba(15,23,42,0.85), transparent); color: white; font-size: 12.5px; line-height: 1.4;
    }

    .cta-section {
        background: linear-gradient(135deg, var(--c-teal-dark), var(--c-teal));
        border-radius: 28px; margin: 0 24px 70px; padding: 50px 40px; text-align: center; color: white;
    }
    .cta-section h2 { font-size: 26px; margin-bottom: 12px; }
    .cta-section p { opacity: 0.92; margin-bottom: 26px; font-size: 14.5px; }
    .cta-section .btn-outline { background: white; }

    @media (max-width: 1000px) {
        .hero-inner { grid-template-columns: 1fr; }
        .intro-grid { grid-template-columns: 1fr; }
        .stats-row, .domaines-grid, .gallery-carousel { grid-template-columns: repeat(2,1fr); }
    }
    @media (max-width: 560px) {
        .stats-row, .domaines-grid, .gallery-carousel { grid-template-columns: 1fr; }
        .hero-text h1 { font-size: 30px; }
    }
@endpush

@section('content')

    <div class="hero">
        <div class="hero-inner">
            <div class="hero-text">
                <h1>Agir aujourd'hui pour préserver <span>l'eau de demain</span></h1>
                <p>
                    L'Agence du Bassin Hydraulique de l'Oum Er-Rbia (ABHOER) œuvre chaque jour pour une gestion
                    intégrée et durable des ressources en eau du bassin — Béni Mellal, Maroc.
                </p>
                <div class="hero-buttons">
                    <a href="{{ route('inscription') }}" class="btn btn-primary"><i class="bi bi-file-earmark-plus-fill"></i> Déposer une demande de stage</a>
                    <a href="{{ route('login') }}" class="btn btn-outline" style="background:rgba(255,255,255,0.95);"><i class="bi bi-box-arrow-in-right"></i> Espace connexion</a>
                </div>
            </div>

            <div class="engagements-card">
                <h3><i class="bi bi-shield-check"></i> Nos engagements</h3>
                <div class="engagement-item">
                    <div class="ico"><i class="bi bi-droplet-fill"></i></div>
                    Gestion intégrée des ressources en eau
                </div>
                <div class="engagement-item">
                    <div class="ico"><i class="bi bi-tree-fill"></i></div>
                    Protection de l'environnement
                </div>
                <div class="engagement-item">
                    <div class="ico"><i class="bi bi-map-fill"></i></div>
                    Accompagnement des territoires
                </div>
                <a href="{{ route('accueil.services') }}" class="btn btn-outline" style="background:rgba(255,255,255,0.95);">En savoir plus <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>

        <div class="wave-decor">
            <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path fill="#ffffff" d="M0,30 C240,60 480,0 720,30 C960,60 1200,0 1440,30 L1440,60 L0,60 Z"></path>
            </svg>
        </div>
    </div>

    <section id="intro">
        <div class="intro-grid">
            <div class="intro-text reveal">
                <p class="section-label">À propos de l'agence</p>
                <h2 class="section-title">Une mission au service de l'eau</h2>
                <p>
                    L'ABHOER, basée à Béni Mellal, est un établissement public marocain chargé de la gestion
                    intégrée, de l'évaluation et de la protection des ressources en eau du bassin de l'Oum Er-Rbia
                    — l'un des plus grands bassins versants du Royaume.
                </p>
                <p>
                    Notre mission : planifier, gérer et protéger durablement l'eau pour soutenir le développement
                    des territoires et préserver l'environnement.
                </p>
                <a href="{{ route('accueil.services') }}" class="btn btn-outline">Découvrir nos services <i class="bi bi-arrow-right"></i></a>

                <div class="stats-row">
                    <div class="stat-box"><div class="num">6</div><div class="label">Directions de service</div></div>
                    <div class="stat-box"><div class="num">1963</div><div class="label">Année de création</div></div>
                    <div class="stat-box"><div class="num">100%</div><div class="label">Service en ligne</div></div>
                    <div class="stat-box"><div class="num">+20</div><div class="label">Partenaires engagés</div></div>
                </div>
            </div>

            <div class="intro-media reveal">
                <img src="{{ asset('images/bassin/barrage-al-massira.jpeg') }}" alt="Barrage Al Massira">
                <div class="play-btn"><i class="bi bi-play-circle-fill"></i></div>
            </div>
        </div>
    </section>

    <section class="domaines-section">
        <div style="text-align:center;">
            <p class="section-label">Ce que nous faisons</p>
            <h2 class="section-title">Nos domaines d'intervention</h2>
        </div>

        <div class="domaines-grid">
            <div class="domaine-card reveal"><div class="ico"><i class="bi bi-droplet-fill"></i></div><p>Gestion des ressources en eau</p></div>
            <div class="domaine-card reveal"><div class="ico"><i class="bi bi-tree-fill"></i></div><p>Protection de l'environnement</p></div>
            <div class="domaine-card reveal"><div class="ico"><i class="bi bi-bar-chart-fill"></i></div><p>Études et Planification</p></div>
            <div class="domaine-card reveal"><div class="ico"><i class="bi bi-megaphone-fill"></i></div><p>Information &amp; Sensibilisation</p></div>
            <div class="domaine-card reveal"><div class="ico"><i class="bi bi-people-fill"></i></div><p>Appui aux territoires</p></div>
        </div>
    </section>

    <section id="galerie">
        <div style="text-align:center;">
            <p class="section-label">En images</p>
            <h2 class="section-title">Le bassin de l'Oum Er-Rbia</h2>
        </div>

        <div class="gallery-carousel">
            @foreach (array_slice($galerie, 0, 3) as $photo)
                <div class="gallery-item reveal">
                    <img src="{{ asset($photo['src']) }}" alt="{{ $photo['legende'] }}">
                    <div class="gallery-caption">{{ $photo['legende'] }}</div>
                </div>
            @endforeach
        </div>

        <div style="text-align:center;margin-top:30px;">
            <a href="{{ route('accueil.localisation') }}" class="btn btn-outline">Voir toutes les photos <i class="bi bi-arrow-right"></i></a>
        </div>
    </section>

    <section style="padding-top:0;">
        <div class="cta-section reveal">
            <h2>Prêt à déposer votre demande de stage ?</h2>
            <p>Créez votre compte et suivez le traitement de votre dossier en temps réel.</p>
            <a href="{{ route('inscription') }}" class="btn btn-outline"><i class="bi bi-file-earmark-plus-fill"></i> S'inscrire maintenant</a>
        </div>
    </section>

@endsection
