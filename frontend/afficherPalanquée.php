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

        <h4>Palanquée <?php echo $numpal+1;?> de la plongée du <?php echo $resPlongee[0]["PLO_DATE"];?> (<?php


            if($resPlongee[0]["PLO_MAT_MID_SOI"] == 1){
                echo "Matin";
            }else if($resPlongee[0]["PLO_MAT_MID_SOI"]==2){
                echo "Après-midi";
            }else if($resPlongee[0]["PLO_MAT_MID_SOI"]==3){
                echo "Soir";
            }


        ?>)</h4>

        <fieldset style="width:800px; margin-left: auto; margin-right: auto;">

          <table class="centered">
            <tr>
              <td>Heure de départ :</td>
              <td><?php echo $resPalanquees[0]['PAL_HEURE_IMMERSION']?></td>
              <td>Heure retour :</td>
              <td><?php echo $resPalanquees[0]['PAL_HEURE_SORTIE_EAU']?></td>
            </tr>

            <tr>
              <td>Temps Prévu :</td>
              <td><?php if(!empty($resPalanquees[0]['PAL_DUREE_PREVUE'])){
                  echo $resPalanquees[0]['PAL_DUREE_PREVUE']." min";
                }?></td>

              <td>Profondeur Prévu :</td>
              <td><?php
                if(!empty($resPalanquees[0]['PAL_PROFONDEUR_PREVU'])){
                  echo $resPalanquees[0]['PAL_PROFONDEUR_PREVU']." m";
                }?></td>
            </tr>

            <tr>
              <td>Temps Réalisé :</td>
              <td><?php if(!empty($resPalanquees[0]['PAL_DUREE_FOND'])){
                echo $resPalanquees[0]['PAL_DUREE_FOND']." min";
                }?></td>

              <td>Profondeur Réalisé :</td>
              <td><?php
                if(!empty($resPalanquees[0]['PAL_PROFONDEUR_REELLE'])){
                  echo $resPalanquees[0]['PAL_PROFONDEUR_REELLE']." m";
                }?></td>
            </tr>

          </table>
        </fieldset>

    <br>
    <br>
<fieldset>
    <table>
        <thead>
        <tr>
            <th>Nom</th>
            <th>Niveau</th>
            <th>Supprimer</th>
        </tr>
        </thead>

        <tbody>
        <?php
        $numPal = "'".$resPalanquees[0]['PAL_NUM']."'";
        $reqPlongeur = "SELECT * FROM PLO_PALANQUEE JOIN PLO_CONCERNER USING (PLO_DATE,PLO_MAT_MID_SOI,PAL_NUM) JOIN PLO_PLONGEUR USING (PER_NUM) JOIN PLO_PERSONNE USING (PER_NUM) JOIN PLO_APTITUDE USING (APT_CODE) WHERE PLO_DATE = $datePlongee AND PLO_MAT_MID_SOI = $periodePlongee AND PAL_NUM=$numPal";
        $reqPlongeur = $bdd->exec($reqPlongeur);


        $date = "\"".$_POST['datePlo']."\"";
        $periode = $_POST['periodePlongee'];
        $idPal = $resPalanquees[0]['PAL_NUM'];

        for ($j=0 ; $j<sizeof($reqPlongeur); $j++){
            ?>
            <tr>
                <td><?php echo $reqPlongeur[$j]['PER_NOM']." ".$reqPlongeur[$j]['PER_PRENOM']?></td>
                <td><?php echo $reqPlongeur[$j]['APT_LIBELLE']?></td>

                    <?php $idPer = $reqPlongeur[$j]['PER_NUM'] ?>
                <td><a onclick='suppPlo(<?php echo "$date, $periode, $idPal, $idPer, $numpal";?>)' href="#" class="btn waves-effect waves-light red">
                        <i class="material-icons medium">clear</i>
                    </a></td>
            </tr>
            <?php
        }

        ?>
        </tbody>

    </table>
    <br>
    <button class="btn waves-effect waves-light" type="submit" name="action">Ajouter un plongeur
        <i class="material-icons right">add_box</i>
    </button>


    </fieldset>

<script>
    function suppPlo(datePlo, periodePlo, idPal, idPer, numeroPal){

        console.log("date : "+datePlo+" periode : "+periodePlo);

        const form = document.createElement('form');
        form.method = 'post';
        form.action = '../backend/suppressionPlongeurPal.php';

        const champDate = document.createElement('input');
        champDate.type = 'hidden';
        champDate.name = 'datePlo';
        champDate.value = datePlo;

        const champIdPal = document.createElement('input');
        champIdPal.type = 'hidden';
        champIdPal.name = 'idPal';
        champIdPal.value = idPal;

        const champIdPer = document.createElement('input');
        champIdPer.type = 'hidden';
        champIdPer.name = 'idPlo';
        champIdPer.value = idPer;

        const champNumPam = document.createElement('input');
        champNumPam.type = 'hidden';
        champNumPam.name = 'numeroPalPlo';
        champNumPam.value = numeroPal;

        const champPeriode = document.createElement('input');
        champPeriode.type = 'hidden';
        champPeriode.name = 'periodePlongee';
        champPeriode.value = periodePlo;

        form.appendChild(champDate);
        form.appendChild(champIdPal);
        form.appendChild(champPeriode);
        form.appendChild(champIdPer);
        form.appendChild(champNumPam);

        document.body.appendChild(form);
        form.submit();
    }
</script>









