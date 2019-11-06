<script>
    function supprimerSite(numSite){

        const form = document.createElement('form');
        form.method = 'post';
        form.action = '../backend/suppressionSite.php';

        const champPeriode = document.createElement('input');
        champPeriode.type = 'hidden';
        champPeriode.name = 'numSite';
        champPeriode.value = numSite;

        form.appendChild(champPeriode);

        document.body.appendChild(form);
        form.submit();
    }
</script>
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

                <td><a onclick="supprimerSite(<?php echo $row['SIT_NUM'];?>)" href="#" class="btn waves-effect waves-light red <?php
                    $nSite = $row['SIT_NUM'];
                    $reqSupprimable = "SELECT * FROM PLO_SITE JOIN PLO_PLONGEE USING (SIT_NUM) WHERE SIT_NUM = $nSite";
                    $reqSupprimable = $bdd->exec($reqSupprimable);
                    if (!empty($reqSupprimable)){
                        echo "disabled";
                    }

                    ?>"><i class="material-icons medium">clear</i>
                </a></td>
            </tr>    
                <?php
           }
    }else{
        echo "Il n'y a aucun site de plongée dans la base";
    }
            ?>
        </table>