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


//selectionner tous les vendeurs
$req_vendeur_good = $bdd->query('SELECT ID_user,name, First_name, login, pseudo, Photo  FROM user WHERE User_privilege = \'2\' AND User_probation = \'0\' ');
$req_vendeur_attente = $bdd->query('SELECT ID_user, name, First_name, login, pseudo, Photo  FROM user WHERE User_privilege = \'2\' AND User_probation = \'1\' ');
$req_vendeur_signale = $bdd->query('SELECT ID_user, name, First_name, login, pseudo, Photo  FROM user WHERE User_privilege = \'2\' AND User_probation = \'2\' ');

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
          <li class= active><a href="admin_vendeurs.php">Vendeurs</a></li>
          <li><a href="admin_item.php">Item</a></li>
          <li><a href="aide.php">Aide</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="../index.php"><span class="glyphicon glyphicon-log-out"></span> Quitter mon espace admin</a></li>
        </ul>
      </div>
    </div>
  </nav>








<div class = "container">
  <div class="row">

    <div class = "col-sm-6 well">
      <div class = "well">
        <h3><center><strong> Liste des vendeurs actuels</strong></center> </h3>
      </div><!-- well ligne 73 encadré du titre-->

      <?php
        while ($donnee = $req_vendeur_good->fetch()):
      ?>

      <form class="" role ="form" method="post">
        <div class = "col-sm-3 text-center">
          <?php
           $photo=$donnee['Photo'];
           if(!$photo) {
             echo '<img src = "../pic.jpg " class="img-circle" height="80" width="80" alt="Photo"/>';
           }
           else{
           echo '<img src = "../img_user/'.$photo.' " class="img-circle" height="80" width="80" alt="Photo"/>';
         }
          ?>
        </div><!-- col-sm-3 ligne 84-->

        <div class="col-sm-7 ">
            <h4><strong>
              <?php
                echo $donnee['First_name'];
                echo $donnee['name']; ?>
            </strong></h4>
            <p><?php echo $donnee['login'];?>
                <br><?php echo $donnee['pseudo'];?></p>
        </div><!-- col-sm-7 ligne 95-->

        <div class="col-sm-2">

        <div>  <input type="hidden" name="keytodelete" value="<?php echo $donnee['ID_user']; ?>" required>
          <input type="submit" name="submitDeletebutton" class="btn btn-black"value="Supprimer"></div>
        </div>
        </form>

      <?php endwhile; ?>
                <?php

                        if(isset($_POST['submitDeletebutton'])) {
                          $id_a_supprimer=$_POST['keytodelete'];
                          $req_vendeur_existe=$bdd->query("SELECT * FROM user WHERE ID_user='$id_a_supprimer'");

                          $count = $req_vendeur_existe->rowCount();

                          if ($count>0) {

                          //si l'array est rempli d'au moins 1 on supprime de la liste des vendeurs autorisés
                            $query = $bdd->prepare('UPDATE user SET User_probation = :User_probation WHERE ID_user = :ID_user');

                            $success = $query->execute(array(
                              ':ID_user' => $id_a_supprimer,
                              ':User_probation' => '3'
                            ));

                            echo '<div class="alert alert-success"> <p>La ligne a été supprimé</p> </div>';
                            header('Location:admin_vendeurs.php');

                          }
                          else {
                            ///warning la ligne n'existe pas
                            echo '<div class="alert alert-warning"> <p>La ligne n'.'existe pas</p> </div>';
                          }

                        }


                    ?>




    </div><!-- col-sm-6 well ligne 72-->


    <div class="col-sm-6" >
      <div class="row">
        <div class = "col-sm-12 well">
          <div class = "well">
            <h3><center><strong> Liste des vendeurs en attente</strong></center> </h3>
          </div><!-- well ligne 73 encadré du titre-->

          <?php
            while ($donnee = $req_vendeur_attente->fetch()):
          ?>

          <form class="" role ="form" method="post">
            <div class = "col-sm-3 text-center">
              <?php
               $photo=$donnee['Photo'];
               if(!$photo) {
                 echo '<img src = "../pic.jpg " class="img-circle" height="80" width="80" alt="Photo"/>';
               }
               else{
               echo '<img src = "../img_user/'.$photo.' " class="img-circle" height="80" width="80" alt="Photo"/>';
             }
              ?>
            </div><!-- col-sm-3 ligne 84-->

            <div class="col-sm-7 ">
                <h4><strong>
                  <?php
                    echo $donnee['First_name'];
                    echo $donnee['name']; ?>
                </strong></h4>
                <p><?php echo $donnee['login'];?>
                    <br><?php echo $donnee['pseudo'];?></p>
            </div><!-- col-sm-7 ligne 95-->

            <div class="col-sm-2">

            <div>  <input type="hidden" name="keytoaccept" value="<?php echo $donnee['ID_user']; ?>" required>
              <input type="submit" name="submitAcceptbutton" class="btn btn-black"value="Accpeter"></div>

            <div>  <input type="hidden" name="keytorefuse" value="<?php echo $donnee['ID_user']; ?>" required>
              <input type="submit" name="submitRefusebutton" class="btn btn-black"value="Refuser"></div>
            </div>
            </form>

          <?php endwhile; ?>
                    <?php

                            if(isset($_POST['submitAcceptbutton'])) {
                              $id_a_ajouter=$_POST['keytoaccept'];
                              $req_vendeur_existe=$bdd->query("SELECT * FROM user WHERE ID_user='$id_a_ajouter'");

                              $count = $req_vendeur_existe->rowCount();

                              if ($count>0) {

                              //si l'array est rempli d'au moins 1 on supprime de la liste des vendeurs autorisés
                                $query = $bdd->prepare('UPDATE user SET User_probation = :User_probation WHERE ID_user = :ID_user');

                                $success = $query->execute(array(
                                  ':ID_user' => $id_a_ajouter,
                                  ':User_probation' => '0'
                                ));

                                echo '<div class="alert alert-success"> <p>La ligne a été ajoutée</p> </div>';
                                header('Location:admin_vendeurs.php');

                              }
                              else {
                                ///warning la ligne n'existe pas
                                echo '<div class="alert alert-warning"> <p>La ligne n'.'existe pas</p> </div>';
                              }

                            }

                            if(isset($_POST['submitRefusebutton'])) {
                              $id_a_refuser=$_POST['keytorefuse'];
                              $req_vendeur_existe=$bdd->query("SELECT * FROM user WHERE ID_user='$id_a_refuser'");

                              $count = $req_vendeur_existe->rowCount();

                              if ($count>0) {

                              //si l'array est rempli d'au moins 1 on supprime de la liste des vendeurs autorisés
                                $query = $bdd->prepare('UPDATE user SET User_probation = :User_probation WHERE ID_user = :ID_user');

                                $success = $query->execute(array(
                                  ':ID_user' => $id_a_refuser,
                                  ':User_probation' => '3'
                                ));

                                echo '<div class="alert alert-success"> <p>La ligne a été refusé</p> </div>';
                                header('Location:admin_vendeurs.php');

                              }
                              else {
                                ///warning la ligne n'existe pas
                                echo '<div class="alert alert-warning"> <p>La ligne n'.'existe pas</p> </div>';
                              }

                            }


                        ?>




        </div><!-- col-sm-12 well ligne 191-->





        <div class = "col-sm-12 well">
          <div class = "well">
            <h3><center><strong> Liste des vendeurs signalés</strong></center> </h3>
          </div><!-- well ligne 73 encadré du titre-->

          <?php
            while ($donnee = $req_vendeur_signale->fetch()):
          ?>

          <form class="" role ="form" method="post">
            <div class = "col-sm-3 text-center">
              <?php
               $photo=$donnee['Photo'];
               if(!$photo) {
                 echo '<img src = "../pic.jpg " class="img-circle" height="80" width="80" alt="Photo"/>';
               }
               else{
               echo '<img src = "../img_user/'.$photo.' " class="img-circle" height="80" width="80" alt="Photo"/>';
             }
              ?>
            </div><!-- col-sm-3 ligne 84-->

            <div class="col-sm-7 ">
                <h4><strong>
                  <?php
                    echo $donnee['First_name'];
                    echo $donnee['name']; ?>
                </strong></h4>
                <p><?php echo $donnee['login'];?>
                    <br><?php echo $donnee['pseudo'];?></p>
            </div><!-- col-sm-7 ligne 95-->

            <div class="col-sm-2">

            <div>  <input type="hidden" name="keytodelete" value="<?php echo $donnee['ID_user']; ?>" required>
              <input type="submit" name="submiDelete2button" class="btn btn-black"value="Supprimer"></div>

            <div>  <input type="hidden" name="keytoignore" value="<?php echo $donnee['ID_user']; ?>" required>
              <input type="submit" name="submitIgnorebutton" class="btn btn-black"value="Ignorer"></div>
            </div>
            </form>

          <?php endwhile; ?>
                    <?php

                            if(isset($_POST['submiDelete2button'])) {
                              $id_a_supprimer=$_POST['keytodelete'];
                              $req_vendeur_existe=$bdd->query("SELECT * FROM user WHERE ID_user='$id_a_supprimer'");

                              $count = $req_vendeur_existe->rowCount();

                              if ($count>0) {

                              //si l'array est rempli d'au moins 1 on supprime de la liste des vendeurs autorisés
                                $query = $bdd->prepare('UPDATE user SET User_probation = :User_probation WHERE ID_user = :ID_user');

                                $success = $query->execute(array(
                                  ':ID_user' => $id_a_supprimer,
                                  ':User_probation' => '3'
                                ));

                                echo '<div class="alert alert-success"> <p>La ligne a été ajoutée</p> </div>';
                                header('Location:admin_vendeurs.php');

                              }
                              else {
                                ///warning la ligne n'existe pas
                                echo '<div class="alert alert-warning"> <p>La ligne n'.'existe pas</p> </div>';
                              }

                            }

                            if(isset($_POST['submitIgnorebutton'])) {
                              $id_a_ignorer=$_POST['keytoignore'];
                              $req_vendeur_existe=$bdd->query("SELECT * FROM user WHERE ID_user='$id_a_ignorer'");

                              $count = $req_vendeur_existe->rowCount();

                              if ($count>0) {

                              //si l'array est rempli d'au moins 1 on supprime de la liste des vendeurs autorisés
                                $query = $bdd->prepare('UPDATE user SET User_probation = :User_probation WHERE ID_user = :ID_user');

                                $success = $query->execute(array(
                                  ':ID_user' => $id_a_ignorer,
                                  ':User_probation' => '0'
                                ));

                                echo '<div class="alert alert-success"> <p>La ligne a été refusé</p> </div>';
                                header('Location:admin_vendeurs.php');

                              }
                              else {
                                ///warning la ligne n'existe pas
                                echo '<div class="alert alert-warning"> <p>La ligne n'.'existe pas</p> </div>';
                              }

                            }


                        ?>




        </div><!-- col-sm-12 well ligne 191-->


     </div>
    </div>

  </div><!-- row ligne 71-->
</div> <!-- container ligne 70-->




<!-- Modal info -->
<div id="infoModal" class="modal">
  <div class="modal-header">
    <h4 class="modal-title"><strong><center>Articles mis en vente par cet acheteur</center></strong></h5>
  </div>
  <div class="modal-body">
    <center>
      En supprimant ce vendeur, vous supprimerez également ses items en cours et la possibilité pour lui de re-vendre des choses.
    </center>
  </div>
  <div class="modal-footer">
    <form method="post">
    <input type="submit" class="btn btn-black" name="valider" value="Valider"></input>
    <input type="submit" class="btn btn-black" name="annuler" value="Annuler"></input>

      <?php

              if(isset($_POST['valider'])) {
                $log_supp=$donnee['login'];
                echo $log_supp;
                $req_supp_vendeur = $bdd->query('UPDATE user SET User_probation = \'3\' WHERE login=\'$log_supp\'');
              }

              ob_end_flush();

          ?>
  </form>
  </div>
</div> <!-- fin modal-->

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
