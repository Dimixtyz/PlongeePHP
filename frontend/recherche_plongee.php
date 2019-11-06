<?php
include "../header.php";
?>
<!DOCTYPE html>

<html>
    <head>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <meta charset="utf-8" />
        <title>SALUT</title>
    </head>

    <body>




    <a href="formPlongeee.php">Ajouter une plongée</a>

    <div id="listeEleves"></div>

    </body>
</html>

<?php
include "../backend/requete_recherchePlongee.php";
?>