<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
    ];

    public function categories() {
        return $this->belongsToMany(Category::class, 'cat_mars')->withPivot('active')->withTimestamps();
    }

    public function models() {
        return $this->hasMany(Models::class, 'marque_id');
    }

    public function materiels() {
        return $this->hasMany(Materiel::class, 'marque_id');
    }
}
