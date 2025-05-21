<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
   protected $fillable = ['nom_client', 'total', 'statut', 'user_id'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function commandeItems()
{
    return $this->hasMany(CommandeItem::class, 'commande_id');
}
 public function user()
    {
        return $this->belongsTo(User::class);
    }

}
