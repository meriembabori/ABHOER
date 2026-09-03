@extends('layouts.public')

@section('title', 'Nos services')

@push('styles')
    /* ================= SERVICES — AQUA THEME ================= */
    .svc-page { background: var(--aqua-bg-deep-1); }

    /* ---- Hero band ---- */
    .svc-hero { position: relative; overflow: hidden; padding-bottom: 0; }
    .svc-hero__photo {
        position: absolute; inset: 0;
        background: url('{{ asset("images/bassin/barrage-1.jpeg") }}') center 35%/cover no-repeat;
    }
    .svc-hero__scrim {
        position: absolute; inset: 0;
        background:
            linear-gradient(100deg, rgba(1,18,30,0.95) 0%, rgba(1,24,39,0.82) 38%, rgba(1,24,39,0.45) 68%, rgba(1,18,30,0.55) 100%),
            linear-gradient(0deg, rgba(1,15,25,0.85) 0%, rgba(1,15,25,0.05) 30%, rgba(1,15,25,0.35) 100%);
    }
    .svc-hero__inner {
        position: relative; z-index: 3;
        max-width: 1580px; margin: 0 auto;
        padding: 56px clamp(20px, 4vw, 64px) 90px;
        display: grid; grid-template-columns: 1fr 1fr; align-items: center; gap: 30px;
        min-height: 380px;
    }
    .svc-hero__text { animation: aquaFadeUp .9s ease both; }
    .svc-hero__text h1 { font-size: clamp(34px, 4vw, 48px); font-weight: 800; color: var(--aqua-white); margin: 6px 0 14px; letter-spacing: -0.5px; }
    .svc-hero__text h1 .accent { color: var(--aqua-cyan); text-shadow: 0 0 22px rgba(0,217,208,0.4); }
    .svc-wave-underline { width: 46px; margin-bottom: 18px; }
    .svc-hero__text p { font-size: 16.5px; line-height: 1.6; color: #C4D2D9; max-width: 460px; }

    /* Floating badges + water drop visual on the right */
    .svc-visual { position: relative; height: 340px; }
    .svc-float-badge {
        position: absolute;
        display: flex; align-items: center; gap: 12px;
        padding: 12px 18px; border-radius: 14px;
        animation: aquaFadeDown .9s ease both;
    }
    .svc-float-badge .ico {
        width: 40px; height: 40px; border-radius: 10px; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center; font-size: 17px;
    }
    .svc-float-badge strong { display: block; font-size: 13.5px; color: var(--aqua-white); font-weight: 700; }
    .svc-float-badge span { display: block; font-size: 11.5px; color: var(--aqua-text-2); margin-top: 1px; }
    .svc-float-badge.b1 { top: 6%; left: 8%; background: rgba(0,217,208,0.14); border: 1px solid rgba(0,217,208,0.3); animation-delay: .1s; }
    .svc-float-badge.b1 .ico { background: rgba(0,217,208,0.25); color: var(--aqua-cyan); }
    .svc-float-badge.b2 { top: 34%; left: 2%; background: rgba(0,143,213,0.14); border: 1px solid rgba(0,143,213,0.3); animation-delay: .25s; }
    .svc-float-badge.b2 .ico { background: rgba(0,143,213,0.25); color: var(--aqua-blue-water); }
    .svc-float-badge.b3 { top: 2%; right: 4%; background: rgba(139,214,60,0.14); border: 1px solid rgba(139,214,60,0.3); animation-delay: .4s; }
    .svc-float-badge.b3 .ico { background: rgba(139,214,60,0.25); color: var(--aqua-green-env); }

    .svc-drop-wrap { position: absolute; right: 14%; bottom: 6%; width: 150px; height: 190px; animation: aquaFadeUp 1.1s ease .3s both; }
    .svc-drop-wrap svg { width: 100%; height: 100%; filter: drop-shadow(0 0 30px rgba(0,220,210,0.4)); }
    .svc-ripple { position: absolute; left: 50%; bottom: -6px; border: 1.5px solid rgba(0,217,208,0.35); border-radius: 50%; transform: translateX(-50%); }
    .svc-ripple.r1 { width: 170px; height: 26px; }
    .svc-ripple.r2 { width: 220px; height: 34px; bottom: -20px; border-color: rgba(0,217,208,0.22); }
    .svc-ripple.r3 { width: 270px; height: 42px; bottom: -34px; border-color: rgba(0,217,208,0.12); }

    /* ---- Cards grid ---- */
    .svc-grid-wrap { position: relative; z-index: 3; max-width: 1580px; margin: -46px auto 0; padding: 0 clamp(20px, 4vw, 64px) 8px; }
    .svc-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 22px; }
    .svc-card {
        background: rgba(7, 22, 33, 0.72); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
        border: 1px solid var(--aqua-hairline); border-radius: 20px;
        padding: 28px 26px; transition: transform .3s, border-color .3s;
        animation: aquaFadeUp .8s ease both;
    }
    .svc-card:hover { transform: translateY(-6px); border-color: rgba(0,217,208,0.35); }
    .svc-card .ico {
        width: 52px; height: 52px; border-radius: 14px; margin-bottom: 18px;
        background: linear-gradient(135deg, var(--aqua-turquoise), var(--aqua-blue-deep));
        display: flex; align-items: center; justify-content: center; color: white; font-size: 22px;
        box-shadow: 0 0 20px rgba(0,217,208,0.25);
    }
    .svc-card h3 { font-size: 17px; font-weight: 700; color: var(--aqua-white); line-height: 1.35; margin-bottom: 10px; }
    .svc-card p { font-size: 13.5px; color: var(--aqua-text-2); line-height: 1.65; margin-bottom: 18px; }
    .svc-card .decouvrir { font-size: 13px; font-weight: 700; color: var(--aqua-cyan); display: inline-flex; align-items: center; gap: 6px; transition: gap .2s; }
    .svc-card:hover .decouvrir { gap: 10px; }

    /* ---- Mission banner ---- */
    .svc-banner-wrap { max-width: 1580px; margin: 0 auto; padding: 40px clamp(20px, 4vw, 64px) 80px; }
    .svc-banner {
        background: rgba(7, 22, 33, 0.72); backdrop-filter: blur(16px);
        border: 1px solid var(--aqua-hairline); border-radius: 20px;
        display: grid; grid-template-columns: 1.6fr auto 1fr auto 1fr auto 1fr 1.3fr; align-items: center;
        overflow: hidden;
    }
    .svc-banner__mission { display: flex; align-items: center; gap: 16px; padding: 24px; }
    .svc-banner__mission .ico {
        width: 46px; height: 46px; border-radius: 12px; flex-shrink: 0;
        background: rgba(139,214,60,0.15); color: var(--aqua-green-env);
        display: flex; align-items: center; justify-content: center; font-size: 19px;
    }
    .svc-banner__mission strong { font-size: 14.5px; color: var(--aqua-cyan); display: block; margin-bottom: 3px; }
    .svc-banner__mission p { font-size: 12.5px; color: var(--aqua-text-2); line-height: 1.5; }
    .svc-banner__divider { width: 1px; align-self: stretch; background: var(--aqua-hairline); margin: 18px 0; }
    .svc-banner__stat { display: flex; align-items: center; gap: 12px; padding: 24px 18px; }
    .svc-banner__stat .ico { width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }
    .svc-banner__stat.cyan .ico { background: rgba(0,217,208,0.15); color: var(--aqua-cyan); }
    .svc-banner__stat.violet .ico { background: rgba(139,92,246,0.15); color: var(--aqua-violet); }
    .svc-banner__stat.turquoise .ico { background: rgba(18,207,197,0.15); color: var(--aqua-turquoise); }
    .svc-banner__stat .num { font-size: 24px; font-weight: 700; color: var(--aqua-white); line-height: 1; }
    .svc-banner__stat .label { font-size: 12px; color: var(--aqua-text-2); margin-top: 2px; }
    .svc-banner__photo { height: 100%; min-height: 108px; background: url('{{ asset("images/bassin/carte-bassin.png") }}') center/cover no-repeat; position: relative; }
    .svc-banner__photo::after { content: ''; position: absolute; inset: 0; background: linear-gradient(90deg, rgba(1,18,30,0.75), rgba(1,18,30,0.15)); }

    @media (max-width: 1100px) {
        .svc-hero__inner { grid-template-columns: 1fr; }
        .svc-visual { display: none; }
        .svc-grid { grid-template-columns: repeat(2, 1fr); }
        .svc-banner { grid-template-columns: 1fr; }
        .svc-banner__divider { display: none; }
        .svc-banner__photo { display: none; }
    }
    @media (max-width: 640px) {
        .svc-grid { grid-template-columns: 1fr; }
        .svc-grid-wrap { margin-top: 0; }
        .svc-hero__inner { padding-bottom: 40px; }
    }
