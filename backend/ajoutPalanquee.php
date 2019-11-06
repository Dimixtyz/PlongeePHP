<?php
include_once "bddPlongee.php";

$bdd = new bddPlongee();

$dateplongee = $_GET['dateplo'];
$seance = $_GET['heure'];
$nbPalanque = $_GET['numPal'];

var_dump($_POST);

$elevePal = $_POST['elevepal'];





$tempsprevu = $_POST['tempsprevu'];


$profondeurprevu= $_POST['profprevue'];

var_dump($elevePal);


for($i=0;$i<$nbPalanque;$i++){

     $reqdernierpal = "select PAL_NUM from PLO_PALANQUEE order by PAL_NUM desc LIMIT 1";
     $repDernierePal = $bdd->exec($reqdernierpal);

     if(sizeof($repDernierePal)==0){
      $repDernierePal = 1 ;
     }else{
      $repDernierePal = $repDernierePal[0]['PAL_NUM']+1;
     }


     $reqPalanque = "INSERT INTO PLO_PALANQUEE(PLO_DATE,PLO_MAT_MID_SOI, PAL_NUM,PAL_PROFONDEUR_PREVU,PAL_DUREE_PREVUE) VALUES ('".$dateplongee."', '".$seance."', '".$repDernierePal."','".$profondeurprevu[$i]."', '".$tempsprevu[$i]."')";
     try
     {
      $bdd->inserer($reqPalanque);
     }
     catch(PDOException $e){
      echo $e->getTraceAsString();
      echo $e->getMessage();
     }



 for($j=0; $j < 5 ; $j++){
  if($elevePal[$j+6*$i]!="choisir"){
   $reqAjoutElevePal = "INSERT INTO PLO_CONCERNER (PLO_DATE, PLO_MAT_MID_SOI, PAL_NUM, PER_NUM) VALUES ('".$dateplongee."','".$seance."','".$repDernierePal."','".$elevePal[$j+6*$i]."')";
   echo $reqAjoutElevePal;
   echo $elevePal[$j+6*$i];
   try
   {
    $bdd->inserer($reqAjoutElevePal);
    echo "eleve n°".$j." de la palanquée : ".$i." a bien été inséré";
   }
   catch(PDOException $e){
    echo $e->getTraceAsString();
    echo $e->getMessage();
   }
  }

 }

}
?>

<form id="redirectionPlongee" method="post" action="../frontend/affichagePlongee.php">
    <input type="hidden" name="datePlo" value="<?php echo $dateplongee;?>">
    <input type="hidden" name="periodePlongee" value="<?php echo $seance;?>">
</form>

<script type="text/javascript">
    document.getElementById('redirectionPlongee').submit();
</script>
















?>


