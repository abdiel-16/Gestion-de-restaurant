<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plat extends Model
{
    use HasFactory;
      protected $fillable = [
        'name',
        'description',
        'prix',
        'categorie_id',
    ];


    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commande_plats')
                    ->withPivot('quantite')
                    ->withTimestamps();
    }

}
