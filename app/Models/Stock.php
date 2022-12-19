<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'materiel',
        'quantite',
        'direction',
        'service',
        'site',
        'filename',
        'public_path',
        'storage_path', 
    ];
}
