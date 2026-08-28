<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DemandeStage extends Model
{
    protected $table = 'demande_stage';

    protected $primaryKey = 'idDemande';

    public $timestamps = false;

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

    protected $casts = [
        'dateDepot' => 'date',
        'dateDebut' => 'date',
        'dateFin' => 'date',
    ];

    public function candidat(): BelongsTo
    {
        return $this->belongsTo(
            Candidat::class,
            'idCandidat',
            'idCandidat'
        );
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(
            Service::class,
            'idService',
            'idService'
        );
    }

    public function documents(): HasMany
    {
        return $this->hasMany(
            Document::class,
            'idDemande',
            'idDemande'
        );
    }

    public function affectation(): HasOne
    {
        return $this->hasOne(
            Affectation::class,
            'idDemande',
            'idDemande'
        );
    }

    public function historiques(): HasMany
    {
        return $this->hasMany(
            Historique::class,
            'idDemande',
            'idDemande'
        );
    }

    public function attestation(): HasOne
    {
        return $this->hasOne(
            Attestation::class,
            'idDemande',
            'idDemande'
        );
    }
}