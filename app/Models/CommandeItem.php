<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeItem extends Model
{
    protected $fillable = ['commande_id', 'type_produit', 'produit_id', 'quantite', 'prix_unitaire', 'image'];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class, 'produit_id');
    }

    public function accessoire()
    {
        return $this->belongsTo(Accessoire::class, 'produit_id');
    }
}
