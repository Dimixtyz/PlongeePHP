<body>

<script>
    function afficherPlo(datePlo, periodePlo){

        console.log("date : "+datePlo+" periode : "+periodePlo);

        const form = document.createElement('form');
        form.method = 'post';
        form.action = '../frontend/affichagePlongee.php';

        const champDate = document.createElement('input');
        champDate.type = 'hidden';
        champDate.name = 'datePlo';
        champDate.value = datePlo;

        const champPeriode = document.createElement('input');
        champPeriode.type = 'hidden';
        champPeriode.name = 'periodePlongee';
        champPeriode.value = periodePlo;

        form.appendChild(champDate);
        form.appendChild(champPeriode);

        document.body.appendChild(form);
        form.submit();
    }
</script>


<?php


include_once "bddPlongee.php";

$bdd = new bddPlongee();

if (isset($_POST['datePlo'], $_POST['periodePlongee'], $_POST['idPal'])) {

    $ploDate = "'" . $_POST['datePlo'] . "'";
    $ploPeriode = "'" . $_POST['periodePlongee'] . "'";
    $idPal = "'" . $_POST['idPal'] . "'";

    $reqSuppConcerner = "DELETE FROM PLO_CONCERNER WHERE PLO_DATE = $ploDate AND PLO_MAT_MID_SOI = $ploPeriode AND PAL_NUM = $idPal";
    $bdd->inserer($reqSuppConcerner);

    $reqSuppPal = "DELETE FROM PLO_PALANQUEE WHERE PLO_DATE = $ploDate AND PLO_MAT_MID_SOI = $ploPeriode AND PAL_NUM = $idPal";
    $bdd->inserer($reqSuppPal);


    $date = "\"" . $_POST['datePlo'] . "\"";
    $periode = $_POST['periodePlongee'];

    echo "<script>afficherPlo($date, $periode)</script>";

    exit();


}else{
    echo "Champs incomplets";
}

?>

</body>

