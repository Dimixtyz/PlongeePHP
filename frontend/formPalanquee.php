<?php
include "../header.php";
include_once "../backend/bddPlongee.php";

$bdd = new bddPlongee();

$nbrePal = $_GET['numPal'];
$dateplongee = $_GET['dateplo'];
$seance = $_GET['heure'];
$numPal = $_GET['numPal'];

echo "<form method='POST' action='../backend/ajoutPalanquee.php?dateplo=".$dateplongee."&heure=".$seance."&numPal=".$numPal."'>";

for($i=1;$i<=$nbrePal;$i++) {

    echo "<div>

        <h2>Palanquée n°".$i."</h2>
        

        <fieldset style=\"width:800px; margin - left: auto; margin - right: auto;\">
            <legend>Palanquée avant la plongée</legend><br/>

            <label>Temps prévu (en minutes) : </label><input type=\"number\" name=\"tempsprevu[]\">
            <label>Profondeur prévue (en mètres) :</label><input type=\"number\" name=\"profprevue[]\">


            <fieldset style=\"width:800px; margin - left: auto; margin - right: auto;\">
                <legend>Ajout de personne à la palanquée</legend><br/>";

    for($j=0;$j<6;$j++){
        echo "<div class=\"input - field col s12\"><select style=\"display: block\" name=\"elevepal[]\"><option value=\"choisir\">Choisissez un élève</option>";


                        $req = "SELECT * FROM PLO_PERSONNE JOIN PLO_PLONGEUR USING(PER_NUM) ORDER BY PER_NOM";
                        $rep = $bdd->exec($req);

                        if(sizeof($rep>0)){
                            for($h=0; $h<sizeof($rep);$h++){
                                echo " <option value = '".$rep[$h]['PER_NUM']."' > ".$rep[$h]['PER_NOM']." ".$rep[$h]['PER_PRENOM']." </option > ";
                            }


                        }


                   echo "</select><br></div>";


    }

    echo "</fieldset></fieldset></div><br><br><br><br>";


}

echo "<button class='btn waves-effect waves-light' type='submit' name='action'>Ajouter les ".$nbrePal." palanquées à la plongée
         <i class='material-icons right'>send</i>
        </button></form>";


?>





