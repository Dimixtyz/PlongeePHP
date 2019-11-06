<?php
include_once "bddPlongee.php";

if (isset($_POST['nomsite'], $_POST['localisationsite'])) {
    $bdd = new bddPlongee();

    $nomMaj = "'".strtoupper($_POST['nomsite'])."'";

    $reqVerificationNom = "SELECT * FROM PLO_SITE WHERE upper(SIT_NOM) = $nomMaj";
    $reqVerificationNom = $bdd->exec($reqVerificationNom);

    if (empty($reqVerificationNom)) {


        $reqdernierSite = "select SIT_NUM from PLO_SITE order by SIT_NUM desc LIMIT 1";
        $reqdernierSite = $bdd->exec($reqdernierSite);

        if (!empty($reqdernierSite)) {
            $derniereSite = $reqdernierSite[0]['SIT_NUM'];
            $numSite = $derniereSite + 1;
        } else {
            $numSite = 1;
        }

        $siteNom = "'" . $_POST['nomsite'] . "'";
        $sitLocalisation = "'" . $_POST['localisationsite'] . "'";

        $reqinserer = "INSERT INTO PLO_SITE (SIT_NUM, SIT_NOM, SIT_LOCALISATION) VALUES ($numSite,$siteNom,$sitLocalisation)";

        $bdd->inserer($reqinserer);

        header('Location: ../index.php');
        exit();


    } else {
        echo "Ce site existe déja ! ";
    }

}

