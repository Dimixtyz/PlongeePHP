<?php
include_once "../header.php";
include_once "../backend/bddPlongee.php";
if(isset($_POST['datePlo'], $_POST['periodePlongee'], $_POST['id'], $_POST['numPal'])) {


    $bdd = new bddPlongee();

    $datePlongee = "'" . $_POST['datePlo'] . "'";
    $periodePlongee = "'" . $_POST['periodePlongee'] . "'";
    $idPal = $_POST['id'];

    $reqPlongee = "SELECT * FROM PLO_PLONGEE JOIN PLO_SITE USING(SIT_NUM) WHERE PLO_DATE = $datePlongee AND PLO_MAT_MID_SOI = $periodePlongee";
    $reqPalanquees = "SELECT * FROM PLO_PALANQUEE WHERE PLO_DATE = $datePlongee AND PLO_MAT_MID_SOI = $periodePlongee AND PAL_NUM = $idPal";


    $resPlongee = $bdd->exec($reqPlongee);

    $resPalanquees = $bdd->exec($reqPalanquees);

}


$numpal = $_POST['numPal'];

?>

<head>


    <link rel="stylesheet" href="css/ajoutUnPlongeur.css">


</head>
<body>

        <?php
        $date = "\"" . $_POST['datePlo'] . "\"";
        $periode = $_POST['periodePlongee'];
        ?>
        <a onclick='afficherPlo(<?php echo "$date, $periode";?>)' href="#" class="waves-effect waves-light btn-large blue circle"><i class="material-icons white-text">keyboard_backspace</i></a>


        <h4 class="center-align">Palanquée <?php echo $numpal+1;?> de la plongée du <?php echo $resPlongee[0]["PLO_DATE"];?> (<?php


            if($resPlongee[0]["PLO_MAT_MID_SOI"] == 1){
                echo "Matin";
            }else if($resPlongee[0]["PLO_MAT_MID_SOI"]==2){
                echo "Après-midi";
            }else if($resPlongee[0]["PLO_MAT_MID_SOI"]==3){
                echo "Soir";
            }


                ?>)</h4>

        <?php
        $dateS = $_POST['datePlo'];
        ?>

        <form method="post" action="../backend/enregistrerInfosPalanquee.php">

            <input type="hidden" name="datePlo" value="<?php echo $dateS;?>">
            <input type="hidden" name="periodePlo" value="<?php echo $periode;?>">
            <input type="hidden" name="idPal" value="<?php echo $idPal?>">
            <input type="hidden" name="numeroPal" value="<?php echo $numpal?>">


            <fieldset style="width:800px; margin-left: auto; margin-right: auto;">


                    <table class="centered">
                        <tr>
                            <td>Heure de départ :</td>
                            <td><input type="time" name="heureDepart" value="<?php echo $resPalanquees[0]['PAL_HEURE_IMMERSION']?>"></td>
                            <td>Heure retour :</td>
                            <td><input type="time" name="heureRetour" value="<?php echo $resPalanquees[0]['PAL_HEURE_SORTIE_EAU']?>"></td>
                        </tr>

                        <tr>
                            <td>Temps Prévu :</td>
                            <td><input type="number" name="tempsPrevu" value="<?php echo $resPalanquees[0]['PAL_DUREE_PREVUE'];?>"></td>

                            <td>Profondeur Prévu :</td>
                            <td><input type="number" name="profondeurPrevu" value="<?php echo $resPalanquees[0]['PAL_PROFONDEUR_PREVU'];?>"></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>Profondeur Réalisé :</td>
                            <td><input type="number" name="profondeurRealiser" value="<?php echo $resPalanquees[0]['PAL_PROFONDEUR_REELLE']; ?>"></td>
                        </tr>

                    </table>

                    <button class="btn waves-effect waves-light green lighten-1" style="border-radius:10px;" type="submit" name="action">Valider la modification
                        <i class="material-icons right">send</i>
                    </button>
            </fieldset>



        </form>
    <br>



</body>

<script>

    function afficherPlo(datePlo, periodePlo){

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









