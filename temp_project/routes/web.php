<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        return redirect('/');
    }
    return back()->with('error', 'Email ou mot de passe incorrect');
});

Route::get('/', function () {
    return view('dashboard.index');
});

Route::get('/inventaire', function () {
    $produits = \App\Models\Produit::all();
    return view('inventaire.index', compact('produits'));
});

Route::get('/inventaire/ajouter', function () {
    return view('inventaire.ajouter');
});

Route::post('/inventaire/ajouter', function (Request $request) {
    \App\Models\Produit::create([
        'reference' => $request->reference,
        'nom' => $request->nom,
        'categorie' => $request->categorie,
        'stock_actuel' => $request->stock_actuel,
        'stock_min' => $request->stock_min,
        'expiration' => $request->expiration,
    ]);
    return redirect('/inventaire')->with('success', 'Produit ajouté avec succès !');
});

Route::get('/inventaire/modifier/{id}', function ($id) {
    $produit = \App\Models\Produit::findOrFail($id);
    return view('inventaire.modifier', compact('produit'));
});

Route::post('/inventaire/modifier/{id}', function (Request $request, $id) {
    $produit = \App\Models\Produit::findOrFail($id);
    $produit->update([
        'reference' => $request->reference,
        'nom' => $request->nom,
        'categorie' => $request->categorie,
        'stock_actuel' => $request->stock_actuel,
        'stock_min' => $request->stock_min,
        'expiration' => $request->expiration,
    ]);
    return redirect('/inventaire')->with('success', 'Produit modifié avec succès !');
});

Route::get('/inventaire/supprimer/{id}', function ($id) {
    \App\Models\Produit::findOrFail($id)->delete();
    return redirect('/inventaire')->with('success', 'Produit supprimé !');
});
Route::get('/entrees', function (Request $request) {
    $query = \App\Models\Entree::query();

    if ($request->search) {
        $query->where('produit', 'like', '%'.$request->search.'%')
              ->orWhere('numero_bon', 'like', '%'.$request->search.'%')
              ->orWhere('fournisseur', 'like', '%'.$request->search.'%');
    }

    if ($request->date) {
        $query->whereDate('date_entree', $request->date);
    }

    if ($request->statut) {
        $query->where('statut', $request->statut);
    }

    $entrees = $query->latest()->get();
    return view('entrees.index', compact('entrees'));
});

Route::get('/entrees/ajouter', function () {
    $produits = \App\Models\Produit::all();
    return view('entrees.ajouter', compact('produits'));
});

Route::post('/entrees/ajouter', function (Request $request) {
    \App\Models\Entree::create([
        'numero_bon' => $request->numero_bon,
        'produit' => $request->produit,
        'quantite' => $request->quantite,
        'fournisseur' => $request->fournisseur,
        'date_entree' => $request->date_entree,
        'responsable' => 'Admin Pharmacie',
        'statut' => 'en_attente',
    ]);
    return redirect('/entrees')->with('success', 'Entrée ajoutée avec succès !');
});

Route::get('/entrees/valider/{id}', function ($id) {
    \App\Models\Entree::findOrFail($id)->update(['statut' => 'validee']);
    return redirect('/entrees')->with('success', 'Entrée validée !');
});

Route::get('/entrees/rejeter/{id}', function ($id) {
    \App\Models\Entree::findOrFail($id)->update(['statut' => 'rejetee']);
    return redirect('/entrees')->with('success', 'Entrée rejetée !');
});

Route::get('/entrees/supprimer/{id}', function ($id) {
    \App\Models\Entree::findOrFail($id)->delete();
    return redirect('/entrees')->with('success', 'Entrée supprimée !');
});
Route::get('/distributions', function (Request $request) {
    $query = \App\Models\Distribution::query();
    if ($request->search) {
        $query->where('produit', 'like', '%'.$request->search.'%')
              ->orWhere('numero_bon', 'like', '%'.$request->search.'%')
              ->orWhere('medecin', 'like', '%'.$request->search.'%');
    }
    if ($request->date) {
        $query->whereDate('date_distribution', $request->date);
    }
    if ($request->statut) {
        $query->where('statut', $request->statut);
    }
    $distributions = $query->latest()->get();
    return view('distributions.index', compact('distributions'));
});

Route::get('/distributions/ajouter', function () {
    $produits = \App\Models\Produit::all();
    return view('distributions.ajouter', compact('produits'));
});

Route::get('/distributions', function (Request $request) {
    $query = \App\Models\Distribution::query();
    if ($request->search) {
        $query->where('produit', 'like', '%'.$request->search.'%')
              ->orWhere('numero_bon', 'like', '%'.$request->search.'%')
              ->orWhere('medecin', 'like', '%'.$request->search.'%');
    }
    if ($request->date) {
        $query->whereDate('date_distribution', $request->date);
    }
    if ($request->statut) {
        $query->where('validation_statut', $request->statut);
    }
    $distributions = $query->latest()->get();
    return view('distributions.index', compact('distributions'));
});

