<?php
include_once "bddPlongee.php";

if(isset($_POST['nomEmb'])){

    $bdd = new bddPlongee();

    $nomMaj = strtoupper($_POST['nomEmb']);
    $reqVerificationNom = "SELECT * FROM PLO_EMBARCATION WHERE upper(EMB_NOM) = $nomMaj";
    $reqVerificationNom = $bdd->exec($reqVerificationNom);

    if (empty($reqVerificationNom)) {


        $reqderniereEmb = "select EMB_NUM from PLO_EMBARCATION order by EMB_NUM desc LIMIT 1";
        $reqderniereEmb = $bdd->exec($reqderniereEmb);

        if (!empty($reqderniereEmb)) {
            $derniereEmb = $reqderniereEmb[0]['EMB_NUM'];
            $numEmb = $derniereEmb + 1;
        } else {
            $numEmb = 1;
        }

        $embNom = "'" . $_POST['nomEmb'] . "'";

        $reqinserer = "INSERT INTO PLO_EMBARCATION (EMB_NUM, EMB_NOM) VALUES ($numEmb,$embNom)";

        $bdd->inserer($reqinserer);

        header('Location: ../index.php');
        exit();



    }else{
        echo "Cette embarcation existe déja";
    }

}


