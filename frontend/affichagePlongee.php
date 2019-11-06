<?php
include_once "../backend/bddPlongee.php";
include_once "../header.php";



if(isset($_POST['datePlo'], $_POST['periodePlongee'])) {

    $bdd = new bddPlongee();

    $datePlongee = "'" . $_POST['datePlo'] . "'";
    $periodePlongee = "'" . $_POST['periodePlongee'] . "'";

    $reqPlongee = "SELECT * FROM PLO_PLONGEE JOIN PLO_SITE USING(SIT_NUM) WHERE PLO_DATE = $datePlongee AND PLO_MAT_MID_SOI = $periodePlongee";
    $reqPalanquees = "SELECT * FROM PLO_PALANQUEE WHERE PLO_DATE = $datePlongee AND PLO_MAT_MID_SOI = $periodePlongee";

    $resPlongee = $bdd->exec($reqPlongee);

    $resPalanquees = $bdd->exec($reqPalanquees);

} ?>

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
    <table class="centered">
        <thead>
        <tr>
            <th>Num Palanquée</th>
            <th>Nombre d'élèves</th>
            <th>Modifier/Consulter</th>
            <th>Supprimer</th>
        </tr>
        </thead>
    <tbody>
    <?php
    $date = $_POST['datePlo'];
    $periode= $_POST['periodePlongee'];
    //$date = preg_replace("#^'#", "", $datePlongee);
    //$date = preg_replace("#'$#", "", $date);
    for ($i = 0; $i<sizeof($resPalanquees); $i++){
        ?>
        <tr>
            <td>
                <p class="text-left">
                    <a> Palanquée n°<?php echo $i+1;?></a></p>
            </td>
            <td>
                <a>1</a>
            </td>


            <td><a class="btn waves-effect waves-light blue lighten-2" href="afficherPalanquée.php?np=<?php echo $resPalanquees[$i][2];?>&aff=<?php echo $i;?>&datePlo=<?php echo $date;?>&periodePlongee=<?php echo $periode;?>">
                    <i class="material-icons medium">create</i>
                </a></td>

            <td><a class="btn waves-effect waves-light red" href="">
                    <i class="material-icons medium">clear</i>
                </a></td>
        </tr>

  <?php

}
?>
    </tbody>
    </table>
    <br>
    <button class="btn waves-effect waves-light" type="submit" name="action">Ajouter une palanquée
        <i class="material-icons right">library_add</i>
    </button>
