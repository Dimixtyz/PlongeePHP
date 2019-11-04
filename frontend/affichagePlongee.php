<?php
include_once "../backend/bddPlongee.php";

var_dump($_POST);

if(isset($_POST['datePlo'], $_POST['periodePlongee'])){

  $bdd = new bddPlongee();

  $datePlongee = $_POST['datePlo'];
  $periodePlongee = $_POST['periodePlongee'];

  $reqPlongee = "SELECT * FROM PLO_PLONGEE JOIN PLO_SITE USING(SIT_NUM) WHERE PLO_DATE = $datePlongee AND PLO_MAT_MID_SOI = $periodePlongee";
  $reqPalanquees = "SELECT * FROM PLO_PALANQUEE WHERE PLO_DATE = $datePlongee AND PLO_MAT_MID_SOI = $periodePlongee";


  $resPalanquees = $bdd->exec($reqPalanquees);

  if (!empty($resPalanquees)){

    var_dump($resPalanquees);

  }



}
?>
