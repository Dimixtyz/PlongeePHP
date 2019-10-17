<?php
include "../header.php";
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8" />
        <title>SALUT</title>
    </head>

    <body>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript">


        $( document ).ready(function(){
            $.ajax({
                type:'POST',
                url:'../backend/requete_rechercher.php',
                data:'recherche=%',
                success: function(data){
                    $('#listeEleves').html(data);
                },
            });
        });

        


    </script>

    <a href="formPlongee.php">Ajouter une plongée</a>

    <div id="listeEleves"></div>

    </body>
</html>

<?php
include "../backend/requete_rechercher.php";
?>