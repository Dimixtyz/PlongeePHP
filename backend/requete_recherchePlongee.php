<?php

include "bddPlongee.php";


$bdd = new bddPlongee();

  $req = 'SELECT * from PLO_PLONGEE join PLO_SITE on PLO_PLONGEE.SIT_NUM = PLO_SITE.SIT_NUM join PLO_EMBARCATION on PLO_PLONGEE.EMB_NUM = PLO_EMBARCATION.EMB_NUM';
  $rep = $bdd->exec($req);

  if (!empty($rep)) {
    ?>

      <form id="formAfficher" method="post" action="../frontend/affichagePlongee.php"/>
    <table class="col-md-3 table">
    <tr>
      <th>Date</th>
      <th>Séance</th>
      <th>Site</th>
      <th>Type d'embarcation</th>
        <th>Afficher</th>
      <th>Modifier</th>
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
          <td><a class="btn waves-effect waves-light blue lighten-2" href="">
                  <i class="material-icons medium">create</i>
            </a></td>
            <td>
                <a class="btn waves-effect waves-light orange" href="../backend/creationPDF.php?dateplongee=<?php echo $row["PLO_DATE"];?>&seance=<?php echo $row["PLO_MAT_MID_SOI"];?>">
                    <i class="material-icons medium">file_download</i>
                </a>
            </td>

          <td><a class="btn waves-effect waves-light red" href="">
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
