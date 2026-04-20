<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>G-PHARM | Portail de connexion</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root { 
            --primary: #0052FF; 
            --bg-body: #F9FBFF; 
            --text-main: #0F172A; 
            --text-label: #475569; 
            --input-bg: #F2F5FF; 
            --text-muted: #64748B;
        }
        
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: var(--bg-body);
            min-height: 100vh; display: flex; align-items: center; justify-content: center; margin: 0;
            flex-direction: column; position: relative;
        }

        /* Bouton Retour identique au Register */
        .back-home {
            position: absolute; top: 40px; left: 40px;
            text-decoration: none; color: var(--text-muted);
            font-weight: 700; font-size: 0.85rem;
            display: flex; align-items: center; gap: 8px;
            text-transform: uppercase; letter-spacing: 0.05em;
            transition: 0.3s;
        }

        /* Carte avec les mêmes arrondis et paddings que le Register */
        .login-card {
            width: 100%; max-width: 480px; padding: 3.5rem;
            background: white; border-radius: 35px;
            border: 1px solid rgba(226, 232, 240, 0.7);
            box-shadow: 0 15px 40px rgba(0, 82, 255, 0.03);
            text-align: center;
        }

        /* L'icône dans le carré bleu arrondi */
        .shield-icon {
            width: 65px; height: 65px; border: 2.5px solid var(--primary); border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.5rem; color: var(--primary); font-size: 1.8rem;
            box-shadow: 0 8px 20px rgba(0, 82, 255, 0.08);
        }

        .login-card h1 { font-weight: 800; font-size: 2.2rem; color: var(--text-main); margin-bottom: 0.5rem; }
        
        .session-badge {
            display: inline-block; background: #F0F4FF; color: var(--primary);
            padding: 6px 18px; border-radius: 100px;
            font-weight: 800; font-size: 0.7rem; text-transform: uppercase;
            letter-spacing: 0.05em; margin-bottom: 2.5rem;
        }

        .form-label { 
            font-weight: 700; font-size: 0.75rem; color: var(--text-label); 
            letter-spacing: 0.05em; text-transform: uppercase; margin-bottom: 10px; display: flex; 
        }
        
        .input-wrapper { position: relative; margin-bottom: 1.5rem; text-align: left; }
        .input-wrapper i.prefix-icon {
            position: absolute; left: 18px; top: 50%; transform: translateY(-50%);
            color: #94A3B8; font-size: 1.1rem;
        }

        .form-control-custom {
            padding: 15px 15px 15px 52px; border-radius: 16px;
            border: 1.5px solid #E2E8F0; background: var(--input-bg);
            font-weight: 500; font-size: 0.95rem; width: 100%; transition: 0.2s;
        }

        .btn-submit {
            width: 100%; padding: 18px; border-radius: 18px;
            background: var(--primary); border: none; color: white;
            font-weight: 700; font-size: 1rem; text-transform: uppercase;
            letter-spacing: 0.05em; transition: 0.3s;
            display: flex; align-items: center; justify-content: center; gap: 12px;
            margin-top: 1rem;
        }

        .register-link {
            margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #F1F5F9;
            font-size: 0.95rem; color: var(--text-muted); font-weight: 500;
        }
        .register-link a { color: var(--primary); text-decoration: none; font-weight: 700; }
    </style>
</head>
<body>

<a href="{{ url('/') }}" class="back-home">
    <i class="bi bi-arrow-left"></i>
    <span>RETOUR À L'ACCUEIL</span>
</a>

<div class="login-card">
    <div class="shield-icon">
        <i class="bi bi-shield-lock-fill"></i>
    </div>
    <h1>Portail de connexion</h1>
    <div class="session-badge">Session : Professionnel Habilité</div>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <div class="input-wrapper">
            <label class="form-label">Identifiant Professionnel</label>
            <i class="bi bi-envelope prefix-icon"></i>
            <input type="email" name="email" class="form-control-custom" placeholder="admin@test.com" required autofocus>
        </div>

        <div class="input-wrapper">
            <div class="d-flex justify-content-between align-items-center w-100">
                <label class="form-label">Mot de passe</label>
                <a href="#" class="text-primary text-decoration-none fw-bold mb-2" style="font-size: 0.75rem;">Accès perdu ?</a>
            </div>
            <i class="bi bi-key prefix-icon"></i>
            <input type="password" name="password" class="form-control-custom" placeholder="••••••••" required>
        </div>

        <div class="input-wrapper">
            <label class="form-label">Unité d'Affectation</label>
            <i class="bi bi-hospital prefix-icon"></i>
            <select name="unite" class="form-control-custom" style="appearance: none; cursor: pointer;" required>
                <option value="" disabled selected>Service Infirmier de l'unité</option>
                <option value="service_infirmier">Service Infirmier de l'unité</option>
                <option value="chef_bloc">Chef de Bloc</option>
                <option value="gestionnaire_pharmacie">Gestionnaire Pharmacie</option>
            </select>
            <i class="bi bi-chevron-down" style="position: absolute; right: 18px; top: 72%; transform: translateY(-50%); color: #94A3B8; pointer-events: none;"></i>
        </div>

        <div class="form-check mb-4 d-flex align-items-center justify-content-start">
            <input class="form-check-input" type="checkbox" id="remember" name="remember" style="width: 1.2rem; height: 1.2rem; border-radius: 6px; cursor: pointer;">
            <label class="form-check-label" for="remember" style="font-size: 0.9rem; font-weight: 500; color: var(--text-muted); cursor: pointer; margin-left: 8px;">
                Maintenir la session ouverte
            </label>
        </div>

        <button type="submit" class="btn-submit">
            ACCÉDER AU SYSTÈME <i class="bi bi-arrow-right-short fs-4"></i>
        </button>
    </form>

    <div class="register-link">
        Nouvel utilisateur ? <a href="{{ route('register') }}">Créer une demande d'accès</a>
    </div>
</div>

<div class="mt-5 text-center text-muted" style="font-size: 0.85rem; font-weight: 500;">
    <i class="bi bi-patch-check-fill text-success me-1"></i>
    Système de traçabilité conforme au <strong>CHU Mohammed VI Oujda</strong>
</div>

</body>
</html>