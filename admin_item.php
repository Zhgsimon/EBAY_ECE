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
$req_item_en_vente = $bdd->query('SELECT ID_item,name_item, pic1, description, categorie, ID_vendeur   FROM item WHERE etat_vente = \'en_vente\'');
//$req_item_en_vente = $bdd->query('SELECT ID_item,name_item, pic1, description, categorie, ID_vendeur   FROM item WHERE etat_vente = \'en_vente\'');
$req_item_en_attente = $bdd->query('SELECT ID_item,name_item, pic1, description, categorie , ID_vendeur  FROM item WHERE etat_vente = \'en_attente\'');
$req_item_signale = $bdd->query('SELECT ID_item,name_item, pic1, description, categorie, ID_vendeur   FROM item WHERE etat_vente = \'signalé\'');

?>





<?php include('includes/header.php') ?>
<nav class="navbar navbar-inverse">
<?php include('includes/nav.php'); ?>
</nav>
<!-- jQuery Modal -->
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<style>
.btn-black{
	background-color: #000 !important;
	color: #fff;
	margin-bottom: 5px ;
	margin-right: 5px;
	float: right;
}
</style>
</head>





<div class = "container">
  <div class="row">

    <div class = "col-sm-5 well" style="margin-right:10px !important;">
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
               echo '<img src = "img_projet/vente.jpg" class="img-circle" height="80" width="80" alt="Photo"/>';
             }
             else{
             echo '<img src = "img_items/'.$photo.' " class="img-circle" height="80" width="80" alt="Photo"/>';
           }
          ?>
        </div><!-- col-sm-3 ligne 84-->

        <div class="col-sm-7 ">
            <h4><strong>
              <?php
                echo $donnee['name_item']; ?>
            </strong></h4>

            <p>Par <strong>
              <?php
              $id_vendeur=$donnee['ID_vendeur'];

              $req_vendeur= $bdd->query ("SELECT login FROM user INNER JOIN item ON ID_user  ='$id_vendeur'");
              $login_vendeur = $req_vendeur->fetch();
                echo $login_vendeur['login'];
                ?>
            </strong></p>
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
             echo '<img src = "img_projet/vente.jpg " class="img-circle" height="80" width="80" alt="Photo"/>';
           }
           else{
           echo '<img src = "img_items/'.$photo.' " class="img-circle" height="80" width="80" alt="Photo"/>';
         }
          ?>
        </div><!-- col-sm-3 ligne 84-->

        <div class="col-sm-7 ">
            <h4><strong>
              <?php
                echo $donnee['name_item']; ?>
            </strong></h4>


          <p>Par <strong>
            <?php
            $id_vendeur=$donnee['ID_vendeur'];

            $req_vendeur= $bdd->query ("SELECT login FROM user INNER JOIN item ON ID_user  ='$id_vendeur'");
            $login_vendeur = $req_vendeur->fetch();
              echo $login_vendeur['login'];
              ?>
          </strong></p>
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
                           echo '<img src = "img_projet/vente.jpg " class="img-circle" height="80" width="80" alt="Photo"/>';
                         }
                         else{
                         echo '<img src = "img_items/'.$photo.' " class="img-circle" height="80" width="80" alt="Photo"/>';
                       }
                        ?>
                      </div><!-- col-sm-3 ligne 84-->

                      <div class="col-sm-7 ">
                          <h4><strong>
                            <?php
                              echo $donnee['name_item']; ?>
                        </strong></h4>

                        <p>Par <strong>
                          <?php
                          $id_vendeur=$donnee['ID_vendeur'];

                          $req_vendeur= $bdd->query ("SELECT login FROM user INNER JOIN item ON ID_user  ='$id_vendeur'");
                          $login_vendeur = $req_vendeur->fetch();
                            echo $login_vendeur['login'];
                            ?>
                        </strong></p>
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





<?php include('includes/footer.php') ?>


</body>
</html>
