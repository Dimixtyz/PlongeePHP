<?php

function VerificationNom(&$nom)
{
    $valide = true;
    $nomTemporaire = $nom;

    $unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'Ae', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'ae', 'ç'=>'c',
                            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y','œ'=>'oe', 'Œ'=>'oe', 'ü'=>'u', 'Ÿ'=>'Y', 'Ŭ'=>'U' );


    $nomTemporaire = strtr( $nomTemporaire, $unwanted_array );


    $nomTemporaire = strtoupper($nomTemporaire);



    /*Gestion des espaces*/
    $nomTemporaire = preg_replace("#^( )+#","",$nomTemporaire);
    $nomTemporaire = preg_replace("#( ){2,}#"," ",$nomTemporaire);
    $nomTemporaire = preg_replace("#( )+$#","",$nomTemporaire);

    $nomTemporaire = preg_replace("#''#", "' '", $nomTemporaire);


    if (preg_match("#[a-zA-Z]( )+'#", $nomTemporaire, $matches)) {

        for($i = 0; $i<sizeof($matches)-1; $i++) {

            if(!empty($matches[$i][0])) {
                $lettre = $matches[$i][0];
                $replace = $lettre . "'";
                $regex = '#' . $matches[$i] . '#';

                $nomTemporaire = preg_replace($regex, $replace, $nomTemporaire);
            }
        }
    }

    if (preg_match("#'( )+[a-zA-Z]#", $nomTemporaire, $matches)) {

        for($i = 0; $i<sizeof($matches)-1; $i++) {

            if(!empty($matches[$i][0])) {
                $lettre = substr($matches[$i], -1);
                $replace = "'".$lettre;
                $regex = '#' . $matches[$i] . '#';

                $nomTemporaire = preg_replace($regex, $replace, $nomTemporaire);
            }
        }
    }




    //Detecte si il y'a que un '
    if (preg_match("#^'$#",$nomTemporaire)) {
        $valide = false;
    }
    //regle des -
    if (preg_match("#(--)[a-zA-Z ]*(--)#",$nomTemporaire)||preg_match("#(^-)|(-$)#",$nomTemporaire)||preg_match("#-{3,}#",$nomTemporaire)) {
        $valide = false;
    }
    //Si le nom est composer d'autre chose que les caractere suivant
    if (!preg_match("#^[a-zA-Z '-]*$#",$nomTemporaire)) {
        $valide = false;
    }

    if ($valide) {
      $nom = $nomTemporaire;
    }

    return $valide;
}

