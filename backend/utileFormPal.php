<?php

class listePal{

    public static $listePal = Array();

    public static function initialisation()
    {
        $listePal = Array();
    }

    public static function ajouterListePal($num)
    {
        array_push(self::$listePal, $num);
    }

    public static function getListe(){
        return listePal;
    }

}



