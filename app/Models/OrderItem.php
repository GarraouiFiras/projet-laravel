<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['commande_id', 'accessoire_id', 'quantite', 'prix_unitaire'];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function accessoire()
    {
        return $this->belongsTo(Accessoire::class);
    }
}
