<?php

namespace App\Http\Controllers;

use App\Models\Mouvement;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MouvementController extends Controller
{
    // 1. Afficher le formulaire de sortie
    public function create()
    {
        // On ne prend que les produits qui ont du stock
        $produits = Produit::where('quantite_stock', '>', 0)->get();
        
        // On récupère les responsables pour la double signature
        $pharmaciens = User::where('role', 'responsable')->get(); 
        
        return view('sorties.create', compact('produits', 'pharmaciens'));
    }

    // 2. Enregistrer la sortie en base de données
    public function store(Request $request)
    {
        $request->validate([
            'produit_id'   => 'required|exists:produits,id',
            'quantite'     => 'required|integer|min:1',
            'lot_number'   => 'required|string',
            'validator_id' => 'required|exists:users,id',
        ]);

        // Créer l'enregistrement du mouvement
        Mouvement::create([
            'produit_id'   => $request->produit_id,
            'type'         => 'sortie',
            'quantite'     => $request->quantite,
            'lot_number'   => $request->lot_number,
            'user_id'      => Auth::id(), // L'utilisateur qui saisit
            'validator_id' => $request->validator_id, // Le responsable qui valide
            'observation'  => $request->observation,
            'is_conforme'  => true,
        ]);

        // Mettre à jour le stock du produit
        $produit = Produit::find($request->produit_id);
        $produit->decrement('quantite_stock', $request->quantite);

        return redirect()->route('home')->with('success', 'Sortie de stupéfiants enregistrée avec succès.');
    }
}