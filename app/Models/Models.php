<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'marque_id',
        'name', 
    ];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function marque() {
        return $this->belongsTo(Marque::class, 'marque_id');
    }

    public function materiels() {
        return $this->hasMany(Materiel::class, 'model_id');
    }
}
