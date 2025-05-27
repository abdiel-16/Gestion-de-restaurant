<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
        protected $fillable = [
        'user_id',
        'statut',
        'table_id',
        'total'
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
    
    public function plats()
    {
        return $this->belongsToMany(Plat::class, 'commande_plats')
                    ->withPivot('quantite')
                    ->withTimestamps();
    }

    

}
