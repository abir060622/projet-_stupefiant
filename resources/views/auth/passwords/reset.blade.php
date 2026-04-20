<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>G-PHARM | Réinitialisation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #F8FAFF; min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: 'Inter', sans-serif; }
        .reset-card { background: white; border-radius: 28px; padding: 3rem; box-shadow: 0 20px 40px rgba(0,82,255,0.1); width: 100%; max-width: 450px; border: 1px solid #E2E8F0; }
        .btn-hosp { background: #0052FF; color: white; border-radius: 14px; padding: 12px; font-weight: 700; border: none; width: 100%; margin-top: 20px; }
        .form-control { border-radius: 12px; padding: 12px; background: #F8FAFC; border: 1px solid #E2E8F0; }
    </style>
</head>
<body>
    <div class="reset-card">
        <div class="text-center mb-4">
            <h3 class="fw-bold">Nouveau Mot de Passe</h3>
            <p class="text-muted small">Sécurisation du compte CHU Oujda</p>
        </div>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="mb-3">
                <label class="small fw-bold text-muted">EMAIL</label>
                <input type="email" name="email" class="form-control" value="{{ $email ?? old('email') }}" readonly>
            </div>
            <div class="mb-3">
                <label class="small fw-bold text-muted">NOUVEAU MOT DE PASSE</label>
                <input type="password" name="password" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label class="small fw-bold text-muted">CONFIRMATION</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn-hosp">METTRE À JOUR L'ACCÈS</button>
        </form>
    </div>
</body>
</html>