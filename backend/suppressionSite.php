<?php
include_once "bddPlongee.php";

if (isset($_POST['numSite'])){

    $bdd = new bddPlongee();

    $numSite = $_POST['numSite'];
    $reqSupp = "DELETE FROM PLO_SITE WHERE SIT_NUM = $numSite";

    $bdd->inserer($reqSupp);

    header('Location: ../frontend/recherche_site.php');
    exit();


}else{
    echo "pas de num de Site !";
}