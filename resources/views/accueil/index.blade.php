@extends('layouts.public')

@section('title', 'Accueil')

@push('styles')
    /* ================= AQUA / SMART WATER HERO ================= */
    /* Shared tokens, navbar, buttons, badge and animations live in public/css/aqua-theme.css */
    .aqua-hero {
        --cyan: var(--aqua-cyan);
        --cyan-bright: var(--aqua-cyan-bright);
        --turquoise: var(--aqua-turquoise);
        --blue-water: var(--aqua-blue-water);
        --blue-deep: var(--aqua-blue-deep);
        --text-2: var(--aqua-text-2);
        --green-env: var(--aqua-green-env);
        --green-light: var(--aqua-green-light);
        --violet: var(--aqua-violet);
        --hairline: var(--aqua-hairline);
        --glass: var(--aqua-glass);

        position: relative;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        background: var(--aqua-bg-deep-1);
        font-family: 'Inter', 'Segoe UI', sans-serif;
        color: var(--aqua-white);
        border-radius: 0 0 32px 32px;
    }

    .aqua-hero__photo {
        position: absolute; inset: 0;
        background: url('{{ asset("images/bassin/hero-barrage-smart.jpg") }}') center 46%/cover no-repeat;
    }
    .aqua-hero__scrim {
        position: absolute; inset: 0;
        background:
            linear-gradient(90deg, rgba(1,18,30,0.96) 0%, rgba(1,24,39,0.80) 33%, rgba(1,24,39,0.40) 66%, rgba(1,18,30,0.55) 100%),
            linear-gradient(0deg, rgba(1,15,25,0.88) 0%, rgba(1,15,25,0.10) 24%, rgba(1,15,25,0) 52%, rgba(1,15,25,0.62) 100%);
    }
    .aqua-hero__mesh { position: absolute; inset: 0; opacity: 0.55; mix-blend-mode: screen; pointer-events: none; }
    .aqua-hero__mesh .pulse { animation: meshPulse 4.5s ease-in-out infinite; transform-origin: center; }
    .aqua-hero__mesh .pulse:nth-child(2n) { animation-delay: 1.1s; }
    .aqua-hero__mesh .pulse:nth-child(3n) { animation-delay: 2.3s; }
    .aqua-hero__mesh .flow { stroke-dasharray: 6 10; animation: meshFlow 18s linear infinite; }
    @keyframes meshPulse { 0%, 100% { opacity: 0.25; r: 1.6; } 50% { opacity: 1; r: 3; } }
    @keyframes meshFlow { to { stroke-dashoffset: -320; } }

    /* ---- Hero body ---- */
    .aqua-body {
        position: relative; z-index: 5; flex: 1;
        display: flex; align-items: center;
        padding: 40px clamp(20px, 4vw, 64px) 24px;
    }
    .aqua-grid {
        width: 100%; max-width: 1620px; margin: 0 auto;
        display: grid; grid-template-columns: 1fr 440px; gap: 56px; align-items: start;
    }

    .aqua-left { position: relative; padding-left: 26px; animation: aquaFadeUp 0.9s ease .1s both; }
    .aqua-left::before {
        content: ''; position: absolute; left: 0; top: 6px; bottom: 6px; width: 2px;
        background: linear-gradient(180deg, var(--cyan), transparent);
        box-shadow: 0 0 12px rgba(0,217,208,0.6);
    }
    .aqua-left::after {
        content: ''; position: absolute; left: -3px; top: 6px; width: 8px; height: 8px; border-radius: 50%;
        background: var(--cyan-bright); box-shadow: 0 0 12px 3px rgba(0,240,229,0.6);
        animation: meshPulse 3s ease-in-out infinite;
    }

    .aqua-left h1 {
        font-size: clamp(34px, 4.6vw, 64px); font-weight: 800; line-height: 1.06;
        color: var(--aqua-white); margin-bottom: 24px; letter-spacing: -0.5px;
    }
    .aqua-left h1 .accent { color: var(--cyan); text-shadow: 0 0 26px rgba(0,217,208,0.45); }

    .aqua-left p.lead {
        font-size: 17px; line-height: 1.65; color: #C4D2D9; max-width: 640px; margin-bottom: 34px;
    }

    .aqua-hero-buttons { display: flex; gap: 16px; flex-wrap: wrap; }
    .aqua-hero-buttons .aqua-btn-primary { min-width: 300px; }

    /* ---- Engagements panel ---- */
    .aqua-panel {
        position: relative; z-index: 5;
        background: rgba(8,25,37,0.80); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
        border: 1px solid var(--hairline); border-radius: 30px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.35);
        padding: 26px; animation: aquaSlideIn 0.9s ease .15s both;
    }
    .aqua-panel__head { display: flex; align-items: center; gap: 12px; padding-bottom: 18px; margin-bottom: 6px; border-bottom: 1px solid var(--hairline); }
    .aqua-panel__icon {
        width: 42px; height: 42px; border-radius: 50%; flex-shrink: 0;
        background: rgba(0,217,208,0.14); border: 1px solid rgba(0,217,208,0.3);
        display: flex; align-items: center; justify-content: center; color: var(--cyan); font-size: 18px;
    }
    .aqua-panel__head h3 { font-size: 20px; font-weight: 700; color: var(--aqua-white); }
    .aqua-panel__head span { font-size: 13px; color: var(--text-2); display: block; margin-top: 2px; }

    .aqua-engagement {
        display: flex; align-items: flex-start; gap: 14px;
        padding: 15px 8px; border-radius: 14px; border: 1px solid transparent;
        transition: background .3s, border-color .3s;
    }
    .aqua-engagement:hover { background: rgba(255,255,255,0.045); border-color: rgba(255,255,255,0.10); }
    .aqua-engagement__icon {
        width: 44px; height: 44px; border-radius: 12px; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center; font-size: 18px;
        transition: filter .3s;
    }
    .aqua-engagement.cyan .aqua-engagement__icon { background: rgba(0,217,208,0.14); color: var(--cyan); }
    .aqua-engagement.green .aqua-engagement__icon { background: rgba(139,214,60,0.14); color: var(--green-env); }
    .aqua-engagement.turquoise .aqua-engagement__icon { background: rgba(18,207,197,0.14); color: var(--turquoise); }
    .aqua-engagement:hover .aqua-engagement__icon { filter: brightness(1.25); }
    .aqua-engagement__body { flex: 1; min-width: 0; }
    .aqua-engagement__body h4 { font-size: 15px; font-weight: 700; color: var(--aqua-white); line-height: 1.3; margin-bottom: 4px; }
    .aqua-engagement__body p { font-size: 13px; color: var(--text-2); line-height: 1.5; }
    .aqua-engagement__arrow {
        width: 30px; height: 30px; border-radius: 50%; flex-shrink: 0; margin-top: 2px;
        border: 1px solid rgba(255,255,255,0.18); display: flex; align-items: center; justify-content: center;
        color: var(--aqua-white-2); font-size: 12px; transition: transform .3s, border-color .3s, color .3s;
    }
    .aqua-engagement:hover .aqua-engagement__arrow { transform: translateX(4px); border-color: var(--cyan); color: var(--cyan); }

    .aqua-panel__cta {
        display: flex; align-items: center; justify-content: center; gap: 8px;
        width: 100%; height: 62px; margin-top: 14px; border-radius: 16px;
        background: linear-gradient(135deg, #11C9C0, #1AD6C5); color: #012027;
        font-weight: 700; font-size: 15px; position: relative; overflow: hidden;
        box-shadow: 0 0 25px rgba(0,220,210,0.22); transition: transform .2s;
    }
    .aqua-panel__cta:hover { transform: translateY(-2px); }
    .aqua-panel__cta::after {
        content: ''; position: absolute; inset: 0; opacity: .5;
        background: linear-gradient(100deg, transparent 30%, rgba(255,255,255,0.35) 50%, transparent 70%);
        transform: translateX(-100%); animation: shimmer 3.5s ease-in-out infinite;
    }
    @keyframes shimmer { 60% { transform: translateX(-100%); } 100% { transform: translateX(100%); } }

    /* ---- Stat cards ---- */
    .aqua-stats {
        position: relative; z-index: 5;
        max-width: 1620px; margin: 0 auto; width: 100%;
        padding: 0 clamp(20px, 4vw, 64px) 44px;
        display: grid; grid-template-columns: repeat(4, 1fr); gap: 22px;
    }
    .aqua-stat {
        position: relative; overflow: hidden;
        background: rgba(6,20,30,0.65); backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px);
        border: 1px solid var(--hairline); border-radius: 18px;
        padding: 20px 22px; min-height: 145px;
        display: flex; flex-direction: column; justify-content: center;
        animation: aquaFadeUp 0.9s ease both; transition: transform .3s;
    }
    .aqua-stat:nth-child(1) { animation-delay: .2s; }
    .aqua-stat:nth-child(2) { animation-delay: .3s; }
    .aqua-stat:nth-child(3) { animation-delay: .4s; }
    .aqua-stat:nth-child(4) { animation-delay: .5s; }
    .aqua-stat:hover { transform: translateY(-5px); }
    .aqua-stat::after { content: ''; position: absolute; left: 0; right: 0; bottom: 0; height: 3px; }
    .aqua-stat.cyan::after { background: var(--cyan); box-shadow: 0 0 12px rgba(0,217,208,0.7); }
    .aqua-stat.blue::after { background: var(--blue-water); box-shadow: 0 0 12px rgba(0,143,213,0.7); }
    .aqua-stat.green::after { background: var(--green-env); box-shadow: 0 0 12px rgba(139,214,60,0.7); }
    .aqua-stat.violet::after { background: var(--violet); box-shadow: 0 0 12px rgba(139,92,246,0.7); }

    .aqua-stat__top { display: flex; align-items: center; gap: 14px; margin-bottom: 12px; }
    .aqua-stat__icon { width: 46px; height: 46px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 19px; flex-shrink: 0; }
    .aqua-stat.cyan .aqua-stat__icon { background: rgba(0,217,208,0.14); color: var(--cyan); box-shadow: 0 0 16px rgba(0,217,208,0.25); }
    .aqua-stat.blue .aqua-stat__icon { background: rgba(0,143,213,0.14); color: var(--blue-water); box-shadow: 0 0 16px rgba(0,143,213,0.25); }
    .aqua-stat.green .aqua-stat__icon { background: rgba(139,214,60,0.14); color: var(--green-env); box-shadow: 0 0 16px rgba(139,214,60,0.25); }
    .aqua-stat.violet .aqua-stat__icon { background: rgba(139,92,246,0.14); color: var(--violet); box-shadow: 0 0 16px rgba(139,92,246,0.25); }
    .aqua-stat__value { font-size: clamp(26px, 2.2vw, 36px); font-weight: 700; color: var(--aqua-white); line-height: 1; }
    .aqua-stat__value .plus { font-size: 0.55em; color: var(--cyan); font-weight: 700; margin-left: 2px; }
    .aqua-stat__label { font-size: 15px; font-weight: 600; color: var(--aqua-white-2); margin-top: 4px; }
    .aqua-stat__sub { font-size: 12.5px; color: var(--text-2); margin-top: 1px; }

    /* ---- Scroll indicator ---- */
    .aqua-scroll-btn {
        position: absolute; right: clamp(20px, 4vw, 64px); bottom: 210px; z-index: 6;
        width: 52px; height: 52px; border-radius: 50%;
        background: rgba(0,217,208,0.12); border: 1px solid rgba(0,217,208,0.45);
        display: flex; align-items: center; justify-content: center; color: var(--cyan); font-size: 18px;
        box-shadow: 0 0 20px rgba(0,217,208,0.3); animation: bobDown 2.4s ease-in-out infinite;
    }
    @keyframes bobDown { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(6px); } }

    @keyframes aquaFadeDown { from { opacity: 0; transform: translateY(-16px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes aquaFadeUp { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes aquaSlideIn { from { opacity: 0; transform: translateX(30px); } to { opacity: 1; transform: translateX(0); } }

    @media (max-width: 1100px) {
        .aqua-grid { grid-template-columns: 1fr; }
        .aqua-panel { max-width: 520px; }
        .aqua-stats { grid-template-columns: repeat(2, 1fr); }
        .aqua-nav__links { display: none; }
        .aqua-scroll-btn { display: none; }
    }
    @media (max-width: 560px) {
        .aqua-stats { grid-template-columns: 1fr; }
        .aqua-hero-buttons { flex-direction: column; align-items: stretch; }
        .aqua-btn-primary { min-width: 0; }
        .aqua-nav { padding: 0 16px; }
        .aqua-btn-ghost span, .aqua-nav__brand-sub { display: none; }
    }

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

    /* ================= À PROPOS — AQUA THEME ================= */
    .apropos-section {
        background: var(--aqua-bg-deep-1);
        border-radius: 30px;
        margin: 0 24px;
        padding: 70px clamp(20px, 4vw, 56px);
        position: relative;
        overflow: hidden;
    }
    .apropos-grid { display: grid; grid-template-columns: 1fr 1.05fr; gap: 60px; align-items: stretch; position: relative; z-index: 2; }

    .apropos-label {
        display: inline-flex; align-items: center; gap: 10px;
        color: var(--aqua-cyan); font-weight: 700; font-size: 12.5px; letter-spacing: 1.5px;
        text-transform: uppercase; margin-bottom: 16px;
    }
    .apropos-label::before { content: ''; width: 20px; height: 1.5px; background: var(--aqua-cyan); display: inline-block; }
    .apropos-text h2 { font-size: clamp(30px, 3.4vw, 40px); font-weight: 800; color: var(--aqua-white); line-height: 1.22; letter-spacing: -0.5px; margin-bottom: 20px; }
    .apropos-text h2 .accent { color: var(--aqua-cyan); text-shadow: 0 0 22px rgba(0,217,208,0.4); }
    .apropos-text p { color: var(--aqua-text-2); line-height: 1.85; font-size: 15px; margin-bottom: 16px; }

    .apropos-media { position: relative; border-radius: 20px; overflow: hidden; box-shadow: 0 0 0 1px var(--aqua-hairline), 0 30px 70px rgba(0,0,0,0.5); min-height: 460px; }
    .apropos-media img { width: 100%; height: 100%; display: block; object-fit: cover; }

    .apropos-caption {
        position: absolute; left: 18px; right: 18px; bottom: 18px; z-index: 2;
        display: flex; align-items: center; gap: 14px;
        background: rgba(4, 15, 24, 0.82); backdrop-filter: blur(10px);
        border: 1px solid var(--aqua-hairline); border-radius: 14px; padding: 14px 16px;
    }
    .apropos-caption .ico {
        width: 40px; height: 40px; border-radius: 11px; flex-shrink: 0;
        background: rgba(0, 217, 208, 0.16); color: var(--aqua-cyan);
        display: flex; align-items: center; justify-content: center; font-size: 17px;
    }
    .apropos-caption strong { display: block; font-size: 14px; color: var(--aqua-white); font-weight: 700; }
    .apropos-caption span { display: block; font-size: 12px; color: var(--aqua-text-2); margin-top: 2px; line-height: 1.4; }

    .apropos-stats { display: grid; grid-template-columns: repeat(4,1fr); gap: 18px; margin-top: 44px; position: relative; z-index: 2; }
    .apropos-stat {
        background: rgba(7, 22, 33, 0.72); backdrop-filter: blur(16px);
        border: 1px solid var(--aqua-hairline); border-radius: 16px; padding: 24px 20px; text-align: center;
        transition: transform .3s, border-color .3s;
    }
    .apropos-stat:hover { transform: translateY(-4px); border-color: rgba(0,217,208,0.3); }
    .apropos-stat .ico {
        width: 42px; height: 42px; border-radius: 12px; margin: 0 auto 14px;
        background: rgba(0, 217, 208, 0.14); color: var(--aqua-cyan);
        display: flex; align-items: center; justify-content: center; font-size: 18px;
    }
    .apropos-stat .num { font-size: 24px; font-weight: 700; color: var(--aqua-white); }
    .apropos-stat .label { font-size: 12px; color: var(--aqua-text-2); margin-top: 4px; }

    @media (max-width: 1000px) {
        .apropos-grid { grid-template-columns: 1fr; }
        .apropos-stats { grid-template-columns: repeat(2,1fr); }
    }
    @media (max-width: 560px) {
        .apropos-stats { grid-template-columns: 1fr; }
    }

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

    <div class="aqua-hero">
        <div class="aqua-hero__photo"></div>
        <div class="aqua-hero__scrim"></div>
        <svg class="aqua-hero__mesh" viewBox="0 0 1662 946" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
            <path class="flow" d="M120,520 C320,470 420,560 620,500 C820,440 900,520 1120,440 C1300,375 1420,410 1560,360" fill="none" stroke="#00D9D0" stroke-width="1.1" opacity="0.35"/>
            <path class="flow" d="M60,610 C260,640 380,580 560,610 C780,646 950,590 1180,560 C1360,536 1460,560 1580,520" fill="none" stroke="#12CFC5" stroke-width="1" opacity="0.28"/>
            <path d="M900,200 C1050,260 1150,220 1300,270 C1420,310 1480,280 1580,300" fill="none" stroke="#00D9D0" stroke-width="0.8" opacity="0.2"/>
            <circle class="pulse" cx="360" cy="505" r="2"/><circle class="pulse" cx="560" cy="512" r="2"/>
            <circle class="pulse" cx="760" cy="470" r="2"/><circle class="pulse" cx="1000" cy="470" r="2"/>
            <circle class="pulse" cx="1230" cy="400" r="2"/><circle class="pulse" cx="1440" cy="380" r="2"/>
            <circle class="pulse" cx="1020" cy="235" r="2"/><circle class="pulse" cx="1260" cy="250" r="2"/>
            <circle class="pulse" cx="1470" cy="290" r="2"/>
            <g fill="#00F0E5">
                <circle class="pulse" cx="360" cy="505" r="2"/><circle class="pulse" cx="560" cy="512" r="2"/>
                <circle class="pulse" cx="760" cy="470" r="2"/><circle class="pulse" cx="1000" cy="470" r="2"/>
                <circle class="pulse" cx="1230" cy="400" r="2"/><circle class="pulse" cx="1440" cy="380" r="2"/>
            </g>
        </svg>

        @include('partials.aqua-navbar', ['active' => 'apropos'])

        <div class="aqua-body">
            <div class="aqua-grid">
                <div class="aqua-left">
                    <div class="aqua-badge"><i class="bi bi-flower1"></i> Notre mission, votre avenir</div>
                    <h1>Agir aujourd'hui<br>pour préserver<br><span class="accent">l'eau de demain</span></h1>
                    <p class="lead">
                        L'Agence du Bassin Hydraulique de l'Oum Er-Rbia (ABHOER) œuvre chaque jour pour une gestion
                        intégrée et durable des ressources en eau du bassin — Béni Mellal, Maroc.
                    </p>
                    <div class="aqua-hero-buttons">
                        <a href="{{ route('inscription') }}" class="aqua-btn-primary"><i class="bi bi-file-earmark-text"></i> Déposer une demande de stage <i class="bi bi-arrow-right"></i></a>
                        <a href="{{ route('login') }}" class="aqua-btn-secondary"><i class="bi bi-lock"></i> Espace connexion</a>
                    </div>
                </div>

                <div class="aqua-panel">
                    <div class="aqua-panel__head">
                        <div class="aqua-panel__icon"><i class="bi bi-shield-check"></i></div>
                        <div>
                            <h3>Nos engagements</h3>
                            <span>Pour un bassin durable et résilient</span>
                        </div>
                    </div>

                    <a href="{{ route('accueil.services') }}" class="aqua-engagement cyan">
                        <div class="aqua-engagement__icon"><i class="bi bi-droplet-fill"></i></div>
                        <div class="aqua-engagement__body">
                            <h4>Gestion intégrée des ressources en eau</h4>
                            <p>Optimiser et préserver chaque goutte.</p>
                        </div>
                        <div class="aqua-engagement__arrow"><i class="bi bi-arrow-right"></i></div>
                    </a>

                    <a href="{{ route('accueil.services') }}" class="aqua-engagement green">
                        <div class="aqua-engagement__icon"><i class="bi bi-tree-fill"></i></div>
                        <div class="aqua-engagement__body">
                            <h4>Protection de l'environnement</h4>
                            <p>Préserver les écosystèmes pour les générations futures.</p>
                        </div>
                        <div class="aqua-engagement__arrow"><i class="bi bi-arrow-right"></i></div>
                    </a>

                    <a href="{{ route('accueil.services') }}" class="aqua-engagement turquoise">
                        <div class="aqua-engagement__icon"><i class="bi bi-people-fill"></i></div>
                        <div class="aqua-engagement__body">
                            <h4>Accompagnement des territoires</h4>
                            <p>Soutenir les acteurs du bassin vers un avenir durable.</p>
                        </div>
                        <div class="aqua-engagement__arrow"><i class="bi bi-arrow-right"></i></div>
                    </a>

                    <a href="{{ route('accueil.services') }}" class="aqua-panel__cta">En savoir plus <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>

        <div class="aqua-stats">
            <div class="aqua-stat cyan">
                <div class="aqua-stat__top">
                    <div class="aqua-stat__icon"><i class="bi bi-water"></i></div>
                </div>
                <div class="aqua-stat__value">37<span class="plus">+</span></div>
                <div class="aqua-stat__label">Barrages</div>
                <div class="aqua-stat__sub">Sur le bassin</div>
            </div>
            <div class="aqua-stat blue">
                <div class="aqua-stat__top">
                    <div class="aqua-stat__icon"><i class="bi bi-droplet-fill"></i></div>
                </div>
                <div class="aqua-stat__value">2.1 <span style="font-size:0.5em;font-weight:600;">Mds m³</span></div>
                <div class="aqua-stat__label">Capacité de stockage</div>
                <div class="aqua-stat__sub">Totale</div>
            </div>
            <div class="aqua-stat green">
                <div class="aqua-stat__top">
                    <div class="aqua-stat__icon"><i class="bi bi-tree-fill"></i></div>
                </div>
                <div class="aqua-stat__value">7<span class="plus">+</span></div>
                <div class="aqua-stat__label">Programmes</div>
                <div class="aqua-stat__sub">En cours</div>
            </div>
            <div class="aqua-stat violet">
                <div class="aqua-stat__top">
                    <div class="aqua-stat__icon"><i class="bi bi-people-fill"></i></div>
                </div>
                <div class="aqua-stat__value">350<span class="plus">+</span></div>
                <div class="aqua-stat__label">Partenaires</div>
                <div class="aqua-stat__sub">Engagés</div>
            </div>
        </div>

        <a href="#intro" class="aqua-scroll-btn" aria-label="Défiler vers le bas"><i class="bi bi-chevron-down"></i></a>
    </div>

    <section id="intro" style="padding-bottom:0;">
        <div class="apropos-section">
            <div class="apropos-grid">
                <div class="apropos-text reveal">
                    <div class="apropos-label">À propos de l'agence</div>
                    <h2>Une mission<br>au <span class="accent">service de l'eau</span></h2>
                    <p>
                        L'ABHOER, basée à Béni Mellal, est un établissement public marocain chargé de la gestion
                        intégrée, de l'évaluation et de la protection des ressources en eau du bassin de l'Oum Er-Rbia
                        — l'un des plus grands bassins versants du Royaume.
                    </p>
                    <p>
                        Notre mission : planifier, gérer et protéger durablement l'eau pour soutenir le développement
                        des territoires et préserver l'environnement.
                    </p>
                    <a href="{{ route('accueil.services') }}" class="aqua-btn-primary"><i class="bi bi-droplet-fill"></i> Découvrir nos services <i class="bi bi-arrow-right"></i></a>
                </div>

                <div class="apropos-media reveal">
                    <img src="{{ asset('images/bassin/barrage-al-massira.jpeg') }}" alt="Barrage Al Massira">
                    <div class="apropos-caption">
                        <div class="ico"><i class="bi bi-droplet-fill"></i></div>
                        <div>
                            <strong>Le barrage Al Massira</strong>
                            <span>Un ouvrage stratégique au service de millions de personnes</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="apropos-stats">
                <div class="apropos-stat"><div class="ico"><i class="bi bi-bank2"></i></div><div class="num">6</div><div class="label">Directions de service</div></div>
                <div class="apropos-stat"><div class="ico"><i class="bi bi-calendar-event-fill"></i></div><div class="num">1963</div><div class="label">Année de création</div></div>
                <div class="apropos-stat"><div class="ico"><i class="bi bi-display"></i></div><div class="num">100%</div><div class="label">Service en ligne</div></div>
                <div class="apropos-stat"><div class="ico"><i class="bi bi-hand-thumbs-up-fill"></i></div><div class="num">+20</div><div class="label">Partenaires engagés</div></div>
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
