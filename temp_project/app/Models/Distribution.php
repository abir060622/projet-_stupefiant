<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    protected $fillable = [
        'numero_bon',
        'produit',
        'quantite',
        'service',
        'medecin',
        'patient',
        'date_distribution',
        'responsable',
        'statut',
    ];

    protected $casts = [
        'date_distribution' => 'date',
    ];
}