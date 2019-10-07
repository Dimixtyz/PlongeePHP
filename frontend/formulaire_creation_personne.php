<!DOCTYPE html>
<html lang="fr">
  <head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <meta charset="utf-8">
    <title>Formulaire personne</title>
  </head>
  <body>
  <form method="post" action="../backend/insererPersonne.php">
	  <fieldset style="width:500px; margin-left: auto; margin-right: auto;">
        <legend>Inscription personne</legend>
        <br/>

        <div class="input-field col s6">
            <i class="material-icons prefix">account_circle</i>
            <input id="icon_prefix" type="text" name="nom" class="validate">
            <label for="icon_prefix">Nom : </label>
        </div>

        <br/>

        <div class="input-field col s6">
            <i class="material-icons prefix">account_circle</i>
            <input id="icon_prefix2" type="text" name="prenom" class="validate">
            <label for="icon_prefix2">Prénom : </label>
        </div>

        <br/>

        <div>
            <label for="type">Choisir le statut : </label>
            <select class="browser-default" id="type" name="statut" size="1" onChange="THEFUNCTION(this.selectedIndex);">
                <option value="aucun">Aucun</option>
                <option value="1">Plongeur</option>
                <option value="securitedesurface">Sécurité de surface</option>
                <option value="directeur">Directeur</option>
            </select>

        <br/>
        <br/>

        <div style="display:none;" id="divAptitude">
            <label for="Aptitude">Aptitude du plongeur : </label>
            <select class="browser-default" name="aptitudeplongeur">

                <?php
                require_once('bddPlongee.php');
                $reqAfficherAptitude = "SELECT * FROM PLO_APTITUDE";
                $bdd = new bddPlongee();
                $res = $bdd->exec($reqAfficherAptitude);

                for($i = 0; $i<sizeof($res); $i++){
                    $aptitudecode = $res[$i][0];
                    $aptitudelibelle = $res[$i][1];
                    echo "<option value='$aptitudecode'>$aptitudelibelle</option><br/>";
                }




                ?>



            </select>
        </div>


        <br/>
        <br/>

        <button class="btn waves-effect waves-light" type="submit" name="action">Valider
         <i class="material-icons right">send</i>
        </button>
      </fieldset>
  </form>
  <script type="text/javascript">
      function THEFUNCTION(i) {
          var divAptitude = document.getElementById('divAptitude');
          switch(i) {
              case 1 : divAptitude.style.display = ''; break;
              default: divAptitude.style.display = 'none'; break;
          }
      }
  </script>
  </body>
</html>
