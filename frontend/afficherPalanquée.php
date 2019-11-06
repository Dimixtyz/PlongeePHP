<?php
include_once "../backend/bddPlongee.php";
if(isset($_GET['datePlo'], $_GET['periodePlongee'])) {

    $bdd = new bddPlongee();

    $datePlongee = "'" . $_GET['datePlo'] . "'";
    $periodePlongee = "'" . $_GET['periodePlongee'] . "'";

    $reqPlongee = "SELECT * FROM PLO_PLONGEE JOIN PLO_SITE USING(SIT_NUM) WHERE PLO_DATE = $datePlongee AND PLO_MAT_MID_SOI = $periodePlongee";
    $reqPalanquees = "SELECT * FROM PLO_PALANQUEE WHERE PLO_DATE = $datePlongee AND PLO_MAT_MID_SOI = $periodePlongee";

    $resPlongee = $bdd->exec($reqPlongee);

    $resPalanquees = $bdd->exec($reqPalanquees);

}


$numpal = $_GET['aff'];

?>

        <h4>Palanquee <?php echo $numpal+1;?></h4>

        <fieldset style="width:800px; margin-left: auto; margin-right: auto;">

          <table class="centered">
            <tr>
              <td>Heure de départ :</td>
              <td><?php echo $resPalanquees[$numpal]['PAL_HEURE_IMMERSION']?></td>
              <td>Heure retour :</td>
              <td><?php echo $resPalanquees[$numpal]['PAL_HEURE_SORTIE_EAU']?></td>
            </tr>

            <tr>
              <td>Temps Prévu :</td>
              <td><?php if(!empty($resPalanquees[$numpal]['PAL_DUREE_PREVUE'])){
                  echo $resPalanquees[$numpal]['PAL_DUREE_PREVUE']." min";
                }?></td>

              <td>Profondeur Prévu :</td>
              <td><?php
                if(!empty($resPalanquees[$numpal]['PAL_PROFONDEUR_PREVU'])){
                  echo $resPalanquees[$numpal]['PAL_PROFONDEUR_PREVU']." m";
                }?></td>
            </tr>

            <tr>
              <td>Temps Réalisé :</td>
              <td><?php if(!empty($resPalanquees[$numpal]['PAL_DUREE_FOND'])){
                echo $resPalanquees[$numpal]['PAL_DUREE_FOND']." min";
                }?></td>

              <td>Profondeur Réalisé :</td>
              <td><?php
                if(!empty($resPalanquees[$numpal]['PAL_PROFONDEUR_REELLE'])){
                  echo $resPalanquees[$numpal]['PAL_PROFONDEUR_REELLE']." m";
                }?></td>
            </tr>

          </table>
        </fieldset>





