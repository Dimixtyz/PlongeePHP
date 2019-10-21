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

                <label>Profondeur maximum (en mètres) : </label>
                <p class="range-field">
                    <input type="range" id="profondeurMax" min="0" max="100" />
                </p>

                <label>Temps fond maximum (en minutes) : </label>
                <p class="range-field">
                    <input type="range" id="TempsFondMax" min="0" max="60" />
                </p>

                <label>Horaire d'immersion : </label>
                <input type="time" name="immersion"><br/><br/>

                <button class="btn waves-effect waves-light" type="submit" name="action">Valider
                    <i class="material-icons right">send</i>
                </button>
                <button class="btn waves-effect waves-light" type="reset" name="action">Effacer
                    <i class="material-icons right">clear</i>
                </button>
            </fieldset>

            <fieldset style="width:800px; margin-left: auto; margin-right: auto;">
                <legend>Palanquée après la plongée</legend><br/>

                <label>Heuraire d'émersion : </label>
                <input type="time" name="sortie">

                <label>Profondeur maximum realisé : </label>
                <p class="range-field">
                    <input type="range" id="profondeurMaxReel" min="0" max="100" />
                </p>

                <label>Temps fond maximum réalisé : </label>
                <p class="range-field">
                    <input type="range" id="TempsFondMaxReel" min="0" max="60" />
                </p><br><br/>

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