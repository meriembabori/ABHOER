<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DemandeStage extends Model
{
    /**
     * Nom de la table.
     */
    protected $table = 'demande_stage';

    /**
     * Clé primaire.
     */
    protected $primaryKey = 'idDemande';

    /**
     * Pas de created_at / updated_at.
     */
    public $timestamps = false;

    /**
     * Champs autorisés.
     */
    protected $fillable = [
        'idCandidat',
        'idService',
        'numeroDemande',
        'dateDepot',
        'dateDebut',
        'dateFin',
        'theme',
        'motivation',
        'statut',
        'typeDepot',
        'typeStage',
        'observation',
    ];

    /**
     * Conversion des dates.
     */
    protected $casts = [
        'dateDepot' => 'datetime',
        'dateDebut' => 'date',
        'dateFin' => 'date',
    ];

    /**
     * Une demande appartient à un candidat.
     */
    public function candidat(): BelongsTo
    {
        return $this->belongsTo(
            Candidat::class,
            'idCandidat',
            'idCandidat'
        );
    }

    /**
     * Une demande appartient à un service.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(
            Service::class,
            'idService',
            'idService'
        );
    }

    /**
     * Une demande possède plusieurs documents.
     */
    public function documents(): HasMany
    {
        return $this->hasMany(
            Document::class,
            'idDemande',
            'idDemande'
        );
    }

    /**
     * Une demande possède une affectation.
     */
    public function affectation(): HasOne
    {
        return $this->hasOne(
            Affectation::class,
            'idDemande',
            'idDemande'
        );
    }

    /**
     * Une demande possède plusieurs historiques.
     */
    public function historiques(): HasMany
    {
        return $this->hasMany(
            Historique::class,
            'idDemande',
            'idDemande'
        );
    }

    /**
     * Une demande peut avoir une attestation de stage associée.
     */
    public function attestation(): HasOne
    {
        return $this->hasOne(
            Attestation::class,
            'idDemande',
            'idDemande'
        );
    }
}