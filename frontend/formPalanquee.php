<?php
include "../header.php";
include_once "../backend/bddPlongee.php";
include_once "../backend/utileFormPal.php";
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

        <form method="post">
            <fieldset style="width:800px; margin-left: auto; margin-right: auto;">
                <legend>Ajout de personne à la palanquée</legend><br/>

                <div id="listPersonnes">
                    <?php
                        $liste = listePal::$listePal;
                        var_dump($liste);
                        foreach ($liste as $num){
                            $reqPersonne = "SELECT PER_NOM, PER_PRENOM FROM PLO_PERSONNE WHERE PER_NUM = $num";
                            $resP = $bdd->exec($reqPersonne);
                            var_dump($resP);

                            ?>
                            <tr>
                                <th><?php echo $resP[0]['PER_NOM']?></th>
                                <th><?php echo $resP[0]['PER_PRENOM']?></th>
                                <th><input type="checkbox" name="listePersonnes[]" value="<?php echo $num?>" checked></th>
                            </tr>

                            <?php
                    }
                    ?>

                </div>

                <input type="text" id="recherchePal"/>

                <div id="suggestions"></div>


            </fieldset>

	        <fieldset style="width:800px; margin-left: auto; margin-right: auto;">
                <legend>Palanquée avant la plongée</legend><br/>

                <label>Profondeur maximum (en mètres) : </label>
                <p class="range-field">
                    <input type="range" id="profondeurMax" min="0" max="100" />
                </p>

                <label>Temps fond maximum (en minutes) : </label>
                <p class="range-field">
                    <input type="range" id="TempsFondMax" min="0" max="60" />
                </p>

                <label>Horaire d'immersion : </label>
                <input type="time" name="immersion"><br/><br/>

                <button class="btn waves-effect waves-light" type="submit" name="action">Valider
                    <i class="material-icons right">send</i>
                </button>
                <button class="btn waves-effect waves-light" type="reset" name="action">Effacer
                    <i class="material-icons right">clear</i>
                </button>
            </fieldset>

            <fieldset style="width:800px; margin-left: auto; margin-right: auto;">
                <legend>Palanquée après la plongée</legend><br/>

                <label>Heuraire d'émersion : </label>
                <input type="time" name="sortie">

                <label>Profondeur maximum realisé : </label>
                <p class="range-field">
                    <input type="range" id="profondeurMaxReel" min="0" max="100" />
                </p>

                <label>Temps fond maximum réalisé : </label>
                <p class="range-field">
                    <input type="range" id="TempsFondMaxReel" min="0" max="60" />
                </p><br><br/>

                <button class="btn waves-effect waves-light" type="submit" name="action">Valider
                    <i class="material-icons right">send</i>
                </button>
                <button class="btn waves-effect waves-light" type="reset" name="action">Effacer
                    <i class="material-icons right">clear</i>
                </button>
            </fieldset>   
        </form>




        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script>


            function updateListe()
            {
                $( "#listPersonnes" ).load(window.location.href + " #listPersonnes" );
            }



            $(document).ready(function(){
                $('#recherchePal').on('change keyup copy paste cut',function(){
                    var recherche = $(this).val();
                    if (!recherche){
                        recherche = "%";
                    }
                    $.ajax({
                        type:'POST',
                        url:'../backend/ajoutPalanquee.php',
                        data:'recherche='+recherche,
                        success:function(data){
                            $('#suggestions').html(data);
                        }
                    });

                });
            });


        </script>



    </body>
</html>