<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListeMarMod extends Model
{
    use HasFactory;
    protected $fillable = [
        'objet_id',
        'marque',
        'model',
    ];

    public function objet() {
        return $this->belongsTo(Listeobjet::class, 'objet_id');
    }

    public function materiels() {
        return $this->hasMany(MaterielsStock::class, 'marmod_id');
    }
}
