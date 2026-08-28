<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Utilisateur extends Authenticatable
{
    use Notifiable;

    /**
     * Table utilisée par l'authentification.
     */
    protected $table = 'utilisateur';

    /**
     * Clé primaire.
     */
    protected $primaryKey = 'idUtilisateur';

    /**
     * Type de la clé primaire.
     */
    protected $keyType = 'int';

    /**
     * La clé primaire est auto-incrémentée.
     */
    public $incrementing = true;

    /**
     * La table utilisateur n'utilise pas
     * les timestamps Laravel.
     */
    public $timestamps = false;

    /**
     * Champs pouvant être remplis.
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
     * Champs cachés.
     */
    protected $hidden = [
        'motDePasse',
    ];

    /**
     * Laravel doit utiliser motDePasse
     * pour l'authentification.
     */
    public function getAuthPassword()
    {
        return $this->motDePasse;
    }

    /**
     * Retourne le candidat associé à cet utilisateur.
     *
     * utilisateur.idCandidat
     *        ↓
     * candidat.idCandidat
     */
    public function candidat(): BelongsTo
    {
        return $this->belongsTo(
            Candidat::class,
            'idCandidat',
            'idCandidat'
        );
    }
}