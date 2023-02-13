<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sortie extends Model
{
    use HasFactory;
    protected $fillable = [
        'materiel',
        'model',
        'num_patrimoine',
        'quantite',
        'raison',
        'numero_fiche',
        'date_sortie',
        'direction',
        'service',
        'site',
        'submitedby'
    ];
}
