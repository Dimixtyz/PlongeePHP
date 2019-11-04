<?php
include("bddPlongee.php");
$bdd = new bddPlongee();

if(isset($_POST['nomsite'])&& !empty($_POST['nomsite'])){
    $nomdusite = $_POST['nomsite'];

}
if(isset($_POST['localisationsite']) && !empty($_POST['localisationsite'])){

    $localisationsite = $_POST['localisationsite'];

}

if(isset($nomdusite) && isset($localisationsite)){
    $reqderniersite = "select SIT_NUM from PLO_SITE order by SIT_NUM desc LIMIT 1";
    $rep = $bdd->exec($reqderniersite);

    if(!empty($rep)){
        $dernierSite = $rep[0]['SIT_NUM'];
        $numsite = $dernierSite+1;

    }else{
        $numsite = 1;
    }

    $sitnom = "'".$nomdusite."'" ;
    $sitlocalisation = "'".$localisationsite."'";
    $reqinserer = "INSERT INTO PLO_SITE (SIT_NUM, SIT_NOM, SIT_LOCALISATION) VALUES ($numsite,$sitnom,$sitlocalisation)";

    $bdd->inserer($reqinserer);

}


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





$typeembarcation = $_POST['type_embarcation'];

$effectifdeplongeur = $_POST['effectifP'];

$effectifdebateau = $_POST['effectifB'];

$numDirecteurDePlongee = $_POST['directeurdeplongee'];

$numSecuriteDeSurface = $_POST['securitedesurface'];

$nombrePalanquee = $_POST['nombrePal'];

$tempsprevu = $_POST['tempsprevu'];

$profondeurprevu= $_POST['profprevue'];

$reqPlongee = "INSERT INTO PLO_PLONGEE (PLO_DATE, PLO_MAT_MID_SOI, SIT_NUM, EMB_NUM, PER_NUM_DIR, PER_NUM_SECU, PLO_EFFECTIF_PLONGEURS, PLO_EFFECTIF_BATEAU, PLO_NB_PALANQUEES) VALUES ('".$dateplongee."', '".$seance."', '".$numsite."', '".$typeembarcation."', '".$numDirecteurDePlongee."', '".$numSecuriteDeSurface."', '".$effectifdeplongeur."', '".$effectifdebateau."', '".$nombrePalanquee."')";


$reqdernierpal = "select PAL_NUM from PLO_PALANQUEE order by PAL_NUM desc LIMIT 1";
$repDernierePal = $bdd->exec($reqdernierpal);



if(sizeof($repDernierePal)==0){
    $repDernierePal = 1 ;
}else{
    $repDernierePal = $repDernierePal[0]['PAL_NUM']+1;
}



try
{
    $bdd->inserer($reqPlongee);
}
catch(PDOException $e){
    echo $e->getTraceAsString();
    echo $e->getMessage();
}

$reqPalanque = "INSERT INTO PLO_PALANQUEE(PLO_DATE,PLO_MAT_MID_SOI, PAL_NUM,PAL_PROFONDEUR_PREVU,PAL_DUREE_PREVUE) VALUES ('".$dateplongee."', '".$seance."', '".$repDernierePal."','".$profondeurprevu."', '".$tempsprevu."')";
try
{
    $bdd->inserer($reqPalanque);
}
catch(PDOException $e){
    echo $e->getTraceAsString();
    echo $e->getMessage();
}

$elevePal1 = $_POST['elevepal1'];
for($i=0; $i < 5 ; $i++){
    if($elevePal1[$i]!="choisir"){
        $reqAjoutElevePal = "INSERT INTO PLO_CONCERNER (PLO_DATE, PLO_MAT_MID_SOI, PAL_NUM, PER_NUM) VALUES ('".$dateplongee."','".$seance."','".$repDernierePal."','".$elevePal1[$i]."')";
        try
        {
            $bdd->inserer($reqAjoutElevePal);
        }
        catch(PDOException $e){
            echo $e->getTraceAsString();
            echo $e->getMessage();
        }
    }

}


//header('Location: ../frontend/recherche_plongee.php');
//exit();


?>

