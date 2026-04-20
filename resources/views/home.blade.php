@extends('layouts.app')

@section('content')
<style>
    .dashboard-container { padding: 2rem; animation: fadeIn 0.5s ease; }
    .welcome-card {
        background: linear-gradient(135deg, #0052FF 0%, #0035A3 100%);
        border-radius: 30px; padding: 3rem; color: white;
        margin-bottom: 2rem; position: relative; overflow: hidden;
    }
    .stat-card {
        background: white; border: 1px solid #E2E8F0;
        border-radius: 24px; padding: 1.5rem;
        transition: all 0.3s ease; height: 100%;
    }
    .stat-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.05); }
    .icon-shape {
        width: 50px; height: 50px; background: #F0F4FF;
        border-radius: 14px; display: flex; align-items: center; justify-content: center;
        color: #0052FF; font-size: 1.3rem; margin-bottom: 1rem;
    }
</style>

<div class="dashboard-container">
    <div class="welcome-card">
        <div class="row align-items: center;">
            <div class="col-md-8">
                <h2 class="fw-800 mb-2">Ravi de vous revoir, {{ Auth::user()->name }} !</h2>
                <p class="opacity-75 mb-0">Unité d'affectation : <strong>{{ Auth::user()->affectation ?? 'Non définie' }}</strong></p>
            </div>
            <div class="col-md-4 text-md-end">
                <i class="bi bi-hospital fs-1 opacity-25"></i>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="icon-shape"><i class="bi bi-box-seam"></i></div>
                <h5 class="fw-bold">Gestion Stock</h5>
                <p class="text-muted small">Consultez l'état actuel des produits et médicaments disponibles.</p>
                <a href="#" class="btn btn-light btn-sm fw-700 rounded-pill px-3">Ouvrir</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="icon-shape"><i class="bi bi-shield-check"></i></div>
                <h5 class="fw-bold">Traçabilité</h5>
                <p class="text-muted small">Suivi des stupéfiants et des mouvements sensibles au CHU.</p>
                <a href="#" class="btn btn-light btn-sm fw-700 rounded-pill px-3">Ouvrir</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="icon-shape"><i class="bi bi-person-gear"></i></div>
                <h5 class="fw-bold">Mon Profil</h5>
                <p class="text-muted small">Gérez vos informations et vos préférences d'accès.</p>
                <a href="#" class="btn btn-light btn-sm fw-700 rounded-pill px-3">Modifier</a>
            </div>
        </div>
    </div>
</div>
@endsection