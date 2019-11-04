<?php
include "../header.php";
include_once "../backend/bddPlongee.php";

$bdd = new bddPlongee();
?>
<br/>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Formulaire palanquée</title>
    </head>
    <body>

        <div id="AjoutPalanquee">
            <fieldset style="width:800px; margin-left: auto; margin-right: auto;">
                <legend>Palanquée avant la plongée</legend><br/>

                <label>Temps prévu (en minutes) : </label><input type="number" name="tempsprevu">
                <label>Profondeur prévue (en mètres) :</label><input type="number" name="profprevue">


                <fieldset style="width:800px; margin-left: auto; margin-right: auto;">
                    <legend>Ajout de personne à la palanquée</legend><br/>

                    <div class="input-field col s12">
                        <select style="display: block" name="elevepal1[]">
                            <option value="choisir">Choisissez un élève</option>


                            <?php
                            include_once "../backend/bddPlongee.php";
                            $bdd = new bddPlongee();
                            $req = "SELECT * FROM PLO_PERSONNE JOIN PLO_PLONGEUR USING(PER_NUM) ORDER BY PER_NOM";
                            $rep = $bdd->exec($req);

                            if(sizeof($rep>0)){
                                for($i=0; $i<sizeof($rep);$i++){
                                    echo "<option value='".$rep[$i]['PER_NUM']."'>".$rep[$i]['PER_NOM']." ".$rep[$i]['PER_PRENOM']."</option>";
                            }


                            }
                            ?>

                        </select>

                        <select style="display: block" name="elevepal1[]">
                            <option value="choisir">Choisissez un élève</option>


                            <?php
                            include_once "../backend/bddPlongee.php";
                            $bdd = new bddPlongee();
                            $req = "SELECT * FROM PLO_PERSONNE JOIN PLO_PLONGEUR USING(PER_NUM) ORDER BY PER_NOM";
                            $rep = $bdd->exec($req);

                            if(sizeof($rep>0)){
                                for($i=0; $i<sizeof($rep);$i++){
                                    echo "<option value='".$rep[$i]['PER_NUM']."'>".$rep[$i]['PER_NOM']." ".$rep[$i]['PER_PRENOM']."</option>";
                                }


                            }
                            ?>

                        </select><br>

                            <select style="display: block" name="elevepal1[]">
                                <option value="choisir">Choisissez un élève</option>

                                <?php
                                include_once "../backend/bddPlongee.php";
                                $bdd = new bddPlongee();
                                $req = "SELECT * FROM PLO_PERSONNE JOIN PLO_PLONGEUR USING(PER_NUM) ORDER BY PER_NOM";
                                $rep = $bdd->exec($req);

                                if(sizeof($rep>0)){
                                    for($i=0; $i<sizeof($rep);$i++){
                                        echo "<option value='".$rep[$i]['PER_NUM']."'>".$rep[$i]['PER_NOM']." ".$rep[$i]['PER_PRENOM']."</option>";
                                    }


                                }
                                ?>

                            </select>
                            <select style="display: block" name="elevepal1[]">
                                <option value="choisir">Choisissez un élève</option>


                                <?php
                                include_once "../backend/bddPlongee.php";
                                $bdd = new bddPlongee();
                                $req = "SELECT * FROM PLO_PERSONNE JOIN PLO_PLONGEUR USING(PER_NUM) ORDER BY PER_NOM";
                                $rep = $bdd->exec($req);

                                if(sizeof($rep>0)){
                                    for($i=0; $i<sizeof($rep);$i++){
                                        echo "<option value='".$rep[$i]['PER_NUM']."'>".$rep[$i]['PER_NOM']." ".$rep[$i]['PER_PRENOM']."</option>";
                                    }


                                }
                                ?>

                            </select>
                            <select style="display: block" name="elevepal1[]">
                                <option value="choisir">Choisissez un élève</option>


                                <?php
                                include_once "../backend/bddPlongee.php";
                                $bdd = new bddPlongee();
                                $req = "SELECT * FROM PLO_PERSONNE JOIN PLO_PLONGEUR USING(PER_NUM) ORDER BY PER_NOM";
                                $rep = $bdd->exec($req);

                                if(sizeof($rep>0)){
                                    for($i=0; $i<sizeof($rep);$i++){
                                        echo "<option value='".$rep[$i]['PER_NUM']."'>".$rep[$i]['PER_NOM']." ".$rep[$i]['PER_PRENOM']."</option>";
                                    }


                                }
                                ?>

                            </select>
                            <select style="display: block" name="elevepal1[]">
                                <option value="choisir">Choisissez un élève</option>


                                <?php
                                include_once "../backend/bddPlongee.php";
                                $bdd = new bddPlongee();
                                $req = "SELECT * FROM PLO_PERSONNE JOIN PLO_PLONGEUR USING(PER_NUM) ORDER BY PER_NOM";
                                $rep = $bdd->exec($req);

                                if(sizeof($rep>0)){
                                    for($i=0; $i<sizeof($rep);$i++){
                                        echo "<option value='".$rep[$i]['PER_NUM']."'>".$rep[$i]['PER_NOM']." ".$rep[$i]['PER_PRENOM']."</option>";
                                    }


                                }
                                ?>

                            </select>
                    </div>
                 </fieldset><br/>

            </fieldset><br/>
        </div>

    </body>
</html>