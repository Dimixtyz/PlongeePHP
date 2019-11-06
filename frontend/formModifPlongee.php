<?php
include "../backend/bddPlongee.php";
include_once "../header.php";



if(isset($_GET['dateplo'], $_GET['seance'])) {

    $bdd = new bddPlongee();

    $datePlongee = $_GET['dateplo'] ;
    $periodePlongee =$_GET['seance'];
    $date = preg_replace("#^'#", "", $datePlongee);
    $date = preg_replace("#'$#", "", $date);
    $periode = preg_replace("#'$#", "", $periodePlongee);
    $periode = preg_replace("#^'#", "", $periode);

    $reqPlongee = "SELECT * FROM PLO_PLONGEE JOIN PLO_SITE USING(SIT_NUM) WHERE PLO_DATE = $datePlongee AND PLO_MAT_MID_SOI = $periodePlongee";

    $resPlongee = $bdd->exec($reqPlongee);

}

?>

<fieldset style="width:800px; margin-left: auto; margin-right: auto;">
    <table class="centered">
      <tr>
        <td>Date :</td>
        <td>
             <input type="date" class="date" id="datePlongee" name="dateplongee" value="<?php

                if($resPlongee[0]['PLO_DATE']!=""){
                    echo $resPlongee[0]['PLO_DATE'];
                }


             ?>">

        </td>
          <td>
            <p>
                <label>
                    <input name="seance" value="matin" type="radio" <?php

                    if($resPlongee[0]['PLO_MAT_MID_SOI']==1){
                        echo "checked";
                    }


                    ?>  />
                    <span>Matin</span>
                </label><br/>
            </p>
            <p>
                <label>
                    <input name="seance" value="apresmidi" type="radio" <?php

                    if($resPlongee[0]['PLO_MAT_MID_SOI']==2){
                        echo "checked";
                    }


                    ?> />
                    <span>Après-midi</span>
                </label><br/>
            </p>
            <p>
                <label>
                    <input name="seance" value="soir" type="radio" <?php

                    if($resPlongee[0]['PLO_MAT_MID_SOI']==3){
                        echo "checked";
                    }


                    ?>  />
                    <span>Soir</span>
                </label>
            </p>

            </td>
      </tr>

      <tr>
        <td>Directeur de plongée :</td>
        <td><?php
          $numDir = "'".$resPlongee[0]['PER_NUM_DIR']."'";
          $reqdir = "SELECT PER_NOM, PER_PRENOM, PER_NUM FROM PLO_PERSONNE WHERE PER_NUM = $numDir";
          $resDir = $bdd->exec($reqdir);?>

          <select id="NomDirecteur" class="browser-default" name="directeurdeplongee">
              <option value = "">Sélectionnez un directeur</option>
              <?php
              require_once "../backend/bddPlongee.php";
              $bdd = new bddPlongee();

              $req = "select PER_NUM,PER_NOM, PER_PRENOM from PLO_PERSONNE JOIN PLO_DIRECTEUR USING(PER_NUM) ORDER BY PER_NOM";

              $rep = $bdd->exec($req);

              for($i = 0; $i<sizeof($rep); $i++){
                  $val = $rep[$i][0];
                  $valaafficher = $rep[$i][1].' '.$rep[$i][2];
                  if($resDir[0]['PER_NUM']==$val){
                       echo "<option value=$val selected>$valaafficher</option><br/>";
                  }else{
                      echo "<option value=$val>$valaafficher</option><br/>";
                  }
              }?>
        </td>
          </select>
      </tr>

      <tr>
        <td>Site de plongée :</td>
        <td>
            <select id="numSite" class="browser-default" name="numSite">
                <option value = "">Sélectionnez le nom du site</option>
                <?php
                require_once "../backend/bddPlongee.php";
                $bdd = new bddPlongee();

                $req = "select * from PLO_SITE order by SIT_NOM";

                $rep = $bdd->exec($req);

                for($i = 0; $i<sizeof($rep); $i++){
                    $val = $rep[$i][0];
                    $valaafficher = $rep[$i][1].' '.$rep[$i][2];
                    if($resPlongee[0]['SIT_NUM']==$val){
                        echo "<option name='numSite' value=\"".$val."\" selected>$valaafficher</option><br/>";
                    }else{
                        echo "<option name='numSite' value=\"".$val."\">$valaafficher</option><br/>";
                    }
                }
                ?>
            </select></td>
      </tr>

      <tr>
        <td>Effectif :</td>
        <td>
         <input type="number" name="effectifB" value="<?php

             echo $resPlongee[0]['PLO_EFFECTIF_BATEAU'];


         ?>" placeholder="Veuillez saisir un nombre" required>
        </td>

      </tr>
    </table>

    <table class="centered">
      <tr>
        <td>Sécurité de surface :</td>
        <td><?php
          $numSecu = "'".$resPlongee[0]['PER_NUM_SECU']."'";
          $reqSecu = "SELECT PER_NOM, PER_PRENOM, PER_NUM FROM PLO_PERSONNE WHERE PER_NUM = $numSecu";
          $resSecu = $bdd->exec($reqSecu); ?>
            <select class="browser-default" id="NomSecuriteSurface" name="securitedesurface">
                <option value = "">Sélectionnez un personnel de sécurité de surface</option>

                <?php
                require_once "../backend/bddPlongee.php";
                $bdd = new bddPlongee();

                $requeteSecuriteSurface = "select PER_NUM,PER_NOM, PER_PRENOM from PLO_PERSONNE JOIN PLO_SECURITE_DE_SURFACE USING(PER_NUM) ORDER BY PER_NOM";

                $resultatSecuriteSurface = $bdd->exec($requeteSecuriteSurface);

                for($i = 0; $i<sizeof($resultatSecuriteSurface); $i++){
                    $vale = $resultatSecuriteSurface[$i][0];
                    $valaffiche = $resultatSecuriteSurface[$i][1].' '.$resultatSecuriteSurface[$i][2];
                    if($resSecu[0]['PER_NUM']==$vale){
                        echo "<option value=$vale selected>$valaffiche</option><br/>";

                    }else{
                        echo "<option value=$vale>$valaffiche</option><br/>";
                    }
                }?>
            </select>
        </td>
      </tr>
    </table>
  </fieldset>




