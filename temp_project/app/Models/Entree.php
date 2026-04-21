<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entree extends Model
{
    protected $fillable = [
        'numero_bon',
        'produit',
        'quantite',
        'fournisseur',
        'date_entree',
        'responsable',
        'statut',
    ];

    protected $casts = [
        'date_entree' => 'date',
    ];
}