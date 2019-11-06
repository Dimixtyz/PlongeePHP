<script>

    function afficherPal(datePlo, periodePlo, numPal, idPal){

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
include_once "bddPlongee.php";

$bdd = new bddPlongee();

if (isset($_POST['datePlo'], $_POST['periodePlongee'], $_POST['idPlo'], $_POST['idPal'],  $_POST['numeroPalPlo'])) {

    $ploDate = "'" . $_POST['datePlo'] . "'";
    $ploPeriode = "'" . $_POST['periodePlongee'] . "'";
    $palId = "'".$_POST['idPal']."'";
    $perId = "'".$_POST['idPlo']."'";


    $reqSuppPlongeurPal = "DELETE FROM PLO_CONCERNER WHERE PLO_DATE = $ploDate AND PLO_MAT_MID_SOI = $ploPeriode AND PAL_NUM = $palId AND PER_NUM = $perId";
    $bdd->inserer($reqSuppPlongeurPal);


    $ploDate =  "\"".$_POST['datePlo']."\"";
    $ploPeriode = $_POST['periodePlongee'];
    $palId = $_POST['idPal'];
    $numeroPalPlo = $_POST['numeroPalPlo'];

    echo "<script>afficherPal($ploDate, $ploPeriode, $numeroPalPlo, $palId)</script>";

    exit();

}else{
    echo "Elements insuffisant";
}
?>
</body>



