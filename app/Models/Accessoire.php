<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessoire extends Model
{
    protected $fillable = ['nom', 'description', 'prix', 'stock', 'image'];

    public function commandeItems()
    {
        return $this->hasMany(CommandeItem::class, 'produit_id')->where('type_produit', 'accessoire');
    }
}