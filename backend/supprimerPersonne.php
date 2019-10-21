<?php
  include("bddPlongee.php");

  $bdd = new bddPlongee();

  $numpersonne= $_GET['id'];



$reqPlongeur = "SELECT * FROM PLO_PLONGEUR WHERE PER_NUM =$numpersonne" ;
$reqDirecteur = "SELECT * FROM PLO_DIRECTEUR WHERE PER_NUM =$numpersonne" ;
$reqSecurite = "SELECT * FROM PLO_SECURITE_DE_SURFACE WHERE PER_NUM =$numpersonne";

$repPlongeur=$bdd->exec($reqPlongeur);
$repDirecteur=$bdd->exec($reqDirecteur);
$repSecurite=$bdd->exec($reqSecurite);

try{

    if(sizeof($repSecurite)>0){
        $reqsuppS="DELETE FROM PLO_SECURITE_DE_SURFACE WHERE PER_NUM = $numpersonne ";
        $bdd->inserer($reqsuppS);

    }

    if(sizeof($repDirecteur)>0){
        $reqsuppD="DELETE FROM PLO_DIRECTEUR WHERE PER_NUM = $numpersonne";
        $bdd->inserer($reqsuppD);

    }

    if(sizeof($repPlongeur)>0){
        $reqsuppP="DELETE FROM PLO_PLONGEUR WHERE PER_NUM = $numpersonne";
        $bdd->inserer($reqsuppP);

    }



    $requ="DELETE FROM PLO_PERSONNE WHERE PER_NUM = $numpersonne";

    $bdd->inserer($requ);

    header("Location: ../frontend/recherche_personne.php");
    exit();


}catch (PDOException $e){
    echo "Impossible de supprimer cette personne car elle est présente dans une plongée ! ";
}





?>