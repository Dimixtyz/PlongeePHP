<?php
include "bddPlongee.php";
$bdd = new bddPlongee();

$eleveinserer = false;

echo "<pre>";
print_r($_POST['statut']);
echo "</pre>";

$rep = $bdd->exec($reqderniernumutilisateur);
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
if (isset($_POST['id'])){
    $id = $_POST['id'];
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
            $reqInsertionPerso = "UPDATE PLO_PERSONNE SET PER_NOM = $nom, PER_PRENOM = $prenom WHERE PER_NUM = $id";
            $bdd->inserer($reqInsertionPerso);
            $eleveinserer = true;
        }else{
            echo "Cet élève existe déjà !!!";
        }

    }

    for($i=0 ; $i<sizeof($statut);$i++){
        if($eleveinserer){

            $reqSupp = "DELETE FROM PLO_SECURITE_DE_SURFACE WHERE PER_NUM = $id";
            $bdd->inserer($req);
            $reqSupp = "DELETE FROM PLO_DIRECTEUR WHERE PER_NUM = $id";
            $bdd->inserer($req);
            $reqSupp = "DELETE FROM PLO_PLONGEUR WHERE PER_NUM = $id";
            $bdd->inserer($req);

            if($statut[$i]=="securitedesurface"){
                $req =  "insert into PLO_SECURITE_DE_SURFACE(PER_NUM) values ($id)";
                $bdd->inserer($req);
            }else if($statut[$i]=="directeur"){
                $req =  "insert into PLO_DIRECTEUR(PER_NUM) values ($id)";
                $bdd->inserer($req);
            }else if($statut[$i]=="plongeur" && isset($_POST['aptitudeplongeur'])){
                $req = "insert into PLO_PLONGEUR(PER_NUM,APT_CODE) values ($id,$aptitudeplongeur)";
                $bdd->inserer($req);

            }

        }



    }

}else{
    echo "VOUS DEVEZ CHOISIR UN STATUT !!";
}





?>
