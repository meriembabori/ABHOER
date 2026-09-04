@php $active = $active ?? ''; @endphp
<nav class="aqua-nav">
    <a href="{{ route('accueil') }}" class="aqua-nav__brand">
        <img src="{{ asset('images/logo-abhoer.png') }}" alt="Logo ABHOER">
        <div>
            <div class="aqua-nav__brand-name">ABHOER</div>
            <span class="aqua-nav__brand-sub">Bassin Hydraulique de l'Oum Er-Rbia</span>
        </div>
    </a>

    <div class="aqua-nav__links">
        <a href="{{ route('accueil') }}#intro" class="{{ $active === 'apropos' ? 'active' : '' }}">
            @if($active === 'apropos')<i class="bi bi-chevron-right" style="font-size:11px;"></i>@endif À propos
        </a>
        <a href="{{ route('accueil.services') }}" class="{{ $active === 'services' ? 'active' : '' }}">
            @if($active === 'services')<i class="bi bi-chevron-right" style="font-size:11px;"></i>@endif Services
        </a>
        <a href="{{ route('accueil.localisation') }}" class="{{ $active === 'localisation' ? 'active' : '' }}">
            @if($active === 'localisation')<i class="bi bi-chevron-right" style="font-size:11px;"></i>@endif Localisation
        </a>
        <a href="{{ route('accueil') }}#galerie" class="{{ $active === 'galerie' ? 'active' : '' }}">
            @if($active === 'galerie')<i class="bi bi-chevron-right" style="font-size:11px;"></i>@endif Galerie
        </a>
    </div>

    <div class="aqua-nav__actions">
        <button type="button" class="aqua-icon-btn js-theme-toggle" aria-label="Changer de thème" aria-pressed="false"><i class="bi bi-sun"></i></button>
        <a href="{{ route('login') }}" class="aqua-btn-ghost"><i class="bi bi-person"></i> <span>Se connecter</span></a>
        <a href="{{ route('inscription') }}" class="aqua-btn-solid">S'inscrire <i class="bi bi-arrow-right"></i></a>
    </div>
</nav>
