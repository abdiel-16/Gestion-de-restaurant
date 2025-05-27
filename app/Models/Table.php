<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Table extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'capacite',
        'est_disponible',
    ];


    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
