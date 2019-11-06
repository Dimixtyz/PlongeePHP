<?php
include_once "../header.php";
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

        <h4>Palanquée <?php echo $numpal+1;?> de la plongée du <?php echo $_GET['datePlo'];?> (<?php


            if(isset($_GET['periodePlongee'])&&$_GET['periodePlongee']==1){
                echo "Matin";
            }else if(isset($_GET['periodePlongee'])&&$_GET['periodePlongee']==2){
                echo "Après-midi";
            }else if(isset($_GET['periodePlongee'])&&$_GET['periodePlongee']==3){
                echo "Soir";
            }






        ?>)</h4>

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
        $numPal = "'".$resPalanquees[$numpal]['PAL_NUM']."'";
        $reqPlongeur = "SELECT * FROM PLO_PALANQUEE JOIN PLO_CONCERNER USING (PLO_DATE,PLO_MAT_MID_SOI,PAL_NUM) JOIN PLO_PLONGEUR USING (PER_NUM) JOIN PLO_PERSONNE USING (PER_NUM) JOIN PLO_APTITUDE USING (APT_CODE) WHERE PLO_DATE = $datePlongee AND PLO_MAT_MID_SOI = $periodePlongee AND PAL_NUM=$numPal";
        $reqPlongeur = $bdd->exec($reqPlongeur);


        for ($j=0 ; $j<sizeof($reqPlongeur); $j++){
            ?>
            <tr>
                <td><?php echo $reqPlongeur[$j]['PER_NOM']." ".$reqPlongeur[$j]['PER_PRENOM']?></td>
                <td><?php echo $reqPlongeur[$j]['APT_LIBELLE']?></td>
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
    <button class="btn waves-effect waves-light" type="submit" name="action">Ajouter un plongeur
        <i class="material-icons right">add_box</i>
    </button>


    </fieldset>







