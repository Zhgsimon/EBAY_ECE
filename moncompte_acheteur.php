<?php

session_start();


try
{
	// On se connecte à MySQL
	//connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost', 'root', '');
	$db_found = mysqli_select_db($db_handle, "EBAY_ECE");

}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

$req = "SELECT name, First_name, login, password, pseudo, photo, Num_tel, Birthdate FROM user WHERE ID_User = '1' ";
$result=mysqli_query($db_handle,$req);
$info=mysqli_fetch_assoc($result);




?>





<?php include('includes/header.php') ?>



<div class="container">
 <div class="row ">
   <div class="col-sm-3 well ">
     <div class="well text-center">
       <img src="pic.jpg" class="img-circle" height="65" width="65" alt="Photo">
       <h4>
         <?php
          echo $info['pseudo'];
        ?>
      </h4>
       <p>
         <?php
          echo $info['First_name'] ;
          echo $info['name'];
        ?>


       </p>
     </div>
     <div class="well text-left">
       <h4>Vos informations : </h4>
      <p> <span class ="glyphicon glyphicon-envelope"></span>
        <?php
         echo $info['login'];
         ?>
       </p>
       <p> <span class ="glyphicon glyphicon-earphone"></span>
         <?php
          echo $info['Num_tel'];
          ?>
        </p>
       <p><span class ="glyphicon glyphicon-gift"></span>
         <?php
          echo $info['Birthdate'];
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
              <strong>Nom</strong><br>X<br>
              <strong>Prenom</strong><br>Y<br>
              <strong>Adresse ligne 1</strong><br>adresse_l1 <br>
              <strong>Adresse Ligne 2</strong> <br>adresse_l2 <br>
              <strong>Ville</strong> <br> Paris<br>
              <strong>Code Postal</strong> <br>75015 <br>
              <strong>Pays</strong> <br> France
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
