<?php

include_once "bddPlongee.php";


$bdd = new bddPlongee();



if (isset($_POST['recherche']) && !empty($_POST['recherche'])) {
  $searchq = $_POST['recherche']."%";
  $req = 'SELECT * from PLO_PERSONNE where PER_NOM like :nom or PER_PRENOM like :nom';
  $rep = $bdd->execAvecChangementParam($req,$searchq);


  if (!empty($rep)) {
    ?>

    <table class="centered">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Statut</th>
          <th>Nombres de plongées</th>
          <th>Certificat</th>
          <th>Modifier</th>
          <th>Supprimer</th>
        </tr>
      </thead>
      <tbody>
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

                    $numpersonne = "'".$row['PER_NUM']."'";
                    $reqPlongeur = "SELECT * FROM PLO_PLONGEUR WHERE PER_NUM =$numpersonne" ;
                    $reqDirecteur = "SELECT * FROM PLO_DIRECTEUR WHERE PER_NUM =$numpersonne" ;
                    $reqSecurite = "SELECT * FROM PLO_SECURITE_DE_SURFACE WHERE PER_NUM =$numpersonne";

                    $repPlongeur=$bdd->exec($reqPlongeur);
                    $repDirecteur=$bdd->exec($reqDirecteur);
                    $repSecurite=$bdd->exec($reqSecurite);



                    $statut ="";
                    $plongeur = "";
                    $directeur = "";
                    $securite = "";



                    if(sizeof($repPlongeur)>0){
                        $plongeur=" Plongeur";
                    }
                    if(sizeof($repDirecteur)>0){
                        $directeur=" Directeur de surface";
                    }
                    if(sizeof($repSecurite)>0){
                        $securite=" Sécurité de surface";
                    }

                    $statut = $plongeur . $directeur . $securite ;

                    if($statut ==""){
                        echo "Élève";
                    }else{
                        echo $statut;
                    }


                    ?></p>
            </td>

            <td>
                <?php
                    $reqNbPlo = "SELECT COUNT(*) as nbPlo FROM PLO_PALANQUEE JOIN PLO_CONCERNER USING (PLO_DATE, PLO_MAT_MID_SOI, PAL_NUM) JOIN PLO_PLONGEUR USING (PER_NUM) WHERE PER_NUM = $numpersonne";
                    $reqNbPlo = $bdd->exec($reqNbPlo);
                    echo $reqNbPlo[0]['nbPlo'];

                ?>

            </td>

            <td>
                <?php

                $reqTestCertificat = "SELECT PER_NUM FROM PLO_PERSONNE WHERE PER_NUM = $numpersonne AND PER_DATE_CERTIF_MED > DATE_ADD(NOW(), INTERVAL -365 DAY)";
                $reqTestCertificat = $bdd->exec($reqTestCertificat);

                if (!empty($reqTestCertificat)){
                    echo "<span class='new badge' data-badge-caption='à jour'></span>";
                }else{
                    echo "<span class='new badge red' data-badge-caption='pas à jour'></span>";
                }



                ?>
            </td>


          <td><a class="btn btn-primary" href="<?php echo "../frontend/formModifPersonnes.php?id=".$row['PER_NUM'];?>">
              Modifier
            </a></td>

          <td><a class="btn btn-danger" href="<?php echo "../backend/supprimerPersonne.php?id=".$row['PER_NUM'];?>">
              Supprimer
            </a></td>
        </tr>
      <?php
    }
  }else{
      echo "Il n'y a aucun eleves de ce nom dans la base";
  }
    ?>
        </tbody>
      </table>
    </div>
  <?php
}