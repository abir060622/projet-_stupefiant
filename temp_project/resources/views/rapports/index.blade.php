@extends('layouts.app')

@section('content')

<style>
    .page-header { margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; }
    .page-header h1 { font-size: 28px; font-weight: bold; color: #1a2340; }
    .btn-print { background: #1a2340; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-size: 14px; cursor: pointer; }

    /* GRILLES */
    .grid-4 { display: grid; grid-template-columns: repeat(4,1fr); gap: 20px; margin-bottom: 25px; }
    .grid-3 { display: grid; grid-template-columns: repeat(3,1fr); gap: 20px; margin-bottom: 25px; }
    .grid-2 { display: grid; grid-template-columns: repeat(2,1fr); gap: 20px; margin-bottom: 25px; }

    /* CARTES STATS */
    .stat-card { background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
    .stat-card .number { font-size: 36px; font-weight: bold; margin: 8px 0 4px; }
    .stat-card .label { font-size: 11px; color: #888; letter-spacing: 1px; }
    .stat-card .sub { font-size: 12px; margin-top: 4px; }
    .green { color: #27ae60; } .red { color: #c0392b; }
    .orange { color: #f39c12; } .blue { color: #2563eb; }
    .border-green { border-left: 4px solid #27ae60; }
    .border-blue { border-left: 4px solid #2563eb; }
    .border-orange { border-left: 4px solid #f39c12; }
    .border-red { border-left: 4px solid #c0392b; }
    .border-purple { border-left: 4px solid #8e44ad; }

    /* SECTION */
    .section-title { font-size: 16px; font-weight: bold; color: #1a2340; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 2px solid #f0f0f0; }

    /* BARRE DE PROGRESSION */
    .progress-bar { background: #f0f0f0; border-radius: 10px; height: 10px; margin-top: 8px; overflow: hidden; }
    .progress-fill { height: 100%; border-radius: 10px; }

    /* TABLEAU */
    .table-container { background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); overflow: hidden; margin-bottom: 25px; }
    .table-header { padding: 20px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; }
    table { width: 100%; border-collapse: collapse; }
    th { background: #f8f9fa; padding: 12px 16px; text-align: left; font-size: 12px; color: #888; }
    td { padding: 12px 16px; font-size: 14px; border-bottom: 1px solid #f9f9f9; }
    .badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; }
    .badge-ok { background: #e8f5e9; color: #27ae60; }
    .badge-low { background: #fff3e0; color: #f39c12; }
    .badge-critical { background: #fdecea; color: #c0392b; }

    @media print {
        .sidebar, .btn-print, .page-header .btn-print { display: none; }
        .main { margin-left: 0 !important; }
    }
</style>

{{-- HEADER --}}
<div class="page-header">
    <div>
        <h1> Rapports & Statistiques</h1>
        <p style="color:#888; font-size:14px; margin-top:4px;">Vue globale de la gestion des stupéfiants</p>
    </div>
    <button class="btn-print" onclick="window.print()"> Imprimer le rapport</button>
</div>

{{-- STATS STOCK --}}
<div class="section-title"> Statistiques du Stock</div>
<div class="grid-4">
    <div class="stat-card border-blue">
        <div class="label">TOTAL PRODUITS</div>
        <div class="number blue">{{ $totalProduits }}</div>
        <div class="sub" style="color:#888;">références enregistrées</div>
    </div>
    <div class="stat-card border-green">
        <div class="label">STOCK TOTAL</div>
        <div class="number green">{{ $stockTotal }}</div>
        <div class="sub green">unités disponibles</div>
    </div>
    <div class="stat-card border-orange">
        <div class="label">STOCK FAIBLE</div>
        <div class="number orange">{{ $stockFaible }}</div>
        <div class="sub orange">à réapprovisionner</div>
    </div>
    <div class="stat-card border-red">
        <div class="label">RUPTURES</div>
        <div class="number red">{{ $ruptures }}</div>
        <div class="sub red">produits épuisés</div>
    </div>
</div>

{{-- STATS ENTREES & DISTRIBUTIONS --}}
<div class="grid-2">
    {{-- ENTREES --}}
    <div class="stat-card">
        <div class="section-title">✅ Entrées Stock</div>
        <div style="display:flex; justify-content:space-between; margin-bottom:15px;">
            <div style="text-align:center;">
                <div style="font-size:32px; font-weight:bold; color:#2563eb;">{{ $totalEntrees }}</div>
                <div style="font-size:12px; color:#888;">Total</div>
            </div>
            <div style="text-align:center;">
                <div style="font-size:32px; font-weight:bold; color:#27ae60;">{{ $entreesValidees }}</div>
                <div style="font-size:12px; color:#888;">Validées</div>
            </div>
            <div style="text-align:center;">
                <div style="font-size:32px; font-weight:bold; color:#f39c12;">{{ $entreesAttente }}</div>
                <div style="font-size:12px; color:#888;">En attente</div>
            </div>
        </div>
        @if($totalEntrees > 0)
        <div style="font-size:13px; color:#888; margin-bottom:5px;">Taux de validation</div>
        <div class="progress-bar">
            <div class="progress-fill" style="width:{{ round($entreesValidees / $totalEntrees * 100) }}%; background:#27ae60;"></div>
        </div>
        <div style="font-size:13px; color:#27ae60; margin-top:5px;">{{ round($entreesValidees / $totalEntrees * 100) }}% validées</div>
        @endif
    </div>

    {{-- DISTRIBUTIONS --}}
    <div class="stat-card">
        <div class="section-title"> Distributions</div>
        <div style="display:flex; justify-content:space-between; margin-bottom:15px;">
            <div style="text-align:center;">
                <div style="font-size:32px; font-weight:bold; color:#8e44ad;">{{ $totalDistributions }}</div>
                <div style="font-size:12px; color:#888;">Total</div>
            </div>
            <div style="text-align:center;">
                <div style="font-size:32px; font-weight:bold; color:#27ae60;">{{ $distributionsValidees }}</div>
                <div style="font-size:12px; color:#888;">Validées</div>
            </div>
            <div style="text-align:center;">
                <div style="font-size:32px; font-weight:bold; color:#f39c12;">{{ $distributionsAttente }}</div>
                <div style="font-size:12px; color:#888;">En attente</div>
            </div>
        </div>
        @if($totalDistributions > 0)
        <div style="font-size:13px; color:#888; margin-bottom:5px;">Taux de validation</div>
        <div class="progress-bar">
            <div class="progress-fill" style="width:{{ round($distributionsValidees / $totalDistributions * 100) }}%; background:#8e44ad;"></div>
        </div>
        <div style="font-size:13px; color:#8e44ad; margin-top:5px;">{{ round($distributionsValidees / $totalDistributions * 100) }}% validées</div>
        @endif
    </div>
</div>

{{-- TABLEAU PRODUITS --}}
<div class="table-container">
    <div class="table-header">
        <h3> État du stock par produit</h3>
    </div>
    <table>
        <thead>
            <tr>
                <th>PRODUIT</th>
                <th>CATÉGORIE</th>
                <th>STOCK ACTUEL</th>
                <th>STOCK MIN</th>
                <th>EXPIRATION</th>
                <th>STATUT</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produits as $produit)
            <tr>
                <td><strong>{{ $produit->nom }}</strong></td>
                <td>{{ $produit->categorie }}</td>
                <td>
                    <strong>{{ $produit->stock_actuel }}</strong> unités
                    <div class="progress-bar">
                        <div class="progress-fill" style="width:{{ $produit->stock_min > 0 ? min(100, round($produit->stock_actuel / ($produit->stock_min * 2) * 100)) : 100 }}%; background:{{ $produit->stock_actuel == 0 ? '#c0392b' : ($produit->stock_actuel <= $produit->stock_min ? '#f39c12' : '#27ae60') }};"></div>
                    </div>
                </td>
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
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center; color:#888; padding:20px;">Aucun produit</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- DERNIÈRES ENTRÉES --}}
<div class="grid-2">
    <div class="table-container">
        <div class="table-header">
            <h3> Dernières entrées</h3>
        </div>
        <table>
            <thead>
                <tr>
                    <th>BON</th>
                    <th>PRODUIT</th>
                    <th>QTÉ</th>
                    <th>STATUT</th>
                </tr>
            </thead>
            <tbody>
                @forelse($entrees as $entree)
                <tr>
                    <td>#{{ $entree->numero_bon }}</td>
                    <td>{{ $entree->produit }}</td>
                    <td>{{ $entree->quantite }}</td>
                    <td>
                        @if($entree->statut == 'validee')
                            <span class="badge badge-ok"></span>
                        @elseif($entree->statut == 'en_attente')
                            <span class="badge badge-low"></span>
                        @else
                            <span class="badge badge-critical"></span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align:center; color:#888; padding:15px;">Aucune entrée</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="table-container">
        <div class="table-header">
            <h3> Dernières distributions</h3>
        </div>
        <table>
            <thead>
                <tr>
                    <th>BON</th>
                    <th>PRODUIT</th>
                    <th>QTÉ</th>
                    <th>STATUT</th>
                </tr>
            </thead>
            <tbody>
                @forelse($distributions as $distribution)
                <tr>
                    <td>#{{ $distribution->numero_bon }}</td>
                    <td>{{ $distribution->produit }}</td>
                    <td>{{ $distribution->quantite }}</td>
                    <td>
                        @if($distribution->statut == 'validee')
                            <span class="badge badge-ok"></span>
                        @elseif($distribution->statut == 'en_attente')
                            <span class="badge badge-low"></span>
                        @else
                            <span class="badge badge-critical"></span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align:center; color:#888; padding:15px;">Aucune distribution</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection