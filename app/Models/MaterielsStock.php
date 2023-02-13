<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterielsStock extends Model
{
    use HasFactory;
    protected $fillable = [
        'objet_id',
        'marmod_id', 
        'num_patrimoine',
        'direction',
        'service',
        'site',
        'status',
        'filename',
        'public_path',
        'storage_path', 
    ];

    public function objet() {
        return $this->belongsTo(Listeobjet::class, 'objet_id');
    }

    public function marmod() {
        return $this->belongsTo(ListeMarMod::class, 'marmod_id');
    }
}
