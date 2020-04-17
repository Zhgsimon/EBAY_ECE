<?php
ob_start();
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


//selectionner tous les items
$req_item_en_vente = $bdd->query('SELECT ID_item,name_item, pic1, description, categorie   FROM item WHERE etat_vente = \'en_vente\'');
//$req_item_en_vente = $bdd->query('SELECT ID_item,name_item, pic1, description, categorie, #ID_vendeur'   FROM item WHERE etat_vente = \'en_vente\'');
$req_item_en_attente = $bdd->query('SELECT ID_item,name_item, pic1, description, categorie   FROM item WHERE etat_vente = \'en_attente\'');
$req_item_signale = $bdd->query('SELECT ID_item,name_item, pic1, description, categorie   FROM item WHERE etat_vente = \'signalé\'');

?>






<!DOCTYPE html>
<html lang="en">
<head>
  <title>Mon compte</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Remember to include jQuery :) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
  <style>
    nav{
     background-color: _#070239 ;
    }

    body {
      font-family: "Lato", sans-serif;
    }

    a{
      color: black;
    }

    .alink{
      color: black;
    }



    .btn-black{
      background-color: #000 !important;
      color: #fff;
      margin-bottom: 5px ;
      margin-right: 5px;
      float: right;
    }

    footer{
      background-color: #E5E4EA ;
      color: #E5E4EA
      padding: 60px 0 30px;
    }
  </style>
</head>



<!-- //barre de navigation du haut -->
<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Votre espace admin</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav" id="menu">
          <li><a href="admin_vendeurs.php">Vendeurs</a></li>
          <li class="active"><a href="admin_item.php">Item</a></li>
          <li><a href="Aide.html">Aide</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="../index.html"><span class="glyphicon glyphicon-log-out"></span> Quitter mon espace admin</a></li>
        </ul>
      </div>
    </div>
  </nav>








