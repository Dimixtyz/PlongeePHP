<?php


class bddPlongee
{
    private $hote = 'mysql:host=localhost;dbname=pphp2a08_bd;charset=utf8';
    private $utilisateur = "pphp2a08";
    private $mdpBdd = "Quae2sheipheing1";
    private $base;

    function __construct(){
        try {
            $this->base = new PDO($this->hote, $this->utilisateur, $this->mdpBdd);
            $this->base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(exception $e) {
            die('Erreur '.$e->getMessage());
        }
    }

    function inserer($req){
        $res = $this->base->prepare($req);
        $res->execute();
    }

    function exec($req){
        $sth = $this->base->prepare($req);
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    function execAvecChangementParam($req,$parquoiremplacer){
        $sth = $this->base->prepare($req);
        $sth->bindParam(':nom', $parquoiremplacer);
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }


}
