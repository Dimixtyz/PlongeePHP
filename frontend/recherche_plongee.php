<?php
include "../header.php";
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8" />
        <title>SALUT</title>
    </head>

    <body>



    <br/>
    <a class="btn waves-effect waves-light green" style="border-radius:10px;" href="formulaire_creation_personne.php">Ajouter une plongée</a>

    <div id="listeEleves"></div>

    </body>
</html>

<?php
include "../backend/requete_recherchePlongee.php";
?>