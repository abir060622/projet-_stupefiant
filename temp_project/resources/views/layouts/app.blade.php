<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>G-PHARM</title>
</head>
<body style="display:flex; min-height:100vh; margin:0; font-family:sans-serif; background:#f5f6fa;">

    <aside style="width:220px; background:#1a2340; color:white; padding:20px 15px; display:flex; flex-direction:column; position:fixed; height:100vh;">
        <div style="margin-bottom:30px; padding-bottom:20px; border-bottom:1px solid #2a3a5c;">
            <h2 style="font-size:16px;">🛡️ G-PHARM</h2>
            <p style="font-size:10px; color:#8899bb; margin-top:4px;">UNITÉ DE GESTION DES STUPÉFIANTS</p>
        </div>

        <div style="font-size:10px; color:#8899bb; margin:10px 0 8px;">NAVIGATION</div>
        <a href="/" style="color:white; text-decoration:none; padding:10px 12px; border-radius:8px; background:#2a3a5c; margin-bottom:5px; display:block;"> Accueil</a>

        <div style="font-size:10px; color:#8899bb; margin:15px 0 8px;">STOCKS & PRODUITS</div>
        <a href="/inventaire" style="color:#ccd6f6; text-decoration:none; padding:10px 12px; border-radius:8px; margin-bottom:5px; display:block;"> Inventaire</a>
        <a href="/entrees" style="color:#ccd6f6; text-decoration:none; padding:10px 12px; border-radius:8px; margin-bottom:5px; display:block;"> Entrées Stock</a>
        <a href="/distributions" style="color:#ccd6f6; text-decoration:none; padding:10px 12px; border-radius:8px; margin-bottom:5px; display:block;"> Distributions</a>
        <a href="/rapports" style="color:#ccd6f6; text-decoration:none; padding:10px 12px; border-radius:8px; margin-bottom:5px; display:block;"> Rapports</a>
        <a href="/pertes" style="color:#ccd6f6; text-decoration:none; padding:10px 12px; border-radius:8px; margin-bottom:5px; display:block;"> Pertes</a>

        <div style="margin-top:auto;">
            <div style="background:#2a3a5c; border-radius:8px; padding:12px; margin-bottom:10px;">
                <strong style="font-size:14px; display:block;">Admin Pharmacie</strong>
                <span style="font-size:11px; color:#8899bb;">Responsable</span>
            </div>
            <a href="/logout" style="display:block; background:#c0392b; color:white; text-align:center; padding:10px; border-radius:8px; text-decoration:none; font-size:13px;">⏻ DÉCONNEXION</a>
        </div>
    </aside>

    <main style="margin-left:220px; padding:30px; flex:1;">
        @yield('content')
    </main>

</body>
</html>