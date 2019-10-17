<?php
include "bddPlongee.php";
$bdd = new bddPlongee();

echo "<pre>";
print_r($_POST['statut']);
echo "</pre>";

$reqderniernumutilisateur = "select PER_NUM from PLO_PERSONNE order by PER_NUM desc LIMIT 1";
$rep = $bdd->exec($reqderniernumutilisateur);
$dernierUtil = $rep[0]['PER_NUM'];

$oninsereoupas = false ;


function peutOnInserer($pre,$no){
    $bdd = new bddPlongee();

    $req = "SELECT COUNT(*) FROM `PLO_PERSONNE` WHERE upper(PER_NOM) = $no AND upper(PER_PRENOM) = $pre ";
    $res=$bdd->exec($req);
    if($res[0][0]>0){
        return false;
    }else{
        return true;
    }




}

if(isset($_POST['nom'])&& $_POST['nom']!=""){
    $nom = "'".$_POST['nom']."'";
}

if(isset($_POST['prenom'])&& $_POST['prenom']!=""){
    $prenom = "'".$_POST['prenom']."'";
}

if(isset($_POST['statut'])){
    $statut = $_POST['statut'];
}

if(isset($_POST['aptitudeplongeur'])){
    $aptitudeplongeur = "'".$_POST['aptitudeplongeur']."'";
}





if(isset($statut)&& sizeof($statut)>0){
    if(isset($nom,$prenom)){
        if(peutOnInserer($prenom,$nom)){
            $PERNUM = $dernierUtil+1 ;
            $reqInsertionPerso = "insert into PLO_PERSONNE values ($PERNUM,$nom,$prenom)";
            $bdd->inserer($reqInsertionPerso);
        }else{
            echo "Cet élève existe déjà !!!";
        }

    }

    for($i=0 ; $i<sizeof($statut);$i++){
        if($statut[$i]=="securitedesurface"){
            $req =  "insert into PLO_SECURITE_DE_SURFACE(PER_NUM) values ($PERNUM)";
            $bdd->inserer($req);
        }else if($statut[$i]=="directeur"){
            $req =  "insert into PLO_DIRECTEUR(PER_NUM) values ($PERNUM)";
            $bdd->inserer($req);
        }else if($statut[$i]=="plongeur" && isset($_POST['aptitudeplongeur'])){
            $req = "insert into PLO_PLONGEUR(PER_NUM,APT_CODE) values ($PERNUM,$aptitudeplongeur)";
            $bdd->inserer($req);

        }


    }

}else{
    echo "VOUS DEVEZ CHOISIR UN STATUT !!";
}








?>
