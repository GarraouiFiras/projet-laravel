<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    // Nom de la table associée au modèle
    protected $table = 'car';
 // Assurez-vous que le nom de la table dans votre base de données est bien 'car'

    // Clé primaire de la table
    protected $primaryKey = 'id'; // Changez 'id' si votre clé primaire a un nom différent

    // Indiquer si la clé primaire est un entier auto-incrémenté
    public $incrementing = true;

    // Type de la clé primaire
    protected $keyType = 'int';

    // Indiquer si les timestamps (created_at et updated_at) doivent être gérés
    public $timestamps = true;

    // Attributs qui peuvent être assignés en masse
    protected $fillable = [
        'name', 'model', 'year', 'price', 'image', 'description',
    ];

    // Attributs qui devraient être cachés dans les tableaux
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // Exemple de relation avec un modèle Owner
    public function owner()
    {
        return $this->belongsTo(Owner::class); // Vérifiez que le modèle 'Owner' existe et est configuré correctement
    }
}
