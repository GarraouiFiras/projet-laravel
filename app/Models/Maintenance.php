<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
   protected $fillable = [
        'user_id',
        'car_id', 
        'appointment_type',
        'date',
        'time',
        'description',
        'status'
    ];


    // Définir la relation avec le modèle Car
    public function car()
    {
        return $this->belongsTo(Car::class ,'car_id');
    }
     public function user()
    {
        return $this->belongsTo(User::class);
    }
}
