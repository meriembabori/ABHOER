@extends('layouts.responsable')

@section('title', 'Demande ' . $demande->numeroDemande)
@section('page-title', $demande->numeroDemande)
@section('page-description', 'Détail et traitement de la demande.')

@section('content')

<a href="{{ route('responsable.demandes.index') }}" class="btn btn-outline-primary btn-sm mb-3"><i class="bi bi-arrow-left"></i> Retour à la liste</a>

<div class="row g-4">
    <div class="col-lg-8">

        <div class="card p-4 mb-4">
            <h6 class="mb-3"><i class="bi bi-person-fill text-primary me-1"></i> Informations du candidat</h6>
            <div class="row">
                <div class="col-md-6 mb-2"><span class="text-muted small d-block">Nom complet</span><strong>{{ $demande->candidat->prenom ?? '' }} {{ $demande->candidat->nom ?? '' }}</strong></div>
                <div class="col-md-6 mb-2"><span class="text-muted small d-block">CIN</span><strong>{{ $demande->candidat->cin ?? '—' }}</strong></div>
                <div class="col-md-6 mb-2"><span class="text-muted small d-block">Email</span><strong>{{ $demande->candidat->email ?? '—' }}</strong></div>
                <div class="col-md-6 mb-2"><span class="text-muted small d-block">Téléphone</span><strong>{{ $demande->candidat->telephone ?? '—' }}</strong></div>
                <div class="col-md-6 mb-2"><span class="text-muted small d-block">Établissement</span><strong>{{ $demande->candidat->etablissement ?? '—' }}</strong></div>
                <div class="col-md-6 mb-2"><span class="text-muted small d-block">Formation</span><strong>{{ $demande->candidat->formation ?? '—' }}</strong></div>
            </div>
        </div>

        <div class="card p-4 mb-4">
            <h6 class="mb-3"><i class="bi bi-file-earmark-text-fill text-primary me-1"></i> Détails de la demande</h6>
            <div class="row">
                <div class="col-md-6 mb-2"><span class="text-muted small d-block">Service demandé</span><strong>{{ $demande->service->nomService ?? '—' }}</strong></div>
                <div class="col-md-6 mb-2"><span class="text-muted small d-block">Type de dépôt</span><strong>{{ $demande->typeDepot ?? '—' }}</strong></div>
                <div class="col-md-6 mb-2"><span class="text-muted small d-block">Type de stage</span><strong>{{ $demande->typeStage ?? '—' }}</strong></div>
                <div class="col-md-6 mb-2"><span class="text-muted small d-block">Thème / Sujet</span><strong>{{ $demande->theme ?? '—' }}</strong></div>
                <div class="col-md-6 mb-2"><span class="text-muted small d-block">Date de dépôt</span><strong>{{ optional($demande->dateDepot)->format('d/m/Y') }}</strong></div>
                <div class="col-md-6 mb-2"><span class="text-muted small d-block">Période souhaitée</span><strong>{{ $demande->dateDebut ? $demande->dateDebut->format('d/m/Y') : '—' }} &rarr; {{ $demande->dateFin ? $demande->dateFin->format('d/m/Y') : '—' }}</strong></div>
            </div>

            @if ($demande->motivation)
                <div class="mt-2"><span class="text-muted small d-block">Motivation</span><p class="mb-0">{{ $demande->motivation }}</p></div>
            @endif
            @if ($demande->observation)
                <div class="mt-2"><span class="text-muted small d-block">Observation</span><p class="mb-0">{{ $demande->observation }}</p></div>
            @endif

            @if ($demande->affectation)
                <hr>
                <div class="row">
                    <div class="col-md-6 mb-2"><span class="text-muted small d-block">Affectée à</span><strong>{{ $demande->affectation->service->nomService ?? '—' }}</strong></div>
                    <div class="col-md-6 mb-2"><span class="text-muted small d-block">Période d'affectation</span><strong>{{ optional($demande->affectation->dateDebut)->format('d/m/Y') }} &rarr; {{ optional($demande->affectation->dateFin)->format('d/m/Y') }}</strong></div>
                </div>
            @endif

            @if ($demande->statut === 'ACCEPTEE')
                <hr>
                @php $etatAttestation = optional($demande->attestation)->statut ?? 'NON_DEMANDEE'; @endphp
                <div><span class="text-muted small d-block">Attestation</span>
                    <span class="badge bg-secondary-subtle text-dark">{{ $etatAttestation }}</span>
                    <a href="{{ route('responsable.attestations.index', ['recherche' => $demande->numeroDemande]) }}" class="small ms-1">gérer</a>
                </div>
            @endif
        </div>

        <div class="card p-4 mb-4">
            <h6 class="mb-3"><i class="bi bi-paperclip text-primary me-1"></i> Documents ({{ $demande->documents->count() }})</h6>
            @forelse ($demande->documents as $document)
                <div class="d-flex justify-content-between border-bottom py-2 small">
                    <span>{{ $document->nomFichier }} <span class="text-muted">({{ $document->typeDocument }})</span></span>
                    <a href="{{ \Illuminate\Support\Facades\Storage::url($document->cheminFichier) }}" target="_blank" class="text-primary fw-bold">Ouvrir</a>
                </div>
            @empty
                <p class="text-muted small">Aucun document pour cette demande.</p>
            @endforelse

            <form class="mt-3 pt-3 border-top" method="POST" action="{{ route('responsable.demandes.documents.store', $demande->idDemande) }}" enctype="multipart/form-data">
                @csrf
                <label class="form-label">Ajouter un ou plusieurs documents (déposés au bureau)</label>
                <input type="file" name="documents[]" multiple class="form-control mb-2">
                <button type="submit" class="btn btn-outline-primary btn-sm"><i class="bi bi-cloud-upload-fill"></i> Ajouter les documents</button>
            </form>
        </div>

        <div class="card p-4">
            <h6 class="mb-3"><i class="bi bi-clock-history text-primary me-1"></i> Historique des actions</h6>
            @forelse ($demande->historiques->sortByDesc('dateAction') as $item)
                <div class="border-bottom py-2 small">
                    <strong class="text-primary">{{ $item->action }}</strong><br>
                    {{ $item->nouvelleValeur }}<br>
                    <span class="text-muted" style="font-size:11px;">{{ optional($item->utilisateur)->prenom }} {{ optional($item->utilisateur)->nom }} — {{ optional($item->dateAction)->format('d/m/Y H:i') }}</span>
                </div>
            @empty
                <p class="text-muted small">Aucune action enregistrée.</p>
            @endforelse
        </div>

    </div>

    <div class="col-lg-4">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0"><i class="bi bi-lightning-charge-fill text-primary me-1"></i> Actions</h6>
                <span class="badge bg-secondary-subtle text-dark">{{ $demande->statut }}</span>
            </div>

            @if (in_array($demande->statut, ['EN_ATTENTE', 'INFOS_DEMANDEES']))
                <form method="POST" action="{{ route('responsable.demandes.accepter', $demande->idDemande) }}" class="mb-2">
                    @csrf
                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-check-circle-fill me-1"></i> Accepter la demande</button>
                </form>

                <details class="border-top pt-2 mt-2">
                    <summary class="fw-bold small mb-2" style="cursor:pointer;color:var(--resp-text);"><i class="bi bi-x-circle-fill me-1 text-danger"></i> Refuser la demande</summary>
                    <form method="POST" action="{{ route('responsable.demandes.refuser', $demande->idDemande) }}" class="mt-2">
                        @csrf
                        <textarea name="motif" rows="3" class="form-control mb-2" placeholder="Motif du refus (optionnel)"></textarea>
                        <button type="submit" class="btn btn-danger w-100 btn-sm">Confirmer le refus</button>
                    </form>
                </details>

                <details class="border-top pt-2 mt-2">
                    <summary class="fw-bold small mb-2" style="cursor:pointer;color:var(--resp-text);"><i class="bi bi-question-circle-fill me-1 text-primary"></i> Demander des informations</summary>
                    <form method="POST" action="{{ route('responsable.demandes.demander-infos', $demande->idDemande) }}" class="mt-2">
                        @csrf
                        <textarea name="message" rows="3" class="form-control mb-2" placeholder="Précisez les informations manquantes" required></textarea>
                        <button type="submit" class="btn btn-outline-primary w-100 btn-sm">Envoyer la demande</button>
                    </form>
                </details>
            @endif

            <details class="border-top pt-2 mt-2" @if($demande->statut === 'ACCEPTEE') open @endif>
                <summary class="fw-bold small mb-2" style="cursor:pointer;color:var(--resp-text);"><i class="bi bi-building me-1 text-primary"></i> Affecter à un service</summary>
                <form method="POST" action="{{ route('responsable.demandes.affecter', $demande->idDemande) }}" class="mt-2">
                    @csrf
                    <label class="form-label">Service</label>
                    <select name="idService" required class="form-select mb-2">
                        <option value="">-- Choisir un service --</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->idService }}" @selected(optional($demande->affectation)->idService === $service->idService)>{{ $service->nomService }}</option>
                        @endforeach
                    </select>
                    <label class="form-label">Date de début</label>
                    <input type="date" name="dateDebut" value="{{ optional(optional($demande->affectation)->dateDebut)->format('Y-m-d') }}" required class="form-control mb-2">
                    <label class="form-label">Date de fin</label>
                    <input type="date" name="dateFin" value="{{ optional(optional($demande->affectation)->dateFin)->format('Y-m-d') }}" required class="form-control mb-2">
                    <button type="submit" class="btn btn-primary w-100 btn-sm">Affecter</button>
                </form>
            </details>
        </div>
    </div>
</div>

@endsection
