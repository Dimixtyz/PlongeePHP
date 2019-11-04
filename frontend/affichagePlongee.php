<?php
include_once "../backend/bddPlongee.php";
include_once "../header.php";



if(isset($_POST['datePlo'], $_POST['periodePlongee'])){

  $bdd = new bddPlongee();

  $datePlongee ="'".$_POST['datePlo']."'";
  $periodePlongee = "'".$_POST['periodePlongee']."'";

  $reqPlongee = "SELECT * FROM PLO_PLONGEE JOIN PLO_SITE USING(SIT_NUM) WHERE PLO_DATE = $datePlongee AND PLO_MAT_MID_SOI = $periodePlongee";
  $reqPalanquees = "SELECT * FROM PLO_PALANQUEE WHERE PLO_DATE = $datePlongee AND PLO_MAT_MID_SOI = $periodePlongee";

  $resPlongee = $bdd->exec($reqPlongee);

  $resPalanquees = $bdd->exec($reqPalanquees);

  ?>

<fieldset style="width:800px; margin-left: auto; margin-right: auto;">

  <div><h2>FICHE DE SECURITE</h2></div>

  <fieldset style="width:800px; margin-left: auto; margin-right: auto;">
    <table class="centered">
      <tr>
        <td>Date :</td>
        <td><?php echo $resPlongee[0]['PLO_DATE'];?></td>
      </tr>

      <tr>
        <td>Directeur de plongée :</td>
        <td><?php
          $numDir = "'".$resPlongee[0]['PER_NUM_DIR']."'";
          $reqdir = "SELECT PER_NOM, PER_PRENOM FROM PLO_PERSONNE WHERE PER_NUM = $numDir";
          $resDir = $bdd->exec($reqdir);
          echo $resDir[0]['PER_NOM']." ".$resDir[0]['PER_PRENOM'];?></td>
      </tr>

      <tr>
        <td>Site de plongée :</td>
        <td><?php echo $resPlongee[0]['SIT_NOM'].", ".$resPlongee[0]['SIT_LOCALISATION'];?></td>
      </tr>

      <tr>
        <td>Effectif :</td>
        <td><?php echo $resPlongee[0]['PLO_EFFECTIF_BATEAU'];?></td>
      </tr>
    </table>

    <table class="centered">
      <tr>
        <td>Sécurité de surface :</td>
        <td><?php
          $numSecu = "'".$resPlongee[0]['PER_NUM_SECU']."'";
          $reqSecu = "SELECT PER_NOM, PER_PRENOM FROM PLO_PERSONNE WHERE PER_NUM = $numSecu";
          $resSecu = $bdd->exec($reqSecu);
          echo $resSecu[0]['PER_NOM']." ".$resSecu[0]['PER_PRENOM'];?></td></td>
      </tr>
    </table>
  </fieldset>

  <br>


    <?php
      for ($i = 0; $i<sizeof($resPalanquees); $i++){

        ?>
        <h4>Palanquee <?php echo $i+1;?></h4>

        <fieldset style="width:800px; margin-left: auto; margin-right: auto;">

          <table class="centered">
            <tr>
              <td>Heure de départ :</td>
              <td><?php echo $resPalanquees[$i]['PAL_HEURE_IMMERSION']?></td>
              <td>Heure retour :</td>
              <td><?php echo $resPalanquees[$i]['PAL_HEURE_SORTIE_EAU']?></td>
            </tr>

            <tr>
              <td>Temps Prévu :</td>
              <td><?php if(!empty($resPalanquees[$i]['PAL_DUREE_PREVUE'])){
                  echo $resPalanquees[$i]['PAL_DUREE_PREVUE']." min";
                }?></td>

              <td>Profondeur Prévu :</td>
              <td><?php
                if(!empty($resPalanquees[$i]['PAL_PROFONDEUR_PREVU'])){
                  echo $resPalanquees[$i]['PAL_PROFONDEUR_PREVU']." m";
                }?></td>
            </tr>

            <tr>
              <td>Temps Réalisé :</td>
              <td><?php if(!empty($resPalanquees[$i]['PAL_DUREE_FOND'])){
                echo $resPalanquees[$i]['PAL_DUREE_FOND']." min";
                }?></td>

              <td>Profondeur Réalisé :</td>
              <td><?php
                if(!empty($resPalanquees[$i]['PAL_PROFONDEUR_REELLE'])){
                  echo $resPalanquees[$i]['PAL_PROFONDEUR_REELLE']." m";
                }?></td>
            </tr>

          </table>

            <br>
            <br>
            <table class="centered">
                <thead>
                  <tr>
                    <th>Nom</th>
                    <th>Niveau</th>
                  </tr>
                </thead>

                <tbody>
              <?php
              $numPal = "'".$resPalanquees[$i]['PAL_NUM']."'";
              $reqPlongeur = "SELECT * FROM PLO_PALANQUEE JOIN PLO_CONCERNER USING (PLO_DATE,PLO_MAT_MID_SOI,PAL_NUM) JOIN PLO_PLONGEUR USING (PER_NUM) JOIN PLO_PERSONNE USING (PER_NUM) JOIN PLO_APTITUDE USING (APT_CODE) WHERE PLO_DATE = $datePlongee AND PLO_MAT_MID_SOI = $periodePlongee AND PAL_NUM=$numPal";
              $reqPlongeur = $bdd->exec($reqPlongeur);


              for ($j=0 ; $j<sizeof($reqPlongeur); $j++){
                ?>
                  <tr>
                    <td><?php echo $reqPlongeur[$j]['PER_NOM']." ".$reqPlongeur[$j]['PER_PRENOM']?></td>
                    <td><?php echo $reqPlongeur[$j]['APT_LIBELLE']?></td>
                  </tr>
                <?php
              }

              ?>
                </tbody>

            </table>



        </fieldset>


        <br>
        <?php
      }
    ?>


</fieldset>




  <?php




}
?>
