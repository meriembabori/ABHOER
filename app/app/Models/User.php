<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Table utilisée pour l'authentification
     */
    protected $table = 'utilisateur';

    /**
     * Clé primaire
     */
    protected $primaryKey = 'idUtilisateur';

    protected $keyType = 'int';

    public $incrementing = true;

    /**
     * Pas de timestamps Laravel
     */
    public $timestamps = false;

    /**
     * Champs modifiables
     */
    protected $fillable = [
        'idCandidat',
        'nom',
        'prenom',
        'login',
        'motDePasse',
        'role',
        'actif',
    ];

    /**
     * Champs cachés
     */
    protected $hidden = [
        'motDePasse',
    ];

    /**
     * Relation :
     *
     * utilisateur.idCandidat
     *        ↓
     * candidat.idCandidat
     */
    public function candidat()
    {
        return $this->belongsTo(
            Candidat::class,
            'idCandidat',
            'idCandidat'
        );
    }

    /**
     * Mot de passe utilisé par Laravel
     */
    public function getAuthPassword()
    {
        return $this->motDePasse;
    }

    /**
     * Identifiant utilisé par Laravel
     */
    public function getAuthIdentifierName()
    {
        return 'idUtilisateur';
    }
}