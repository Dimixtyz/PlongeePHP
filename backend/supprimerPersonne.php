<?php
  include("bddPlongee.php");

  $bdd = new bddPlongee();

  $idPlongeeASupp = $_GET['id'];
  $req="DELETE FROM PLO_PERSONNE WHERE PLO_NUM = $idSyllabusASupp";

  $bdd->inserer($req);

  header("Location: ../frontend/requete_rechercher.php");
  exit();

?>