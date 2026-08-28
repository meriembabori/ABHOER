<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attestation extends Model
{
    protected $table = 'attestation_stage';

    protected $primaryKey = 'idAttestation';

    protected $fillable = [
        'idDemande',
        'statut',
        'datePreparation',
        'dateDisponibilite',
        'dateRemise',
        'cheminFichier',
        'observation',
    ];

    protected $casts = [
        'datePreparation' => 'date',
        'dateDisponibilite' => 'date',
        'dateRemise' => 'date',
    ];

    public function demande(): BelongsTo
    {
        return $this->belongsTo(
            DemandeStage::class,
            'idDemande',
            'idDemande'
        );
    }
}
