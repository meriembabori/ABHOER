<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Utilisateur extends Authenticatable
{
    use Notifiable;

    /**
     * Nom de la table.
     */
    protected $table = 'utilisateur';

    /**
     * Clé primaire.
     */
    protected $primaryKey = 'idUtilisateur';

    /**
     * La table n'utilise pas created_at / updated_at.
     */
    public $timestamps = false;

    /**
     * Champs autorisés en écriture.
     */
    protected $fillable = [
        'idCandidat',
        'idService',
        'nom',
        'prenom',
        'login',
        'email',
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
     * Conversion des champs.
     */
    protected $casts = [
        'actif' => 'boolean',
    ];

    /**
     * Mot de passe utilisé par Laravel Auth.
     */
    public function getAuthPassword()
    {
        return $this->motDePasse;
    }

    /**
     * Relation avec le candidat.
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
     * Relation avec le service.
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
     * Historique des actions effectuées par l'utilisateur.
     */
    public function historiques(): HasMany
    {
        return $this->hasMany(
            Historique::class,
            'idUtilisateur',
            'idUtilisateur'
        );
    }

    /**
     * Notifications.
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(
            Notification::class,
            'idUtilisateur',
            'idUtilisateur'
        );
    }
}