<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    protected $table = 'service';

    protected $primaryKey = 'idService';

    public $timestamps = false;

    protected $fillable = [
        'idDepartement',
        'nomService',
        'capaciteAccueil',
        'description',
    ];

    /**
     * Département du service.
     */
    public function departement(): BelongsTo
    {
        return $this->belongsTo(
            Departement::class,
            'idDepartement',
            'idDepartement'
        );
    }

    /**
     * Demandes associées au service.
     */
    public function demandes(): HasMany
    {
        return $this->hasMany(
            DemandeStage::class,
            'idService',
            'idService'
        );
    }

    /**
     * Affectations associées au service.
     */
    public function affectations(): HasMany
    {
        return $this->hasMany(
            Affectation::class,
            'idService',
            'idService'
        );
    }
}