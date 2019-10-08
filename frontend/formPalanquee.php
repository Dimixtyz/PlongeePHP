<?php
include "../header.php";
?>
<br/>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Formulaire palanquée</title>
        <script>
            var zoneAjoutPersonne; 
            var nbPersonnePalanquee=0;
            function ajouterPersonne(){
	            if(nbPersonnePalanquee==2){ //si il s'agit du premier ajout
		            zoneAjoutPersonne = document.getElementById('pieceCompteAjoute') //on séléctionne l'emplacement où on veux effectuer les ajouts de champs
		        document.getElementById('supCompte').style.display='inline' //on rend disponible le bouton supprimer
	            }
	
	            //on ajoute un nouveau champ
	            var input = document.createElement("input");
	            input.type = "text";
	            input.name = "pieceCompteAjoute["+nbPersonnePalanquee+"]";
	            input.id  = "pieceCompte"+nbPersonnePalanquee;
	            input.style.display = "block";
	            zoneAjoutPersonne.appendChild(input);
	            nbPersonnePalanquee++;
            }

            function supprimerPieceCompte(){
	            nbPersonnePalanquee--;
	            zoneAjoutPersonne.removeChild(document.getElementById('pieceCompte'+nbPersonnePalanquee)) //on supprime le dernier champs ajouté 
	            if(nbPersonnePalanquee==0){
	                document.getElementById('supCompte').style.display='none';// on rend indisponible le bouton supprimer
	            }
            }
        </script>
    </head>
    <body>
        <form method="post">
            <fieldset style="width:800px; margin-left: auto; margin-right: auto;">
                <legend>Ajout de personne à la palanquée</legend><br/>
                <label>Personne 1 : </label>
                <div class="input-field col s6">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="icon_prefix" type="text" name="nom1" class="validate">
                    <label for="icon_prefix">Nom : </label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="icon_prefix2" type="text" name="prenom1" class="validate">
                    <label for="icon_prefix2">Prénom : </label>
                </div>
                <label>Personne 2 : </label>
                <div class="input-field col s6">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="icon_prefix" type="text" name="nom2" class="validate">
                    <label for="icon_prefix">Nom : </label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="icon_prefix2" type="text" name="prenom2" class="validate">
                    <label for="icon_prefix2">Prénom : </label>
                </div>
                <a class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>

            </fieldset>

	        <fieldset style="width:800px; margin-left: auto; margin-right: auto;">
                <legend>Palanquée avant la plongée</legend><br/>

                <label>Profondeur maximum (en mètres) : </label>
                <p class="range-field">
                    <input type="range" id="profondeurMax" min="0" max="100" />
                </p>

                <label>Temps fond maximum (en minutes) : </label>
                <p class="range-field">
                    <input type="range" id="TempsFondMax" min="0" max="60" />
                </p>

                <label>Horaire d'immersion : </label>
                <input type="time" name="immersion"><br/><br/>

                <button class="btn waves-effect waves-light" type="submit" name="action">Valider
                    <i class="material-icons right">send</i>
                </button>
                <button class="btn waves-effect waves-light" type="reset" name="action">Effacer
                    <i class="material-icons right">clear</i>
                </button>
            </fieldset>

            <fieldset style="width:800px; margin-left: auto; margin-right: auto;">
                <legend>Palanquée après la plongée</legend><br/>

                <label>Heuraire d'émersion : </label>
                <input type="time" name="sortie">

                <label>Profondeur maximum realisé : </label>
                <p class="range-field">
                    <input type="range" id="profondeurMaxReel" min="0" max="100" />
                </p>

                <label>Temps fond maximum réalisé : </label>
                <p class="range-field">
                    <input type="range" id="TempsFondMaxReel" min="0" max="60" />
                </p><br><br/>

                <button class="btn waves-effect waves-light" type="submit" name="action">Valider
                    <i class="material-icons right">send</i>
                </button>
                <button class="btn waves-effect waves-light" type="reset" name="action">Effacer
                    <i class="material-icons right">clear</i>
                </button>
            </fieldset>   
        </form>        
    </body>
</html>