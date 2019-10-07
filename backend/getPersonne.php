<?php
include 'fonc_oracle.php';
function getPersonne(){
    $req = 'SELECT * from PLO_PERSONNE';
    $query = PreparerRequeteOCI($conn,$req);
    if ($query !== FALSE) {
        $resultat=$query->fetchAll();
    } else {
        $resultat=0;
    }
    return $resultat;

}
?>
