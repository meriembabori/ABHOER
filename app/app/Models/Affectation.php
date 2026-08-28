<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Affectation extends Model
{
    protected $table = 'affectation';

    protected $primaryKey = 'idAffectation';

    public $timestamps = false;

    protected $fillable = [
        'idDemande',
        'idService',
        'dateAffectation',
        'dateDebut',
        'dateFin',
        'observation',
    ];

    protected $casts = [
        'dateAffectation' => 'date',
        'dateDebut' => 'date',
        'dateFin' => 'date',
    ];

    public function demande(): BelongsTo
    {
        return $this->belongsTo(
            DemandeStage::class,
            'idDemande',
            'idDemande'
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
}