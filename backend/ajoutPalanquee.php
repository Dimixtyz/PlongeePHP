<?php
include_once "bddPlongee.php";
include_once "utileFormPal.php";

$bdd = new bddPlongee();

if (isset($_POST['recherche'])){
    echo '<form id="formAjout" action="../frontend/formPalanquee.php" method="post"/>';
    $recherche = $_POST['recherche']."%";
    $req = 'SELECT * from PLO_PERSONNE where PER_NOM like :nom or PER_PRENOM like :nom LIMIT 0,3';
    $rep = $bdd->execAvecChangementParam($req,$recherche);

    foreach ($rep as $pal){
        ?>
    <tr>
        <th><?php echo $pal['PER_NOM']?></th>
        <th><?php echo $pal['PER_PRENOM']?></th>
        <th><button type="submit" name="numPal" form="formAjout" value="<?php echo $pal['PER_NUM'] ?>">Ajouter</button></th>
    </tr>

    <?php
    }
    listePal::ajouterListePal("2");


}
?>
<script>
    $('#ajoutPer').click(function() {
        var id = $(this).val();
        console.log("id : "+id);
        window.location.replace("../frontend/formPalanquee.php?numPal=" + id);
    });
</script>