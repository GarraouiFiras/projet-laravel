<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
    'civilite',
    'name',
    'telephone',
    'email',
    'password',
     'role', 
];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
     public function isVendeur()
    {
        return $this->role === 'vendeur';
    }

    public function isTechnicien()
    {
        return $this->role === 'technicien';
    }

    public function isGestionnaire()
    {
        return $this->role === 'gestionnaire';
    }
    public function commandes() {
    return $this->hasMany(Commande::class);
}
    public function maintenances()
{
    return $this->hasMany(Maintenance::class);
}
}
