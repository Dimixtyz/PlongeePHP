<?php
include "header.php";
?>

<!DOCTYPE html>
<html ng-app>

    <head>
        <title>Accueil</title>
        <link rel="stylesheet" type="text/css" href="/frontend/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    </head>

    <body>
        <!--<div class="slider">
            <ul class="slides">
                <li>
                    <img src="https://cdn.pixabay.com/photo/2013/02/09/04/33/sea-79606_960_720.jpg">
                    <div class="caption right-align">
                        <h1 class="yellow-text text-lighten-3">Site de gestion de plongée</h1>
                        <h4 class="light yellow-text text-lighten-3">Un site ergonomique et complet !</h4>
                    </div>
                </li>
                <li>
                    <img src="https://cdn.pixabay.com/photo/2014/10/28/00/01/shark-506025_960_720.jpg">
                    <div class="caption left-align">
                        <h1 class="yellow-text text-lighten-3">Gestion de personne et plongée</h1>
                        <h4 class="light yellow-text text-lighten-3">mais aussi une création de sites ou d'embarations</h4>
                    </div>
                </li>
            </ul>
        </div>

        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.slider').slider({full_width: true});
            });
        </script> -->

        <br/>
        <br/>
        <br/>
        

        <div class="backback">
            <div class="row" id="range1">
                <div class="col s12 m6 l3" id="cadre1"> 
                    <p class="titre1">PLONGÉE</p>
                </div>
                <div class="col s12 m6 l3" id="cadre1"> 
                    <p class="titre1">PERSONNE</p>
                </div>
                <div class="col s12 m6 l3" id="cadre1"> 
                    <p class="titre1">SITE</p>
                </div>
                <div class="col s12 m6 l3" id="cadre1"> 
                    <p class="titre1">EMBARCATION</p>
                </div>
            </div>



            <div class="row" id="range2">
                <div class="col s12 m6 l3" id="cadre2">
                    <div class="bouton1">
                        <a id="texteBouton" class="waves-effect waves-light btn lime lighten-2" href="/frontend/recherche_plongee.php">Recherche plongée</a>
                    </div>
                </div>
                <div class="col s12 m6 l3" id="cadre2">
                    <div class="bouton2">
                        <a id="texteBouton" class="waves-effect waves-light btn lime lighten-2" href="/frontend/recherche_personne.php">Personne</a>
                    </div>      
                </div>
                <div class="col s12 m6 l3" id="cadre2">
                    <div class="bouton3">
                        <a id="texteBouton" class="waves-effect waves-light btn lime lighten-2"  href="/frontend/recherche_personne.php">Ajouter Site</a>
                    </div>      
                </div>
                <div class="col s12 m6 l3" id="cadre2">
                    <div class="bouton4">
                        <a id="texteBouton" class="waves-effect waves-light btn lime lighten-2" href="/frontend/recherche_personne.php">Ajouter embarcation</a>
                    </div>      
                </div>
            </div>
        </div>
          



        <br/>
        <br/>
    </body>

</html>

