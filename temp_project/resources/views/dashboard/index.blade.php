@extends('layouts.app')

@section('content')

<style>
    .page-header { margin-bottom: 25px; display: flex; justify-content: space-between; align-items: flex-start; }
    .page-header h1 { font-size: 28px; font-weight: bold; color: #1a2340; }
    .page-header p { color: #888; font-size: 14px; margin-top: 4px; }
    .alert-urgence {
        background: #c0392b; color: white;
        padding: 15px 20px; border-radius: 10px;
        display: flex; justify-content: space-between;
        align-items: center; margin-bottom: 20px;
    }
    .badge-urgence { background: rgba(255,255,255,0.2); padding: 5px 15px; border-radius: 20px; font-size: 12px; }
    .grid-3 { display: grid; grid-template-columns: repeat(3,1fr); gap: 20px; margin-bottom: 20px; }
    .grid-4 { display: grid; grid-template-columns: repeat(4,1fr); gap: 20px; }
    .card { background: white; padding: 25px 20px; border-radius: 12px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
    .card-left { text-align: left; }
    .card-number { font-size: 36px; font-weight: bold; margin-bottom: 8px; }
    .card-label { color: #888; font-size: 13px; margin-bottom: 15px; }
    .btn-red { background: #c0392b; color: white; border: none; padding: 8px 20px; border-radius: 20px; cursor: pointer; }
    .btn-orange { background: white; color: #f39c12; border: 2px solid #f39c12; padding: 8px 20px; border-radius: 20px; cursor: pointer; }
    .btn-dark { background: #1a2340; color: white; border: none; padding: 8px 20px; border-radius: 20px; cursor: pointer; }
    .stat-green { color: #27ae60; }
    .stat-red { color: #c0392b; }
    .stat-orange { color: #f39c12; }
    .border-left-orange { border-left: 4px solid #f39c12; text-align: left; }
    .border-left-red { border-left: 4px solid #c0392b; text-align: left; }
    .attentes-list { list-style: none; margin-top: 10px; }
    .attentes-list li { color: #f39c12; font-size: 13px; margin-bottom: 5px; }
    .card-title { font-size: 11px; color: #888; letter-spacing: 1px; margin-bottom: 10px; }
</style>

<div class="page-header">
    <div>
        <h1>Tableau de bord</h1>
        <p>📅 {{ now()->translatedFormat('l d F Y') }}</p>
    </div>
    <div style="color:#2563eb; font-size:13px;">🔒 Session : <strong>Responsable</strong></div>
</div>

<div class="alert-urgence">
    <span>🔴 ACTIONS OBLIGATOIRES IMMÉDIATES</span>
    <span class="badge-urgence">Urgences</span>
</div>

<div class="grid-3">
    <div class="card">
        <div class="card-number stat-red">0</div>
        <div class="card-label">Destructions à valider</div>
        <button class="btn-red">Traiter maintenant</button>
    </div>
    <div class="card">
        <div class="card-number stat-orange">0</div>
        <div class="card-label">Sans double signature</div>
        <button class="btn-orange">Régulariser</button>
    </div>
    <div class="card">
        <div class="card-number">0</div>
        <div class="card-label">Écart de stock détecté</div>
        <button class="btn-dark">Analyser l'écart</button>
    </div>
</div>

<div class="grid-4">
    <div class="card card-left">
        <div class="card-title">STOCK TOTAL</div>
        <div class="card-number">1,240</div>
        <div class="stat-green" style="font-size:13px;">↑ +12 cette semaine</div>
    </div>
    <div class="card card-left">
        <div class="card-title">CONCORDANCE</div>
        <div class="card-number stat-green">100%</div>
        <div style="color:#888; font-size:13px;">Vérifier stock maintenant</div>
    </div>
    <div class="card border-left-orange">
        <div class="card-title">ATTENTES</div>
        <ul class="attentes-list">
            <li>• 0 Distributions</li>
            <li>• 0 Destructions</li>
            <li>• 0 Retours</li>
        </ul>
    </div>
    <div class="card border-left-red">
        <div class="card-title">ALERTES</div>
        <div class="card-number stat-red">03</div>
        <div class="stat-red" style="font-size:13px;">Ruptures critiques</div>
    </div>
</div>

@endsection