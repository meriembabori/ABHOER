@extends('layouts.public')

@section('title', 'Nos services')

@push('styles')
    .services-hero { text-align: center; padding-bottom: 20px; }
    .services-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 22px; margin-top: 40px; }
    .service-card {
        background: white; border-radius: 18px; padding: 30px 26px;
        box-shadow: 0 6px 20px rgba(15,23,42,0.06); transition: transform 0.3s, box-shadow 0.3s;
        border: 1px solid #f1f5f9;
    }
    .service-card:hover { transform: translateY(-6px); box-shadow: 0 18px 36px rgba(15,23,42,0.12); }
    .service-icon {
        width: 54px; height: 54px; border-radius: 14px;
        background: linear-gradient(135deg, var(--c-teal), var(--c-teal-dark));
        display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; margin-bottom: 18px;
    }
    .service-card h3 { font-size: 16.5px; color: var(--c-navy); margin-bottom: 10px; line-height: 1.3; }
    .service-card p { font-size: 13.5px; color: #64748b; line-height: 1.65; margin-bottom: 16px; }
    .service-card .decouvrir { font-size: 13px; font-weight: 700; color: var(--c-teal-dark); display: inline-flex; align-items: center; gap: 5px; }

    .cta-banner {
        background: var(--c-teal-pale); border-radius: 20px; padding: 34px 40px;
        display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-top: 50px;
    }
    .cta-banner p { font-size: 15px; font-weight: 600; color: var(--c-navy); }
    .cta-banner span { font-size: 13px; color: #64748b; display: block; margin-top: 4px; font-weight: normal; }

    @media (max-width: 900px) { .services-grid { grid-template-columns: 1fr 1fr; } }
    @media (max-width: 560px) { .services-grid { grid-template-columns: 1fr; } }
@endpush

@section('content')

    <div class="breadcrumb">
        <a href="{{ route('accueil') }}">Accueil</a> &rsaquo; Services
    </div>

    <section class="services-hero">
        <p class="section-label">Organisation</p>
        <h1 class="section-title">Nos services</h1>
        <p style="color:#64748b;max-width:600px;margin:0 auto;font-size:14.5px;">
            Découvrez les différents services de l'ABHOER au service d'une gestion durable de l'eau.
        </p>
    </section>

    <section style="padding-top:0;">
        <div class="services-grid">
            @foreach ($services as $service)
                <div class="service-card reveal">
                    <div class="service-icon"><i class="bi {{ $service['icone'] }}"></i></div>
                    <h3>{{ $service['nom'] }}</h3>
                    <p>{{ $service['description'] }}</p>
                    <span class="decouvrir">Découvrir <i class="bi bi-arrow-right"></i></span>
                </div>
            @endforeach
        </div>

        <div class="cta-banner">
            <p>Une question ou un besoin spécifique ?<span>Notre équipe est à votre écoute.</span></p>
            <a href="{{ route('accueil.localisation') }}" class="btn btn-primary">Nous contacter <i class="bi bi-arrow-right"></i></a>
        </div>
    </section>

@endsection
