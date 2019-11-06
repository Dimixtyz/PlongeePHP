<?php
include_once "bddPlongee.php";
include_once "TestNom.php";

$bdd = new bddPlongee();

$eleveinserer = false;

$reqderniernumutilisateur = "select PER_NUM from PLO_PERSONNE order by PER_NUM desc LIMIT 1";
$rep = $bdd->exec($reqderniernumutilisateur);
$dernierUtil = $rep[0]['PER_NUM'];

$oninsereoupas = false ;


function peutOnInserer(&$pre,&$no){
    $bdd = new bddPlongee();

    if(strlen($pre)>= 30 || strlen($no)>=30){
        echo "Nom ou prenom trop long !\n";
        return false;
    }

    if (VerificationNom($no) && VerificationPrenom($pre)) {

        $nomRecherche = "'" . strtoupper($no) . "'";
        $prenomRecherche = "'" . strtoupper($pre) . "'";

        $req = "SELECT COUNT(*) FROM PLO_PERSONNE WHERE upper(PER_NOM) = $nomRecherche AND upper(PER_PRENOM) = $prenomRecherche";

        $res = $bdd->exec($req);
        if ($res[0][0] > 0) {
            return false;
        } else {
            return true;
        }
    }

}

if(isset($_POST['nom'])&& $_POST['nom']!=""){
    $nom = $_POST['nom'];
}

if(isset($_POST['prenom'])&& $_POST['prenom']!=""){
    $prenom = $_POST['prenom'];
}

if(isset($_POST['statut'])){
    $statut = $_POST['statut'];
}

if(isset($_POST['aptitudeplongeur'])){
    $aptitudeplongeur = "'".$_POST['aptitudeplongeur']."'";
}





if(isset($statut, $nom, $prenom)&& sizeof($statut)>0){

    if(peutOnInserer($prenom,$nom)){
        $PERNUM = $dernierUtil+1 ;

        $prenom = "'".$prenom."'";
        $nom = "'".$nom."'";
        $reqInsertionPerso = "insert into PLO_PERSONNE(PER_NUM, PER_NOM, PER_PRENOM) values ($PERNUM,$nom,$prenom)";
        $bdd->inserer($reqInsertionPerso);
        $eleveinserer = true;
    }else{
        echo "Impossible d'inserer cet utilisateur";
    }


    for($i=0 ; $i<sizeof($statut);$i++){
        if($eleveinserer){


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

    }

    if (!empty($_POST['certificat'])){
        $reqCertificat = "UPDATE PLO_PERSONNE SET PER_DATE_CERTIF_MED = SYSDATE() WHERE PER_NUM = $PERNUM";
        $bdd->inserer($reqCertificat);
    }


    header("Location: ../frontend/recherche_personne.php");
    exit();

}else{
    echo "VOUS DEVEZ CHOISIR UN STATUT !!";
}





?>
