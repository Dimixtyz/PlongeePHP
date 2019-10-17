<html>
    <head>
        <meta charset="utf-8">
        <title>Plongée</title>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type"/>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="/frontend/css/style.css">
        <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="script.js"></script>
    </head>
    <body>
        <div class="navbar-fixed">
            <nav class="navBarPlongee" style="width:100%">
                <div class="nav-wrapper">
                    <a href="../index.php" class="brand-logo left" style="padding-left:10px;">Site de Plongée</a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a href="../index.php">Accueil</a></li>
                        <li><a href="/frontend/recherche_personne.php">Recherche personne</a></li>
                        <li><a href="/frontend/formPlongee.php">Formulaire plongée</a></li>
                        <li><a href="/frontend/formPalanquee.php">Formulaire palanquée</a></li>
                        <li><a href="/frontend/formulaire_creation_personne.php">Inscription personne</a></li>
                        <li><a href="/backend/deconnexion.php" onclick = "javascript:confirm('êtes-vous certain ?')">Déconnexion</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </body>
</html>