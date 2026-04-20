@extends('layouts.app')

@section('content')

<style>
    .page-header { margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; }
    .page-header h1 { font-size: 28px; font-weight: bold; color: #1a2340; }
    .btn-add { background: #1a2340; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-size: 14px; text-decoration: none; }
    .btn-add:hover { background: #2a3a5c; }

    /* STATS */
    .grid-4 { display: grid; grid-template-columns: repeat(4,1fr); gap: 20px; margin-bottom: 25px; }
    .stat-card { background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
    .stat-card .number { font-size: 32px; font-weight: bold; margin: 8px 0 4px; }
    .stat-card .label { font-size: 11px; color: #888; letter-spacing: 1px; }
    .stat-card .sub { font-size: 12px; margin-top: 4px; }
    .green { color: #27ae60; }
    .red { color: #c0392b; }
    .orange { color: #f39c12; }
    .border-green { border-left: 4px solid #27ae60; }
    .border-red { border-left: 4px solid #c0392b; }
    .border-orange { border-left: 4px solid #f39c12; }
    .border-blue { border-left: 4px solid #2563eb; }

    /* FILTRES */
    .filters { background: white; padding: 20px; border-radius: 12px; margin-bottom: 20px; display: flex; gap: 15px; align-items: center; flex-wrap: wrap; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
    .filters input, .filters select { padding: 9px 14px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; outline: none; }
    .filters input:focus, .filters select:focus { border-color: #1a2340; }
    .btn-filter { background: #1a2340; color: white; border: none; padding: 9px 18px; border-radius: 8px; cursor: pointer; font-size: 14px; }

    /* TABLEAU */
    .table-container { background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); overflow: hidden; }
    .table-header { padding: 20px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; }
    .table-header h3 { font-size: 16px; font-weight: bold; color: #1a2340; }
    table { width: 100%; border-collapse: collapse; }
    th { background: #f8f9fa; padding: 12px 16px; text-align: left; font-size: 12px; color: #888; letter-spacing: 1px; border-bottom: 1px solid #f0f0f0; }
    td { padding: 14px 16px; font-size: 14px; border-bottom: 1px solid #f9f9f9; }
    tr:hover { background: #f8f9fa; }
    .badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; }
    .badge-ok { background: #e8f5e9; color: #27ae60; }
    .badge-low { background: #fff3e0; color: #f39c12; }
    .badge-critical { background: #fdecea; color: #c0392b; }
    .btn-action { padding: 6px 14px; border-radius: 6px; font-size: 12px; cursor: pointer; border: none; margin-right: 5px; }
    .btn-view { background: #e8f0fe; color: #2563eb; }
    .btn-edit { background: #e8f5e9; color: #27ae60; }
    .btn-delete { background: #fdecea; color: #c0392b; }
</style>

{{-- HEADER --}}
<div class="page-header">
    <div>
        <h1>📦 Inventaire</h1>
        <p style="color:#888; font-size:14px; margin-top:4px;">Gestion des stupéfiants en stock</p>
    </div>
    <a href="#" class="btn-add">+ Ajouter un produit</a>
</div>

{{-- STATS --}}
<div class="grid-4">
    <div class="stat-card border-blue">
        <div class="label">TOTAL PRODUITS</div>
        <div class="number" style="color:#2563eb;">24</div>
        <div class="sub" style="color:#888;">références actives</div>
    </div>
    <div class="stat-card border-green">
        <div class="label">EN STOCK</div>
        <div class="number green">18</div>
        <div class="sub green">stock suffisant</div>
    </div>
    <div class="stat-card border-orange">
        <div class="label">STOCK FAIBLE</div>
        <div class="number orange">03</div>
        <div class="sub orange">à réapprovisionner</div>
    </div>
    <div class="stat-card border-red">
        <div class="label">RUPTURE</div>
        <div class="number red">03</div>
        <div class="sub red">ruptures critiques</div>
    </div>
</div>

{{-- FILTRES --}}
<div class="filters">
    <input type="text" placeholder="🔍 Rechercher un produit...">
    <select>
        <option>Toutes les catégories</option>
        <option>Morphiniques</option>
        <option>Benzodiazépines</option>
        <option>Anesthésiques</option>
    </select>
    <select>
        <option>Tous les statuts</option>
        <option>En stock</option>
        <option>Stock faible</option>
        <option>Rupture</option>
    </select>
    <button class="btn-filter">Filtrer</button>
</div>

{{-- TABLEAU --}}
<div class="table-container">
    <div class="table-header">
        <h3>Liste des produits</h3>
        <span style="color:#888; font-size:13px;">24 produits trouvés</span>
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
            <tr>
                <td><strong>#STU-001</strong></td>
                <td>Morphine 10mg/ml</td>
                <td>Morphiniques</td>
                <td><strong>150</strong> unités</td>
                <td>50</td>
                <td>12/2026</td>
                <td><span class="badge badge-ok">✅ En stock</span></td>
                <td>
                    <button class="btn-action btn-view">Voir</button>
                    <button class="btn-action btn-edit">Modifier</button>
                    <button class="btn-action btn-delete">Supprimer</button>
                </td>
            </tr>
            <tr>
                <td><strong>#STU-002</strong></td>
                <td>Fentanyl 50mcg/ml</td>
                <td>Morphiniques</td>
                <td><strong>25</strong> unités</td>
                <td>30</td>
                <td>06/2026</td>
                <td><span class="badge badge-low">⚠️ Stock faible</span></td>
                <td>
                    <button class="btn-action btn-view">Voir</button>
                    <button class="btn-action btn-edit">Modifier</button>
                    <button class="btn-action btn-delete">Supprimer</button>
                </td>
            </tr>
            <tr>
                <td><strong>#STU-003</strong></td>
                <td>Diazépam 5mg</td>
                <td>Benzodiazépines</td>
                <td><strong>0</strong> unités</td>
                <td>20</td>
                <td>03/2026</td>
                <td><span class="badge badge-critical">🔴 Rupture</span></td>
                <td>
                    <button class="btn-action btn-view">Voir</button>
                    <button class="btn-action btn-edit">Modifier</button>
                    <button class="btn-action btn-delete">Supprimer</button>
                </td>
            </tr>
            <tr>
                <td><strong>#STU-004</strong></td>
                <td>Kétamine 500mg</td>
                <td>Anesthésiques</td>
                <td><strong>80</strong> unités</td>
                <td>25</td>
                <td>09/2026</td>
                <td><span class="badge badge-ok">✅ En stock</span></td>
                <td>
                    <button class="btn-action btn-view">Voir</button>
                    <button class="btn-action btn-edit">Modifier</button>
                    <button class="btn-action btn-delete">Supprimer</button>
                </td>
            </tr>
            <tr>
                <td><strong>#STU-005</strong></td>
                <td>Codéine 30mg</td>
                <td>Morphiniques</td>
                <td><strong>12</strong> unités</td>
                <td>40</td>
                <td>08/2026</td>
                <td><span class="badge badge-low">⚠️ Stock faible</span></td>
                <td>
                    <button class="btn-action btn-view">Voir</button>
                    <button class="btn-action btn-edit">Modifier</button>
                    <button class="btn-action btn-delete">Supprimer</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

@endsection