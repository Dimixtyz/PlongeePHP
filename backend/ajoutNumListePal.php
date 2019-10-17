<?php
include_once "utileFormPal.php";
include_once "bddPlongee.php";

if (isset($_POST['ajout'])){

    listePal::ajouterListePal($_POST['ajout']);
    ?><script>console.log("Ajoute")</script><?php

}

