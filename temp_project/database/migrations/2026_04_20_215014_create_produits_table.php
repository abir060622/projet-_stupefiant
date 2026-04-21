<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [
        'reference',
        'nom',
        'categorie',
        'stock_actuel',
        'stock_min',
        'expiration',
    ];
}