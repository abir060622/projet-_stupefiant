@extends('layouts.app')

@section('content')

<style>
    .page-header { margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; }
    .page-header h1 { font-size: 28px; font-weight: bold; color: #1a2340; }
    .btn-back { background: #f5f6fa; color: #1a2340; border: 2px solid #1a2340; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 14px; }
    .form-card { background: white; border-radius: 12px; padding: 35px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); max-width: 700px; }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; font-size: 13px; font-weight: bold; color: #1a2340; margin-bottom: 8px; }
    .form-group input, .form-group select { width: 100%; padding: 12px 16px; border: 1.5px solid #e0e0e0; border-radius: 8px; font-size: 14px; outline: none; }
    .grid-2 { display: grid; grid-template-columns: repeat(2,1fr); gap: 20px; }
    .btn-submit { background: #27ae60; color: white; border: none; padding: 14px 30px; border-radius: 8px; font-size: 15px; cursor: pointer; width: 100%; margin-top: 10px; }
</style>

<div class="page-header">
    <div>
        <h1> Modifier le produit</h1>
        <p style="color:#888; font-size:14px; margin-top:4px;">Mettre à jour les informations</p>
    </div>
    <a href="/inventaire" class="btn-back">← Retour</a>
</div>

<div class="form-card">
    <form action="/inventaire/modifier/{{ $produit->id }}" method="POST">
        @csrf
        <div class="grid-2">
            <div class="form-group">
                <label> Référence</label>
                <input type="text" name="reference" value="{{ $produit->reference }}" required>
            </div>
            <div class="form-group">
                <label> Nom du produit</label>
                <input type="text" name="nom" value="{{ $produit->nom }}" required>
            </div>
        </div>
        <div class="form-group">
            <label> Catégorie</label>
            <select name="categorie" required>
                <option value="Morphiniques" {{ $produit->categorie == 'Morphiniques' ? 'selected' : '' }}>Morphiniques</option>
                <option value="Benzodiazépines" {{ $produit->categorie == 'Benzodiazépines' ? 'selected' : '' }}>Benzodiazépines</option>
                <option value="Anesthésiques" {{ $produit->categorie == 'Anesthésiques' ? 'selected' : '' }}>Anesthésiques</option>
                <option value="Autres" {{ $produit->categorie == 'Autres' ? 'selected' : '' }}>Autres</option>
            </select>
        </div>
        <div class="grid-2">
            <div class="form-group">
                <label> Stock actuel</label>
                <input type="number" name="stock_actuel" value="{{ $produit->stock_actuel }}" min="0" required>
            </div>
            <div class="form-group">
                <label> Stock minimum</label>
                <input type="number" name="stock_min" value="{{ $produit->stock_min }}" min="0" required>
            </div>
        </div>
        <div class="form-group">
            <label> Date d'expiration</label>
            <input type="text" name="expiration" value="{{ $produit->expiration }}" required>
        </div>
        <button type="submit" class="btn-submit"> Enregistrer les modifications</button>
    </form>
</div>

@endsection