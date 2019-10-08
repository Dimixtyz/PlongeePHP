<?php

include "bddPlongee.php";


$bdd = new bddPlongee();



if (isset($_POST['recherche']) && !empty($_POST['recherche'])) {
  $searchq = $_POST['recherche']."%";
  $req = 'SELECT * from PLO_PERSONNE where PER_NOM like :nom or PER_PRENOM like :nom';
  $rep = $bdd->execAvecChangementParam($req,$searchq);


  if (!empty($rep)) {
    ?>

    <table class="col-md-3 table">
    <tr>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Modifier</th>
      <th>Supprimer</th>
    </tr>
      <?php
      foreach ($rep as $row) {
        ?>
        <tr>
          <td>
            <p class="text-left">
              <?php echo $row["PER_NOM"]; ?></p>
          </td>
          <td>
            <p class="text-left">
              <?php echo $row["PER_PRENOM"]; ?></p>
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
      echo "Il n'y a aucun eleves de ce nom dans la base";
  }
    ?>
      </table>
    </div>
  <?php
}