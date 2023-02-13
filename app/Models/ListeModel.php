<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListeModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'materiel_id',
        'nom',
    ];
}
