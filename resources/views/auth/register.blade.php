<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>G-PHARM | Inscription Professionnelle</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --hosp-blue: #0052FF;
            --hosp-bg: #F8FAFF;
            --hosp-text: #0F172A;
            --hosp-muted: #64748B;
        }

        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--hosp-bg); 
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            margin: 0;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 550px; /* Légèrement plus large pour les formulaires d'inscription */
            position: relative;
        }

        .login-card {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 28px;
            padding: 3.5rem 3rem;
            box-shadow: 0 25px 50px -12px rgba(0, 82, 255, 0.08);
        }

        .header-section {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo-ring {
            width: 54px; height: 54px;
            background: #FFFFFF;
            border: 2px solid var(--hosp-blue);
            border-radius: 16px;
            display: inline-flex; align-items: center; justify-content: center;
            color: var(--hosp-blue);
            font-size: 1.6rem;
            margin-bottom: 1.2rem;
            box-shadow: 0 8px 20px rgba(0, 82, 255, 0.1);
        }

        .header-section h2 {
            font-weight: 800;
            font-size: 1.75rem;
            letter-spacing: -0.03em;
            color: var(--hosp-text);
            margin-bottom: 0.5rem;
        }

        .header-section .badge {
            background: #F0F5FF;
            color: var(--hosp-blue);
            font-weight: 700;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 6px 14px;
            border-radius: 100px;
        }

        .form-group-custom {
            margin-bottom: 1.5rem;
        }

        .label-custom {
            font-size: 0.75rem;
            font-weight: 800;
            color: var(--hosp-muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 0.6rem;
            display: block;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper i.main-icon {
            position: absolute;
            left: 1.2rem;
            color: var(--hosp-muted);
            font-size: 1.1rem;
            pointer-events: none;
        }

        .form-control-custom {
            width: 100%;
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            padding: 12px 12px 12px 3.2rem;
            border-radius: 14px;
            font-weight: 500;
            color: var(--hosp-text);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-control-custom:focus {
            background: #FFFFFF;
            border-color: var(--hosp-blue);
            box-shadow: 0 0 0 4px rgba(0, 82, 255, 0.08);
            outline: none;
        }

        select.form-control-custom {
            appearance: none;
            cursor: pointer;
            padding-right: 3rem;
        }

        .chevron-icon {
            position: absolute;
            right: 1.2rem;
            color: var(--hosp-muted);
            font-size: 0.8rem;
            pointer-events: none;
            opacity: 0.6;
        }

        .btn-submit {
            background: var(--hosp-blue);
            color: white;
            border: none;
            padding: 16px;
            border-radius: 16px;
            font-weight: 700;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 1rem;
            transition: 0.3s;
            box-shadow: 0 10px 25px rgba(0, 82, 255, 0.2);
            margin-top: 1.5rem;
            text-transform: uppercase;
            cursor: pointer;
        }

        .btn-submit:hover {
            background: #0044D6;
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(0, 82, 255, 0.3);
        }

        .auth-footer {
            margin-top: 2rem;
            text-align: center;
            font-size: 0.9rem;
            color: var(--hosp-muted);
        }

        .auth-footer a {
            color: var(--hosp-blue);
            font-weight: 700;
            text-decoration: none;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--hosp-muted);
            font-size: 0.8rem;
            font-weight: 700;
            text-decoration: none;
            margin-bottom: 2rem;
            transition: 0.2s;
        }

        .back-link:hover { color: var(--hosp-blue); }
    </style>
</head>
<body>

<div class="auth-wrapper">
    <div class="login-card">
        <a href="/" class="back-link text-uppercase">
            <i class="bi bi-arrow-left"></i> Retour à l'accueil
        </a>

        <div class="header-section">
            <div class="logo-ring"><i class="bi bi-person-plus-fill"></i></div>
            <h2>Créer un compte</h2>
            <span class="badge">Nouveau membre du personnel</span>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="form-group-custom">
                        <label class="label-custom">Nom et Prénom</label>
                        <div class="input-wrapper">
                            <i class="bi bi-person-fill main-icon"></i>
                            <input type="text" name="name" class="form-control-custom" placeholder="ex: Nom Prenom" required>
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <div class="form-group-custom">
                        <label class="label-custom">Email Institutionnel</label>
                        <div class="input-wrapper">
                            <i class="bi bi-envelope-at-fill main-icon"></i>
                            <input type="email" name="email" class="form-control-custom" placeholder="nom.prenom@sante.ma" required>
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <div class="form-group-custom">
                        <label class="label-custom">Unité / Service d'affectation</label>
                        <div class="input-wrapper">
                            <i class="bi bi-person-badge-fill main-icon"></i>
                            <select name="role" class="form-control-custom" required>
                                <option value="" selected disabled>Sélectionnez votre unité...</option>
                                <option value="infirmier">Service Infirmier de l'unité</option>
                                <option value="pharmacien">Pharmacie Centrale CHU</option>
                                <option value="chef_bloc">Chef de Bloc</option>
                            </select>
                            <i class="bi bi-chevron-down chevron-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="form-group-custom">
                        <label class="label-custom">Mot de passe</label>
                        <div class="input-wrapper">
                            <i class="bi bi-key-fill main-icon"></i>
                            <input type="password" name="password" class="form-control-custom" placeholder="••••••••" required>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="form-group-custom">
                        <label class="label-custom">Confirmation</label>
                        <div class="input-wrapper">
                            <i class="bi bi-shield-lock-fill main-icon"></i>
                            <input type="password" name="password_confirmation" class="form-control-custom" placeholder="••••••••" required>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                Soumettre ma demande d'accès <i class="bi bi-check-circle-fill ms-2"></i>
            </button>
        </form>

        <div class="auth-footer">
            Déjà inscrit ? <a href="{{ route('login') }}">Se connecter au portail</a>
        </div>
    </div>

    <div class="text-center mt-4 text-muted" style="font-size: 0.75rem; font-weight: 500;">
        <i class="bi bi-info-circle-fill text-primary me-1"></i> Votre demande sera validée par l'administrateur du CHU Oujda.
    </div>
</div>

</body>
</html>