<?php
session_start();


// connexion à la base de donnée
  try
  {
    $bdd = new PDO('mysql:host=localhost;dbname=ece_ebay;charset=utf8', 'root', '',
          array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }
  catch (Exception $e)
  {
      die('Erreur : ' . $e->getMessage());
  }

  $ID_user=$_SESSION['ID_user']; //ID_user good
  $req_nego=$bdd->query("SELECT *  FROM nego WHERE ID_vendeur = '$ID_user' AND prix_final is NULL" );

 ?>


 <?php include('includes/header.php'); ?>
   <nav class="navbar navbar-inverse">
   <?php include('includes/nav.php'); ?>
   </nav>

<!DOCTYPE html>
<head>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function(){


      $("#2").click(function(){

        $("#3").css("display", "block");
      });

      $("#1").click(function(){

        $("#3").css("display", "none");

      });
    });
</script>
  <style>





.row{
    overflow: hidden;
}

[class*="col-"]{
    margin-bottom: -99999px;
    padding-bottom: 99999px;
}







  </style>

</head>
  <body>




  	<div class="container" style="margin-bottom: 35px">



           <div class="row"><div class="col-sm-12"><h2>Bienvenue dans l'espace<b> Négociation </b></h2></div></div>

          <div class="row" style="margin-bottom: 35px">
                 <div class="col-sm-3" style="background-color: #D4D4D4"><h4><b>Vous négociez avec les acheteurs.</b> Vous fixez le prix et attendez.</h4></div>

                <div class="col-sm-3" style="background-color: #E2E2E2"><h4>L'acheteur <b>accepte votre offre ou propose une contre-offre</b>. Si l'acheteur accepte votre offre, le processus se termine.</h4></div>

                <div class="col-sm-3" style="background-color: #D4D4D4"><h4><b>Le processus se répète 5 fois</b>, jusqu'à ce qu'il soit conclu de façon satisfaisante ou qu'il se décompose.</h4></div>

                <div class="col-sm-3" style="background-color: #E2E2E2"><h4>Notez bien que si vous acceptez une offre sur un article,<b> l'acheteur est sous contrat légal pour l'acheter</b></h4></div>

          </div>
          <?php
          while ($donnee = $req_nego->fetch()):
          ?>
          <div class="row"><div class="col-sm-12"><h2>Vous négociez pour <b> L'item : </b></h2></div></div>

          <div class="row" style="margin-bottom: 50px">
              <div class="col-sm-2">
                <?php
                $ID_item=$donnee['ID_item'];
                $req_item=$bdd->query("SELECT *  FROM item WHERE ID_item = '$ID_item' " );
                $item=$req_item->fetch();

                $photo=$item['pic1'];
                  if(!$photo) {
                    echo '<img src = "img_projet/vente.jpg"  height="150" width="150" alt="Photo"/>';
                  }
                  else{
                  echo '<img src = "img_items/'.$photo.' " height="150" width="150" alt="Photo"/>';
                }
                ?>
              </div>

              <div class="col-sm-10" style="background-color: #E2E2E2 ">

              <u><h3 class="text-left">
              <?php echo $item['name_item'];?>
              </h3></u>
              <h4 class="text-center">   <?php echo $item['description'];?></h4>
               <h4 class="text-center">   <?php echo $item['Categorie'];?></h4>
                <h4 class="text-center">   <?php
                $ID_acheteur=$item['ID_acheteur'];
                $req_acheteur=$bdd->query("SELECT name,First_name  FROM user WHERE ID_user = '$ID_acheteur' " );
                $acheteur=$req_acheteur->fetch();
                echo "Negociation avec";
                echo $acheteur['First_name'];
                echo " ";
                echo $acheteur['name'];?></h4>
              </div>

          </div>

          <div class="row"><div class="col-sm-12">
            <h3 style="float: left;">Voici l'offre de l'acheteur :
              <?php echo $donnee['prix_acheteur']; ?> €
            </h3><h3 class="text-right"> Nombre de tentatives restante : <?php echo $donnee['Nb_propositions_restantes']; ?></h3>
              <div class="form-group">
              <input  type="radio" name="accepte" id="1"><label style="margin-right: 35px" >Accepter l'offre</label>
              <input type="radio" name="refusé" id="2"><label>Refuser l'offre</label>
            </div>
            </div></div>

            <div class="row"><div class="col-sm-4"><div class="form-group">
              <label style="display: none;">Contre offre</label>
              <input type="number" class="form-control" placeholder="Prix proposé"  required name="?" style="display: none;" id="3">
            </div></div></div>

<?php
endwhile;
?>
</div>

</div>

<?php include('includes/footer.php'); ?>

  </body>

  </html>
