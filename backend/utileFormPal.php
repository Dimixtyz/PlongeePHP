<?php

class listePal{

    public static $liste = array();

    public static function initialisation()
    {
        listePal::$liste = array();
    }

    public static function ajouterListePal($num)
    {
        listePal::$liste = array_push(listePal::$liste, $num);
    }


}



