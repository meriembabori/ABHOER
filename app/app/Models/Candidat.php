<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Candidat extends Model
{
    protected $table = 'candidat';

    protected $primaryKey = 'idCandidat';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'nom',
        'prenom',
        'cin',
        'telephone',
        'email',
        'etablissement',
        'formation',
        'niveauEtude',
    ];

    /**
     * Un candidat possède plusieurs demandes.
     */
    public function demandes(): HasMany
    {
        return $this->hasMany(
            DemandeStage::class,
            'idCandidat',
            'idCandidat'
        );
    }

    /**
     * Un candidat possède normalement un seul compte utilisateur.
     */
    public function utilisateur(): HasOne
    {
        return $this->hasOne(
            Utilisateur::class,
            'idCandidat',
            'idCandidat'
        );
    }
}