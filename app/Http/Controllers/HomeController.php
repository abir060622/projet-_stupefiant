<?php

namespace App\Http\Controllers;

use App\Models\Mouvement;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Actions Urgentes (Celles qui n'ont pas encore de validator_id)
        $destructions_a_valider = Mouvement::where('type', 'destruction')
                                    ->whereNull('validator_id')
                                    ->count();

        $signatures_manquantes = Mouvement::where('type', 'sortie')
                                    ->whereNull('validator_id')
                                    ->count();

        // 2. Décomposition des attentes (Widget Jaune/Rouge/Bleu)
        $attentes = [
            'distributions' => Mouvement::where('type', 'sortie')->whereNull('validator_id')->count(),
            'destructions'  => $destructions_a_valider,
            'retours'       => Mouvement::where('type', 'retour')->whereNull('validator_id')->count(),
        ];

        // 3. Activités récentes avec relations (pour les avatars et noms)
        $recent_activities = Mouvement::with(['produit', 'user', 'validator'])
                                ->latest()
                                ->take(6)
                                ->get();

        // 4. Audit Utilisateurs (Nombre d'actions par personne)
        $top_users = User::withCount('mouvements') // Assure-toi d'avoir la relation dans User.php
                        ->orderBy('mouvements_count', 'desc')
                        ->take(3)
                        ->get();

        return view('home', compact(
            'destructions_a_valider', 
            'signatures_manquantes', 
            'attentes', 
            'recent_activities',
            'top_users'
        ));
    }
}