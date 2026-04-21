@extends('layouts.app')

@section('content')

<style>
    .page-header { margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; }
    .page-header h1 { font-size: 28px; font-weight: bold; color: #1a2340; }
    .btn-add { background: #1a2340; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-size: 14px; text-decoration: none; }
    .grid-4 { display: grid; grid-template-columns: repeat(4,1fr); gap: 20px; margin-bottom: 25px; }
    .stat-card { background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
    .stat-card .number { font-size: 32px; font-weight: bold; margin: 8px 0 4px; }
    .stat-card .label { font-size: 11px; color: #888; letter-spacing: 1px; }
    .green { color: #27ae60; } .red { color: #c0392b; } .orange { color: #f39c12; } .blue { color: #2563eb; }
    .border-green { border-left: 4px solid #27ae60; } .border-blue { border-left: 4px solid #2563eb; }
    .border-orange { border-left: 4px solid #f39c12; } .border-red { border-left: 4px solid #c0392b; }
    .table-container { background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); overflow: hidden; }
    .table-header { padding: 20px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; }
    table { width: 100%; border-collapse: collapse; }
    th { background: #f8f9fa; padding: 12px 16px; text-align: left; font-size: 12px; color: #888; }
    td { padding: 14px 16px; font-size: 14px; border-bottom: 1px solid #f9f9f9; }
    tr:hover { background: #f8f9fa; }
    .badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; }
    .badge-ok { background: #e8f5e9; color: #27ae60; }
    .badge-low { background: #fff3e0; color: #f39c12; }
    .badge-critical { background: #fdecea; color: #c0392b; }
    .btn-action { padding: 6px 14px; border-radius: 6px; font-size: 12px; cursor: pointer; border: none; margin-right: 5px; text-decoration: none; display: inline-block; }
    .btn-edit { background: #e8f5e9; color: #27ae60; }
    .btn-delete { background: #fdecea; color: #c0392b; }
    .alert-success { background: #e8f5e9; color: #27ae60; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #27ae60; }
</style>

<div class="page-header">
    <div>
        <h1> Inventaire</h1>
        <p style="color:#888; font-size:14px; margin-top:4px;">Gestion des stupéfiants en stock</p>
    </div>
    <a href="/inventaire/ajouter" class="btn-add">+ Ajouter un produit</a>
</div>

@if(session('success'))
    <div class="alert-success"> {{ session('success') }}</div>
@endif

<div class="grid-4">
    <div class="stat-card border-blue">
        <div class="label">TOTAL PRODUITS</div>
        <div class="number blue">{{ $produits->count() }}</div>
    </div>
    <div class="stat-card border-green">
        <div class="label">EN STOCK</div>
        <div class="number green">{{ $produits->where('stock_actuel', '>', 0)->count() }}</div>
    </div>
    <div class="stat-card border-orange">
        <div class="label">STOCK FAIBLE</div>
        <div class="number orange">{{ $produits->filter(fn($p) => $p->stock_actuel > 0 && $p->stock_actuel <= $p->stock_min)->count() }}</div>
    </div>
    <div class="stat-card border-red">
        <div class="label">RUPTURE</div>
        <div class="number red">{{ $produits->where('stock_actuel', 0)->count() }}</div>
    </div>
</div>

<div class="table-container">
    <div class="table-header">
        <h3>Liste des produits</h3>
        <span style="color:#888; font-size:13px;">{{ $produits->count() }} produits</span>
    </div>
    <table>
        <thead>
            <tr>
                <th>RÉFÉRENCE</th>
                <th>PRODUIT</th>
                <th>CATÉGORIE</th>
                <th>STOCK ACTUEL</th>
                <th>STOCK MIN</th>
                <th>EXPIRATION</th>
                <th>STATUT</th>
                <th>ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produits as $produit)
            <tr>
                <td><strong>#{{ $produit->reference }}</strong></td>
                <td>{{ $produit->nom }}</td>
                <td>{{ $produit->categorie }}</td>
                <td><strong>{{ $produit->stock_actuel }}</strong> unités</td>
                <td>{{ $produit->stock_min }}</td>
                <td>{{ $produit->expiration }}</td>
                <td>
                    @if($produit->stock_actuel == 0)
                        <span class="badge badge-critical"> Rupture</span>
                    @elseif($produit->stock_actuel <= $produit->stock_min)
                        <span class="badge badge-low"> Stock faible</span>
                    @else
                        <span class="badge badge-ok"> En stock</span>
                    @endif
                </td>
                <td>
                    <a href="/inventaire/modifier/{{ $produit->id }}" class="btn-action btn-edit"> Modifier</a>
                    <a href="/inventaire/supprimer/{{ $produit->id }}" class="btn-action btn-delete" onclick="return confirm('Supprimer ce produit ?')"> Supprimer</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align:center; color:#888; padding:30px;">
                    Aucun produit — <a href="/inventaire/ajouter">Ajouter un produit</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection