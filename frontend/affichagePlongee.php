<script>

    function suppPal(datePlo, periodePlo, numPal){

        const form = document.createElement('form');
        form.method = 'post';
        form.action = '../backend/suppressionPalanquee.php';

        const champDate = document.createElement('input');
        champDate.type = 'hidden';
        champDate.name = 'datePlo';
        champDate.value = datePlo;

        const champNum = document.createElement('input');
        champNum.type = 'hidden';
        champNum.name = 'idPal';
        champNum.value = numPal;

        const champPeriode = document.createElement('input');
        champPeriode.type = 'hidden';
        champPeriode.name = 'periodePlongee';
        champPeriode.value = periodePlo;

        form.appendChild(champDate);
        form.appendChild(champPeriode);
        form.appendChild(champNum);

        document.body.appendChild(form);
        form.submit();
    }

    function modifierPal(datePlo, periodePlo, numPal, idPal){

        console.log("Modification");

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
include_once "../backend/bddPlongee.php";
include_once "../header.php";


if(isset($_POST['datePlo'], $_POST['periodePlongee'])) {

    $date = preg_replace("#'#", "", $_POST['datePlo']);
    $date = preg_replace('#"#', "", $date);
    $periode= preg_replace("#'#", "", $_POST['periodePlongee']);
    $periode= preg_replace('#"#', "", $periode);

    $bdd = new bddPlongee();

    $datePlongee = "'" . $date . "'";
    $periodePlongee = "'" . $periode . "'";

    $reqPlongee = "SELECT * FROM PLO_PLONGEE JOIN PLO_SITE USING(SIT_NUM) WHERE PLO_DATE = $datePlongee AND PLO_MAT_MID_SOI = $periodePlongee";
    $reqPalanquees = "SELECT * FROM PLO_PALANQUEE WHERE PLO_DATE = $datePlongee AND PLO_MAT_MID_SOI = $periodePlongee";


    $resPlongee = $bdd->exec($reqPlongee);

    $resPalanquees = $bdd->exec($reqPalanquees);

} ?>



  <div><h2>FICHE DE SECURITÉ</h2></div>

  <fieldset style="width:800px; margin-left: auto; margin-right: auto;">
    <table class="centered">
      <tr>
        <td>Date :</td>
        <td><pre><?php echo $resPlongee[0]['PLO_DATE'];?>   |   <?php
            if($resPlongee[0]['PLO_MAT_MID_SOI']==1){
                echo "Matin";
            }else if($resPlongee[0]['PLO_MAT_MID_SOI']==2){
                echo "Après-midi";
            }else if($resPlongee[0]['PLO_MAT_MID_SOI']==3){
                echo "Soir";
            }


                ?></pre></td>
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
          echo $resSecu[0]['PER_NOM']." ".$resSecu[0]['PER_PRENOM'];?>
        </td>
      </tr>
    </table>
    <a class="btn waves-effect waves-light green lighten-1" style="border-radius:10px;text-align:center;" href="formModifPlongee.php?dateplo=<?php echo $datePlongee;?>&seance=<?php echo $periodePlongee;?>">Modifier   <i class="material-icons medium">edit</i></a>
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

    $date = preg_replace("#'#", "", $_POST['datePlo']);
    $date = preg_replace('#"#', "", $date);
    $periode= preg_replace("#'#", "", $_POST['periodePlongee']);
    $periode= preg_replace('#"#', "", $periode);

    for ($i = 0; $i<sizeof($resPalanquees); $i++){
        ?>
        <tr>
            <td>
                <p class="text-left">
                    <a> Palanquée n°<?php echo $i+1;?></a></p>
            </td>
            <td>
                <a><?php
                    $numPal = "'".$resPalanquees[$i]['PAL_NUM']."'";
                    $reqnbelev = "SELECT COUNT(*) as NB_ELEV FROM PLO_CONCERNER WHERE PLO_DATE =".$datePlongee." AND PLO_MAT_MID_SOI =".$periodePlongee." AND PAL_NUM =".$numPal;
                    $repnbelev = $bdd->exec($reqnbelev);

                    echo $repnbelev[0]['NB_ELEV'];



                    ?></a>
            </td>


            <?php
            $date = preg_replace("#'#", "", $_POST['datePlo']);
            $date = preg_replace('#"#', "", $date);
            $periode= preg_replace("#'#", "", $_POST['periodePlongee']);
            $periode= preg_replace('#"#', "", $periode);
            $date = "\"".$date."\"";
            $numPal = $resPalanquees[$i]['PAL_NUM'];
            ?>

            <td><a onclick='modifierPal(<?php echo "$date, $periode, $i, $numPal";?>)' href="#" class="btn waves-effect waves-light blue lighten-2" style="border-radius:10px;">
                    <i class="material-icons medium">create</i>
                </a></td>


            <td><a onclick='suppPal(<?php echo "$date, $periode, $numPal";?>)' href="#" class="btn waves-effect waves-light red" style="border-radius:10px;">
                    <i class="material-icons medium">clear</i>
                </a></td>
        </tr>

  <?php
}

    $date = preg_replace("#'#", "", $_POST['datePlo']);
    $date = preg_replace('#"#', "", $date);
    $periode= preg_replace("#'#", "", $_POST['periodePlongee']);
    $periode= preg_replace('#"#', "", $periode);
?>
    </tbody>
    </table>

    <br>
    <a class="btn waves-effect waves-light blue lighten-2" style="border-radius:10px;" href="formPalanqueeAjoutApres.php?dateplo='.<?php echo $date?>.'&seance='.<?php echo $periode?>">Ajouter une palanquée  <i class="material-icons small">add_box</i></a>


