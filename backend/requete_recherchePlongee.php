<?php

include "bddPlongee.php";


$bdd = new bddPlongee();

  $req = 'SELECT * from PLO_PLONGEE join SITE on PLO_PLONGEE.SIT_NUM = SITE.SIT_NUM join PLO_EMBARCATION on PLO_PLONGEE.EMB_NUM = PLO_EMBARCATION.EMB_NUM';
  $rep = $bdd->exec($req);

  if (!empty($rep)) {
    ?>

    <table class="col-md-3 table">
    <tr>
      <th>Date</th>
      <th>Séance</th>
      <th>Site</th>
      <th>Type d'embarcation</th>
      <th>Modifier</th>
      <th>Supprimer</th>
    </tr>
      <?php
      foreach ($rep as $row) {
        ?>
        <tr>
          <td>
            <p class="text-left">
              <?php echo $row["PLO_DATE"]; ?></p>
          </td>
          <td>
            <p class="text-left">
              <?php if($row["PLO_MATIN_APRESMIDI"]== 1){
                      echo ("Matin");
                    } 
                    else if($row["PLO_MATIN_APRESMIDI"]== 2){
                      echo("Après-midi");
                    }
                    else if($row["PLO_MATIN_APRESMIDI"]== 3){
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
          <td><a class="btn btn-primary" href="">
              Modifier
            </a></td>

          <td><a class="btn btn-danger" href="">
              Supprimer
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
