<?php
include_once "bddPlongee.php";

if (isset($_POST['numEmb'])){

    $bdd = new bddPlongee();

    $numEmb = $_POST['numEmb'];
    $reqSupp = "DELETE FROM PLO_EMBARCATION WHERE EMB_NUM = $numEmb";

    $bdd->inserer($reqSupp);

    header('Location: ../frontend/recherche_embarcation.php');
    exit();


}else{
    echo "pas de num d'Embarcation !";
}