@endpush

@section('content')

    <div class="svc-page">
        @include('partials.aqua-navbar', ['active' => 'services'])

        <div class="svc-hero">
            <div class="svc-hero__photo"></div>
            <div class="svc-hero__scrim"></div>

            <div class="svc-hero__inner">
                <div class="svc-hero__text">
                    <div class="aqua-badge">Organisation</div>
                    <h1>Nos <span class="accent">services</span></h1>
                    <svg class="svc-wave-underline" viewBox="0 0 46 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 5 C 8 -1, 15 11, 23 5 C 31 -1, 38 11, 45 5" stroke="#00D9D0" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <p>Découvrez les différents services de l'ABHOER au service d'une gestion durable de l'eau.</p>
                </div>

                <div class="svc-visual">
                    <div class="svc-float-badge b1">
                        <div class="ico"><i class="bi bi-shield-check"></i></div>
                        <div><strong>Gestion durable</strong><span>Notre engagement</span></div>
                    </div>
                    <div class="svc-float-badge b2">
                        <div class="ico"><i class="bi bi-graph-up-arrow"></i></div>
                        <div><strong>Excellence</strong><span>Notre performance</span></div>
                    </div>
                    <div class="svc-float-badge b3">
                        <div class="ico"><i class="bi bi-people-fill"></i></div>
                        <div><strong>Innovation</strong><span>Notre avenir</span></div>
                    </div>

                    <div class="svc-drop-wrap">
                        <div class="svc-ripple r3"></div>
                        <div class="svc-ripple r2"></div>
                        <div class="svc-ripple r1"></div>
                        <svg viewBox="0 0 120 150" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="dropGrad" x1="0" y1="0" x2="1" y2="1">
                                    <stop offset="0%" stop-color="#8FF2EA"/>
                                    <stop offset="55%" stop-color="#00D9D0"/>
                                    <stop offset="100%" stop-color="#005B91"/>
                                </linearGradient>
                            </defs>
                            <path d="M60 4 C 60 4 12 66 12 100 A 48 48 0 0 0 108 100 C 108 66 60 4 60 4 Z" fill="url(#dropGrad)" opacity="0.92"/>
                            <ellipse cx="42" cy="80" rx="10" ry="16" fill="#ffffff" opacity="0.35"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="svc-grid-wrap">
            <div class="svc-grid">
                @foreach ($services as $service)
                    <div class="svc-card">
                        <div class="ico"><i class="bi {{ $service['icone'] }}"></i></div>
                        <h3>{{ $service['nom'] }}</h3>
                        <p>{{ $service['description'] }}</p>
                        <span class="decouvrir">Découvrir <i class="bi bi-arrow-right"></i></span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="svc-banner-wrap">
            <div class="svc-banner">
                <div class="svc-banner__mission">
                    <div class="ico"><i class="bi bi-flower1"></i></div>
                    <div>
                        <strong>Notre mission</strong>
                        <p>Agir aujourd'hui pour préserver l'eau de demain et garantir un avenir durable pour tous.</p>
                    </div>
                </div>
                <div class="svc-banner__divider"></div>
                <div class="svc-banner__stat cyan">
                    <div class="ico"><i class="bi bi-droplet-fill"></i></div>
                    <div><div class="num">37</div><div class="label">Projets en cours</div></div>
                </div>
                <div class="svc-banner__divider"></div>
                <div class="svc-banner__stat violet">
                    <div class="ico"><i class="bi bi-people-fill"></i></div>
                    <div><div class="num">350+</div><div class="label">Collaborateurs engagés</div></div>
                </div>
                <div class="svc-banner__divider"></div>
                <div class="svc-banner__stat turquoise">
                    <div class="ico"><i class="bi bi-geo-alt-fill"></i></div>
                    <div><div class="num">6</div><div class="label">Délégations provinciales</div></div>
                </div>
                <div class="svc-banner__photo"></div>
            </div>
        </div>
    </div>

@endsection
