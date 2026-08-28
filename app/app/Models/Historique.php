<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Historique extends Model
{
    protected $table = 'historique';

    protected $primaryKey = 'idHistorique';

    public $timestamps = false;

    protected $fillable = [
        'idUtilisateur',
        'idDemande',
        'action',
        'dateAction',
        'ancienneValeur',
        'nouvelleValeur',
    ];

    protected $casts = [
        'dateAction' => 'datetime',
    ];

    public function demande(): BelongsTo
    {
        return $this->belongsTo(
            DemandeStage::class,
            'idDemande',
            'idDemande'
        );
    }
    public function utilisateur(): BelongsTo
{
    return $this->belongsTo(
        Utilisateur::class,
        'idUtilisateur',
        'idUtilisateur'
    );
}

}