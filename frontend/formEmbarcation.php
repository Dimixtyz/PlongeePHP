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
                <legend>Formulaire d'ajout de type d'embarcation</legend>
                <label>Ajouter un moyen d'embarcation : <label>
                <input type="text" name="moyenEmbarcation"><br/>
                <br/>
                <button class="btn waves-effect waves-light green lighten-1" style="border-radius:10px;" type="submit" name="action">Ajouter l'embarcation
                    <i class="material-icons right">send</i>
                </button>
                <button class="btn waves-effect waves-light red lighten-1" style="border-radius:10px;" type="reset" name="action">Effacer
                    <i class="material-icons right">clear</i>
                </button>
                <button class="btn waves-effect waves-light grey darken-4" style="border-radius:10px;" type="button" value = "Retour"  onclick = "history.back()" style="margin:auto">
                    Retour
                </button>
            </fieldset>
        </form>
    </body>
</html>