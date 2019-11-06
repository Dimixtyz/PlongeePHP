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

    function afficherPlo(datePlo, periodePlo){

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
        <th>Statut</th>
        <th>Afficher</th>
        <th>PDF</th>
      <th>Supprimer</th>
    </tr>
      <?php
      foreach ($rep as $row) {
        ?>

          <?php $date = "\"".$row["PLO_DATE"]."\"";
          $periode = $row["PLO_MAT_MID_SOI"];?>

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
                <?php
                $valide = true;
                $dateRecherche = "'".$row["PLO_DATE"]."'";
                $periodeRecherce = "'".$row["PLO_MAT_MID_SOI"]."'";

                $reqStatut = "SELECT * FROM PLO_PALANQUEE JOIN PLO_PLONGEE USING (PLO_DATE, PLO_MAT_MID_SOI) WHERE PLO_DATE = $dateRecherche AND PLO_MAT_MID_SOI = $periodeRecherce";
                $reqStatut = $bdd->exec($reqStatut);

                if (!empty($reqStatut)){

                    foreach ($reqStatut as $key => $planquee) {

                        foreach ($planquee as $valeur){
                            $valide = false;
                        }

                    }

                }else{
                    $valide = false;
                }

                if ($valide){
                    echo "Complet";
                    $reqStatut = "UPDATE PLO_PLONGEE SET PLO_ETAT = 'Complet' WHERE PLO_DATE = $dateRecherche AND PLO_MAT_MID_SOI = $periodeRecherce";
                }else{
                    echo "Incomplet";
                    $reqStatut = "UPDATE PLO_PLONGEE SET PLO_ETAT = 'Imcomplet' WHERE PLO_DATE = $dateRecherche AND PLO_MAT_MID_SOI = $periodeRecherce";
                }
                $bdd->inserer($reqStatut);


                ?>
            </td>



            <td>
                <a onclick='afficherPlo(<?php echo "$date, $periode";?>)' href="#" class="btn waves-effect waves-light deep-purple darken-2" ><i class="material-icons medium">visibility</i></a>
            </td>

            <td>
                <a class="btn waves-effect waves-light orange" target="_blank" href="../backend/creationPDF.php?dateplongee=<?php echo $row["PLO_DATE"];?>&seance=<?php echo $row["PLO_MAT_MID_SOI"];?>">
                    <i class="material-icons medium">file_download</i>
                </a>
            </td>



          <td><a onclick='supprimer(<?php echo "$date, $periode";?>)' href="#" class="btn waves-effect waves-light red <?php
              $ploDate = "'".$row["PLO_DATE"]."'";
              $ploPeriode = "'".$row["PLO_MAT_MID_SOI"]."'";

              $reqSupprimable = "SELECT * FROM PLO_PLONGEE JOIN PLO_PALANQUEE USING (PLO_DATE, PLO_MAT_MID_SOI) WHERE PLO_DATE = $ploDate AND PLO_MAT_MID_SOI = $ploPeriode";
              $reqSupprimable = $bdd->exec($reqSupprimable);
              if (!empty($reqSupprimable)){
                  echo "disabled";
              }

              ?>">
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
