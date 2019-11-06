<?php

    include "bddPlongee.php";


    $bdd = new bddPlongee();

    $req = 'SELECT * from PLO_SITE';
    $rep = $bdd->exec($req);

    if (!empty($rep)) {
?>


        <table class="col-md-3 table">
            <tr>
                <th>Nom</th>
                <th>Localisation</th>
                <th>Supprimer</th>
            </tr>

            <?php
            foreach ($rep as $row) {
            ?>
            <tr>
                <td>
                    <p class="text-left"><?php echo $row["SIT_NOM"]; ?></p>
                </td>
                <td>
                    <p class="text-left"><?php echo $row["SIT_LOCALISATION"]; ?></p>
                </td>

                <td><a href="#" class="btn waves-effect waves-light red"><i class="material-icons medium">clear</i>
                </a></td>
            </tr>    
                <?php
           }
    }else{
        echo "Il n'y a aucun site de plongée dans la base";
    }
            ?>
        </table>