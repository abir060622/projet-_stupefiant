<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>G-PHARM - Connexion</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }

        body {
            min-height: 100vh;
            display: flex;
            background: #f5f6fa;
        }

        /* GAUCHE */
        .left-panel {
            width: 45%;
            background: #1a2340;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px;
            color: white;
        }
        .left-panel .logo { font-size: 22px; font-weight: bold; margin-bottom: 8px; }
        .left-panel .subtitle { font-size: 12px; color: #8899bb; letter-spacing: 2px; margin-bottom: 60px; }
        .left-panel h2 { font-size: 28px; font-weight: bold; margin-bottom: 15px; text-align: center; }
        .left-panel p { font-size: 14px; color: #8899bb; text-align: center; line-height: 1.8; }

        .features { margin-top: 50px; width: 100%; }
        .feature-item {
            display: flex; align-items: center; gap: 15px;
            padding: 15px; border-radius: 10px;
            background: rgba(255,255,255,0.05);
            margin-bottom: 12px;
        }
        .feature-icon { font-size: 24px; }
        .feature-text strong { display: block; font-size: 14px; }
        .feature-text span { font-size: 12px; color: #8899bb; }

        /* DROITE */
        .right-panel {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 60px;
        }
        .login-box {
            background: white;
            border-radius: 16px;
            padding: 50px 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        .login-box h3 { font-size: 24px; font-weight: bold; color: #1a2340; margin-bottom: 8px; }
        .login-box p { font-size: 14px; color: #888; margin-bottom: 35px; }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 13px; font-weight: bold; color: #1a2340; margin-bottom: 8px; }
        .form-group input {
            width: 100%; padding: 12px 16px;
            border: 1.5px solid #e0e0e0; border-radius: 8px;
            font-size: 14px; outline: none;
            transition: border-color 0.2s;
        }
        .form-group input:focus { border-color: #1a2340; }

        .form-options {
            display: flex; justify-content: space-between;
            align-items: center; margin-bottom: 25px;
        }
        .form-options label { font-size: 13px; color: #888; display: flex; align-items: center; gap: 6px; }
        .form-options a { font-size: 13px; color: #2563eb; text-decoration: none; }

        .btn-login {
            width: 100%; padding: 14px;
            background: #1a2340; color: white;
            border: none; border-radius: 8px;
            font-size: 16px; font-weight: bold;
            cursor: pointer; transition: background 0.2s;
        }
        .btn-login:hover { background: #2a3a5c; }

        .divider { text-align: center; margin: 25px 0; color: #888; font-size: 13px; position: relative; }
        .divider::before, .divider::after {
            content: ''; position: absolute; top: 50%;
            width: 40%; height: 1px; background: #e0e0e0;
        }
        .divider::before { left: 0; }
        .divider::after { right: 0; }

        .alert-error {
            background: #fdecea; color: #c0392b;
            padding: 12px 16px; border-radius: 8px;
            font-size: 13px; margin-bottom: 20px;
            border-left: 4px solid #c0392b;
            display: none;
        }

        .security-note {
            margin-top: 25px; padding: 12px;
            background: #f8f9fa; border-radius: 8px;
            font-size: 12px; color: #888; text-align: center;
        }
    </style>
</head>
<body>

    {{-- PANNEAU GAUCHE --}}
    <div class="left-panel">
        <div class="logo">🛡️ G-PHARM</div>
        <div class="subtitle">UNITÉ DE GESTION DES STUPÉFIANTS</div>

        <h2>Système de Traçabilité</h2>
        <p>Plateforme sécurisée pour la gestion et le suivi des stupéfiants pharmaceutiques</p>

        <div class="features">
            <div class="feature-item">
                <div class="feature-icon">📦</div>
                <div class="feature-text">
                    <strong>Gestion des stocks</strong>
                    <span>Suivi en temps réel des inventaires</span>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">📋</div>
                <div class="feature-text">
                    <strong>Traçabilité complète</strong>
                    <span>Historique de chaque mouvement</span>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">🔔</div>
                <div class="feature-text">
                    <strong>Alertes automatiques</strong>
                    <span>Notifications de rupture de stock</span>
                </div>
            </div>
        </div>
    </div>

    {{-- PANNEAU DROIT --}}
    <div class="right-panel">
        <div class="login-box">
            <h3>Connexion</h3>
            <p>Accédez à votre espace de gestion</p>

            <div class="alert-error" id="error-msg">
                ❌ Email ou mot de passe incorrect
            </div>

            <form action="/login" method="POST">
                @csrf
                <div class="form-group">
                    <label>📧 Adresse email</label>
                    <input type="email" name="email" placeholder="admin@gpharm.ma" required>
                </div>

                <div class="form-group">
                    <label>🔒 Mot de passe</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>

                <div class="form-options">
                    <label>
                        <input type="checkbox" name="remember">
                        Se souvenir de moi
                    </label>
                    <a href="#">Mot de passe oublié ?</a>
                </div>

                <button type="submit" class="btn-login">
                    🔐 Se connecter
                </button>
            </form>

            <div class="security-note">
                🔒 Connexion sécurisée — Accès réservé au personnel autorisé
            </div>
        </div>
    </div>

</body>
</html>