<?php
echo "<script>console.log('bonjour')</script>";
if (isset($_GET['ajout'])){
    listePal::ajouterListePal($_POST['ajout']);
}