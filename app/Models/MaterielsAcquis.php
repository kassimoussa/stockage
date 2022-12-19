<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterielsAcquis extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_acquisition',
        'nom_mat',
        'description_mat',
        'marque_mat',
        'processeur_mat',
        'ram_mat',
        'stockage_mat',
        'quantite',
        'os_mat',
    ];
}
