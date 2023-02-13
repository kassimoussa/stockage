<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listeobjet extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom', 
    ];

    public function marmods() {
        return $this->hasMany(ListeMarMod::class, 'objet_id');
    }

    public function materiels() {
        return $this->hasMany(MaterielsStock::class, 'objet_id');
    }
}
