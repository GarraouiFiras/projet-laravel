<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $table = 'models'; // Nom de la table (optionnel si le nom est correct)
    protected $fillable = ['name']; // Colonnes modifiables
    public function cars()
{
    return $this->hasMany(Car::class, 'model');
}

}
