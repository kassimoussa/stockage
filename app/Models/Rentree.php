<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rentree extends Model
{
    use HasFactory;
    protected $fillable = [
        'materiel',
        'model',
        'num_patrimoine',
        'quantite',
        'date_rentree',
        'direction',
        'service',
        'site',
        'submitedby'
    ];
}
