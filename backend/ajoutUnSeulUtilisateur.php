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

<body>
<?php

include "bddPlongee.php";
$bdd=new bddPlongee();



if(isset($_POST['elevepal'])){
    $numPlongeur = $_POST['elevepal'];
}

$dateplongee = $_GET['date'];
$seance = $_GET['seance'];
$numpal = $_GET['numpal'];
$numeroPal = $_GET['numeroPal'];


$dateplongee = preg_replace("#'#", "", $dateplongee);
$seance = preg_replace("#'#", "", $seance);
$numpal = preg_replace("#'#", "", $numpal);
$numeroPal = preg_replace("#'#", "", $numeroPal);



$req = "INSERT INTO PLO_CONCERNER (PLO_DATE, PLO_MAT_MID_SOI, PAL_NUM, PER_NUM) VALUES ('".$dateplongee."','".$seance."','".$numpal."','".$numPlongeur."')";

$dateplongee = "\"".$dateplongee."\"";

try{
    $bdd->inserer($req);
    echo "<script>allerPalanquee($dateplongee, $seance, $numeroPal, $numpal)</script>";

}catch(PDOException $e){
    echo "l'ajout de l'élève a échoué car il est déjà présent dans la palanquée";
}










?>

</body>
