<?php
include "../header.php";
include_once "../backend/bddPlongee.php";

$bdd = new bddPlongee();


?>
<br/>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Formulaire palanquée</title>
    </head>
    <body>

        <form method="post">
            <fieldset style="width:800px; margin-left: auto; margin-right: auto;">
                <legend>Ajout de personne à la palanquée</legend><br/>









            </fieldset>



	        <fieldset style="width:800px; margin-left: auto; margin-right: auto;">
                <legend>Palanquée avant la plongée</legend><br/>

                <label>Profondeur maximum (en mètres) :</label><input type="number" name="profmaxavant">
                <label>Temps fond maximum (en minutes) : </label><input type="number" name="tempsfondmaxavant">
                <label>Horraire d'immersion (en min) : </label><input type="number" name="tempsimmersionavant">



                <button class="btn waves-effect waves-light" type="submit" name="action">Valider
                    <i class="material-icons right">send</i>
                </button>
                <button class="btn waves-effect waves-light" type="reset" name="action">Effacer
                    <i class="material-icons right">clear</i>
                </button>
            </fieldset>

            <fieldset style="width:800px; margin-left: auto; margin-right: auto;">
                <legend>Palanquée après la plongée</legend><br/>

                <label>Profondeur maximum (en mètres) :</label><input type="number" name="profmaxapres">
                <label>Temps fond maximum (en minutes) : </label><input type="number" name="tempsfondmaxapres">
                <label>Horraire d'immersion (en min) : </label><input type="number" name="tempsimmersionapres">

                <br><br/>

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