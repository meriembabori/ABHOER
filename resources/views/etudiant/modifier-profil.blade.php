<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Modifier mon profil - ABHOER</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <style>
        body {
            background: #f5f7fa;
            color: #1f2937;
            font-family: Arial, sans-serif;
        }

        .page-wrapper {
            min-height: 100vh;
        }

        .topbar {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            padding: 16px 30px;
        }

        .brand {
            color: #123b70;
            font-weight: 700;
            font-size: 21px;
            text-decoration: none;
        }

        .brand small {
            display: block;
            color: #6b7280;
            font-size: 11px;
            font-weight: 400;
        }

        .content {
            max-width: 1050px;
            margin: 0 auto;
            padding: 35px 20px;
        }

        .page-title {
            color: #123b70;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .page-subtitle {
            color: #6b7280;
            margin-bottom: 30px;
        }

        .form-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .form-header {
            background: #123b70;
            color: white;
            padding: 25px 30px;
        }

        .form-header h4 {
            margin: 0;
            font-weight: 700;
        }

        .form-header p {
            margin: 5px 0 0;
            font-size: 14px;
            opacity: .85;
        }

        .form-body {
            padding: 30px;
        }

        .section-title {
            color: #123b70;
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #374151;
        }

        .required {
            color: #dc3545;
        }

        .form-control {
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 11px 13px;
        }

        .form-control:focus {
            border-color: #1261c9;
            box-shadow: 0 0 0 .2rem rgba(18, 97, 201, .10);
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .form-text {
            color: #6b7280;
            font-size: 11px;
        }

        .error-message {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
        }

        .alert-error {
            background: #fff1f2;
            border: 1px solid #fecdd3;
            color: #be123c;
            border-radius: 9px;
            padding: 13px 16px;
            margin-bottom: 25px;
        }

        .btn-primary {
            background: #1261c9;
            border-color: #1261c9;
        }

        .btn-primary:hover {
            background: #0d4fa8;
            border-color: #0d4fa8;
        }

        .btn-secondary-custom {
            background: #ffffff;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .btn-secondary-custom:hover {
            background: #f3f4f6;
        }

        .logout-btn {
            border: none;
            background: transparent;
            color: #6b7280;
        }

        .logout-btn:hover {
            color: #dc3545;
        }
    </style>

</head>

<body>

<div class="page-wrapper">

    {{-- BARRE SUPERIEURE --}}
    <div class="topbar">

        <div class="container-fluid">

            <div class="d-flex justify-content-between align-items-center">

                <a
                    href="{{ route('etudiant.dashboard') }}"
                    class="brand"
                >
                    ABHOER

                    <small>
                        Gestion des stages
                    </small>
                </a>

                <div class="d-flex align-items-center gap-3">

                    <span class="text-secondary small">
                        {{ $user->prenom ?? '' }}
                        {{ $user->nom ?? '' }}
                    </span>

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="logout-btn"
                        >
                            <i class="bi bi-box-arrow-right me-1"></i>
                            Déconnexion
                        </button>
                    </form>

                </div>

            </div>

        </div>

    </div>

    {{-- CONTENU --}}
    <main class="content">

        <div class="mb-4">

            <h2 class="page-title">
                Modifier mon profil
            </h2>

            <p class="page-subtitle">
                Modifiez vos informations personnelles et universitaires.
            </p>

        </div>

        {{-- ERREURS --}}
        @if($errors->any())

            <div class="alert-error">

                <div class="fw-semibold mb-2">

                    <i class="bi bi-exclamation-circle me-2"></i>

                    Veuillez corriger les erreurs suivantes :

                </div>

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif

        <div class="form-card">

            <div class="form-header">

                <h4>
                    Informations du candidat
                </h4>

                <p>
                    Les informations avec une étoile (*) sont obligatoires.
                </p>

            </div>

            <div class="form-body">

                <form
                    method="POST"
                    action="{{ route('etudiant.profil.update') }}"
                    enctype="multipart/form-data"
                >

                    @csrf

                    @method('PUT')

                    {{-- PHOTO DE PROFIL --}}
                    <div class="section-title">
                        <i class="bi bi-camera me-2"></i>
                        Photo de profil
                    </div>

                    <div class="d-flex align-items-center gap-3 mb-4">
                        <img
                            id="photo-preview"
                            src="{{ $candidat->photo ? asset('storage/' . $candidat->photo) : 'https://ui-avatars.com/api/?name=' . urlencode(($candidat->prenom ?? '') . ' ' . ($candidat->nom ?? '')) }}"
                            alt="Photo de profil"
                            style="width:84px;height:84px;border-radius:50%;object-fit:cover;border:2px solid rgba(0,217,208,0.3);"
                        >
                        <div>
                            <input
                                type="file"
                                id="photo"
                                name="photo"
                                accept="image/png, image/jpeg, image/webp"
                                class="form-control"
                                onchange="document.getElementById('photo-preview').src = URL.createObjectURL(this.files[0])"
                            >
                            <small class="text-secondary">JPG, PNG ou WEBP — 2 Mo maximum.</small>
                            @error('photo')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- INFORMATIONS PERSONNELLES --}}
                    <div class="section-title">

                        <i class="bi bi-person me-2"></i>

                        Informations personnelles

                    </div>

                    <div class="row g-4">

                        {{-- NOM --}}
                        <div class="col-md-6">

                            <label
                                for="nom"
                                class="form-label"
                            >
                                Nom
                                <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                id="nom"
                                name="nom"
                                class="form-control"
                                value="{{ old('nom', $candidat->nom ?? '') }}"
                                required
                            >

                            @error('nom')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- PRENOM --}}
                        <div class="col-md-6">

                            <label
                                for="prenom"
                                class="form-label"
                            >
                                Prénom
                                <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                id="prenom"
                                name="prenom"
                                class="form-control"
                                value="{{ old('prenom', $candidat->prenom ?? '') }}"
                                required
                            >

                            @error('prenom')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- CIN --}}
                        <div class="col-md-6">

                            <label
                                for="cin"
                                class="form-label"
                            >
                                CIN
                            </label>

                            <input
                                type="text"
                                id="cin"
                                name="cin"
                                class="form-control"
                                value="{{ old('cin', $candidat->cin ?? '') }}"
                            >

                            @error('cin')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- CNE --}}
                        <div class="col-md-6">

                            <label
                                for="cne"
                                class="form-label"
                            >
                                CNE
                            </label>

                            <input
                                type="text"
                                id="cne"
                                name="cne"
                                class="form-control"
                                value="{{ old('cne', $candidat->cne ?? '') }}"
                                placeholder="Exemple : R123456789"
                            >

                            <div class="form-text">
                                Votre Code National de l'Étudiant.
                            </div>

                            @error('cne')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- DATE NAISSANCE --}}
                        <div class="col-md-6">

                            <label
                                for="dateNaissance"
                                class="form-label"
                            >
                                Date de naissance
                            </label>

                            <input
                                type="date"
                                id="dateNaissance"
                                name="dateNaissance"
                                class="form-control"
                                value="{{ old('dateNaissance', $candidat->dateNaissance ?? '') }}"
                            >

                            @error('dateNaissance')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- TELEPHONE --}}
                        <div class="col-md-6">

                            <label
                                for="telephone"
                                class="form-label"
                            >
                                Téléphone
                            </label>

                            <input
                                type="text"
                                id="telephone"
                                name="telephone"
                                class="form-control"
                                value="{{ old('telephone', $candidat->telephone ?? '') }}"
                                placeholder="Exemple : 06XXXXXXXX"
                            >

                            @error('telephone')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- EMAIL --}}
                        <div class="col-md-6">

                            <label
                                for="email"
                                class="form-label"
                            >
                                Adresse email
                                <span class="required">*</span>
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email', $candidat->email ?? '') }}"
                                required
                            >

                            @error('email')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- ADRESSE --}}
                        <div class="col-md-6">

                            <label
                                for="adresse"
                                class="form-label"
                            >
                                Adresse
                            </label>

                            <textarea
                                id="adresse"
                                name="adresse"
                                class="form-control"
                                placeholder="Votre adresse complète"
                            >{{ old('adresse', $candidat->adresse ?? '') }}</textarea>

                            @error('adresse')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                    {{-- INFORMATIONS UNIVERSITAIRES --}}
                    <div class="section-title mt-5">

                        <i class="bi bi-mortarboard me-2"></i>

                        Informations universitaires

                    </div>

                    <div class="row g-4">

                        {{-- ETABLISSEMENT --}}
                        <div class="col-md-6">

                            <label
                                for="etablissement"
                                class="form-label"
                            >
                                Établissement
                            </label>

                            <input
                                type="text"
                                id="etablissement"
                                name="etablissement"
                                class="form-control"
                                value="{{ old('etablissement', $candidat->etablissement ?? '') }}"
                                placeholder="Exemple : FST Béni Mellal"
                            >

                            @error('etablissement')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- FORMATION --}}
                        <div class="col-md-6">

                            <label
                                for="formation"
                                class="form-label"
                            >
                                Formation
                            </label>

                            <input
                                type="text"
                                id="formation"
                                name="formation"
                                class="form-control"
                                value="{{ old('formation', $candidat->formation ?? '') }}"
                                placeholder="Exemple : MIACSD"
                            >

                            @error('formation')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- NIVEAU --}}
                        <div class="col-md-6">

                            <label
                                for="niveauEtude"
                                class="form-label"
                            >
                                Niveau d'étude
                            </label>

                            <input
                                type="text"
                                id="niveauEtude"
                                name="niveauEtude"
                                class="form-control"
                                value="{{ old('niveauEtude', $candidat->niveauEtude ?? '') }}"
                                placeholder="Exemple : Licence 3"
                            >

                            @error('niveauEtude')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- ANNEE --}}
                        <div class="col-md-6">

                            <label
                                for="anneeUniversitaire"
                                class="form-label"
                            >
                                Année universitaire
                            </label>

                            <input
                                type="text"
                                id="anneeUniversitaire"
                                name="anneeUniversitaire"
                                class="form-control"
                                value="{{ old('anneeUniversitaire', $candidat->anneeUniversitaire ?? '') }}"
                                placeholder="Exemple : 2025-2026"
                            >

                            @error('anneeUniversitaire')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                    {{-- BOUTONS --}}
                    <div class="d-flex justify-content-end gap-2 mt-5 pt-4 border-top">

                        <a
                            href="{{ route('etudiant.profil') }}"
                            class="btn btn-secondary-custom px-4"
                        >
                            <i class="bi bi-x-lg me-2"></i>
                            Annuler
                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary px-4"
                        >
                            <i class="bi bi-check-lg me-2"></i>
                            Enregistrer les modifications
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </main>

</div>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

</body>

</html>