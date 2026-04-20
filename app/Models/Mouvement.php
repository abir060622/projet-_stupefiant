<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mouvement extends Model
{
    protected $fillable = [
        'produit_id', 'type', 'quantite', 'lot_number', 
        'user_id', 'validator_id', 'observation', 'is_conforme'
    ];

    // Le produit concerné par le mouvement
    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class);
    }

    // L'auteur de l'action 
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Le valideur de l'action 
    public function validator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'validator_id');
    }
}