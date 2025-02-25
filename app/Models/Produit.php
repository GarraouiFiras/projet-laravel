<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class car extends Model
{
    use HasFactory;
    protected $table = 'cars';
    // Définir les attributs qui peuvent être remplis en masse
    protected $fillable = [
        'name',        // Nom de la voiture
        'model',       // Modèle de la voiture
        'year',        // Année de la voiture
        'price',       // Prix de la voiture
        'image',       // Nom du fichier d'image
        'description', // Description de la voiture
    ];
}
