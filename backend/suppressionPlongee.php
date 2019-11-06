<?php
include_once "bddPlongee.php";

$bdd = new bddPlongee();

if (isset($_POST['datePlo'], $_POST['periodePlongee'])) {
    $ploDate = "'" . $_POST['datePlo'] . "'";
    $ploPeriode = "'" . $_POST['periodePlongee'] . "'";

    $reqSupprimable = "SELECT * FROM PLO_PLONGEE JOIN PLO_PALANQUEE USING (PLO_DATE, PLO_MAT_MID_SOI) WHERE PLO_DATE = $ploDate AND PLO_MAT_MID_SOI = $ploPeriode";
    $reqSupprimable = $bdd->exec($reqSupprimable);

    if (!empty($reqSupprimable)) {
        echo "Impossible de supprimer cette plongée !";
    }else{

        $reqSupp = "DELETE FROM PLO_PLONGE WHERE PLO_DATE = $ploDate AND PLO_MAT_MID_SOI = $ploPeriode";
        $bdd->inserer($reqSupp);

        header("Location: ../frontend/recherche_plongee.php");
        exit();

    }


}