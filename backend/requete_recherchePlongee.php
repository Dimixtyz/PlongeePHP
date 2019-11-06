<script>

    function supprimer(datePlo, periodePlo){

        console.log("date : "+datePlo+" periode : "+periodePlo);

        const form = document.createElement('form');
        form.method = 'post';
        form.action = '../backend/suppressionPlongee.php';

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

    function afficher(datePlo, periodePlo){

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

include "bddPlongee.php";


$bdd = new bddPlongee();

  $req = 'SELECT * from PLO_PLONGEE join PLO_SITE on PLO_PLONGEE.SIT_NUM = PLO_SITE.SIT_NUM join PLO_EMBARCATION on PLO_PLONGEE.EMB_NUM = PLO_EMBARCATION.EMB_NUM';
  $rep = $bdd->exec($req);

  if (!empty($rep)) {
    ?>

    <table class="col-md-3 table">
    <tr>
      <th>Date</th>
      <th>Séance</th>
      <th>Site</th>
      <th>Type d'embarcation</th>
        <th>Afficher</th>
        <th>PDF</th>
      <th>Supprimer</th>
    </tr>
      <?php
      foreach ($rep as $row) {
        ?>

          <input type="hidden" name="datePlo" value="<?php echo $row["PLO_DATE"];?>">
          <input type="hidden" name="periodePlongee" value="<?php echo $row["PLO_MAT_MID_SOI"];?>">

        <tr>
          <td>
            <p class="text-left">
              <?php echo $row["PLO_DATE"]; ?></p>
          </td>
          <td>
            <p class="text-left">
              <?php if($row["PLO_MAT_MID_SOI"]== 1){
                      echo ("Matin");
                    } 
                    else if($row["PLO_MAT_MID_SOI"]== 2){
                      echo("Après-midi");
                    }
                    else if($row["PLO_MAT_MID_SOI"]== 3){
                      echo("Soir");
                    }?></p>
          </td>
          <td>
            <p class="text-left">
              <?php echo $row["SIT_NOM"]; ?></p>
          </td>
          <td>
            <p class="text-left">
              <?php echo $row["EMB_NOM"]; ?></p>
          </td>
            <td>
                <button class="waves-effect waves-light btn-small deep-purple darken-2" type="submit" form="formAfficher"><i class="material-icons medium">visibility</i></button>
            </td>

            <td>
                <a class="btn waves-effect waves-light orange" target="_blank" href="../backend/creationPDF.php?dateplongee=<?php echo $row["PLO_DATE"];?>&seance=<?php echo $row["PLO_MAT_MID_SOI"];?>">
                    <i class="material-icons medium">file_download</i>
                </a>
            </td>

            <?php $date = "\"".$row["PLO_DATE"]."\"";
            $periode = $row["PLO_MAT_MID_SOI"];?>

          <td><a onclick='supprimer(<?php echo "$date, $periode";?>)' class="btn waves-effect waves-light red <?php
              $ploDate = "'".$row["PLO_DATE"]."'";
              $ploPeriode = "'".$row["PLO_MAT_MID_SOI"]."'";

              $reqSupprimable = "SELECT * FROM PLO_PLONGEE JOIN PLO_PALANQUEE USING (PLO_DATE, PLO_MAT_MID_SOI) WHERE PLO_DATE = $ploDate AND PLO_MAT_MID_SOI = $ploPeriode";
              $reqSupprimable = $bdd->exec($reqSupprimable);
              if (!empty($reqSupprimable)){
                  echo "disabled";
              }

              ?>" href="">
                  <i class="material-icons medium">clear</i>
            </a></td>

        </tr>
      <?php
    }
  }else{
      echo "Il n'y a aucune plongée dans la base";
  }
    ?>
      </table>
    </div>

  <?php
