<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $fillable = ['client_name', 'car_id', 'date', 'time', 'description'];
    // Définir la relation avec le modèle Car
    public function car()
    {
        return $this->belongsTo(Car::class ,'car_id');
    }
}
