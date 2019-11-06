<html>
    <head>
        <meta charset="utf-8">
        <title>Plongée</title>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type"/>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <!--<script>
            $(".dropdown-trigger").dropdown();
        <scrpit>-->
    </head>
    <body>
        <ul id="dropdown1" class="dropdown-content">
            <li><a href="/frontend/recherche_plongee.php">Consulter</a></li>
            <li class="divider"></li>
            <li><a href="/frontend/formPlongeee.php">Ajouter</a></li>
        </ul>
        <ul id="dropdown2" class="dropdown-content">
            <li><a href="/frontend/recherche_personne.php">Consulter</a></li>
            <li class="divider"></li>
            <li><a href="/frontend/formulaire_creation_personne.php">Ajouter</a></li>
        </ul>
        <ul id="dropdown3" class="dropdown-content">
            <li><a href="#!">Consulter</a></li>
            <li class="divider"></li>
            <li><a href="/frontend/formSite.php">Ajouter</a></li>
        </ul>
        <ul id="dropdown4" class="dropdown-content">
            <li><a href="#!">Consulter</a></li>
            <li class="divider"></li>
            <li><a href="/frontend/formEmbarcation.php">Ajouter</a></li>
        </ul>

        <div class="navbar-fixed">
            <nav class="blue darken-4" style="width:100%">
                <div class="nav-wrapper">
                    <a href="../index.php" class="brand-logo" style="padding-left:10px;padding-right:10px;">Site de Plongée</a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a class="dropdown-trigger" href="/frontend/recherche_plongee.php" data-target="dropdown1">Plongée<i class="material-icons right">arrow_drop_down</i></a></li>
                        <li><a class="dropdown-trigger" href="/frontend/recherche_personne.php" data-target="dropdown2">Personne<i class="material-icons right">arrow_drop_down</i></a></li>
                        <li><a class="dropdown-trigger" href="/frontend/recherche_personne.php" data-target="dropdown3">Site<i class="material-icons right">arrow_drop_down</i></a></li>
                        <li><a class="dropdown-trigger" href="/frontend/recherche_personne.php" data-target="dropdown4">Embarcation<i class="material-icons right">arrow_drop_down</i></a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </body>
</html>