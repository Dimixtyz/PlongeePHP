<?php
include "bddPlongee.php";
$bdd = new bddPlongee();

$eleveinserer = false;



function peutOnInserer($pre,$no){
    $bdd = new bddPlongee();

    $req = "SELECT PER_NOM, PER_PRENOM FROM PLO_PERSONNE WHERE upper(PER_NOM) = $no AND upper(PER_PRENOM) = $pre ";
    $res=$bdd->exec($req);
    if(!empty($res) && $_POST['nom'] != $res[0]['PER_NOM'] && $_POST['prenom'] != $res[0]['PER_PRENOM']){
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


if(isset($nom,$prenom)){
    if(peutOnInserer($prenom,$nom)){
        $reqInsertionPerso = "UPDATE PLO_PERSONNE SET PER_NOM = $nom, PER_PRENOM = $prenom WHERE PER_NUM = $id";
        $bdd->inserer($reqInsertionPerso);
        $eleveinserer = true;
    }else{
        echo "Cet élève existe déjà !!!";
    }

}


if(isset($statut)&& sizeof($statut)>0){

    $reqEstIlDirectreur = "SELECT COUNT(*) as NUM_PER FROM `PLO_DIRECTEUR` WHERE PER_NUM = $id";
    $repEstIlDirecteur = $bdd->exec($reqEstIlDirectreur);

    if($repEstIlDirecteur[0]['NUM_PER']==1){
        $estDirecteur= true;
    }else{
        $estDirecteur= false;
    }

    $reqEstIlSecuriteDeSurface = "SELECT COUNT(*) as NUM_PER FROM `PLO_SECURITE_DE_SURFACE` WHERE PER_NUM = $id";
    $repEstIlSecuriteDeSurface = $bdd->exec($reqEstIlSecuriteDeSurface);
    if($repEstIlSecuriteDeSurface[0]['NUM_PER']==1){
        $estSecuriteDeSurface= true;
    }else{
        $estSecuriteDeSurface= false;
    }

    $reqEstIlPlongeur = "SELECT COUNT(*) as NUM_PER,APT_CODE FROM `PLO_PLONGEUR` WHERE PER_NUM = $id";
    $repEstIlPlongeur = $bdd->exec($reqEstIlPlongeur);
    if($repEstIlPlongeur[0]['NUM_PER']==1){
        $estPlongeur= true;
    }else{
        $estPlongeur= false;
    }

    $cptDir = false;
    $cptPlongeur = false;
    $cptSec = false;



    for($i=0 ; $i<sizeof($statut);$i++){

        if($statut[$i]=="securitedesurface" && $estSecuriteDeSurface==false){
            $req =  "insert into PLO_SECURITE_DE_SURFACE(PER_NUM) values ($id)";
            $bdd->inserer($req);
        }else if($statut[$i]=="directeur" && $estDirecteur==false){
            $req =  "insert into PLO_DIRECTEUR(PER_NUM) values ($id)";
            $bdd->inserer($req);
        }else if($statut[$i]=="plongeur" && isset($_POST['aptitudeplongeur']) && $estPlongeur==false){
            $req = "insert into PLO_PLONGEUR(PER_NUM,APT_CODE) values ($id,$aptitudeplongeur)";
            $bdd->inserer($req);

        }else if($statut[$i]=="plongeur" && isset($_POST['aptitudeplongeur']) && $estPlongeur){
            $req = "UPDATE `PLO_PLONGEUR` SET `APT_CODE` = $aptitudeplongeur WHERE PER_NUM = $id";
            $bdd->inserer($req);
        }

        if($statut[$i]=="directeur"){
            $cptDir=true;
        }
        if($statut[$i]=="securitedesurface"){
            $cptSec=true;
        }
        if($statut[$i]=="plongeur"){
            $cptPlongeur = true;
        }


    }

        if($estPlongeur && $cptPlongeur==false){
            try{
                $reqSupp = "DELETE FROM PLO_PLONGEUR WHERE PER_NUM = $id";
                $bdd->inserer($reqSupp);
            }catch (PDOException $e){

            }
        }

        if($estSecuriteDeSurface && $cptSec==false){
            try{
                $reqSupp = "DELETE FROM PLO_SECURITE_DE_SURFACE WHERE PER_NUM = $id";
                $bdd->inserer($reqSupp);
            }catch(PDOException $e){

            }
        }

        if($estDirecteur && $cptDir==false){
            try{
                $reqSupp = "DELETE FROM PLO_DIRECTEUR WHERE PER_NUM = $id";
                $bdd->inserer($reqSupp);
            }catch (PDOException $e){

            }
        }


    if (!empty($_POST['certificat'])){
        $reqCertificat = "UPDATE PLO_PERSONNE SET PER_DATE_CERTIF_MED = SYSDATE() WHERE PER_NUM = $id";
        $bdd->inserer($reqCertificat);
    }






}else{
    //echo "VOUS DEVEZ CHOISIR UN STATUT !!";
}

header("Location: ../frontend/recherche_personne.php");
exit();

?>
