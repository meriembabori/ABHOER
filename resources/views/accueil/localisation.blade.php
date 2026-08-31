@extends('layouts.public')

@section('title', 'Localisation')

@push('styles')
    .location-grid { display: grid; grid-template-columns: 0.9fr 1.1fr; gap: 40px; align-items: start; }
    .location-card { background: white; border-radius: 18px; padding: 28px; box-shadow: 0 6px 20px rgba(15,23,42,0.06); }
    .location-item { display: flex; gap: 14px; margin-bottom: 22px; }
    .location-item:last-child { margin-bottom: 0; }
    .location-item .ico {
        width: 42px; height: 42px; border-radius: 11px; background: var(--c-teal-pale); color: var(--c-teal-dark);
        display: flex; align-items: center; justify-content: center; font-size: 19px; flex-shrink: 0;
    }
    .location-item h4 { font-size: 13.5px; color: var(--c-navy); margin-bottom: 3px; }
    .location-item p { font-size: 13px; color: #64748b; line-height: 1.5; }

    .map-wrap { border-radius: 18px; overflow: hidden; box-shadow: 0 20px 50px rgba(15,23,42,0.12); min-height: 360px; }
    .map-wrap iframe { width: 100%; height: 100%; min-height: 360px; border: 0; display: block; }

    .bassin-stats {
        display: grid; grid-template-columns: repeat(4,1fr); gap: 14px; margin: 40px 0;
    }
    .bassin-stat { background: white; border-radius: 14px; padding: 18px; text-align: center; box-shadow: 0 4px 14px rgba(15,23,42,0.05); }
    .bassin-stat .ico { color: var(--c-teal-dark); font-size: 22px; margin-bottom: 8px; }
    .bassin-stat .num { font-size: 14px; font-weight: 700; color: var(--c-navy); }
    .bassin-stat .label { font-size: 11px; color: #94a3b8; margin-top: 3px; }

    .gallery-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 18px; margin-top: 30px; }
    .gallery-item { position: relative; border-radius: 16px; overflow: hidden; aspect-ratio: 4/3; box-shadow: 0 8px 22px rgba(15,23,42,0.08); }
    .gallery-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
    .gallery-item:hover img { transform: scale(1.08); }
    .gallery-caption {
        position: absolute; inset: auto 0 0 0; padding: 14px 16px 12px;
        background: linear-gradient(0deg, rgba(15,23,42,0.85), transparent); color: white; font-size: 12.5px; line-height: 1.4;
    }

    @media (max-width: 900px) {
        .location-grid { grid-template-columns: 1fr; }
        .bassin-stats { grid-template-columns: repeat(2,1fr); }
        .gallery-grid { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 560px) { .gallery-grid { grid-template-columns: 1fr; } }
@endpush

@section('content')

    <div class="breadcrumb">
        <a href="{{ route('accueil') }}">Accueil</a> &rsaquo; Localisation
    </div>

    <section style="padding-bottom:0;">
        <p class="section-label">Nous trouver</p>
        <h1 class="section-title">Localisation</h1>
        <p style="color:#64748b;max-width:600px;font-size:14.5px;margin-bottom:36px;">
            Retrouvez toutes les informations pour nous trouver et nous contacter facilement.
        </p>

        <div class="location-grid">
            <div class="location-card reveal">
                <img src="{{ asset('images/bassin/siege-abhoer.jpeg') }}" alt="Siège de l'ABHOER"
                     style="width:100%;border-radius:12px;margin-bottom:20px;display:block;">

                <div class="location-item">
                    <div class="ico"><i class="bi bi-geo-alt-fill"></i></div>
                    <div>
                        <h4>Adresse</h4>
                        <p>Agence du Bassin Hydraulique de l'Oum Er-Rbia, Béni Mellal, Maroc</p>
                    </div>
                </div>
                <div class="location-item">
                    <div class="ico"><i class="bi bi-compass-fill"></i></div>
                    <div>
                        <h4>Coordonnées GPS</h4>
                        <p>Latitude : {{ $latitude }} — Longitude : {{ $longitude }}</p>
                    </div>
                </div>
                <div class="location-item">
                    <div class="ico"><i class="bi bi-droplet-fill"></i></div>
                    <div>
                        <h4>Zone d'action</h4>
                        <p>Bassin de l'Oum Er-Rbia : provinces de Béni Mellal, Khouribga, Khénifra, El Jadida, Settat...</p>
                    </div>
                </div>
                <a href="https://www.openstreetmap.org/?mlat={{ $latitude }}&mlon={{ $longitude }}#map=13/{{ $latitude }}/{{ $longitude }}"
                   target="_blank" class="btn btn-primary" style="margin-top:8px;">
                    <i class="bi bi-signpost-2-fill"></i> Itinéraire
                </a>
            </div>

            <div class="map-wrap reveal">
                <iframe
                    src="https://www.openstreetmap.org/export/embed.html?bbox={{ $longitude - 0.08 }}%2C{{ $latitude - 0.06 }}%2C{{ $longitude + 0.08 }}%2C{{ $latitude + 0.06 }}&layer=mapnik&marker={{ $latitude }}%2C{{ $longitude }}"
                    loading="lazy">
                </iframe>
            </div>
        </div>

        <h2 style="font-size:20px;color:var(--c-navy);margin:44px 0 6px;">Le bassin de l'Oum Er-Rbia</h2>

        <div class="bassin-stats">
            <div class="bassin-stat"><div class="ico"><i class="bi bi-rulers"></i></div><div class="num">40 000 km²</div><div class="label">Superficie</div></div>
            <div class="bassin-stat"><div class="ico"><i class="bi bi-bricks"></i></div><div class="num">Bin El Ouidane</div><div class="label">Barrage principal</div></div>
            <div class="bassin-stat"><div class="ico"><i class="bi bi-water"></i></div><div class="num">Oum Er-Rbia</div><div class="label">Cours d'eau principal</div></div>
            <div class="bassin-stat"><div class="ico"><i class="bi bi-buildings-fill"></i></div><div class="num">Béni Mellal, Khouribga</div><div class="label">Villes principales</div></div>
        </div>

        <div class="gallery-grid">
            @foreach ($galerie as $photo)
                <div class="gallery-item reveal">
                    <img src="{{ asset($photo['src']) }}" alt="{{ $photo['legende'] }}">
                    <div class="gallery-caption">{{ $photo['legende'] }}</div>
                </div>
            @endforeach
        </div>
    </section>

@endsection
