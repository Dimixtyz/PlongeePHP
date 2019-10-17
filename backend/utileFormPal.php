<?php

class listePal{

    public static $liste = array();

    public static function initialisation()
    {
        static::$liste = array();
    }

    public static function ajouterListePal($num)
    {
        if(!isset(static::$liste)){
            static::initialisation();
        }

        static::$liste = array_push(static::$liste, $num);

        echo "<script>console.log('Insertion de '".$num.");</script>";
    }


}



