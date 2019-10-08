<!DOCTYPE html>
<html lang="fr">
  <head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <meta charset="utf-8">
    <title>Formulaire plongée</title>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('.datepicker');
      });
    </script>
  </head>
  <body>
  <form>
	  <fieldset style="width:850px; margin-left: auto; margin-right: auto; margin-top:5%">
  	  <legend>FORMULAIRE PLONGÉE</legend>
      <br/>
        
      <label> Date de la plongée : </label>
      <input type="date" class="date" id="datePlongee" name="datePlongee">


          <br/>
      <br/>

      <label> Séance de la plongée : </label> <br/>
          <label>
              <input class="with-gap"  name="seance" value="matin" type="radio"  />
              <span>Matin</span>
          </label>
          <label>
              <input class="with-gap" name="seance" value="apresmidi" type="radio"  />
              <span>Après-midi</span>
          </label>
          <label>
              <input class="with-gap" name="seance" value="soir" type="radio"  />
              <span>Soir</span>
          </label>

      <br/>
      <br/>

          <fieldset>
          <legend>Site de la plongée</legend>
          <label>Nom du site : </label><input type="text" name="nomsite"><br/>
          <label>Localisation du site : </label><input type="text" name="localisationsite"><br/>
          </fieldset>


          <br/>
      <br/>

          <label> Type d'embarcation : </label><br/>
          <label>
              <input class="with-gap" name="type_embarcation" value="beclem" type="radio"  />
              <span>Beclem</span>
          </label>
          <label>
              <input class="with-gap" name="type_embarcation" value="estelenn" type="radio"  />
              <span>Estelenn</span>
          </label>


      <br/>
      <br/>

      <label>Effectif plongeurs : </label><input type="number" name="effectifP"><br/>
      <label>Effectif bateau : </label><input type="number" name="effectifB">

      <br/>
      <br/>

      <label>Directeur de plongée : </label><br/>
      <label>Nom : </label>
      <select id="NomDirecteur" class="browser-default">

        <option value = "">Sélectionnez un directeur</option>
          <?php
          include "../backend/bddPlongee.php";
          $bdd = new bddPlongee();

          $req = "select PER_NUM,PER_NOM, PER_PRENOM from PLO_PERSONNE JOIN PLO_DIRECTEUR USING(PER_NUM) ORDER BY PER_NOM";

          $rep = $bdd->exec($req);

          for($i = 0; $i<sizeof($rep); $i++){
              $val = $rep[$i][0];
              $valaafficher = $rep[$i][1].' '.$rep[$i][2];
              echo "<option value=$val>$valaafficher</option><br/>";
          }

          ?>
      </select> 


      <br/>
      <br/>



      <label>Sécurité de surface : </label><br/>
      <label>Nom : </label>
      <select class="browser-default" id="NomDirecteur">
          <option value = "">Sélectionnez un directeur</option>

          <?php
          require_once "../backend/bddPlongee.php";
          $bdd = new bddPlongee();

          $requeteSecuriteSurface = "select PER_NUM,PER_NOM, PER_PRENOM from PLO_PERSONNE JOIN PLO_SECURITE_DE_SURFACE USING(PER_NUM) ORDER BY PER_NOM";

          $resultatSecuriteSurface = $bdd->exec($requeteSecuriteSurface);

          for($i = 0; $i<sizeof($resultatSecuriteSurface); $i++){
              $vale = $resultatSecuriteSurface[$i][0];
              $valaffiche = $resultatSecuriteSurface[$i][1].' '.$resultatSecuriteSurface[$i][2];
              echo "<option value=$vale>$valaffiche</option><br/>";
          }

          ?>
      </select> 


      <br/>
      <br/>

      <input type="submit" name="envoi" value=" Envoyer ">
      <input type="reset" name="efface" value="Effacer ">

      <br/>
      <br/>
    </fieldset><br/></br/>
   <input type = "button" value = "Retour"  onclick = "history.back()" style="margin:auto">
  </form>        
  </body>
</html>