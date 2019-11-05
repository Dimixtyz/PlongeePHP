<?php
include_once "bddPlongee.php";
include_once "TestNom.php";
header('Content-type: application/json');
$reponse = array();

$bdd = new bddPlongee();

$eleveinserer = false;

$reqderniernumutilisateur = "select PER_NUM from PLO_PERSONNE order by PER_NUM desc LIMIT 1";
$rep = $bdd->exec($reqderniernumutilisateur);
$dernierUtil = $rep[0]['PER_NUM'];

$oninsereoupas = false ;


function peutOnInserer(&$pre,&$no){
    $bdd = new bddPlongee();


    if (VerificationNom($no) && VerificationPrenom($pre)) {

        $nomRecherche = "'" . strtoupper($no) . "'";
        $prenomRecherche = "'" . strtoupper($pre) . "'";

        $req = "SELECT COUNT(*) FROM PLO_PERSONNE WHERE upper(PER_NOM) = $nomRecherche AND upper(PER_PRENOM) = $prenomRecherche";


        $res = $bdd->exec($req);
        if ($res[0][0] > 0) {
            $reponse = "Cet utilisateur existe deja";
            envoiJSON($reponse);
            return false;
        } else {
            return true;
        }
    }else{
        $reponse = "Nom ou prenom inadapte";
        envoiJSON($reponse);
        return false;
    }
}

if(isset($_POST['nom'])&& $_POST['nom']!=""){
    $nom = $_POST['nom'];
}else{
    $reponse = "Champ nom incomplet";
    envoiJSON($reponse);
}

if(isset($_POST['prenom'])&& $_POST['prenom']!=""){
    $prenom = $_POST['prenom'];
}else{
    $reponse = "Champ prenom incomplet";
    envoiJSON($reponse);
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

            $prenom = "'".$prenom."'";
            $nom = "'".$nom."'";
            $reqInsertionPerso = "insert into PLO_PERSONNE(PER_NUM, PER_NOM, PER_PRENOM) values ($PERNUM,$nom,$prenom)";
            $bdd->inserer($reqInsertionPerso);
            $eleveinserer = true;

            if (!empty($_POST['certificat'])){
                $reqCertificat = "UPDATE PLO_PERSONNE SET PER_DATE_CERTIF_MED = SYSDATE() WHERE PER_NUM = $PERNUM";
                $bdd->inserer($reqCertificat);
            }


        }else{
            $reponse = "Impossible d ajouter cet utilisateur";
            envoiJSON($reponse);
        }

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

    $reponse = "Utilisateur bien ajoute";
    envoiJSON($reponse);

}else{
    $reponse = "Impossible d ajouter cet utilisateur";
    envoiJSON($reponse);
}

function envoiJSON($var) {
    $myJson = json_encode($var);
    echo $myJson;
    exit();
}


?>
