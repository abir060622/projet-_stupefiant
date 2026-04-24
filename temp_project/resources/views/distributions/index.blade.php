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
    .green { color: #27ae60; } .red { color: #c0392b; }
    .orange { color: #f39c12; } .blue { color: #2563eb; }
    .border-green { border-left: 4px solid #27ae60; }
    .border-blue { border-left: 4px solid #2563eb; }
    .border-orange { border-left: 4px solid #f39c12; }
    .border-red { border-left: 4px solid #c0392b; }
    .filters { background: white; padding: 20px; border-radius: 12px; margin-bottom: 20px; display: flex; gap: 15px; align-items: center; flex-wrap: wrap; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
    .filters input, .filters select { padding: 9px 14px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; outline: none; }
    .btn-filter { background: #1a2340; color: white; border: none; padding: 9px 18px; border-radius: 8px; cursor: pointer; }
    .btn-reset { background: #f5f6fa; color: #888; border: 1px solid #ddd; padding: 9px 18px; border-radius: 8px; text-decoration: none; font-size: 14px; }
    .table-container { background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); overflow: hidden; }
    .table-header { padding: 20px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; }
    table { width: 100%; border-collapse: collapse; }
    th { background: #f8f9fa; padding: 12px 16px; text-align: left; font-size: 12px; color: #888; }
    td { padding: 12px 16px; font-size: 13px; border-bottom: 1px solid #f9f9f9; }
    tr:hover { background: #f8f9fa; }
    .badge { padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: bold; }
    .badge-ok { background: #e8f5e9; color: #27ae60; }
    .badge-pending { background: #fff3e0; color: #f39c12; }
    .badge-one { background: #e3f2fd; color: #2563eb; }
    .badge-rejected { background: #fdecea; color: #c0392b; }
    .btn-action { padding: 5px 10px; border-radius: 6px; font-size: 11px; cursor: pointer; border: none; margin-right: 3px; text-decoration: none; display: inline-block; }
    .btn-sign-inf { background: #e3f2fd; color: #2563eb; }
    .btn-sign-resp { background: #e8f5e9; color: #27ae60; }
    .btn-reject { background: #fdecea; color: #c0392b; }
    .sign-status { font-size: 11px; margin-top: 3px; }
    .alert-success { background: #e8f5e9; color: #27ae60; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #27ae60; }
    .alert-warning { background: #fff3e0; color: #f39c12; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #f39c12; }
</style>

<div class="page-header">
    <div>
        <h1> Distributions</h1>
        <p style="color:#888; font-size:14px; margin-top:4px;">Double signature obligatoire par distribution</p>
    </div>
    <a href="/distributions/ajouter" class="btn-add">+ Nouvelle distribution</a>
</div>

@if(session('success'))
    <div class="alert-success"> {{ session('success') }}</div>
@endif

@php
    $sansDoubleSignature = $distributions->where('validation_statut', '!=', 'validee')->where('validation_statut', '!=', 'rejetee')->count();
@endphp

@if($sansDoubleSignature > 0)
    <div class="alert-warning">
         <strong>{{ $sansDoubleSignature }} distribution(s)</strong> en attente de double signature !
    </div>
@endif

<div class="grid-4">
    <div class="stat-card border-blue">
        <div class="label">TOTAL</div>
        <div class="number blue">{{ $distributions->count() }}</div>
    </div>
    <div class="stat-card border-green">
        <div class="label">DOUBLE SIGNÉES</div>
        <div class="number green">{{ $distributions->where('validation_statut', 'validee')->count() }}</div>
    </div>
    <div class="stat-card border-orange">
        <div class="label">EN ATTENTE</div>
        <div class="number orange">{{ $distributions->whereIn('validation_statut', ['en_attente', 'une_signature'])->count() }}</div>
    </div>
    <div class="stat-card border-red">
        <div class="label">REJETÉES</div>
        <div class="number red">{{ $distributions->where('validation_statut', 'rejetee')->count() }}</div>
    </div>
</div>

<form method="GET" action="/distributions">
<div class="filters">
    <input type="text" name="search" placeholder="🔍 Rechercher..." value="{{ request('search') }}">
    <input type="date" name="date" value="{{ request('date') }}">
    <select name="statut">
        <option value="">Tous les statuts</option>
        <option value="validee" {{ request('statut') == 'validee' ? 'selected' : '' }}>✅ Double signée</option>
        <option value="une_signature" {{ request('statut') == 'une_signature' ? 'selected' : '' }}>🖊️ 1 signature</option>
        <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>⏳ En attente</option>
        <option value="rejetee" {{ request('statut') == 'rejetee' ? 'selected' : '' }}>❌ Rejetée</option>
    </select>
    <button type="submit" class="btn-filter">Filtrer</button>
    <a href="/distributions" class="btn-reset">Réinitialiser</a>
</div>
</form>

<div class="table-container">
    <div class="table-header">
        <h3>Liste des distributions</h3>
        <span style="color:#888; font-size:13px;">{{ $distributions->count() }} distributions</span>
    </div>
    <table>
        <thead>
            <tr>
                <th>N° BON</th>
                <th>PRODUIT</th>
                <th>QTÉ</th>
                <th>SERVICE</th>
                <th>MÉDECIN</th>
                <th>PATIENT</th>
                <th>DATE</th>
                <th>SIGNATURES</th>
                <th>STATUT</th>
                <th>ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            @forelse($distributions as $d)
            <tr>
                <td><strong>#{{ $d->numero_bon }}</strong></td>
                <td>{{ $d->produit }}</td>
                <td><strong>{{ $d->quantite }}</strong></td>
                <td>{{ $d->service }}</td>
                <td>{{ $d->medecin }}</td>
                <td>{{ $d->patient ?? '—' }}</td>
                <td>{{ $d->date_distribution->format('d/m/Y') }}</td>
                <td>
                    <div class="sign-status">
                        @if($d->signature_infirmier)
                             <span style="color:#27ae60;">Infirmier: {{ $d->signature_infirmier }}</span>
                        @else
                             <span style="color:#f39c12;">Infirmier manquant</span>
                        @endif
                    </div>
                    <div class="sign-status">
                        @if($d->signature_responsable)
                             <span style="color:#27ae60;">Resp: {{ $d->signature_responsable }}</span>
                        @else
                             <span style="color:#f39c12;">Responsable manquant</span>
                        @endif
                    </div>
                </td>
                <td>
                    @if($d->validation_statut == 'validee')
                        <span class="badge badge-ok"> Validée</span>
                    @elseif($d->validation_statut == 'une_signature')
                        <span class="badge badge-one"> 1/2</span>
                    @elseif($d->validation_statut == 'rejetee')
                        <span class="badge badge-rejected"> Rejetée</span>
                    @else
                        <span class="badge badge-pending"> En attente</span>
                    @endif
                </td>
                <td>
                    @if(!$d->signature_infirmier)
                        <a href="/distributions/signer-infirmier/{{ $d->id }}?nom=Infirmier" class="btn-action btn-sign-inf">🖊️ Inf</a>
                    @endif
                    @if(!$d->signature_responsable)
                        <a href="/distributions/signer-responsable/{{ $d->id }}?nom=Responsable" class="btn-action btn-sign-resp">🖊️ Resp</a>
                    @endif
                    @if($d->validation_statut != 'rejetee')
                        <a href="/distributions/rejeter/{{ $d->id }}" class="btn-action btn-reject" onclick="return confirm('Rejeter ?')">❌</a>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" style="text-align:center; color:#888; padding:30px;">
                    Aucune distribution — <a href="/distributions/ajouter">Ajouter</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection