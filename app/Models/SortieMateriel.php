<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SortieMateriel extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'marque_id', 
        'model_id', 
        'materiel_id', 
        'num_patrimoine', 
        'raison', 
        'date_sortie',
        'direction',
        'service',
        'site',
        'submitedby'
    ];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function marque() {
        return $this->belongsTo(Marque::class, 'marque_id');
    }

    public function model() {
        return $this->belongsTo(Models::class, 'model_id');
    }

    public function materiel() {
        return $this->belongsTo(Materiel::class, 'materiel_id');
    }
}
