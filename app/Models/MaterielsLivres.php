<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterielsLivres extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_livraison',
        'nom_mat',
        'description_mat',
        'marque_mat',
        'quantite',
        'observation',
    ];
}
