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
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular-materialize/0.2.2/angular-materialize.min.js"></script>
        <meta charset="utf-8">
        <title>Formulaire personne</title>
        <script>
            $(document).ready(function(){
                $('select').not('.disabled').formSelect();
            }); 
        </script>
        <script type="text/javascript">
            function affichageAptitude(element){
                var targetElement;
                targetElement = document.getElementById(element) ;
                if (targetElement.style.display == "none"){
                    targetElement.style.display = "" ;
                }
                else{
                targetElement.style.display = "none" ;
                }
            } 
        </script>
  </head>
  <body>
  <form method="post" action="../backend/insererPersonne.php">
	  <fieldset style="width:800px; margin-left: auto; margin-right: auto;">
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
        <label>Choisir le statut : </label>
        <div >

            <label>
                <input type="checkbox"  name="statut[]" value="plongeur" onclick="affichageAptitude('divAptitude')"/>
                <span>Plongeur</span><br>
            </label>

            <label>
                <input type="checkbox"  name="statut[]" value="securitedesurface" />
                <span>Sécurité de surface</span><br>
            </label>

            <label>
                <input type="checkbox"  name="statut[]" value="directeur" />
                <span>Directeur</span>
            </label>

        </div>
        <br/>
        <br/>

        <div id="divAptitude" style="display:none">
            <label for="Aptitude">Aptitude du plongeur : </label>
            <select class="browser-default" name="aptitudeplongeur">

                <?php
                require_once('../backend/bddPlongee.php');
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
        <button class="btn waves-effect waves-light" type="reset" name="action">Effacer
            <i class="material-icons right">clear</i>
        </button>
      </fieldset>
  </form>

  </body>
</html>
