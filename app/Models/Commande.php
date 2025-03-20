<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = ['nom_client', 'total', 'statut'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function commandeItems()
{
    return $this->hasMany(CommandeItem::class, 'commande_id');
}

}
