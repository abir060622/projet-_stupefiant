<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>G-PHARM | Vérification du Compte</title>
    
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
            padding: 20px;
            margin: 0;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 500px;
        }

        .verify-card {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 28px;
            padding: 3.5rem 2.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 82, 255, 0.08);
            text-align: center;
        }

        .icon-box {
            width: 70px; height: 70px;
            background: #EEF2FF;
            border: 2px solid var(--hosp-blue);
            border-radius: 20px;
            display: inline-flex; align-items: center; justify-content: center;
            color: var(--hosp-blue);
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }

        h2 {
            font-weight: 800;
            font-size: 1.6rem;
            color: var(--hosp-text);
            margin-bottom: 1rem;
        }

        .instruction-text {
            color: var(--hosp-muted);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .btn-resend {
            background: var(--hosp-blue);
            color: white;
            border: none;
            padding: 14px 24px;
            border-radius: 14px;
            font-weight: 700;
            width: 100%;
            transition: 0.3s;
            text-transform: uppercase;
            box-shadow: 0 10px 20px rgba(0, 82, 255, 0.15);
        }

        .btn-resend:hover {
            background: #0044D6;
            transform: translateY(-2px);
        }

        .btn-logout {
            background: transparent;
            color: var(--hosp-muted);
            border: 1px solid #E2E8F0;
            padding: 10px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.85rem;
            margin-top: 1.5rem;
            width: 100%;
            transition: 0.2s;
        }

        .btn-logout:hover {
            background: #F8FAFC;
            color: #EF4444;
        }

        .status-alert {
            background: #ECFDF5;
            border: 1px solid #10B981;
            color: #065F46;
            padding: 1rem;
            border-radius: 14px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>

<div class="auth-wrapper">
    <div class="verify-card">
        <div class="icon-box"><i class="bi bi-envelope-check-fill"></i></div>
        
        <h2>Vérifiez votre email</h2>
        
        <p class="instruction-text">
            Avant de continuer, merci de cliquer sur le lien de vérification que nous venons de vous envoyer par email. 
            <br><small class="fw-bold text-primary">Vérifiez vos courriers indésirables (Spam) si besoin.</small>
        </p>

        @if (session('resent'))
            <div class="status-alert">
                <i class="bi bi-send-check-fill me-2"></i> Un nouveau lien de vérification a été envoyé.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn-resend">
                Renvoyer le lien <i class="bi bi-arrow-repeat ms-2"></i>
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                Se déconnecter <i class="bi bi-box-arrow-right ms-2"></i>
            </button>
        </form>
    </div>

    <div class="text-center mt-4 text-muted" style="font-size: 0.75rem; font-weight: 600;">
        <i class="bi bi-shield-fill-check text-success me-1"></i> Protection des données • G-PHARM Oujda
    </div>
</div>

</body>
</html>