<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8" />
        <title>SALUT</title>
    </head>

    <body>
      <form  method="post" action="recherche_personne.php">
  <div class="form-group">
    <label for="Recherche"></label>
    <input type="text" name="recherche" placeholder="Rechercher des membres...">
  </div>
  <div class="text-center">
    <button type="submit" name="valider_recherche_personne">Rechercher</button>
  </div>
</form>
<a href="formulaire_creation_personne.php">Ajouter une personne</a>

    </body>
</html>

<?php
include "requete_rechercher.php";
?>
