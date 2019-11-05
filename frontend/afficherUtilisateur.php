<?php
include_once "../header.php";
include_once "../backend/bddPlongee.php";

if (isset($_POST['id'])) {

    $bdd = new bddPlongee();
    $id = $_POST['id'];

    $reqPersonne = "SELECT * FROM PLO_PERSONNE WHERE PER_NUM = $id";
    $reqPersonne = $bdd->exec($reqPersonne);
    ?>
    <div class="center"><h4><?php echo $reqPersonne[0]['PER_NOM'] . " " . $reqPersonne[0]['PER_PRENOM']; ?></h4></div>
    <br>
    <div id="Role">
    Role :
    <table class="centered">
    <thead>
    <th>Directeur</th>
    <th>Securite de surface</th>
    <th>Plongeur</th>
    </thead>
    <tbody>
    <?php

    $reqDirecteur = "SELECT PER_NUM FROM PLO_DIRECTEUR WHERE PER_NUM = $id";
    $reqDirecteur = $bdd->exec($reqDirecteur);

    if (!empty($reqDirecteur)) {
        ?>
        <td><i class="material-icons medium">done</i></td>
        <?php
    } else {
        ?>
        <td><i class="material-icons medium">close</i></td>
        <?php

    }

    $reqSecuSurface = "SELECT PER_NUM FROM PLO_SECURITE_DE_SURFACE WHERE PER_NUM = $id";
    $reqSecuSurface = $bdd->exec($reqSecuSurface);

    if (!empty($reqDirecteur)) {
        ?>
        <td><i class="material-icons medium">done</i></td>
        <?php
    } else {
         ?>
            <td><i class="material-icons medium">close</i></td>
        <?php
    }






    $reqPlongeur = "SELECT * FROM PLO_PLONGEUR WHERE PER_NUM = $id";
    $reqPlongeur = $bdd->exec($reqPlongeur);


    if (!empty($reqPlongeur)){
        ?>
        <td><i class="material-icons medium">done</i></td>
        <?php
    }else{
        ?>
        <td><i class="material-icons medium">close</i></td>
        <?php
    }

?>

            </tbody>
        </table>
    </div>
        <?php

        if(!empty($reqPlongeur)) {
            $reqNbPlo = "SELECT COUNT(*) as nbPlo FROM PLO_PALANQUEE JOIN PLO_CONCERNER USING (PLO_DATE, PLO_MAT_MID_SOI, PAL_NUM) JOIN PLO_PLONGEUR USING (PER_NUM) WHERE PER_NUM = $id";
            $reqNbPlo = $bdd->exec($reqNbPlo);
            ?>
            <div class="center">A réalisé : <?php echo $reqNbPlo[0]['nbPlo'];?> plongées</div>

<?php
    }
    $req = "SELECT * from PLO_PLONGEE join PLO_SITE on PLO_PLONGEE.SIT_NUM = PLO_SITE.SIT_NUM join PLO_EMBARCATION on PLO_PLONGEE.EMB_NUM = PLO_EMBARCATION.EMB_NUM JOIN PLO_PALANQUEE USING (PLO_DATE,PLO_MAT_MID_SOI) JOIN PLO_CONCERNER USING (PLO_DATE, PLO_MAT_MID_SOI, PAL_NUM) JOIN PLO_PLONGEUR USING (PER_NUM) WHERE PER_NUM = $id";
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
                <button type="submit" form="formAfficher">Afficher</button>
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
  }
}