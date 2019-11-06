<?php
include_once "bddPlongee.php";

?>

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


<?php

if (isset($_POST['heureDepart'],$_POST['heureRetour'],$_POST['tempsPrevu'],$_POST['profondeurPrevu'],$_POST['profondeurRealiser'], $_POST['datePlo'], $_POST['periodePlo'], $_POST['idPal'], $_POST['numeroPal'])){

    $bdd = new bddPlongee();

    $idPal = $_POST['idPal'];
    $periodePlo = $_POST['periodePlo'];
    $datePlo = $_POST['datePlo'];
    $numeroPal= $_POST['numeroPal'];


    $heureDepart = $_POST['heureDepart'];
    $heureRetour = $_POST['heureRetour'];
    $tempsPrevu = $_POST['tempsPrevu'];
    $profondeurPrevu = $_POST['profondeurPrevu'];
    $profondeurRealiser = $_POST['profondeurRealiser'];

    if(!empty($heureDepart) && !empty($heureRetour)){

        $tmp1 = explode(':',$heureDepart);
        $temps1 = ((intval($tmp1[0])*60) + intval($tmp1[1]));

        $tmp2 = explode(':',$heureRetour);
        $temps2 = ((intval($tmp2[0])*60) + intval($tmp2[1]));


        if ($heureDepart < $heureRetour){
            $tempsReel = $temps2 - $temps1;
            echo "En cours ... ";
        }
    }


    if (isset($tempsReel)){
        $reqInsert = "UPDATE PLO_PALANQUEE SET PAL_PROFONDEUR_PREVU = '".$profondeurPrevu."', PAL_DUREE_PREVUE = '".$tempsPrevu."', PAL_HEURE_IMMERSION = '".$heureDepart."', PAL_HEURE_SORTIE_EAU = '".$heureRetour."', PAL_PROFONDEUR_REELLE = '".$profondeurRealiser."', PAL_DUREE_FOND = '".$tempsReel."' WHERE PLO_DATE = '".$datePlo."' AND PLO_MAT_MID_SOI = '".$periodePlo."' AND PAL_NUM = '".$idPal."'";
    }else{
        $reqInsert = "UPDATE PLO_PALANQUEE SET PAL_PROFONDEUR_PREVU = '".$profondeurPrevu."', PAL_DUREE_PREVUE = '".$tempsPrevu."', PAL_HEURE_IMMERSION = '".$heureDepart."', PAL_HEURE_SORTIE_EAU = '".$heureRetour."', PAL_PROFONDEUR_REELLE = '".$profondeurRealiser."' WHERE PLO_DATE = '".$datePlo."' AND PLO_MAT_MID_SOI = '".$periodePlo."' AND PAL_NUM = '".$idPal."'";
    }

    $bdd->inserer($reqInsert);

    $datePlo = "\"".$datePlo."\"";


    ?>

<script>goPal(<?php echo "$datePlo, $periodePlo, $numeroPal, $idPal";?>);</script>


<?php

exit();

}else{
    echo "infos manquantes";
}


