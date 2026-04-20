@extends('layouts.app')

@section('content')

<style>
    .page-header { margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; }
    .page-header h1 { font-size: 28px; font-weight: bold; color: #1a2340; }
    .btn-add { background: #1a2340; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-size: 14px; text-decoration: none; }

    /* STATS */
    .grid-4 { display: grid; grid-template-columns: repeat(4,1fr); gap: 20px; margin-bottom: 25px; }
    .stat-card { background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
    .stat-card .number { font-size: 32px; font-weight: bold; margin: 8px 0 4px; }
    .stat-card .label { font-size: 11px; color: #888; letter-spacing: 1px; }
    .stat-card .sub { font-size: 12px; margin-top: 4px; }
    .green { color: #27ae60; }
    .red { color: #c0392b; }
    .orange { color: #f39c12; }
    .blue { color: #2563eb; }
    .border-green { border-left: 4px solid #27ae60; }
    .border-blue { border-left: 4px solid #2563eb; }
    .border-orange { border-left: 4px solid #f39c12; }
    .border-red { border-left: 4px solid #c0392b; }

    /* FILTRES */
    .filters { background: white; padding: 20px; border-radius: 12px; margin-bottom: 20px; display: flex; gap: 15px; align-items: center; flex-wrap: wrap; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
    .filters input, .filters select { padding: 9px 14px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; outline: none; }
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
    .badge-pending { background: #fff3e0; color: #f39c12; }
    .badge-rejected { background: #fdecea; color: #c0392b; }
    .btn-action { padding: 6px 14px; border-radius: 6px; font-size: 12px; cursor: pointer; border: none; margin-right: 5px; }
    .btn-view { background: #e8f0fe; color: #2563eb; }
    .btn-validate { background: #e8f5e9; color: #27ae60; }
    .btn-delete { background: #fdecea; color: #c0392b; }
</style>

{{-- HEADER --}}
<div class="page-header">
    <div>
        <h1>✅ Entrées Stock</h1>
        <p style="color:#888; font-size:14px; margin-top:4px;">Historique des entrées de stupéfiants</p>
    </div>
    <a href="#" class="btn-add">+ Nouvelle entrée</a>
</div>

{{-- STATS --}}
<div class="grid-4">
    <div class="stat-card border-blue">
        <div class="label">TOTAL ENTRÉES</div>
        <div class="number blue">142</div>
        <div class="sub" style="color:#888;">ce mois-ci</div>
    </div>
    <div class="stat-card border-green">
        <div class="label">VALIDÉES</div>
        <div class="number green">128</div>
        <div class="sub green">entrées confirmées</div>
    </div>
    <div class="stat-card border-orange">
        <div class="label">EN ATTENTE</div>
        <div class="number orange">10</div>
        <div class="sub orange">à valider</div>
    </div>
    <div class="stat-card border-red">
        <div class="label">REJETÉES</div>
        <div class="number red">04</div>
        <div class="sub red">entrées refusées</div>
    </div>
</div>

{{-- FILTRES --}}
<div class="filters">
    <input type="text" placeholder="🔍 Rechercher...">
    <input type="date">
    <select>
        <option>Tous les statuts</option>
        <option>Validée</option>
        <option>En attente</option>
        <option>Rejetée</option>
    </select>
    <button class="btn-filter">Filtrer</button>
</div>

{{-- TABLEAU --}}
<div class="table-container">
    <div class="table-header">
        <h3>Liste des entrées</h3>
        <span style="color:#888; font-size:13px;">142 entrées trouvées</span>
    </div>
    <table>
        <thead>
            <tr>
                <th>N° BON</th>
                <th>PRODUIT</th>
                <th>QUANTITÉ</th>
                <th>FOURNISSEUR</th>
                <th>DATE ENTRÉE</th>
                <th>RESPONSABLE</th>
                <th>STATUT</th>
                <th>ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>#ENT-001</strong></td>
                <td>Morphine 10mg/ml</td>
                <td><strong>100</strong> unités</td>
                <td>Pharma Maroc</td>
                <td>20/04/2026</td>
                <td>Admin Pharmacie</td>
                <td><span class="badge badge-ok">✅ Validée</span></td>
                <td>
                    <button class="btn-action btn-view">Voir</button>
                    <button class="btn-action btn-validate">Valider</button>
                    <button class="btn-action btn-delete">Rejeter</button>
                </td>
            </tr>
            <tr>
                <td><strong>#ENT-002</strong></td>
                <td>Fentanyl 50mcg/ml</td>
                <td><strong>50</strong> unités</td>
                <td>MediSupply</td>
                <td>19/04/2026</td>
                <td>Admin Pharmacie</td>
                <td><span class="badge badge-pending">⏳ En attente</span></td>
                <td>
                    <button class="btn-action btn-view">Voir</button>
                    <button class="btn-action btn-validate">Valider</button>
                    <button class="btn-action btn-delete">Rejeter</button>
                </td>
            </tr>
            <tr>
                <td><strong>#ENT-003</strong></td>
                <td>Diazépam 5mg</td>
                <td><strong>200</strong> unités</td>
                <td>Pharma Maroc</td>
                <td>18/04/2026</td>
                <td>Admin Pharmacie</td>
                <td><span class="badge badge-ok">✅ Validée</span></td>
                <td>
                    <button class="btn-action btn-view">Voir</button>
                    <button class="btn-action btn-validate">Valider</button>
                    <button class="btn-action btn-delete">Rejeter</button>
                </td>
            </tr>
            <tr>
                <td><strong>#ENT-004</strong></td>
                <td>Kétamine 500mg</td>
                <td><strong>30</strong> unités</td>
                <td>BioPharm</td>
                <td>17/04/2026</td>
                <td>Admin Pharmacie</td>
                <td><span class="badge badge-rejected">❌ Rejetée</span></td>
                <td>
                    <button class="btn-action btn-view">Voir</button>
                    <button class="btn-action btn-validate">Valider</button>
                    <button class="btn-action btn-delete">Rejeter</button>
                </td>
            </tr>
            <tr>
                <td><strong>#ENT-005</strong></td>
                <td>Codéine 30mg</td>
                <td><strong>75</strong> unités</td>
                <td>MediSupply</td>
                <td>16/04/2026</td>
                <td>Admin Pharmacie</td>
                <td><span class="badge badge-pending">⏳ En attente</span></td>
                <td>
                    <button class="btn-action btn-view">Voir</button>
                    <button class="btn-action btn-validate">Valider</button>
                    <button class="btn-action btn-delete">Rejeter</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

@endsection