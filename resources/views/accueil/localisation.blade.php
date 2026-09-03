@extends('layouts.public')

@section('title', 'Localisation')

@push('styles')
    /* ================= LOCALISATION — AQUA THEME ================= */
    .loc-page { background: var(--aqua-bg-deep-1); position: relative; }
    .loc-page::before {
        content: '';
        position: absolute; inset: 0; height: 640px;
        background: url('{{ asset("images/bassin/barrage-2.jpeg") }}') center 30%/cover no-repeat;
        opacity: 0.16; mask-image: linear-gradient(180deg, black, transparent);
        -webkit-mask-image: linear-gradient(180deg, black, transparent);
        pointer-events: none;
    }

    .loc-wrap { position: relative; z-index: 2; max-width: 1580px; margin: 0 auto; padding: 46px clamp(20px, 4vw, 64px) 90px; }

    .loc-header { max-width: 640px; margin-bottom: 40px; animation: aquaFadeUp .8s ease both; }
    .loc-label {
        display: inline-flex; align-items: center; gap: 10px;
        color: var(--aqua-cyan); font-weight: 700; font-size: 12.5px; letter-spacing: 1.5px;
        text-transform: uppercase; margin-bottom: 14px;
    }
    .loc-label::before { content: ''; width: 20px; height: 1.5px; background: var(--aqua-cyan); display: inline-block; }
    .loc-header h1 { font-size: clamp(30px, 3.6vw, 42px); font-weight: 800; color: var(--aqua-white); line-height: 1.2; letter-spacing: -0.5px; }
    .loc-header h1 .accent { color: var(--aqua-cyan); text-shadow: 0 0 22px rgba(0,217,208,0.4); }
    .loc-header p { font-size: 15px; color: var(--aqua-text-2); line-height: 1.7; margin-top: 14px; }

    .loc-grid { display: grid; grid-template-columns: 0.85fr 1.15fr; gap: 26px; align-items: start; }

    .loc-card {
        background: rgba(7, 22, 33, 0.72); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
        border: 1px solid var(--aqua-hairline); border-radius: 20px;
        padding: 22px; animation: aquaFadeUp .9s ease .1s both;
    }
    .loc-card img { width: 100%; border-radius: 14px; margin-bottom: 22px; display: block; aspect-ratio: 16/10; object-fit: cover; }

    .loc-item { display: flex; gap: 14px; margin-bottom: 22px; }
    .loc-item:last-of-type { margin-bottom: 26px; }
    .loc-item .ico {
        width: 42px; height: 42px; border-radius: 12px; flex-shrink: 0;
        background: rgba(0, 217, 208, 0.12); color: var(--aqua-cyan);
        display: flex; align-items: center; justify-content: center; font-size: 18px;
    }
    .loc-item h4 { font-size: 14px; font-weight: 700; color: var(--aqua-white); margin-bottom: 4px; }
    .loc-item p { font-size: 13px; color: var(--aqua-text-2); line-height: 1.55; }

    /* ---- Map panel ---- */
    .loc-map-panel {
        position: relative; border-radius: 20px; overflow: hidden;
        border: 1px solid var(--aqua-hairline);
        box-shadow: 0 24px 60px rgba(0,0,0,0.4);
        min-height: 560px; height: 100%;
        animation: aquaFadeUp .9s ease .2s both;
    }
    .loc-map-panel iframe {
        width: 100%; height: 100%; min-height: 560px; border: 0; display: block;
        filter: invert(93%) hue-rotate(175deg) brightness(0.92) contrast(0.92) saturate(1.15);
    }
    .loc-map-zoom {
        position: absolute; top: 18px; right: 18px; z-index: 3;
        display: flex; flex-direction: column; border-radius: 12px; overflow: hidden;
        border: 1px solid var(--aqua-hairline); box-shadow: 0 8px 22px rgba(0,0,0,0.35);
    }
    .loc-map-zoom button {
        width: 40px; height: 40px; background: rgba(6, 20, 30, 0.88); color: var(--aqua-white);
        border: none; font-size: 17px; cursor: pointer; transition: background .2s;
    }
    .loc-map-zoom button:first-child { border-bottom: 1px solid var(--aqua-hairline); }
    .loc-map-zoom button:hover { background: rgba(0, 217, 208, 0.22); }

    .loc-map-bar {
        position: absolute; left: 16px; right: 16px; bottom: 16px; z-index: 3;
        display: flex; align-items: center; justify-content: space-between;
        background: rgba(4, 15, 24, 0.85); backdrop-filter: blur(10px);
        border: 1px solid var(--aqua-hairline); border-radius: 14px;
        padding: 14px 18px; font-size: 14px; font-weight: 600; color: var(--aqua-white);
    }
    .loc-map-bar i { color: var(--aqua-cyan); margin-right: 8px; }
    .loc-map-bar a { display: flex; align-items: center; color: var(--aqua-white); }
    .loc-map-bar .go { color: var(--aqua-cyan); font-size: 15px; }

    /* ---- Bassin stats ---- */
    .loc-stats-label { margin: 54px 0 20px; }
    .loc-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; }
    .loc-stat {
        background: rgba(7, 22, 33, 0.72); backdrop-filter: blur(16px);
        border: 1px solid var(--aqua-hairline); border-radius: 16px; padding: 22px;
        transition: transform .3s, border-color .3s;
        animation: aquaFadeUp .8s ease both;
    }
    .loc-stat:hover { transform: translateY(-4px); border-color: rgba(0,217,208,0.3); }
    .loc-stat .ico {
        width: 40px; height: 40px; border-radius: 11px; margin-bottom: 14px;
        background: rgba(0, 217, 208, 0.14); color: var(--aqua-cyan);
        display: flex; align-items: center; justify-content: center; font-size: 17px;
    }
    .loc-stat .num { font-size: 16px; font-weight: 700; color: var(--aqua-white); }
    .loc-stat .label { font-size: 12px; color: var(--aqua-text-2); margin-top: 3px; }

    /* ---- Gallery ---- */
    .loc-gallery-label { margin: 58px 0 20px; }
    .loc-gallery { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
    .loc-gallery-item { position: relative; border-radius: 16px; overflow: hidden; aspect-ratio: 4/3; border: 1px solid var(--aqua-hairline); }
    .loc-gallery-item img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s; }
    .loc-gallery-item:hover img { transform: scale(1.08); }
    .loc-gallery-caption {
        position: absolute; inset: auto 0 0 0; padding: 14px 16px 12px;
        background: linear-gradient(0deg, rgba(1,15,25,0.92), transparent); color: white; font-size: 12.5px; line-height: 1.4;
    }

    @media (max-width: 1100px) {
        .loc-grid { grid-template-columns: 1fr; }
        .loc-map-panel { min-height: 420px; }
        .loc-map-panel iframe { min-height: 420px; }
        .loc-stats { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 640px) {
        .loc-stats, .loc-gallery { grid-template-columns: 1fr; }
    }
@endpush

@section('content')

    <div class="loc-page">
        @include('partials.aqua-navbar', ['active' => 'localisation'])

        <div class="loc-wrap">

            <div class="loc-header">
                <div class="loc-label">Notre localisation</div>
                <h1>Nous sommes là <span class="accent">pour vous servir</span></h1>
                <p>Retrouvez toutes les informations pour nous trouver et nous contacter facilement.</p>
            </div>

            <div class="loc-grid">

                <div class="loc-card">
                    <img src="{{ asset('images/bassin/siege-abhoer.jpeg') }}" alt="Siège de l'ABHOER">

                    <div class="loc-item">
                        <div class="ico"><i class="bi bi-geo-alt-fill"></i></div>
                        <div>
                            <h4>Adresse</h4>
                            <p>Agence du Bassin Hydraulique de l'Oum Er-Rbia, Béni Mellal, Maroc</p>
                        </div>
                    </div>
                    <div class="loc-item">
                        <div class="ico"><i class="bi bi-compass-fill"></i></div>
                        <div>
                            <h4>Coordonnées GPS</h4>
                            <p>Latitude : {{ $latitude }} — Longitude : {{ $longitude }}</p>
                        </div>
                    </div>
                    <div class="loc-item">
                        <div class="ico"><i class="bi bi-droplet-fill"></i></div>
                        <div>
                            <h4>Zone d'action</h4>
                            <p>Bassin de l'Oum Er-Rbia : provinces de Béni Mellal, Khouribga, Khénifra, El Jadida, Settat...</p>
                        </div>
                    </div>

                    <a href="https://www.openstreetmap.org/?mlat={{ $latitude }}&mlon={{ $longitude }}#map=13/{{ $latitude }}/{{ $longitude }}"
                       target="_blank" class="aqua-btn-primary" style="width:100%;">
                        <i class="bi bi-signpost-2-fill"></i> Itinéraire
                    </a>
                </div>

                <div class="loc-map-panel">
                    <div class="loc-map-zoom">
                        <button type="button" aria-label="Zoom avant"><i class="bi bi-plus"></i></button>
                        <button type="button" aria-label="Zoom arrière"><i class="bi bi-dash"></i></button>
                    </div>

                    <iframe
                        src="https://www.openstreetmap.org/export/embed.html?bbox={{ $longitude - 0.08 }}%2C{{ $latitude - 0.06 }}%2C{{ $longitude + 0.08 }}%2C{{ $latitude + 0.06 }}&layer=mapnik&marker={{ $latitude }}%2C{{ $longitude }}"
                        loading="lazy">
                    </iframe>

                    <div class="loc-map-bar">
                        <span><i class="bi bi-geo-alt-fill"></i> Béni Mellal — Siège ABHOER</span>
                        <a href="https://www.google.com/maps?q={{ $latitude }},{{ $longitude }}" target="_blank" class="go">
                            Voir sur Google Maps <i class="bi bi-box-arrow-up-right" style="margin-left:6px;"></i>
                        </a>
                    </div>
                </div>

            </div>

            <div class="loc-stats-label loc-label">Le bassin de l'Oum Er-Rbia</div>

            <div class="loc-stats">
                <div class="loc-stat"><div class="ico"><i class="bi bi-rulers"></i></div><div class="num">40 000 km²</div><div class="label">Superficie du bassin</div></div>
                <div class="loc-stat"><div class="ico"><i class="bi bi-bricks"></i></div><div class="num">Bin El Ouidane</div><div class="label">Barrage principal</div></div>
                <div class="loc-stat"><div class="ico"><i class="bi bi-water"></i></div><div class="num">Oum Er-Rbia</div><div class="label">Cours d'eau principal</div></div>
                <div class="loc-stat"><div class="ico"><i class="bi bi-buildings-fill"></i></div><div class="num">Béni Mellal, Khouribga</div><div class="label">Villes principales</div></div>
            </div>

            <div class="loc-gallery-label loc-label">En images</div>

            <div class="loc-gallery">
                @foreach ($galerie as $photo)
                    <div class="loc-gallery-item">
                        <img src="{{ asset($photo['src']) }}" alt="{{ $photo['legende'] }}">
                        <div class="loc-gallery-caption">{{ $photo['legende'] }}</div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

@endsection