Route::get('/distributions/ajouter', function () {
    $produits = \App\Models\Produit::all();
    return view('distributions.ajouter', compact('produits'));
});

Route::post('/distributions/ajouter', function (Request $request) {
    \App\Models\Distribution::create([
        'numero_bon' => $request->numero_bon,
        'produit' => $request->produit,
        'quantite' => $request->quantite,
        'service' => $request->service,
        'medecin' => $request->medecin,
        'patient' => $request->patient,
        'date_distribution' => $request->date_distribution,
        'responsable' => 'Admin Pharmacie',
        'statut' => 'en_attente',
        'signature_infirmier' => null,
        'signature_responsable' => null,
        'validation_statut' => 'en_attente',
    ]);
    return redirect('/distributions')->with('success', 'Distribution enregistrée — En attente de double signature !');
});

Route::get('/distributions/signer-infirmier/{id}', function (Request $request, $id) {
    $distribution = \App\Models\Distribution::findOrFail($id);
    $distribution->update([
        'signature_infirmier' => $request->nom ?? 'Infirmier',
        'validation_statut' => $distribution->signature_responsable ? 'validee' : 'une_signature',
        'statut' => $distribution->signature_responsable ? 'validee' : 'en_attente',
    ]);
    return redirect('/distributions')->with('success', '✅ Signature infirmier enregistrée !');
});

Route::get('/distributions/signer-responsable/{id}', function (Request $request, $id) {
    $distribution = \App\Models\Distribution::findOrFail($id);
    $distribution->update([
        'signature_responsable' => $request->nom ?? 'Responsable',
        'validation_statut' => $distribution->signature_infirmier ? 'validee' : 'une_signature',
        'statut' => $distribution->signature_infirmier ? 'validee' : 'en_attente',
    ]);
    return redirect('/distributions')->with('success', '✅ Signature responsable enregistrée !');
});

Route::get('/distributions/rejeter/{id}', function ($id) {
    \App\Models\Distribution::findOrFail($id)->update([
        'validation_statut' => 'rejetee',
        'statut' => 'rejetee'
    ]);
    return redirect('/distributions')->with('success', 'Distribution rejetée !');
});
Route::get('/rapports', function () {
    $totalProduits = \App\Models\Produit::count();
    $stockTotal = \App\Models\Produit::sum('stock_actuel');
    $ruptures = \App\Models\Produit::where('stock_actuel', 0)->count();
    $stockFaible = \App\Models\Produit::whereColumn('stock_actuel', '<=', 'stock_min')->where('stock_actuel', '>', 0)->count();

    $totalEntrees = \App\Models\Entree::count();
    $entreesValidees = \App\Models\Entree::where('statut', 'validee')->count();
    $entreesAttente = \App\Models\Entree::where('statut', 'en_attente')->count();

    $totalDistributions = \App\Models\Distribution::count();
    $distributionsValidees = \App\Models\Distribution::where('statut', 'validee')->count();
    $distributionsAttente = \App\Models\Distribution::where('statut', 'en_attente')->count();

    $produits = \App\Models\Produit::all();
    $entrees = \App\Models\Entree::latest()->take(5)->get();
    $distributions = \App\Models\Distribution::latest()->take(5)->get();

    return view('rapports.index', compact(
        'totalProduits', 'stockTotal', 'ruptures', 'stockFaible',
        'totalEntrees', 'entreesValidees', 'entreesAttente',
        'totalDistributions', 'distributionsValidees', 'distributionsAttente',
        'produits', 'entrees', 'distributions'
    ));
});
Route::get('/pertes', function (Request $request) {
    $query = \App\Models\Perte::query();
    if ($request->search) {
        $query->where('infirmier', 'like', '%'.$request->search.'%')
              ->orWhere('produit', 'like', '%'.$request->search.'%');
    }
    $pertes = $query->latest()->get();
    return view('pertes.index', compact('pertes'));
});

Route::get('/pertes/ajouter', function () {
    $produits = \App\Models\Produit::all();
    return view('pertes.ajouter', compact('produits'));
});

Route::post('/pertes/ajouter', function (Request $request) {
    $nbPertes = \App\Models\Perte::where('infirmier', $request->infirmier)->count();
    $statut = $nbPertes >= 1 ? 'alerte' : 'normale';

    \App\Models\Perte::create([
        'numero_bon' => $request->numero_bon,
        'produit' => $request->produit,
        'quantite' => $request->quantite,
        'infirmier' => $request->infirmier,
        'service' => $request->service,
        'motif' => $request->motif,
        'date_perte' => $request->date_perte,
        'statut' => $statut,
    ]);
    return redirect('/pertes')->with('success', 'Perte enregistrée !');
});

Route::get('/pertes/supprimer/{id}', function ($id) {
    \App\Models\Perte::findOrFail($id)->delete();
    return redirect('/pertes')->with('success', 'Perte supprimée !');
});

Route::get('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
});