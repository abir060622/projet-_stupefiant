<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>G-PHARM | Portail CHU Mohammed VI Oujda</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root { 
            --primary: #0052FF; 
            --primary-soft: rgba(0, 82, 255, 0.08);
            --bg: #F4F7FF; 
            --text-main: #0F172A; 
            --text-muted: #64748B;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: 
                radial-gradient(circle at 10% 20%, rgba(0, 82, 255, 0.03) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(99, 102, 241, 0.03) 0%, transparent 40%),
                var(--bg);
            min-height: 100vh; display: flex; flex-direction: column; margin: 0; 
        }
        
        .main-container { 
            width: 100%; max-width: 1100px; margin: auto; padding: 40px 20px; 
            animation: fadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1); 
            flex: 1; display: flex; flex-direction: column; justify-content: center;
        }
        
        /* Badge & Hero Section */
        .regulatory-header { text-align: center; margin-bottom: 4rem; }
        
        .security-badge {
            display: inline-flex; align-items: center; gap: 10px;
            background: white; border: 1px solid rgba(0, 82, 255, 0.1);
            padding: 10px 20px; border-radius: 100px;
            font-weight: 700; font-size: 0.85rem; color: var(--primary);
            box-shadow: 0 4px 15px rgba(0, 82, 255, 0.05);
            margin-bottom: 2rem;
        }

        .regulatory-header h1 { 
            font-size: 3.5rem; font-weight: 800; letter-spacing: -0.05em; 
            color: var(--text-main); margin-bottom: 1.2rem; line-height: 1;
        }
        
        .regulatory-header p { 
            color: var(--text-muted); font-size: 1.2rem; max-width: 750px; 
            margin: 0 auto; line-height: 1.7; font-weight: 450;
        }

        /* Cartes High-Tech */
        .compact-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; }

        .card-ux {
            background: rgba(255, 255, 255, 0.8); 
            backdrop-filter: blur(10px);
            border-radius: 35px; padding: 3rem;
            border: 1px solid white; 
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.02);
            display: flex; flex-direction: column; 
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .card-ux:hover { 
            transform: translateY(-12px); 
            background: white;
            border-color: var(--primary); 
            box-shadow: 0 30px 60px rgba(0, 82, 255, 0.08); 
        }

        .icon-circle {
            width: 56px; height: 56px; background: var(--primary-soft); color: var(--primary);
            border-radius: 18px; display: flex; align-items: center; justify-content: center; 
            font-size: 1.5rem; margin-bottom: 2rem;
        }

        .tag-line { font-size: 0.8rem; font-weight: 800; color: var(--primary); letter-spacing: 0.15em; margin-bottom: 1rem; display: block; }
        h2 { font-weight: 800; font-size: 1.9rem; color: var(--text-main); margin-bottom: 1.2rem; line-height: 1.2; }
        .desc-sm { color: var(--text-muted); font-size: 1.1rem; line-height: 1.6; margin-bottom: 2.5rem; flex-grow: 1; }

        /* Boutons */
        .btn-action {
            padding: 18px; border-radius: 20px; font-weight: 700; font-size: 1.1rem;
            text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 10px; transition: 0.3s;
        }
        .btn-prim { background: var(--primary); color: white; border: none; }
        .btn-sec { background: #EDF2F7; color: var(--text-main); border: none; }

        .btn-action:hover { transform: scale(1.02); filter: brightness(1.05); color: inherit; }
        .btn-prim:hover { color: white; box-shadow: 0 10px 20px rgba(0, 82, 255, 0.2); }

        /* Footer Institutionnel */
        .official-footer {
            background: white; border-top: 1px solid rgba(0,0,0,0.05); padding: 1.5rem 3rem; 
            display: flex; justify-content: space-between; align-items: center; 
            font-size: 0.85rem; color: var(--text-muted); font-weight: 500;
        }
        
        .status-pill { display: flex; align-items: center; gap: 20px; }
        .pill-item { display: flex; align-items: center; gap: 8px; }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        
        @media (max-width: 900px) { 
            .compact-grid { grid-template-columns: 1fr; gap: 2rem; } 
            .regulatory-header h1 { font-size: 2.8rem; }
            .official-footer { flex-direction: column; gap: 15px; text-align: center; }
        }
    </style>
</head>
<body>

<div class="main-container">
    <div class="regulatory-header">
        <div class="security-badge">
            <span class="spinner-grow spinner-grow-sm text-success" role="status"></span>
            <span>SÉCURITÉ PHARMACEUTIQUE ACTIVE</span>
        </div>
        <h1>Système G-PHARM</h1>
        <p>
            Gestion intelligente et traçabilité des substances vénéneuses pour les unités de soins intensifs du <strong>CHU MOHAMMED VI - OUJDA</strong>.
        </p>
    </div>

    <div class="compact-grid">
        <div class="card-ux">
            <div class="icon-circle"><i class="bi bi-shield-lock-fill"></i></div>
            <span class="tag-line">ACCÈS PROFESSIONNEL</span>
            <h2>Espace Praticien & Gestionnaire</h2>
            <p class="desc-sm">Pilotez les inventaires théoriques, les entrées de stock et validez les distributions critiques en temps réel.</p>
            <a href="{{ route('login') }}" class="btn-action btn-prim">
                Se connecter au portail <i class="bi bi-arrow-right-short fs-4"></i>
            </a>
        </div>

        <div class="card-ux">
            <div class="icon-circle" style="background: #F1F5F9; color: #475569;"><i class="bi bi-person-plus-fill"></i></div>
            <span class="tag-line" style="color: #64748B;">DEMANDE D'ACCÈS</span>
            <h2>Nouvelle Habilitation</h2>
            <p class="desc-sm">Soumettez votre demande pour obtenir vos droits d'accès après vérification par le responsable d'unité.</p>
            <a href="{{ route('register') }}" class="btn-action btn-sec">
                Créer un compte <i class="bi bi-plus-lg"></i>
            </a>
        </div>
    </div>
</div>

<footer class="official-footer">
    <div>
        © 2026 G-PHARM • <strong>CHU MOHAMMED VI OUJDA</strong> • UNITÉ DES FLUX SENSIBLES
    </div>
    <div class="status-pill">
        <div class="pill-item text-success">
            <i class="bi bi-patch-check-fill"></i>
            <span>TRAÇABILITÉ TOTALE</span>
        </div>
        <div class="pill-item">
            <i class="bi bi-database-fill-check"></i>
            <span>AUDIT LOG ACTIF</span>
        </div>
    </div>
</footer>

</body>
</html>