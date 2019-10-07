<?php


class bddPlongee
{
    private $utilisateur = "ETU2_39";
    private $mdpBdd = "ETU2_39";
    private $base;
    private $db;




    function __construct(){
        try {
          $hote = 'spartacus.iutc3.unicaen.fr';
          $port = '1521'; // port par défaut
          $service = 'info.iutc3.unicaen.fr';

          $this->db =
          "oci:dbname=(DESCRIPTION =
          (ADDRESS_LIST =
            (ADDRESS =
              (PROTOCOL = TCP)
              (Host = ".$hote .")
              (Port = ".$port."))
          )
          (CONNECT_DATA =
            (SERVICE_NAME = ".$service.")
          )
          )";
            $this->base = new PDO($this->db, $this->utilisateur, $this->mdpBdd);
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
