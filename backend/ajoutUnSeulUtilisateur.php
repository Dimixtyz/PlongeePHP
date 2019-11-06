<script>

function allerPalanquee(datePlo, periodePlo, numPal, idPal){

const form = document.createElement('form');
form.method = 'post';
form.action = '../frontend/afficherPalanquée.php';

const champDate = document.createElement('input');
champDate.type = 'hidden';
champDate.name = 'datePlo';
champDate.value = datePlo;

const champNum = document.createElement('input');
champNum.type = 'hidden';
champNum.name = 'id';
champNum.value = idPal;

const champNumPal = document.createElement('input');
champNumPal.type = 'hidden';
champNumPal.name = 'numPal';
champNumPal.value = numPal;

const champPeriode = document.createElement('input');
champPeriode.type = 'hidden';
champPeriode.name = 'periodePlongee';
champPeriode.value = periodePlo;

form.appendChild(champDate);
form.appendChild(champPeriode);
form.appendChild(champNum);
form.appendChild(champNumPal);

document.body.appendChild(form);
form.submit();
}
</script>
<?php

include "bddPlongee.php";
$bdd=new bddPlongee();



if(isset($_POST['elevepal'])){
    $numPlongeur = $_POST['elevepal'];
}

$dateplongee = $_GET['date'];
$seance = $_GET['seance'];
$numpal = $_GET['numpal'];

$req = "INSERT INTO PLO_CONCERNER (PLO_DATE, PLO_MAT_MID_SOI, PAL_NUM, PER_NUM) VALUES ($dateplongee, $seance,$numpal,$numPlongeur)";

try{
    $bdd->inserer($req);
    modifierPal($date, $periode, 1, $numPal);

}catch(PDOException $e){
    echo "l'ajout de l'élève a échoué car il est déjà présent dans la palanquée";
}










?>
