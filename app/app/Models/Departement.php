<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departement extends Model
{
    protected $table = 'departement';

    protected $primaryKey = 'idDepartement';

    public $timestamps = false;

    protected $fillable = [
        'nomDepartement',
        'description',
    ];

    public function services(): HasMany
    {
        return $this->hasMany(
            Service::class,
            'idDepartement',
            'idDepartement'
        );
    }
}