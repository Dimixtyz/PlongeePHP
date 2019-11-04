<?php
include "../header.php";
include_once  "../backend/bddPlongee.php";

$bdd = new bddPlongee();

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $reqInfos = "SELECT PER_NOM, PER_PRENOM FROM PLO_PERSONNE WHERE PER_NUM = $id";
    $reqPlongeur = "SELECT PLO_APTITUDE.APT_CODE, APT_LIBELLE FROM PLO_APTITUDE INNER JOIN PLO_PLONGEUR ON PLO_PLONGEUR.APT_CODE = PLO_APTITUDE.APT_CODE INNER JOIN PLO_PERSONNE USING(PER_NUM) WHERE PER_NUM = $id";
    $reqDirecteur = "SELECT PER_NUM FROM PLO_DIRECTEUR WHERE PER_NUM = $id";
    $reqSecuSurface = "SELECT PER_NUM FROM PLO_SECURITE_DE_SURFACE WHERE PER_NUM = $id";

    $repInfo = $bdd->exec($reqInfos);

    if (!empty($reqInfos)) {
        $plongeur = false;
        $directeur = false;
        $securiteSurface = false;

        $nom = $repInfo[0]["PER_NOM"];
        $prenom = $repInfo[0]["PER_PRENOM"];

        $repPlongeur = $bdd->exec($reqPlongeur);
        if (!empty($repPlongeur)) {
            $plongeur = true;
            $aptitudeCode = $repPlongeur[0]["APT_CODE"];
            $aptitudeLibelle = $repPlongeur[0]["APT_LIBELLE"];
        }

        $repDirecteur = $bdd->exec($reqDirecteur);
        if (!empty($repDirecteur)) {
            $directeur = true;
        }

        $repSecuSurface = $bdd->exec($reqSecuSurface);
        if (!empty($repSecuSurface)) {
            $securiteSurface = true;
        }


    }


    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script type="text/javascript"
                src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/angular-materialize/0.2.2/angular-materialize.min.js"></script>
        <meta charset="utf-8">
        <title>Formulaire personne</title>
        <script>
            $(document).ready(function () {
                $('select').not('.disabled').formSelect();
            });
        </script>
        <script type="text/javascript">
            function affichageAptitude(element) {
                var targetElement;
                targetElement = document.getElementById(element);
                if (targetElement.style.display == "none") {
                    targetElement.style.display = "";
                } else {
                    targetElement.style.display = "none";
                }
            }
        </script>
    </head>
    <body>
    <form method="post" action="../backend/modifPersonne.php">
        <fieldset style="width:800px; margin-left: auto; margin-right: auto;">
            <legend>Modification personne</legend>
            <br/>

            <div class="input-field col s6">
                <i class="material-icons prefix">account_circle</i>
                <input id="icon_prefix" type="text" name="nom" class="validate" value="<?php echo $nom; ?>">
                <label for="icon_prefix">Nom : </label>
            </div>

            <br/>

            <div class="input-field col s6">
                <i class="material-icons prefix">account_circle</i>
                <input id="icon_prefix2" type="text" name="prenom" class="validate" value="<?php echo $prenom; ?>">
                <label for="icon_prefix2">Prénom : </label>
            </div>

            <br/>
            <label>Choisir le statut : </label>
            <div>

                <label>
                    <input type="checkbox" name="statut[]" value="plongeur" onclick="affichageAptitude('divAptitude')"<?php if($plongeur){echo "checked";}?>/>
                    <span>Plongeur</span><br>
                </label>

                <label>
                    <input type="checkbox" name="statut[]" value="securitedesurface"<?php if($securiteSurface){echo "checked";}?>/>
                    <span>Sécurité de surface</span><br>
                </label>

                <label>
                    <input type="checkbox" name="statut[]" value="directeur"<?php if($directeur){echo "checked";}?>/>
                    <span>Directeur</span>
                </label>

            </div>
            <br/>
            <br/>



            <div id="divAptitude" style="display:none">
                <label for="Aptitude">Aptitude du plongeur : </label>
                <select class="browser-default" name="aptitudeplongeur">

                    <?php
                    require_once('../backend/bddPlongee.php');
                    $reqAfficherAptitude = "SELECT * FROM PLO_APTITUDE";
                    $bdd = new bddPlongee();
                    $res = $bdd->exec($reqAfficherAptitude);

                    for ($i = 0; $i < sizeof($res); $i++) {
                        $aptitudecode = $res[$i][0];
                        $aptitudelibelle = $res[$i][1];
                        $estSelect = "";
                        if ($plongeur){
                            if($aptitudeCode == $aptitudecode){
                                $estSelect = "selected";
                            }
                        }

                        echo "<option value='$aptitudecode'".$estSelect.">$aptitudelibelle</option><br/>";
                    }


                    ?>

                </select>
            </div>

            <input type="hidden" name="id" value="<?php echo $id;?>">
            <?php if($plongeur){echo "<script> affichageAptitude('divAptitude');console.log('Plongeur');</script>";}?>

            <br>
            <?php

            $reqTestCertificat = "SELECT PER_NUM FROM PLO_PERSONNE WHERE PER_NUM = '".$id."' AND PER_DATE_CERTIF_MED > DATE_ADD(NOW(), INTERVAL -365 DAY)";
            $reqTestCertificat = $bdd->exec($reqTestCertificat);

            if (empty($reqTestCertificat)){
                ?>
                <div>
                    Certificat médical :<br>
                    <input type="file" name="certificat" id="certificat">
                </div>
                <?php
            }else{
               ?>

                <div>
                    Certificat médical à jour<br>
                    <a onclick="newCertificat()">nouveau certificat</a>
                    <div id="newCerti"></div>
                </div>

                <?php
            }

            ?>


            <br/>
            <br/>

            <button class="btn waves-effect waves-light" type="submit" name="action">Modifier
                <i class="material-icons right">send</i>
            </button>

        </fieldset>
    </form>


    <script>

        function newCertificat() {
            document.getElementById("newCerti").innerHTML = "<input type='file' name='certificat' id='certificat'>";
        }

    </script>


    </body>
    </html>

    <?php
}