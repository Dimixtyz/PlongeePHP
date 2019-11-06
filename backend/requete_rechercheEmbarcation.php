<script>
    function supprimerSite(numEmb){

        const form = document.createElement('form');
        form.method = 'post';
        form.action = '../backend/suppressionEmbarcation.php';

        const champNumEmb = document.createElement('input');
        champNumEmb.type = 'hidden';
        champNumEmb.name = 'numEmb';
        champNumEmb.value = numEmb;

        form.appendChild(champNumEmb);

        document.body.appendChild(form);
        form.submit();
    }
</script>

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

                <td>
                    <a onclick="supprimerSite(<?php echo $row['EMB_NUM'];?>)" href="#" class="btn waves-effect waves-light red <?php
                    $nEmb = $row['EMB_NUM'];
                    $reqSupprimable = "SELECT * FROM PLO_EMBARCATION JOIN PLO_PLONGEE USING (EMB_NUM) WHERE EMB_NUM = $nEmb";
                    $reqSupprimable = $bdd->exec($reqSupprimable);
                    if (!empty($reqSupprimable)){
                        echo "disabled";
                    }

                    ?>" style="border-radius:10px;"><i class="material-icons medium">clear</i></a>
                </td>
            </tr>    
                <?php
           }
    }else{
        echo "Il n'y a aucun type d'embarcation dans la base";
    }
            ?>
        </table>