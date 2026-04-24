<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perte extends Model
{
    protected $fillable = [
        'numero_bon',
        'produit',
        'quantite',
        'infirmier',
        'service',
        'motif',
        'date_perte',
        'statut',
    ];

    protected $casts = [
        'date_perte' => 'date',
    ];
}