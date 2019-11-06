<?php
include "../header.php";
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta content="text/html; charset=UTF-8" http-equiv="content-type"/>
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
  <form id="formInscription" action="../backend/insererPersonne.php" method="post" enctype="multipart/form-data">
	  <fieldset style="width:800px; margin-left: auto; margin-right: auto;">
        <legend>Inscription personne</legend>
        <br/>

        <div class="input-field col s6">
            <i class="material-icons prefix">account_circle</i>
            <input id="nom" type="text" name="nom" class="validate">
            <label for="nom">Nom : </label>
        </div>

        <br/>

        <div class="input-field col s6">
            <i class="material-icons prefix">account_circle</i>
            <input id="prenom" type="text" name="prenom" class="validate">
            <label for="prenom">Prénom : </label>
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
            <select class="browser-default" id="aptitudeplongeur" name="aptitudeplongeur">

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



            </select><br>
        </div>

          <div>
              Certificat médical :<br/>
              <input type="file" name="certificat" id="certificat">
          </div>


        <br/>
        <br/>

          <br>

        <button class="btn waves-effect waves-light green lighten-1" style="border-radius:10px;" type="submit" name="action">Valider
         <i class="material-icons right">send</i>
        </button>
        <button class="btn waves-effect waves-light red lighten-1" style="border-radius:10px;" type="reset" name="action">Effacer
            <i class="material-icons right">clear</i>
        </button>
        <button class="btn waves-effect waves-light grey darken-4" style="border-radius:10px;" value = "Retour"  onclick = "history.back()" style="margin:auto">
                Retour
        </button>
      </fieldset>
  </form>
  <br>
  <div id="divMsgErreur"></div>


  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script type="javascript">

      timeout = null;
      document.addEventListener('DOMContentLoaded', function() {
          document.getElementsByTagName('form')[0].addEventListener('submit', (e) => {
              e.preventDefault();

              let form = e.target;

              fetch(form.action, { method: form.method, body: new FormData(form) })
                  .then(response => response.json())
                  .then(json => {
                      clearTimeout(timeout);
                      document.getElementById("divMsgErreur").innerHTML=json.text;
                      timeout = setTimeout(() => document.getElementById("divMsgErreur").innerHTML="", 3000);
                  });

              return false;
          });
      });

  </script>

  </body>
</html>
