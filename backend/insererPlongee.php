<?php
include("bddPlongee.php");
$bdd = new bddPlongee();


if(isset($_POST['dateplongee'])){
    $dateplongee = $_POST['dateplongee'];

}

if(isset($_POST['seance'])){
    if($_POST['seance']=="matin"){
        $seance = '1';

    }elseif($_POST['seance']=="apresmidi"){
        $seance = '2';

    }elseif ($_POST['seance']=="soir"){
        $seance='3';
    }


}


if (isset($_POST['numSite'], $_POST['effectifP'], $_POST['effectifB'], $_POST['directeurdeplongee'], $_POST['securitedesurface'], $_POST['nombrePal'], $seance, $dateplongee)){
$numsite = $_POST['numSite'];

$typeembarcation = $_POST['type_embarcation'];

$effectifdeplongeur = $_POST['effectifP'];

$effectifdebateau = $_POST['effectifB'];

$numDirecteurDePlongee = $_POST['directeurdeplongee'];

$numSecuriteDeSurface = $_POST['securitedesurface'];

$nombrePalanquee = $_POST['nombrePal'];



$reqPlongee = "INSERT INTO PLO_PLONGEE (PLO_DATE, PLO_MAT_MID_SOI, SIT_NUM, EMB_NUM, PER_NUM_DIR, PER_NUM_SECU, PLO_EFFECTIF_PLONGEURS, PLO_EFFECTIF_BATEAU, PLO_NB_PALANQUEES) VALUES ('".$dateplongee."', '".$seance."', '".$numsite."', '".$typeembarcation."', '".$numDirecteurDePlongee."', '".$numSecuriteDeSurface."', '".$effectifdeplongeur."', '".$effectifdebateau."', '".$nombrePalanquee."')";


try
{
    $bdd->inserer($reqPlongee);
}
catch(PDOException $e){

}


header('Location: ../frontend/formPalanquee.php?dateplo='.$dateplongee.'&heure='.$seance.'&numPal='.$nombrePalanquee);
exit();


}else{
    echo "Infos manquantes";
}



?>

