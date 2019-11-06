<?php

    include "bddPlongee.php";


    $bdd = new bddPlongee();

    $req = 'SELECT * from PLO_EMBARCATION';
    $rep = $bdd->exec($req);

    if (!empty($rep)) {
?>


        <table class="col-md-3 table">
            <tr>
                <th>Nom de l'embarcation</th>
                <th>Supprimer</th>
            </tr>

            <?php
            foreach ($rep as $row) {
            ?>
            <tr>
                <td>
                    <p class="text-left"><?php echo $row["EMB_NOM"]; ?></p>
                </td>

                <td><a href="#" class="btn waves-effect waves-light red"><i class="material-icons medium">clear</i>
                </a></td>
            </tr>    
                <?php
           }
    }else{
        echo "Il n'y a aucun type d'embarcation dans la base";
    }
            ?>
        </table>