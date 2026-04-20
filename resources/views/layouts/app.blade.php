<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>G-Pharm | CHU Oujda</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        :root {
            --sb-bg: #0f172a;           /* Ardoise sombre */
            --sb-active-bg: rgba(59, 130, 246, 0.1); 
            --sb-active-color: #3b82f6; 
            --sb-text: #94a3b8;         
            --sb-hover: #1e293b;        
        }

        body, html { 
            height: 100%; margin: 0; overflow: hidden;
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        #app { display: flex; height: 100vh; }

        /* Sidebar - Structure Nette */
        .sidebar {
            width: 280px;
            background: var(--sb-bg);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            border-right: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar-header {
            padding: 2.5rem 1.5rem;
            background: rgba(0,0,0,0.1);
        }

        .brand-box {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            font-weight: 800;
            font-size: 1.35rem;
            letter-spacing: -0.5px;
        }

        /* Zone de Scroll Intégrée */
        .sidebar-scrollbox {
            flex-grow: 1;
            overflow-y: auto;
            padding: 1rem 0;
        }

        /* Scrollbar Fine & Discrète */
        .sidebar-scrollbox::-webkit-scrollbar { width: 5px; }
        .sidebar-scrollbox::-webkit-scrollbar-thumb { 
            background: rgba(255,255,255,0.1); 
            border-radius: 10px; 
        }

        /* Labels des Sections */
        .nav-label {
            padding: 1.5rem 1.8rem 0.6rem;
            font-size: 0.65rem;
            font-weight: 800;
            text-transform: uppercase;
            color: #475569;
            letter-spacing: 1.3px;
        }

        /* Liens de Navigation */
        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.85rem 1.5rem;
            margin: 0.2rem 1rem;
            color: var(--sb-text);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            border-radius: 8px;
            transition: all 0.2s ease;
            position: relative;
        }

        .nav-link i { 
            font-size: 1.25rem; 
            margin-right: 12px; 
            opacity: 0.7;
            transition: 0.2s;
        }

        .nav-link:hover {
            background: var(--sb-hover);
            color: #ffffff;
        }

        .nav-link:hover i { opacity: 1; }

        /* État Actif */
        .nav-link.active {
            background: var(--sb-active-bg);
            color: var(--sb-active-color);
            font-weight: 700;
        }

        .nav-link.active i { 
            color: var(--sb-active-color); 
            opacity: 1; 
        }

        /* Petit indicateur pro à gauche */
        .nav-link.active::before {
            content: "";
            position: absolute;
            left: -1rem;
            height: 22px;
            width: 4px;
            background: var(--sb-active-color);
            border-radius: 0 4px 4px 0;
        }

        /* Footer Sidebar */
        .sidebar-footer {
            padding: 1.5rem;
            background: rgba(0,0,0,0.25);
            border-top: 1px solid rgba(255,255,255,0.05);
        }

        .user-pill {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1.25rem;
        }

        .avatar-box {
            width: 40px; height: 40px;
            background: var(--sb-active-color);
            color: white;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800;
        }

        .btn-logout {
            width: 100%;
            background: transparent;
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #f87171;
            padding: 10px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.8rem;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-logout:hover {
            background: #ef4444;
            color: white;
            border-color: #ef4444;
        }

        .main-content {
            flex-grow: 1;
            overflow-y: auto;
            height: 100vh;
            padding: 2.5rem;
        }
    </style>
</head>
<body>
    <div id="app">
        @auth
            <aside class="sidebar">
                <div class="sidebar-header">
                    <div class="brand-box">
                        <i class="bi bi-shield-plus text-primary"></i> G-PHARM
                    </div>
                    <div style="color:#64748b; font-size: 0.65rem; font-weight: 700; margin-top: 5px; letter-spacing: 0.5px;">
                        UNITÉ DE GESTION DES STUPÉFIANTS
                    </div>
                </div>

                <div class="sidebar-scrollbox">
                    <div class="nav-label">Navigation</div>
                    <a href="{{ route('home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2-fill"></i> Accueil
                    </a>

                    <div class="nav-label">Stocks & Produits</div>
                    <a href="{{ route('medicaments.index') }}" class="nav-link {{ request()->is('inventaire*') ? 'active' : '' }}">
                        <i class="bi bi-capsule-pill"></i> Inventaire
                    </a>
                    <a href="#" class="nav-link"><i class="bi bi-arrow-down-left-square"></i> Entrées Stock</a>
                    <a href="#" class="nav-link"><i class="bi bi-arrow-up-right-square"></i> Sorties / Bons</a>

                    @if(Auth::user()->role == 'responsable')
                    <div class="nav-label">Contrôle Médical</div>
                    <a href="#" class="nav-link"><i class="bi bi-person-badge"></i> Utilisateurs</a>
                    <a href="#" class="nav-link"><i class="bi bi-clipboard-data"></i> Rapports & Audit</a>
                    @endif
                </div>

                <div class="sidebar-footer">
                    <div class="user-pill">
                        <div class="avatar-box">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                        <div class="overflow-hidden">
                            <div style="color:white; font-size:0.85rem; font-weight:600;" class="text-truncate">{{ Auth::user()->name }}</div>
                            <div style="color:var(--sb-text); font-size:0.7rem; font-weight: 500;">{{ ucfirst(Auth::user()->role) }}</div>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn-logout">
                            <i class="bi bi-power"></i> DÉCONNEXION
                        </button>
                    </form>
                </div>
            </aside>
        @endauth

        <main class="main-content">
            @yield('content')
        </main>
    </div>
</body>
</html>