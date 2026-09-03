<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Candidat extends Model
{
    /**
     * Nom de la table.
     */
    protected $table = 'candidat';

    /**
     * Clé primaire.
     */
    protected $primaryKey = 'idCandidat';

    /**
     * Pas de timestamps.
     */
    public $timestamps = false;

    /**
     * Champs autorisés.
     */
    protected $fillable = [
        'nom',
        'prenom',
        'cin',
        'cne',
        'dateNaissance',
        'telephone',
        'adresse',
        'email',
        'photo',
        'etablissement',
        'formation',
        'niveauEtude',
        'anneeUniversitaire',
        'diplome',
        'anneeObtentionDiplome',
    ];

    /**
     * Conversion.
     */
    protected $casts = [
        'dateNaissance' => 'date',
        'anneeObtentionDiplome' => 'integer',
    ];

    /**
     * Un candidat peut avoir plusieurs demandes.
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
     * Un candidat peut avoir plusieurs utilisateurs associés.
     */
    public function utilisateurs(): HasMany
    {
        return $this->hasMany(
            Utilisateur::class,
            'idCandidat',
            'idCandidat'
        );
    }
}