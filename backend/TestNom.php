<?php

if (isset($_POST['nom'])) {
  $nom = $_POST['nom'];
}else {
  $nom = "25d5";
}


function VerificationNom(&$nom)
{
    $valide = true;
    $nomTemporaire = $nom;

    $unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'Ae', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'ae', 'ç'=>'c',
                            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y','œ'=>'oe', 'Œ'=>'oe', 'ü'=>'u', 'Ÿ'=>'Y' );


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
                          'Ú'=>'ú', 'Û'=>'û', 'Ö'=>'ö','Ã'=>'ã','Ë'=>'ë', 'Ñ'=>'ñ', 'Õ'=>'õ','Ö'=>'ö', 'Ü'=>'ü','Ý'=>'ý','Ÿ'=>'ÿ'
                        );

  $unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'Ae', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                          'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                          'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'ae', 'ç'=>'c',
                          'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                          'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y','œ'=>'oe', 'Œ'=>'oe', 'ü'=>'u', 'Ÿ'=>'Y' );



  if (preg_match("#^.#u", $prenomTemporaire, $matches)) {

      if(!empty($matches[0])) {
          $lettre = $matches[0];
          $replace = strtr($lettre, $unwanted_array);
          $replace = strtoupper($replace);
          $regex = '#^' . $lettre . '#u';
          $prenomTemporaire = preg_replace($regex, $replace, $prenomTemporaire);
      }
  }

  if (preg_match_all("#( |-)[a-Z\\u00C0\\u00C1\\u00C2\\u00C3\\u00C4\\u00C5\\u00C6\\u00C7\\u00C8\\u00C9\\u00CA\\u00CB\\u00CC\\u00CD\\u00CE\\u00CF\\u00D0\\u00D1\\u00D2\\u00D3\\u00D4\\u00D5\\u00D6\\u00D8\\u00D9\\u00DA\\u00DB\\u00DC\\u00DD\\u00DF\\u00E0\\u00E1\\u00E2\\u00E3\\u00E4\\u00E5\\u00E6\\u00E7\\u00E8\\u00E9\\u00EA\\u00EB\\u00EC\\u00ED\\u00EE\\u00EF\\u00F0\\u00F1\\u00F2\\u00F3\\u00F4\\u00F5\\u00F6\\u00F9\\u00FA\\u00FB\\u00FC\\u00FD\\u00FF\\u0153]#u", $prenomTemporaire, $matches)) {

      for ($i=0; $i <sizeof($matches[0]) ; $i++) {
        print_r($matches);
        if(!empty($matches[$i])) {
            $arg = substr($matches[$i],0,1);

            $lettre = substr($matches[$i], 1);
            $replace = strtr($lettre, $unwanted_array);
            $replace = $arg.strtoupper($replace);

            $regex = '#('.$arg.')' . $lettre . '#u';


            echo "<br/>arg = $arg  lettre = $lettre  regex = $regex<br/>";

            $prenomTemporaire = preg_replace($regex, $replace, $prenomTemporaire);
        }

      }

  }

  $prenomTemporaire = strtr( $prenomTemporaire, $lowerCharAccent );

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


$liseNom = array("Ébé-ébé","ébé-ébé","ébé-Ébé","éÉé-Ébé","'éÉ'é-É'bé'",
"'éæé-É'bé'",
"'éæé-É'Ŭé'",
"'é !é-É'Ŭé'",
"éé’’éé--uù  gg",
"Éééé--gg--gg",
"DE LA TR€UC",
"DE LA TRUC",
"ééééééééééééééééééééééééééééééééééééééééééééééé",
"ùùùùùùùùùùùùùùùùùùùù",
"-péron-de - la   branche-",
"pied-de-biche",
"Ferdinand--SaintMalo ALAnage",
"Ferdinand--SaintMalo-ALAnage",
"aa--bb--cc",
"A' ' b",
"A'",
"'",
"x",
"A '' b",
"bénard     ébert",
"ÆøœŒøñ",
"\a",
"\\a",
"b\\a",
"b\a",
"Æ'-'nO",
"çççç ççç ÇÇÇÇ ÇÇÇ ",
"àâäéèêëïîôöùûüÿç",
"ÀÂÄÉÈÊËÏÎÔÖÙÛÜŸÇ");

foreach ($liseNom as $value) {
  echo "($value)   ";
  if (VerificationPrenom($value)) {
    echo "$value <br/> ";
  }else {
    echo "Invalide <br/> ";
  }
}


VerificationPrenom($nom);
 ?>
