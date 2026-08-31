<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Documents - ABHOER</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        .header {
            background: linear-gradient(135deg, #0d6e6e, #25a6a6);
            color: white;
            padding: 18px 35px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .logout button {
            background: white;
            color: #0d6e6e;

            border: none;
            padding: 10px 20px;

            border-radius: 6px;

            font-weight: bold;

            cursor: pointer;
        }

        .container {
            width: 90%;
            max-width: 900px;

            margin: 35px auto;
        }

        .card {
            background: white;

            padding: 30px;

            border-radius: 10px;

            box-shadow:
                0 4px 12px rgba(0, 0, 0, 0.08);
        }

        h2 {
            color: #0d6e6e;

            margin-top: 0;
        }

        .subtitle {
            color: #64748b;

            margin-bottom: 30px;
        }

        .steps {
            display: flex;

            gap: 10px;

            margin-bottom: 30px;
        }

        .step {
            flex: 1;

            text-align: center;

            padding: 12px;

            background: #e2e8f0;

            border-radius: 6px;

            font-weight: bold;

            color: #64748b;
        }

        .step.active {
            background: #0d6e6e;
            color: white;
        }

        .section-title {
            color: #0d6e6e;

            border-bottom:
                2px solid #e2e8f0;

            padding-bottom: 8px;

            margin-top: 25px;
        }

        .info-box {
            background: #f8fafc;

            padding: 15px;

            border-radius: 6px;

            margin-bottom: 25px;
        }

        .info-box strong {
            color: #0d6e6e;
        }

        .alert {
            padding: 12px 15px;

            border-radius: 6px;

            margin-bottom: 20px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        .document-row {
            border: 1px solid #cbd5e1;

            border-radius: 8px;

            padding: 20px;

            margin-top: 20px;

            background: #f8fafc;
        }

        .form-group {
            margin-top: 15px;
        }

        label {
            display: block;

            font-weight: bold;

            margin-bottom: 8px;

            color: #334155;
        }

        input,
        select {
            width: 100%;

            padding: 12px;

            border: 1px solid #cbd5e1;

            border-radius: 6px;

            font-size: 15px;

            background: white;
        }

        input:focus,
        select:focus {
            outline: none;

            border-color: #0d6e6e;
        }

        .required {
            color: #dc2626;
        }

        .error {
            margin-top: 6px;

            color: #dc2626;

            font-size: 14px;
        }

        .existing-documents {
            margin-top: 30px;
        }

        .existing-document {
            padding: 12px;

            border-bottom: 1px solid #e2e8f0;
        }

        .existing-document:last-child {
            border-bottom: none;
        }

        .actions {
            display: flex;

            justify-content: space-between;

            margin-top: 30px;

            gap: 15px;
        }

        .button {
            display: inline-block;

            padding: 11px 20px;

            border-radius: 6px;

            background: #0d6e6e;

            color: white;

            text-decoration: none;

            border: none;

            font-weight: bold;

            cursor: pointer;
        }

        .button:hover {
            background: #14606a;
        }

        .button.secondary {
            background: #64748b;
        }

        .button.secondary:hover {
            background: #475569;
        }

        .add-button {
            margin-top: 20px;

            background: #16a34a;
        }

        .add-button:hover {
            background: #15803d;
        }

        .remove-button {
            margin-top: 15px;

            background: #dc2626;

            padding: 8px 14px;

            border: none;

            color: white;

            border-radius: 5px;

            cursor: pointer;
        }

        @media (max-width: 700px) {

            .header {
                padding: 15px 20px;
            }

            .header h1 {
                font-size: 20px;
            }

            .container {
                width: 95%;
            }

            .card {
                padding: 20px;
            }

            .steps {
                flex-direction: column;
            }

            .actions {
                flex-direction: column;
            }

            .button {
                text-align: center;
            }

        }

    </style>

</head>


<body>

<header class="header">

    <h1>
        ABHOER - Gestion des stages
    </h1>

    <form
        method="POST"
        action="{{ route('logout') }}"
        class="logout"
    >

        @csrf

        <button type="submit">
            Se déconnecter
        </button>

    </form>

</header>


<main class="container">

    <div class="card">

        <h2>
            Documents de la demande
        </h2>

        <p class="subtitle">
            Ajoutez les documents nécessaires à votre demande de stage.
        </p>


        <!-- Étapes -->

        <div class="steps">

            <div class="step">
                1. Informations
            </div>

            <div class="step active">
                2. Documents
            </div>

            <div class="step">
                3. Confirmation
            </div>

        </div>


        <!-- Message de succès -->

        @if (session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif


        <!-- Erreurs -->

        @if ($errors->any())

            <div class="alert alert-error">

                <strong>
                    Veuillez corriger les erreurs suivantes :
                </strong>

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        <!-- Informations demande -->

        <div class="info-box">

            <strong>
                Numéro de demande :
            </strong>

            {{ $demande->numeroDemande }}

            <br>

            <strong>
                Type de stage :
            </strong>

            {{ $demande->typeDepot }}

            <br>

            <strong>
                Thème :
            </strong>

            {{ $demande->theme }}

        </div>


        <form
            method="POST"
            action="{{ route(
                'etudiant.demande.documents.store',
                $demande->idDemande
            ) }}"
            enctype="multipart/form-data"
        >

            @csrf


            <h3 class="section-title">
                Ajouter des documents
            </h3>


            <div id="documents-container">


                <!-- Premier document -->

                <div class="document-row">

                    <div class="form-group">

                        <label>

                            Type de document

                            <span class="required">
                                *
                            </span>

                        </label>

                        <select
                            name="types[]"
                            required
                        >

                            <option value="">
                                -- Sélectionner --
                            </option>

                            <option value="CV">
                                CV
                            </option>

                            <option value="Lettre de motivation">
                                Lettre de motivation
                            </option>

                            <option value="Convention de stage">
                                Convention de stage
                            </option>

                            <option value="Attestation d'inscription">
                                Attestation d'inscription
                            </option>

                            <option value="Relevé de notes">
                                Relevé de notes
                            </option>

                            <option value="Autre">
                                Autre
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label>

                            Fichier

                            <span class="required">
                                *
                            </span>

                        </label>

                        <input
                            type="file"
                            name="documents[]"
                            accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                            required
                        >

                    </div>

                </div>

            </div>


            <!-- Ajouter un document -->

            <button
                type="button"
                class="button add-button"
                onclick="ajouterDocument()"
            >
                + Ajouter un autre document
            </button>


            <!-- Documents déjà enregistrés -->

            @if ($documents->count() > 0)

                <div class="existing-documents">

                    <h3 class="section-title">
                        Documents déjà ajoutés
                    </h3>


                    @foreach ($documents as $document)

                        <div class="existing-document">

                            <strong>
                                {{ $document->typeDocument }}
                            </strong>

                            <br>

                            {{ $document->nomFichier }}

                            <br>

                            <small>
                                Ajouté le
                                {{ $document->dateAjout?->format('d/m/Y H:i') }}
                            </small>

                        </div>

                    @endforeach

                </div>

            @endif


            <!-- Boutons -->

            <div class="actions">

                <a
                    href="{{ route('etudiant.dashboard') }}"
                    class="button secondary"
                >
                    ← Annuler
                </a>

                <button
                    type="submit"
                    class="button"
                >
                    Continuer →
                </button>

            </div>

        </form>

    </div>

</main>


<script>

    function ajouterDocument()
    {
        const container =
            document.getElementById('documents-container');

        const row =
            document.createElement('div');

        row.className = 'document-row';

        row.innerHTML = `

            <div class="form-group">

                <label>

                    Type de document

                    <span class="required">
                        *
                    </span>

                </label>

                <select
                    name="types[]"
                    required
                >

                    <option value="">
                        -- Sélectionner --
                    </option>

                    <option value="CV">
                        CV
                    </option>

                    <option value="Lettre de motivation">
                        Lettre de motivation
                    </option>

                    <option value="Convention de stage">
                        Convention de stage
                    </option>

                    <option value="Attestation d'inscription">
                        Attestation d'inscription
                    </option>

                    <option value="Relevé de notes">
                        Relevé de notes
                    </option>

                    <option value="Autre">
                        Autre
                    </option>

                </select>

            </div>


            <div class="form-group">

                <label>

                    Fichier

                    <span class="required">
                        *
                    </span>

                </label>

                <input
                    type="file"
                    name="documents[]"
                    accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                    required
                >

            </div>


            <button
                type="button"
                class="remove-button"
                onclick="this.parentElement.remove()"
            >
                Supprimer
            </button>

        `;

        container.appendChild(row);
    }

</script>


</body>

</html>