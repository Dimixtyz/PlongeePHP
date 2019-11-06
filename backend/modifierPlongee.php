<?php
include "../backend/bddPlongee.php";
$bdd = new bddPlongee();

$date = $_GET['date'];
$seance= "'".$_GET['seance']."'";




if (isset($_POST['numSite'], $_POST['effectifB'], $_POST['directeurdeplongee'], $_POST['securitedesurface'],$_POST['type_embarcation'])){
    $numsite = "'".$_POST['numSite']."'";

    $typeembarcation = "'".$_POST['type_embarcation']."'";


    $effectifdebateau = "'".$_POST['effectifB']."'";

    $numDirecteurDePlongee = "'".$_POST['directeurdeplongee']."'";

    $numSecuriteDeSurface = "'".$_POST['securitedesurface']."'";




    $reqPlongee = "UPDATE PLO_PLONGEE SET SIT_NUM = $numsite, EMB_NUM = $typeembarcation, PER_NUM_DIR = $numDirecteurDePlongee , PER_NUM_SECU = $numSecuriteDeSurface, PLO_EFFECTIF_BATEAU = $effectifdebateau WHERE PLO_DATE = $date AND PLO_MAT_MID_SOI =$seance";


    try
    {
        $bdd->inserer($reqPlongee);
        echo "on a bien modifé";
    }
    catch(PDOException $e){

    }


    //header('Location: ../frontend/formPalanquee.php?dateplo='.$dateplongee.'&heure='.$seance.'&numPal='.$nombrePalanquee);
   // exit();


}else{
    echo "Infos manquantes";
}






?>
