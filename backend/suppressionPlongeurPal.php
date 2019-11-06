<?php
include_once "bddPlongee.php";

$bdd = new bddPlongee();

if (isset($_POST['datePlo'], $_POST['periodePlongee'], $_POST['idPlo'], $_POST['idPal'])) {

    $ploDate = "'" . $_POST['datePlo'] . "'";
    $ploPeriode = "'" . $_POST['periodePlongee'] . "'";
    $palId = "'".$_POST['idPal']."'";
    $perId = "'".$_POST['idPlo']."'";

    $reqSuppPlongeurPal = "DELETE FROM PLO_CONCERNER WHERE PLO_DATE = $ploDate AND PLO_MAT_MID_SOI = $ploPeriode AND PAL_NUM = $palId AND PER_NUM = $perId";
    $bdd->inserer($reqSuppPlongeurPal);




}