<?php
  include("bddPlongee.php");

  $bdd = new bddPlongee();

  $idPlongeeASupp = $_GET['id'];
  $req="DELETE FROM PLO_PERSONNE WHERE PER_NUM = $idPlongeeASupp";

  $bdd->inserer($req);

  header("Location: ../frontend/requete_rechercher.php");
  exit();

?>