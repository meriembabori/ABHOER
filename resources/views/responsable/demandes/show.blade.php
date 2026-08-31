@extends('layouts.responsable')

@section('title', 'Demande ' . $demande->numeroDemande)
@section('page-title', $demande->numeroDemande)
@section('page-subtitle', 'Détail et traitement de la demande')

@section('content')

    <style>
        .detail-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 18px; align-items: start; }
        .detail-grid .card { margin-bottom: 18px; }
        .detail-grid .card h3 { display: flex; align-items: center; gap: 8px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px; margin-bottom: 14px; }
        .detail-grid .card h3 i { color: var(--c-teal-dark); }

        .info-line { display: flex; justify-content: space-between; padding: 9px 0; border-bottom: 1px solid #f8fafc; font-size: 13.5px; }
        .info-line span:first-child { color: #64748b; }
        .info-line span:last-child { font-weight: 600; text-align: right; color: var(--c-navy); }

        .doc-item { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #f8fafc; font-size: 13.5px; }
        .doc-item a { color: var(--c-teal-dark); font-weight: 600; }

        .action-block { border-top: 1px solid #f1f5f9; padding-top: 14px; margin-top: 14px; }
        .action-block summary { cursor: pointer; font-weight: 600; color: var(--c-navy); margin-bottom: 10px; font-size: 13.5px; list-style: none; display: flex; align-items: center; gap: 7px; }
        .action-block summary::-webkit-details-marker { display: none; }

        .timeline-item { padding: 10px 0; border-bottom: 1px solid #f8fafc; font-size: 12.5px; }
        .timeline-item .action-name { font-weight: 700; color: var(--c-teal-dark); }
        .timeline-item .action-meta { color: #94a3b8; font-size: 11.5px; margin-top: 2px; }

        .badge-large { padding: 7px 16px; font-size: 13px; }

        .btn-block { width: 100%; justify-content: center; margin-bottom: 10px; }

        @media (max-width: 1000px) { .detail-grid { grid-template-columns: 1fr; } }
    </style>

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;">
        <a href="{{ route('responsable.demandes.index') }}" style="color:var(--c-teal-dark);font-size:13px;font-weight:600;">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
        <span class="badge badge-large badge-{{ $demande->statut }}">{{ $demande->statut }}</span>
    </div>

    <div class="detail-grid">

        <div>
            <div class="card">
                <h3><i class="bi bi-person-fill"></i> Informations du candidat</h3>
                <div class="info-line"><span>Nom complet</span><span>{{ $demande->candidat->prenom ?? '' }} {{ $demande->candidat->nom ?? '' }}</span></div>
                <div class="info-line"><span>CIN</span><span>{{ $demande->candidat->cin ?? '—' }}</span></div>
                <div class="info-line"><span>Email</span><span>{{ $demande->candidat->email ?? '—' }}</span></div>
                <div class="info-line"><span>Téléphone</span><span>{{ $demande->candidat->telephone ?? '—' }}</span></div>
                <div class="info-line"><span>Établissement</span><span>{{ $demande->candidat->etablissement ?? '—' }}</span></div>
                <div class="info-line"><span>Formation</span><span>{{ $demande->candidat->formation ?? '—' }}</span></div>
                <div class="info-line"><span>Niveau d'étude</span><span>{{ $demande->candidat->niveauEtude ?? '—' }}</span></div>
            </div>

            <div class="card">
                <h3><i class="bi bi-file-earmark-text-fill"></i> Détails de la demande</h3>
                <div class="info-line"><span>Service demandé</span><span>{{ $demande->service->nomService ?? '—' }}</span></div>
                <div class="info-line"><span>Type de dépôt</span><span>{{ $demande->typeDepot ?? '—' }}</span></div>
                <div class="info-line"><span>Type de stage</span><span>{{ $demande->typeStage ?? '—' }}</span></div>
                <div class="info-line"><span>Thème / Sujet</span><span>{{ $demande->theme ?? '—' }}</span></div>
                <div class="info-line"><span>Date de dépôt</span><span>{{ optional($demande->dateDepot)->format('d/m/Y') }}</span></div>
                <div class="info-line"><span>Période souhaitée</span><span>
                    {{ $demande->dateDebut ? $demande->dateDebut->format('d/m/Y') : '—' }}
                    &rarr;
                    {{ $demande->dateFin ? $demande->dateFin->format('d/m/Y') : '—' }}
                </span></div>

                @if ($demande->motivation)
                    <div class="info-line" style="flex-direction:column;align-items:flex-start;">
                        <span>Motivation</span>
                        <span style="font-weight:normal;text-align:left;margin-top:6px;color:#334155;">{{ $demande->motivation }}</span>
                    </div>
                @endif

                @if ($demande->observation)
                    <div class="info-line" style="flex-direction:column;align-items:flex-start;">
                        <span>Observation</span>
                        <span style="font-weight:normal;text-align:left;margin-top:6px;color:#334155;">{{ $demande->observation }}</span>
                    </div>
                @endif

                @if ($demande->affectation)
                    <div class="info-line"><span>Affectée à</span><span>{{ $demande->affectation->service->nomService ?? '—' }}</span></div>
                    <div class="info-line"><span>Période d'affectation</span><span>
                        {{ optional($demande->affectation->dateDebut)->format('d/m/Y') }}
                        &rarr;
                        {{ optional($demande->affectation->dateFin)->format('d/m/Y') }}
                    </span></div>
                @endif

                @if ($demande->statut === 'ACCEPTEE')
                    <div class="info-line">
                        <span>Attestation</span>
                        <span>
                            @php $etatAttestation = optional($demande->attestation)->statut ?? 'NON_DEMANDEE'; @endphp
                            <span class="badge badge-{{ $etatAttestation }}" style="font-size:10.5px;">{{ $etatAttestation }}</span>
                            — <a href="{{ route('responsable.attestations.index', ['recherche' => $demande->numeroDemande]) }}" style="color:var(--c-teal-dark);">gérer</a>
                        </span>
                    </div>
                @endif
            </div>

            <div class="card">
                <h3><i class="bi bi-paperclip"></i> Documents ({{ $demande->documents->count() }})</h3>

                @forelse ($demande->documents as $document)
                    <div class="doc-item">
                        <span>{{ $document->nomFichier }} <span style="color:#94a3b8;">({{ $document->typeDocument }})</span></span>
                        <a href="{{ \Illuminate\Support\Facades\Storage::url($document->cheminFichier) }}" target="_blank">Ouvrir</a>
                    </div>
                @empty
                    <p style="color:#94a3b8;font-size:13px;">Aucun document pour cette demande.</p>
                @endforelse

                <form style="margin-top:14px;border-top:1px solid #f1f5f9;padding-top:14px;" method="POST" action="{{ route('responsable.demandes.documents.store', $demande->idDemande) }}" enctype="multipart/form-data">
                    @csrf
                    <label>Ajouter un ou plusieurs documents (déposés au bureau)</label>
                    <input type="file" name="documents[]" multiple style="margin-bottom:10px;">
                    <button type="submit" class="btn btn-secondary"><i class="bi bi-cloud-upload-fill"></i> Ajouter les documents</button>
                </form>
            </div>

            <div class="card">
                <h3><i class="bi bi-clock-history"></i> Historique des actions</h3>
                @forelse ($demande->historiques->sortByDesc('dateAction') as $item)
                    <div class="timeline-item">
                        <div class="action-name">{{ $item->action }}</div>
                        <div>{{ $item->nouvelleValeur }}</div>
                        <div class="action-meta">
                            {{ optional($item->utilisateur)->prenom }} {{ optional($item->utilisateur)->nom }}
                            — {{ optional($item->dateAction)->format('d/m/Y H:i') }}
                        </div>
                    </div>
                @empty
                    <p style="color:#94a3b8;font-size:13px;">Aucune action enregistrée.</p>
                @endforelse
            </div>
        </div>

        <div>
            <div class="card">
                <h3><i class="bi bi-lightning-charge-fill"></i> Actions</h3>

                @if (in_array($demande->statut, ['EN_ATTENTE', 'INFOS_DEMANDEES']))
                    <form method="POST" action="{{ route('responsable.demandes.accepter', $demande->idDemande) }}">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-block"><i class="bi bi-check-circle-fill"></i> Accepter la demande</button>
                    </form>

                    <details class="action-block">
                        <summary><i class="bi bi-x-circle-fill"></i> Refuser la demande</summary>
                        <form method="POST" action="{{ route('responsable.demandes.refuser', $demande->idDemande) }}">
                            @csrf
                            <textarea name="motif" rows="3" placeholder="Motif du refus (optionnel)" style="margin-bottom:10px;"></textarea>
                            <button type="submit" class="btn btn-danger btn-block">Confirmer le refus</button>
                        </form>
                    </details>

                    <details class="action-block">
                        <summary><i class="bi bi-question-circle-fill"></i> Demander des informations</summary>
                        <form method="POST" action="{{ route('responsable.demandes.demander-infos', $demande->idDemande) }}">
                            @csrf
                            <textarea name="message" rows="3" placeholder="Précisez les informations manquantes" required style="margin-bottom:10px;"></textarea>
                            <button type="submit" class="btn btn-secondary btn-block">Envoyer la demande</button>
                        </form>
                    </details>
                @endif

                <details class="action-block" @if($demande->statut === 'ACCEPTEE') open @endif>
                    <summary><i class="bi bi-building"></i> Affecter à un service</summary>
                    <form method="POST" action="{{ route('responsable.demandes.affecter', $demande->idDemande) }}">
                        @csrf
                        <label>Service</label>
                        <select name="idService" required style="margin-bottom:10px;">
                            <option value="">-- Choisir un service --</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->idService }}" @selected(optional($demande->affectation)->idService === $service->idService)>
                                    {{ $service->nomService }}
                                </option>
                            @endforeach
                        </select>
                        <label>Date de début</label>
                        <input type="date" name="dateDebut" value="{{ optional(optional($demande->affectation)->dateDebut)->format('Y-m-d') }}" required style="margin-bottom:10px;">
                        <label>Date de fin</label>
                        <input type="date" name="dateFin" value="{{ optional(optional($demande->affectation)->dateFin)->format('Y-m-d') }}" required style="margin-bottom:10px;">
                        <label>Observation</label>
                        <textarea name="observation" rows="2" placeholder="Optionnel" style="margin-bottom:10px;">{{ optional($demande->affectation)->observation }}</textarea>
                        <button type="submit" class="btn btn-primary btn-block">Affecter</button>
                    </form>
                </details>
            </div>
        </div>

    </div>

@endsection
