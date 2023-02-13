<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
    ]; 

    public function marques() {
        return $this->belongsToMany(Marque::class, 'cat_mars')->withPivot('active')->withTimestamps();
    }

    public function models() {
        return $this->hasMany(Models::class, 'category_id');
    }

    public function materiels() {
        return $this->hasMany(Materiel::class, 'category_id');
    }

}
