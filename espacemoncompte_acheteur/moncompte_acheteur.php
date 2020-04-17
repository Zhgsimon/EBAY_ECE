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






<!DOCTYPE html>
<html lang="en">
<head>
  <title>Mon compte</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="moncompte_acheteur.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>


<body>

<!-- //barre de navigation du haut -->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav" id="menu">
        <li><a href="#">Home</a></li>
        <li><a href="#">Catégories</a></li>
        <li><a href="#">Achat</a></li>
        <li><a href="#">Vendre</a></li>
        <li class="active"><a href="#">Votre compte</a></li>
        <li><a href="#">Panier</a></li>
        <li><a href="#">Admin</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>


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

<footer class="container-fluid text-center">

  <div class="container">
 <div class="row">
 <div class="col-lg-8 col-md-8 col-sm-12">
 <h6><b>Information additionnelle</b></h6>
 <p>
Adolf Hitler [ˈadɔlf ˈhɪtlɐ]3 Écouter est un idéologue et homme d'État allemand, né le 20 avril 1889 à Braunau am Inn en Autriche-Hongrie (aujourd'hui en Autriche et toujours ville-frontière avec l’Allemagne) et mort par suicide le 30 avril 1945 à Berlin. Fondateur et figure centrale du nazisme, il prend le pouvoir en Allemagne en 1933 et instaure une dictature totalitaire, impérialiste, antisémite et raciste désignée sous le nom de Troisième Reich.
</p>
 <p>
 L’antisémitisme est le nom donné de nos jours à la discrimination et à l'hostilité manifestées à l'encontre des Juifs
 </p>
 </div>
 <div class="col-lg-4 col-md-4 col-sm-12">
 <h6><b>Contact</b></h6>
 <p>
 37, quai de Grenelle, 75015 Paris, France <br>
 info@webDynamique.ece.fr <br>
 +33 01 02 03 04 05 <br>
 +33 01 03 02 05 04
 </p>
 </div>
 </div>
 <div class="footer-copyright text-center">&copy; 2019 Copyright | Droit d'auteur: webDynamique.ece.fr</div>
</footer>


</body>
</html>