function VerificationPrenom(&$prenom){

  $valide = true;
  $prenomTemporaire = $prenom;

  /*Gestion des espaces*/
  $prenomTemporaire = preg_replace("#^( )+#","",$prenomTemporaire);
  $prenomTemporaire = preg_replace("#( ){2,}#"," ",$prenomTemporaire);
  $prenomTemporaire = preg_replace("#( )+$#","",$prenomTemporaire);

  $prenomTemporaire = preg_replace("#''#", "' '", $prenomTemporaire);


  $prenomTemporaire = strtolower($prenomTemporaire);

  $lowerCharAccent = array('À'=>'à', 'Â'=>'â', 'Ä'=>'ä', 'Á'=>'á', 'Ç'=>'ç', 'È'=>'è', 'É'=>'é', 'Ê'=>'ê','Ì'=>'ì', 'Í'=>'í', 'Î'=>'î', 'Ï'=>'ï', 'Ò'=>'ò', 'Ó'=>'ó', 'Ô'=>'ô', 'Ù'=>'ù',
                          'Ú'=>'ú', 'Û'=>'û', 'Ö'=>'ö','Ã'=>'ã','Ë'=>'ë', 'Ñ'=>'ñ', 'Õ'=>'õ','Ö'=>'ö', 'Ü'=>'ü','Ý'=>'ý','Ÿ'=>'ÿ', 'Ŭ'=>'u', 'ø'=>'o', 'œ'=>'oe','Œ'=>'oe'
                        );

  $unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'Ae', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                          'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                          'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'ae', 'ç'=>'c',
                          'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                          'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y','œ'=>'oe', 'Œ'=>'oe', 'ü'=>'u', 'Ÿ'=>'Y', 'Ŭ'=>'U' );



  $prenomTemporaire = strtr( $prenomTemporaire, $lowerCharAccent );

  if (preg_match("#^[a-zA-ZÀÂÄÇÉÈÊËÎÏÔÖÙÛÜŸÆŒàâäçéèêëîïôöùûüÿæœ]#u", $prenomTemporaire, $matches)) {

      if(!empty($matches[0])) {
          $lettre = $matches[0];
          $replace = strtr($lettre, $unwanted_array);
          if (strlen($replace)==2){
              $replace = strtoupper($replace[0]).$replace[1];
          }else{
              $replace = strtoupper($replace);
          }
          $regex = '#^' . $lettre . '#u';
          $prenomTemporaire = preg_replace($regex, $replace, $prenomTemporaire);
      }
  }

  if (preg_match_all("#( )[a-zA-ZÀÂÄÇÉÈÊËÎÏÔÖÙÛÜŸÆŒàâäçéèêëîïôöùûüÿæœ]#u", $prenomTemporaire, $matches)) {

      for ($i=0; $i <sizeof($matches[0]) ; $i++) {

        if(!empty($matches[0][$i])) {
            $lettre = str_replace(" ","",$matches[0][$i]);
            $replace = strtr($lettre, $unwanted_array);
            if (strlen($replace)==2){
                $replace = ' '.strtoupper($replace[0]).$replace[1];
            }else{
                $replace = ' '.strtoupper($replace);
            }
            $regex = '#( )' . $lettre . '#u';
            $prenomTemporaire = preg_replace($regex, $replace, $prenomTemporaire);
        }
      }
  }
  if (preg_match_all("#(-)[a-zA-ZÀÂÄÇÉÈÊËÎÏÔÖÙÛÜŸÆŒàâäçéèêëîïôöùûüÿæœ]#u", $prenomTemporaire, $matches)) {
      for ($i=0; $i <sizeof($matches[0]) ; $i++) {
        if(!empty($matches[0][$i])) {
            $lettre = str_replace("-","",$matches[0][$i]);
            $replace = strtr($lettre, $unwanted_array);
            if (strlen($replace)==2){
                $replace = '-'.strtoupper($replace[0]).$replace[1];
            }else{
                $replace = '-'.strtoupper($replace);
            }
            $regex = '#(-)' . $lettre . '#u';
            $prenomTemporaire = preg_replace($regex, $replace, $prenomTemporaire);
        }
      }
  }
  if (preg_match_all("#(')[a-zA-ZÀÂÄÇÉÈÊËÎÏÔÖÙÛÜŸÆŒàâäçéèêëîïôöùûüÿæœ]#u", $prenomTemporaire, $matches)) {
      for ($i=0; $i <sizeof($matches[0]) ; $i++) {
        if(!empty($matches[0][$i])) {
            $lettre = str_replace("'","",$matches[0][$i]);
            $replace = strtr($lettre, $unwanted_array);
            $replace = "'".strtoupper($replace);
            $regex = "#(')" . $lettre . '#u';
            $prenomTemporaire = preg_replace($regex, $replace, $prenomTemporaire);
        }
      }
  }

  //Detecte si il y'a que un '
  if (preg_match("#^'$#u",$prenomTemporaire)) {
      $valide = false;
  }
  //regle des -
  if (preg_match("#(--).*(--)#u",$prenomTemporaire)||preg_match("#(^-)|(-$)#u",$prenomTemporaire)||preg_match("#-{3,}#u",$prenomTemporaire)) {
      $valide = false;
  }
  //Si le nom est composer d'autre chose que les caractere suivant
  if (!preg_match("#^[[:alpha:] '-]*$#u",$prenomTemporaire)) {
      $valide = false;
  }

  if ($valide) {
    $prenom = $prenomTemporaire;
  }


  return $valide;

}

 ?>
