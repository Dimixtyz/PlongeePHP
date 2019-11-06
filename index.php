<?php
include "header.php";
?>

<!DOCTYPE html>
<html ng-app>

    <head>
        <title>Accueil</title>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    </head>

    <body style="background-color:#eeeeee">
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
        <br/>
        <br/>
        <br/>

        <div class="row center-align">
            <div class="col s3" style="border-radius:10px;">
                <ul class="collection with-header" style="border-radius:10px;">
                    <li class="collection-header"><h4>PLONGÉE</h4></li>
                    <li class="collection-item"><div><a class="btn waves-effect waves-light green" style="border-radius:10px;" href="/frontend/recherche_plongee.php">Consulter</a></div></li>
                    <li class="collection-item"><div><a class="btn waves-effect waves-light green" style="border-radius:10px;" href="/frontend/formPlongeee.php">Ajouter</a></div></li>
                </ul>
            </div>



            <div class="col s3" style="border-radius:10px;">
                <ul class="collection with-header" style="border-radius:10px;">
                    <li class="collection-header"><h4>PERSONNE</h4></li>
                    <li class="collection-item"><div><a class="btn waves-effect waves-light green" style="border-radius:10px;" href="/frontend/recherche_personne.php">Consulter</a></div></li>
                    <li class="collection-item"><div><a class="btn waves-effect waves-light green" style="border-radius:10px;" href="/frontend/formulaire_creation_personne.php">Ajouter</a></div></li>
                </ul>
            </div>



            <div class="col s3" style="border-radius:10px;">
                <ul class="collection with-header" style="border-radius:10px;">
                    <li class="collection-header"><h4>SITE</h4></li>
                    <li class="collection-item"><div><a class="btn waves-effect waves-light green" style="border-radius:10px;" href="">Consulter</a></div></li>
                    <li class="collection-item"><div><a class="btn waves-effect waves-light green" style="border-radius:10px;" href="/frontend/formSite.php">Ajouter</a></div></li>
                </ul>
            </div>



            <div class="col s3" style="border-radius:10px;"> 
                <ul class="collection with-header" style="border-radius:10px;">
                    <li class="collection-header"><h4>EMBARCATION</h4></li>
                    <li class="collection-item"><div><a class="btn waves-effect waves-light green" style="border-radius:10px;" href="#!">Consulter</a></div></li>
                    <li class="collection-item"><div><a class="btn waves-effect waves-light green" style="border-radius:10px;" href="/frontend/formEmbarcation.php">Ajouter</a></div></li>
                </ul>
            </div>

            <br/>
            <br/>
        </div>
        <br/>
        <br/>
    </body>

</html>

