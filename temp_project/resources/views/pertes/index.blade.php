@extends('layouts.app')

@section('content')

<style>
    .page-header { margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; }
    .page-header h1 { font-size: 28px; font-weight: bold; color: #1a2340; }
    .btn-add { background: #1a2340; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-size: 14px; text-decoration: none; }
    .grid-3 { display: grid; grid-template-columns: repeat(3,1fr); gap: 20px; margin-bottom: 25px; }
    .stat-card { background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
    .stat-card .number { font-size: 32px; font-weight: bold; margin: 8px 0 4px; }
    .stat-card .label { font-size: 11px; color: #888; letter-spacing: 1px; }
    .green { color: #27ae60; } .red { color: #c0392b; } .orange { color: #f39c12; }
    .border-green { border-left: 4px solid #27ae60; }
    .border-red { border-left: 4px solid #c0392b; }
    .border-orange { border-left: 4px solid #f39c12; }
    .filters { background: white; padding: 20px; border-radius: 12px; margin-bottom: 20px; display: flex; gap: 15px; align-items: center; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
    .filters input { padding: 9px 14px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; outline: none; flex: 1; }
    .btn-filter { background: #1a2340; color: white; border: none; padding: 9px 18px; border-radius: 8px; cursor: pointer; }
    .btn-reset { background: #f5f6fa; color: #888; border: 1px solid #ddd; padding: 9px 18px; border-radius: 8px; text-decoration: none; font-size: 14px; }
    .table-container { background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); overflow: hidden; }
    .table-header { padding: 20px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; }
    table { width: 100%; border-collapse: collapse; }
    th { background: #f8f9fa; padding: 12px 16px; text-align: left; font-size: 12px; color: #888; }
    td { padding: 14px 16px; font-size: 14px; border-bottom: 1px solid #f9f9f9; }
    tr:hover { background: #f8f9fa; }
    tr.alerte { background: #fdecea !important; border-left: 4px solid #c0392b; }
    tr.alerte:hover { background: #fad4d0 !important; }
    .badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; }
    .badge-normale { background: #e8f5e9; color: #27ae60; }
    .badge-alerte { background: #fdecea; color: #c0392b; animation: pulse 1s infinite; }
    @keyframes pulse { 0% { opacity: 1; } 50% { opacity: 0.5; } 100% { opacity: 1; } }
    .btn-action { padding: 6px 14px; border-radius: 6px; font-size: 12px; cursor: pointer; border: none; text-decoration: none; display: inline-block; }
    .btn-delete { background: #fdecea; color: #c0392b; }
    .alert-success { background: #e8f5e9; color: #27ae60; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #27ae60; }
    .alert-danger { background: #fdecea; color: #c0392b; padding: 15px 20px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #c0392b; font-weight: bold; }
</style>

<div class="page-header">
    <div>
        <h1> Pertes de Stupéfiants</h1>
        <p style="color:#888; font-size:14px; margin-top:4px;">Suivi des pertes par infirmier</p>
    </div>
    <a href="/pertes/ajouter" class="btn-add">+ Enregistrer une perte</a>
</div>

@if(session('success'))
    <div class="alert-success"> {{ session('success') }}</div>
@endif

{{-- ALERTE INFIRMIERS --}}
@php
    $infirmiersAlerte = \App\Models\Perte::where('statut', 'alerte')->pluck('infirmier')->unique();
@endphp

@if($infirmiersAlerte->count() > 0)
    <div class="alert-danger">
         ALERTE — Les infirmiers suivants ont 2 pertes ou plus :
        @foreach($infirmiersAlerte as $inf)
            <strong>{{ $inf }}</strong>{{ !$loop->last ? ', ' : '' }}
        @endforeach
    </div>
@endif

{{-- STATS --}}
<div class="grid-3">
    <div class="stat-card border-orange">
        <div class="label">TOTAL PERTES</div>
        <div class="number orange">{{ $pertes->count() }}</div>
        <div style="font-size:12px; color:#888; margin-top:4px;">enregistrées</div>
    </div>
    <div class="stat-card border-green">
        <div class="label">NORMALES</div>
        <div class="number green">{{ $pertes->where('statut', 'normale')->count() }}</div>
        <div style="font-size:12px; color:#888; margin-top:4px;">1ère perte</div>
    </div>
    <div class="stat-card border-red">
        <div class="label">EN ALERTE</div>
        <div class="number red">{{ $pertes->where('statut', 'alerte')->count() }}</div>
        <div style="font-size:12px; color:#c0392b; margin-top:4px;">2ème perte ou plus !</div>
    </div>
</div>

{{-- FILTRES --}}
<form method="GET" action="/pertes">
<div class="filters">
    <input type="text" name="search" placeholder=" Rechercher par infirmier ou produit..." value="{{ request('search') }}">
    <button type="submit" class="btn-filter">Filtrer</button>
    <a href="/pertes" class="btn-reset">Réinitialiser</a>
</div>
</form>

{{-- TABLEAU --}}
<div class="table-container">
    <div class="table-header">
        <h3>Liste des pertes</h3>
        <span style="color:#888; font-size:13px;">{{ $pertes->count() }} pertes enregistrées</span>
    </div>
    <table>
        <thead>
            <tr>
                <th>N° BON</th>
                <th>PRODUIT</th>
                <th>QUANTITÉ</th>
                <th>INFIRMIER</th>
                <th>SERVICE</th>
                <th>MOTIF</th>
                <th>DATE</th>
                <th>STATUT</th>
                <th>ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pertes as $perte)
            <tr class="{{ $perte->statut == 'alerte' ? 'alerte' : '' }}">
                <td><strong>#{{ $perte->numero_bon }}</strong></td>
                <td>{{ $perte->produit }}</td>
                <td><strong>{{ $perte->quantite }}</strong> unités</td>
                <td>
                    @if($perte->statut == 'alerte')
                        🚨 <strong style="color:#c0392b;">{{ $perte->infirmier }}</strong>
                    @else
                        {{ $perte->infirmier }}
                    @endif
                </td>
                <td>{{ $perte->service }}</td>
                <td>{{ $perte->motif }}</td>
                <td>{{ $perte->date_perte->format('d/m/Y') }}</td>
                <td>
                    @if($perte->statut == 'alerte')
                        <span class="badge badge-alerte"> ALERTE</span>
                    @else
                        <span class="badge badge-normale"> Normale</span>
                    @endif
                </td>
                <td>
                    <a href="/pertes/supprimer/{{ $perte->id }}" class="btn-action btn-delete" onclick="return confirm('Supprimer ?')">🗑️</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" style="text-align:center; color:#888; padding:30px;">
                    Aucune perte enregistrée
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection