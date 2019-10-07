<?php
include "../header.php";
?>
<br/>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Formulaire palanquée</title>
  </head>
  <body>
    <form method="post">
	  <fieldset style="width:500px; margin-left: auto; margin-right: auto;">
         <legend>Palanquée avant la plongée</legend><br/>
         <label>Profondeur maximum : </label><input type="text" name="profondeur" placeholder="Profondeur"><label> (en mètres) </label><br/><br/>
         <p class="range-field">
            <input type="range" id="test5" min="0" max="100" />
          </p>
         <label>Temps fond maximum : </label><input type="text" name="tempsMax" placeholder="Temps maximum"><label> (en minutes) </label><br/><br/>
         <label>Horaire d'immersion : </label><input type="time" name="immersion"><br/><br/>
         <input type="submit" name="envoi" value=" Envoyer ">
         <input type="reset" name="efface" value="Effacer ">
      </fieldset>
      <fieldset>
        <legend>Palanquée après la plongée</legend><br/>
        <label>Heuraire d'émersion : </label><input type="time" name="sortie"><br/><br/>
        <label>Profondeur maximum realisé : </label><input type="text" name="profondeurReel" placeholder="Profondeur réalisé"><label> (en mètres) </label><br/><br/>
        <label>Temps fond maximum réalisé : </label><input type="text" name="tempsReel" placeholder="Temps fond réalisé"><label> (en minutes) </label><br/><br/>
        <input type="submit" name="envoi" value=" Envoyer ">
        <input type="reset" name="efface" value="Effacer ">
      </fieldset> <br/>
     <input type = "button" value = "Retour"  onclick = "history.back()">    
    </form>        
  </body>
</html>