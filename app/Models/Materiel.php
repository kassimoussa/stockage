<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'marque_id', 
        'model_id', 
        'num_patrimoine',
        'direction',
        'service',
        'site',
        'status',
        'filename',
        'public_path',
        'storage_path', 
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
}
