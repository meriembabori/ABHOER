<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    protected $table = 'document';

    protected $primaryKey = 'idDocument';

    public $timestamps = false;

    protected $fillable = [
        'idDemande',
        'nomFichier',
        'typeDocument',
        'cheminFichier',
        'dateAjout',
    ];

    protected $casts = [
        'dateAjout' => 'datetime',
    ];

    /**
     * Un document appartient à une demande.
     */
    public function demande(): BelongsTo
    {
        return $this->belongsTo(
            DemandeStage::class,
            'idDemande',
            'idDemande'
        );
    }
}