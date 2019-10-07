<?php
include "bddPlongee.php";
$bdd = new bddPlongee();

$questcequoninsert = 'rien';

$reqderniernumutilisateur = "select PER_NUM from PLO_PERSONNE where rownum=1 order by PER_NUM desc";
$rep = $bdd->exec($reqderniernumutilisateur);
$dernierUtil = $rep[0]['PER_NUM'];


if(isset($_POST['nom'])&& $_POST['nom']!=""){
    $nom = "'".$_POST['nom']."'";
}

if(isset($_POST['prenom'])&& $_POST['prenom']!=""){
    $prenom = "'".$_POST['prenom']."'";
}

if(isset($_POST['statut'])&&$_POST['statut']!="aucun"){
    $statut = "'".$_POST['statut']."'";
}

if(isset($_POST['aptitudeplongeur'])){
    $aptitudeplongeur = "'".$_POST['aptitudeplongeur']."'";
}


if(isset($nom,$prenom,$statut)){

    $PERNUM = $dernierUtil+1 ;
    $reqInsertionPerso = "insert into PLO_PERSONNE values ($PERNUM,$nom,$prenom)";
    $bdd->exec(req);

}

if(isset($aptitudeplongeur) && $statut == "plongeur"){
    $reqInsererPlongeur = "insert into PLO_PLONGEUR values ($PERNUM,$aptitudeplongeur)";

}else if($statut == "securitedesurface"){
    $reqInsererSecuriteDeSurface = "insert into PLO_PLONGEUR values ($PERNUM,$aptitudeplongeur)";
}







?>
