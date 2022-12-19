<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    use HasFactory;
    protected $fillable = [
        'numero_devis',
        'type_fiche',
        'numero_fiche',
        'fournisseur',
        'filename',
        'public_path',
        'storage_path'
    ];
}
