<?php


include_once "bddPlongee.php";

$bdd = new bddPlongee();

if (isset($_POST['datePlo'], $_POST['periodePlongee'], $_POST['idPal'])) {

    $ploDate = "'" . $_POST['datePlo'] . "'";
    $ploPeriode = "'" . $_POST['periodePlongee'] . "'";
    $idPal = "'" . $_POST['idPal'] . "'";

    $reqSuppConcerner = "DELETE FROM PLO_CONCERNER WHERE PLO_DATE = $ploDate AND PLO_MAT_MID_SOI = $ploPeriode AND PAL_NUM = $idPal";
    $bdd->inserer($reqSuppConcerner);

    $reqSuppPal = "DELETE FROM PLO_PALANQUEE WHERE PLO_DATE = $ploDate AND PLO_MAT_MID_SOI = $ploPeriode AND PAL_NUM = $idPal";
    $bdd->inserer($reqSuppPal);

?>





    <?php


    exit();


}else{
    echo "Champs incomplets";
}