<div class = "container">
  <div class="row">

    <div class = "col-sm-6 well">
      <div class = "well">
        <h3><center><strong> Liste des items en vente</strong></center> </h3>
      </div><!-- well ligne 73 encadré du titre-->

      <?php
        while ($donnee = $req_item_en_vente->fetch()):
      ?>

      <form class="" role ="form" method="post">
        <div class = "col-sm-3 text-center">
          <?php
           $photo=$donnee['pic1'];
             if(!$photo) {
               echo '<img src = "../vente.jpg" class="img-circle" height="80" width="80" alt="Photo"/>';
             }
             else{
             echo '<img src = "../img_items/'.$photo.' " class="img-circle" height="80" width="80" alt="Photo"/>';
           }
          ?>
        </div><!-- col-sm-3 ligne 84-->

        <div class="col-sm-7 ">
            <h4><strong>
              <?php
                echo $donnee['name_item']; ?>
            </strong></h4>
            <!--
            <p><i>Mis en vente par <strong> -->
              <?php
              //$id_vendeur=$donnee['#ID_vendeur'];

              //$vendeur= $bdd->query ("SELECT login FROM user INNER JOIN item ON ID_user  ='$id_vendeur'");
              ?>
            <!-- </strong></i></p> -->
            <p><?php echo $donnee['categorie'];?><i>
                <br><?php echo $donnee['description'];?></i></p>
        </div><!-- col-sm-7 ligne 95-->

        <div class="col-sm-2">

        <div>  <input type="hidden" name="keytodelete" value="<?php echo $donnee['ID_item']; ?>" required>
          <input type="submit" name="submitDeletebutton" class="btn btn-black"value="Supprimer"></div>

        </div>
        </form>

      <?php endwhile; ?>
                <?php

                        if(isset($_POST['submitDeletebutton'])) {
                          $id_a_supprimer=$_POST['keytodelete'];
                          $req_item_existe=$bdd->query("SELECT * FROM item WHERE ID_item='$id_a_supprimer'");

                          $count = $req_item_existe->rowCount();

                          if ($count>0) {

                          //si l'array est rempli d'au moins 1 on supprime de la liste des vendeurs autorisés
                            $query = $bdd->prepare('UPDATE item SET etat_vente = :etat_vente WHERE ID_item = :ID_item');

                            $success = $query->execute(array(
                              ':ID_item' => $id_a_supprimer,
                              ':etat_vente' => 'banni'
                            ));

                            echo '<div class="alert alert-success"> <p>La ligne a été supprimé</p> </div>';
                            header('Location:admin_item.php');

                          }
                          else {
                            ///warning la ligne n'existe pas
                            echo '<div class="alert alert-warning"> <p>La ligne n'.'existe pas</p> </div>';
                          }

                        }




                    ?>




    </div><!-- col-sm-6 well ligne 72-->

    <div class = "col-sm-6 ">
      <div class="row">
        <div class="col-sm-12 well">
          <div class="well">
        <h3><center><strong> Liste des items en attente</strong></center> </h3>
      </div><!-- well ligne 73 encadré du titre-->

      <?php
        while ($donnee = $req_item_en_attente->fetch()):
      ?>

      <form class="" role ="form" method="post">
        <div class = "col-sm-3 text-center">
          <?php
           $photo=$donnee['pic1'];
           if(!$photo) {
             echo '<img src = "../vente.jpg " class="img-circle" height="80" width="80" alt="Photo"/>';
           }
           else{
           echo '<img src = "../img_items/'.$photo.' " class="img-circle" height="80" width="80" alt="Photo"/>';
         }
          ?>
        </div><!-- col-sm-3 ligne 84-->

        <div class="col-sm-7 ">
            <h4><strong>
              <?php
                echo $donnee['name_item']; ?>
            </strong></h4>
            <p><?php echo $donnee['categorie'];?><i>
                <br><?php echo $donnee['description'];?></i></p>
        </div><!-- col-sm-7 ligne 95-->

        <div class="col-sm-2">

        <div>  <input type="hidden" name="keytoAdd" value="<?php echo $donnee['ID_item']; ?>" required>
          <input type="submit" name="submitAddButton" class="btn btn-black"value="Ajouter"></div>
          <div>  <input type="hidden" name="keytoignore2" value="<?php echo $donnee['ID_item']; ?>" required>
            <input type="submit" name="submitIgnorebutton2" class="btn btn-black"value="Ignorer"></div>
        </div>
        </form>

      <?php endwhile; ?>
                <?php

                        if(isset($_POST['submitAddButton'])) {
                          $id_a_ajouter=$_POST['keytoAdd'];
                          $req_item_existe=$bdd->query("SELECT * FROM item WHERE ID_item='$id_a_ajouter'");

                          $count = $req_item_existe->rowCount();

                          if ($count>0) {

                          //si l'array est rempli d'au moins 1 on supprime de la liste des vendeurs autorisés
                            $query = $bdd->prepare('UPDATE item SET etat_vente = :etat_vente WHERE ID_item = :ID_item');

                            $success = $query->execute(array(
                              ':ID_item' => $id_a_ajouter,
                              ':etat_vente' => 'en_vente'
                            ));

                            echo '<div class="alert alert-success"> <p>La ligne a été supprimé</p> </div>';
                            header('Location:admin_item.php');

                          }
                          else {
                            ///warning la ligne n'existe pas
                            echo '<div class="alert alert-warning"> <p>La ligne n'.'existe pas</p> </div>';
                          }

                        }

                        if(isset($_POST['submitIgnorebutton2'])) {
                          $id_a_ignorer=$_POST['keytoignore2'];
                          $req_item_existe=$bdd->query("SELECT * FROM item WHERE ID_item='$id_a_ignorer'");

                          $count = $req_item_existe->rowCount();

                          if ($count>0) {

                          //si l'array est rempli d'au moins 1 on supprime de la liste des vendeurs autorisés
                            $query = $bdd->prepare('UPDATE item SET etat_vente = :etat_vente WHERE ID_item = :ID_item');

                            $success = $query->execute(array(
                              ':ID_item' => $id_a_ignorer,
                              ':etat_vente' => 'banni'
                            ));

                            echo '<div class="alert alert-success"> <p>La ligne a été ignoré</p> </div>';
                            header('Location:admin_item.php');

                          }
                          else {
                            ///warning la ligne n'existe pas
                            echo '<div class="alert alert-warning"> <p>La ligne n'.'existe pas</p> </div>';
                          }

                        }
                    ?>
                  </div>

                    <div class = "col-sm-12 well">
                      <div class="well">
                      <h3><center><strong> Liste des items signalés</strong></center> </h3>
                    </div><!-- well ligne 73 encadré du titre-->

                    <?php
                      while ($donnee = $req_item_signale->fetch()):
                    ?>

                    <form class="" role ="form" method="post">
                      <div class = "col-sm-3 text-center">
                        <?php
                         $photo=$donnee['pic1'];
                         if(!$photo) {
                           echo '<img src = "../vente.jpg " class="img-circle" height="80" width="80" alt="Photo"/>';
                         }
                         else{
                         echo '<img src = "../img_items/'.$photo.' " class="img-circle" height="80" width="80" alt="Photo"/>';
                       }
                        ?>
                      </div><!-- col-sm-3 ligne 84-->

                      <div class="col-sm-7 ">
                          <h4><strong>
                            <?php
                              echo $donnee['name_item']; ?>
                          </strong></h4>
                          <p><?php echo $donnee['categorie'];?><i>
                              <br><?php echo $donnee['description'];?></i></p>
                      </div><!-- col-sm-7 ligne 95-->

                      <div class="col-sm-2">

                      <div>  <input type="hidden" name="keytodelete2" value="<?php echo $donnee['ID_item']; ?>" required>
                        <input type="submit" name="submitDeletebutton2" class="btn btn-black"value="Supprimer"></div>
                        <div>  <input type="hidden" name="keytoignore" value="<?php echo $donnee['ID_item']; ?>" required>
                          <input type="submit" name="submitIgnorebutton" class="btn btn-black"value="Ignorer"></div>
                      </div>
                      </form>

                    <?php endwhile; ?>
                              <?php

                                      if(isset($_POST['submitDeletebutton2'])) {
                                        $id_a_supprimer=$_POST['keytodelete2'];
                                        $req_item_existe=$bdd->query("SELECT * FROM item WHERE ID_item='$id_a_supprimer'");

                                        $count = $req_item_existe->rowCount();

                                        if ($count>0) {

                                        //si l'array est rempli d'au moins 1 on supprime de la liste des vendeurs autorisés
                                          $query = $bdd->prepare('UPDATE item SET etat_vente = :etat_vente WHERE ID_item = :ID_item');

                                          $success = $query->execute(array(
                                            ':ID_item' => $id_a_supprimer,
                                            ':etat_vente' => 'banni'
                                          ));

                                          echo '<div class="alert alert-success"> <p>La ligne a été supprimé</p> </div>';
                                          header('Location:admin_item.php');

                                        }
                                        else {
                                          ///warning la ligne n'existe pas
                                          echo '<div class="alert alert-warning"> <p>La ligne n'.'existe pas</p> </div>';
                                        }

                                      }

                                      if(isset($_POST['submitIgnorebutton'])) {
                                        $id_a_ignorer=$_POST['keytoignore'];
                                        $req_item_existe=$bdd->query("SELECT * FROM item WHERE ID_item='$id_a_ignorer'");

                                        $count = $req_item_existe->rowCount();

                                        if ($count>0) {

                                        //si l'array est rempli d'au moins 1 on supprime de la liste des vendeurs autorisés
                                          $query = $bdd->prepare('UPDATE item SET etat_vente = :etat_vente WHERE ID_item = :ID_item');

                                          $success = $query->execute(array(
                                            ':ID_item' => $id_a_ignorer,
                                            ':etat_vente' => 'en_vente'
                                          ));

                                          echo '<div class="alert alert-success"> <p>La ligne a été ignoré</p> </div>';
                                          header('Location:admin_item.php');

                                        }
                                        else {
                                          ///warning la ligne n'existe pas
                                          echo '<div class="alert alert-warning"> <p>La ligne n'.'existe pas</p> </div>';
                                        }

                                      }


                                ob_end_flush();
                                  ?>



                                </div>
    </div><!-- col-sm-6 well ligne 72-->

  </div>
     </div>
    </div>

  </div><!-- row ligne 71-->
