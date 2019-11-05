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

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="js/customJs.js"></script>
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

        $(document).ready(function(){
            $('#recherche').on('change keyup copy paste cut',function(){
                var recherche = $(this).val();
                if (!recherche){
                    recherche = "%";
                }
                $.ajax({
                    type:'POST',
                    url:'../backend/requete_rechercher.php',
                    data:'recherche='+recherche,
                    success:function(data){
                        $('#listeEleves').html(data);
                    }
                });

            });
        });


    </script>




  <div class="form-group">
    <label for="Recherche"></label>
    <input type="text" id="recherche" placeholder="Rechercher des membres...">
  </div>


    <a href="formulaire_creation_personne.php">Ajouter une personne</a>

    <div id="listeEleves"></div>

    </body>
</html>

<?php
include "../backend/requete_rechercher.php";
?>
