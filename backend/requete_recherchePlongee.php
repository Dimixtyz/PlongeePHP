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
      <th>Statut</th>
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
            <td>
                <p class="text-left">
                    <?php

                    require_once "bddPlongee.php";
                    $bdd = new bddPlongee();
                    $numpersonne = "'".$row['PER_NUM']."'";
                    $reqPlongeur = "SELECT * FROM PLO_PLONGEUR WHERE PER_NUM =$numpersonne" ;
                    $reqDirecteur = "SELECT * FROM PLO_DIRECTEUR WHERE PER_NUM =$numpersonne" ;
                    $reqSecurite = "SELECT * FROM PLO_SECURITE_DE_SURFACE WHERE PER_NUM =$numpersonne";

                    $repPlongeur=$bdd->exec($reqPlongeur);
                    $repDirecteur=$bdd->exec($reqDirecteur);
                    $repSecurite=$bdd->exec($reqSecurite);



                    $statut = "";

                    if(!empty($repDirecteur)){
                        $statut+="Directeur";
                    }
                    if(!empty($repSecurite)){
                        $statut+="Directeur de surface";
                    }
                    if(!empty($repSecurite)){
                        $statut+="Sécurité de surface";
                    }

                    echo "COUCOU";


                    ?></p>
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