</div> <!-- container ligne 70-->



<!-- Text modal qui se trouvait ligne 144 entre col-sm-2 et hidden -->
<!--  <a href="#deleteModal" class ="btn btn-black" rel="modal:open" role="button" name="sup" value="<?//php echo $donnee['login']; ?>"><span class="glyphicon glyphicon-trash"></span></a> -->

  <!-- Modal supprimer -->
  <!--
  <div id="deleteModal" class="modal">
    <div class="modal-header">
      <h4 class="modal-title"><strong><center>Êtes-vous sur de vouloir supprimer ce vendeur?</center></strong></h5>
    </div>
    <div class="modal-body">
      <center>En supprimant ce vendeur, vous supprimerez également ses items en cours et la possibilité pour lui de re-vendre des choses.</center>
    </div>
    <div class="modal-footer">
      <input type="submit" class="btn btn-black" name="valider" value="Valider"><input type="hidden"  name="sup" value="<?php echo $donnee['login']; ?>"></input> </input>
      <input type="submit" class="btn btn-black" name="annuler" value="Annuler"></input>
  <p>-->

<!--text php qui se trouvait a la place du nouveau truc php-->
<!--  if (isset($_POST) && $_POST['sup']!=0){
    echo "je suis la";
    $log_supp=$_POST['sup'];
    echo $log_supp;
    $req_supp_vendeur = $bdd->prepare('UPDATE user SET User_probation = \'3\' WHERE login= ? ');
    $req_supp_vendeur->execute(array($log_supp));
  }


  }
  //$sup=0 faudrait reset la

  ?>
-->

<!-- HTML qui se trouvait juste apres le truc php du dessus -->
<!--    </div>  fin modal-->

  <!--   <a href="#infoModal" class="btn btn-black" rel="modal:open" role="button"> + d'infos</a>
  </div> col-sm-2 ligne 103-->





<?php include('../includes/footer.php') ?>


</body>
</html>
