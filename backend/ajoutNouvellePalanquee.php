<?php
include_once "bddPlongee.php";?>

<script>
    function goPal(datePlo, periodePlo, numPal, idPal){

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

$bdd = new bddPlongee();

$dateplongee = $_GET['dateplo'];
$seance = $_GET['heure'];


$elevePal = $_POST['elevepal'];

$tempsprevu = $_POST['tempsprevu'];


$profondeurprevu= $_POST['profprevue'];



    $reqdernierpal = "select PAL_NUM from PLO_PALANQUEE order by PAL_NUM desc LIMIT 1";
    $repDernierePal = $bdd->exec($reqdernierpal);

    if(sizeof($repDernierePal)==0){
        $repDernierePal = 1 ;
    }else{
        $repDernierePal = $repDernierePal[0]['PAL_NUM']+1;
    }


    $reqPalanque = "INSERT INTO PLO_PALANQUEE(PLO_DATE,PLO_MAT_MID_SOI, PAL_NUM,PAL_PROFONDEUR_PREVU,PAL_DUREE_PREVUE) VALUES ('".$dateplongee."', '".$seance."', '".$repDernierePal."','".$profondeurprevu."', '".$tempsprevu."')";
    try
    {
        $bdd->inserer($reqPalanque);
    }
    catch(PDOException $e){
        echo $e->getTraceAsString();
        echo $e->getMessage();
        exit();
    }



    for($j=0; $j < 5 ; $j++){
        if($elevePal[$j]!="choisir"){
            $reqAjoutElevePal = "INSERT INTO PLO_CONCERNER (PLO_DATE, PLO_MAT_MID_SOI, PAL_NUM, PER_NUM) VALUES ('".$dateplongee."','".$seance."','".$repDernierePal."','".$elevePal[$j]."')";
            try
            {
                $bdd->inserer($reqAjoutElevePal);
            }
            catch(PDOException $e){
                echo $e->getTraceAsString();
                echo $e->getMessage();
                exit();
            }
        }

    }

    $req = "SELECT COUNT(*) as NB_PAL FROM PLO_PALANQUEE WHERE PLO_DATE = '".$dateplongee."' AND PLO_MAT_MID_SOI = '".$seance."'";
    $req = $bdd->exec($req);

    $numPal = $req[0]['NB_PAL'];

    $date = "\"".$dateplongee."\"";

?>


<script>goPal(<?php echo "$date, $seance, $numPal, $repDernierePal" ?>)</script>

</body>






?>


