<?php
include "../header.php";
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <meta charset="utf-8">
    <title>Formulaire site</title>
  </head>
  <body>
        <form methode="post">
            <fieldset style="width:850px; margin-left: auto; margin-right: auto; margin-top:5%">
                <legend>Formulaire de création de site</legend>
                <label>Nom du site : </label><input type="text" name="nomsite"><br/>
                <label>Localisation du site : </label><input type="text" name="localisationsite"><br/>
            </fieldset>
        </form>
    </body>
</html>
        