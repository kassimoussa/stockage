<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rentree extends Model
{
    use HasFactory;
    protected $fillable = [
        'materiel',
        'quantite',
        'date_rentree',
        'fournisseur',
        'direction',
        'service',
        'site',
        'submitedby'
    ];
}
