<?php
session_start();

class listePal{

    public static function initialisation()
    {
        $_SESSION['listePal'] = array();
    }

    public static function ajouterListePal($num)
    {
        if(!isset($_SESSION['listePal'])){
            static::initialisation();
        }

        $_SESSION['listePal'] = array_push($_SESSION['listePal'], $num);

        echo "<script>console.log('Insertion de '+$num);</script>";
    }


}



