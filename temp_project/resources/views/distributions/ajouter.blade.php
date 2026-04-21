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
    .btn-submit { background: #1a2340; color: white; border: none; padding: 14px 30px; border-radius: 8px; font-size: 15px; cursor: pointer; width: 100%; margin-top: 10px; }
</style>

<div class="page-header">
    <div>
        <h1> Nouvelle distribution</h1>
        <p style="color:#888; font-size:14px; margin-top:4px;">Enregistrer une sortie de stupéfiants</p>
    </div>
    <a href="/distributions" class="btn-back">← Retour</a>
</div>

<div class="form-card">
    <form action="/distributions/ajouter" method="POST">
        @csrf
        <div class="grid-2">
            <div class="form-group">
                <label> Numéro de bon</label>
                <input type="text" name="numero_bon" placeholder="Ex: DIST-001" required>
            </div>
            <div class="form-group">
                <label> Produit</label>
                <select name="produit" required>
                    <option value="">-- Choisir un produit --</option>
                    @foreach($produits as $produit)
                        <option value="{{ $produit->nom }}">{{ $produit->nom }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="grid-2">
            <div class="form-group">
                <label> Quantité</label>
                <input type="number" name="quantite" placeholder="Ex: 10" min="1" required>
            </div>
            <div class="form-group">
                <label> Service</label>
                <input type="text" name="service" placeholder="Ex: Urgences" required>
            </div>
        </div>
        <div class="grid-2">
            <div class="form-group">
                <label> Médecin prescripteur</label>
                <input type="text" name="medecin" placeholder="Ex: Dr. Martin" required>
            </div>
            <div class="form-group">
                <label> Patient (optionnel)</label>
                <input type="text" name="patient" placeholder="Ex: Ahmed Benali">
            </div>
        </div>
        <div class="form-group">
            <label> Date de distribution</label>
            <input type="date" name="date_distribution" required>
        </div>
        <button type="submit" class="btn-submit"> Enregistrer la distribution</button>
    </form>
</div>

@endsection