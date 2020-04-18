<?php

session_start();


try
{
	$bdd = new PDO('mysql:host=localhost;dbname=ece_ebay;charset=utf8', 'root', '',
				array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
		die('Erreur : ' . $e->getMessage());
}
/*
$req = bdd->query('SELECT name, First_name, login, password, pseudo, photo, Num_tel, Birthdate FROM user WHERE ID_User = '1' ');
$info=$req->fetch();
*/



?>





<?php include('includes/header.php') ?>



<div class="container">
 <div class="row ">
   <div class="col-sm-3 well ">
     <div class="well text-center">
       <img src="pic.jpg" class="img-circle" height="65" width="65" alt="Photo">
       <h4>
         <?php
          echo $_SESSION['Pseudo'];
        ?>
      </h4>
       <p>
         <?php
          echo $_SESSION['First_name'] ;
          echo $_SESSION['Name'];
        ?>


       </p>
     </div>
     <div class="well text-left">
       <h4>Vos informations : </h4>
      <p> <span class ="glyphicon glyphicon-envelope"></span>
        <?php
         echo $_SESSION['login'];
         ?>
       </p>
       <p> <span class ="glyphicon glyphicon-earphone"></span>
         <?php
          echo $_SESSION['Num_tel'];
          ?>
        </p>
       <p><span class ="glyphicon glyphicon-gift"></span>
         <?php
          echo $_SESSION['Birthdate'];
          ?>
        </p>
     </div>

     <p><a href="#Aide"><span class ="glyphicon glyphicon-question-sign"></span> Aide</a></p>

     <p align="justify"><small> <strong>Rappel:</strong> Vous avez accepter la clause stipulant que si vous faites une
        offre sur un article, vous est êtes sous obligation légale de l'acheter si le vendeur accepte votre offre. </small></p>
   </div>


   <div class="col-sm-7">
     <div class="row">

       <div class="col-sm-12">
         <div class="well">
           <a href="#" class="btn btn-black" style="float: right;" role="button"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>
           <h3><span class ="glyphicon glyphicon-plane"></span> Vos informations de livraison </h3>
            <p>
							<?php
							$id_user=$_SESSION['ID_user'];
							$req_adresse = $bdd->query("SELECT * FROM `adresse_livraison` WHERE `ID_user`='$id_user' AND `adresse_principale` = 1");
							$adresse=$req_adresse->fetch();
							 ?>
              <strong>Nom</strong><br><?php echo $adresse['Nom']?><br>
              <strong>Prenom</strong><br><?php echo $adresse['Prenom']?><br>
              <strong>Numero de téléphone</strong><br>0<?php echo $adresse['Num_tel']?> <br>
              <strong>Adresse</strong><br> <?php echo $adresse['Num_rue']?>  <?php echo $adresse['Nom_rue']?> <br>
              <strong>Ville</strong> <br><?php echo $adresse['Ville']?><br>
              <strong>Code Postal</strong> <br><?php echo $adresse['Code_postal']?> <br>
              <strong>Pays</strong> <br> <?php echo $adresse['Pays']?>
            </p>
         </div>
       </div>

       <div class="col-sm-12">
         <div class="well">
           <div id="options_paiement">
             <a href="#" class="btn btn-black" style="float: right;" role="button"><span class="glyphicon glyphicon-trash"></span> Supprimer</a>
             <a href="#" class="btn btn-black" style="float: right;" role="button"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>
          </div>
            <h3><span class ="glyphicon glyphicon-credit-card"></span> Vos informations de paiement </h3>
            <p>
              <strong>Nom présent sur la carte</strong><br>X Y<br>
              <strong>N° Carte </strong><br>XXXX XXXX XXXX XX12 <br>
              <strong>Date d'expiration</strong> <br>04/20<br>
            </p>
         </div>
       </div>



     </div>
   </div>

   <div class="col-sm-2 well">
       <h4><span class ="glyphicon glyphicon-hourglass"></span>Prochaine(s) livraison(s)</h4>
       <p><strong>Fri. 27 November 2015</strong></p>
   </div>


 </div>
</div>

<?php include('includes/footer.php') ?>



</body>
</html>
