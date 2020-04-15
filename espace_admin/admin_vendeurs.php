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


//selectionner tous les vendeurs
$req = $bdd->query('SELECT name, First_name, login, pseudo, Photo  FROM user WHERE User_privilege = \'2\'  '); 
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
          <li><a href="item.php">Item</a></li>
          <li><a href="Aide.html">Aide</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="../index.html"><span class="glyphicon glyphicon-log-out"></span> Quitter mon espace admin</a></li>
        </ul>
      </div>
    </div>
  </nav>


<!-- Liste des vendeurs -->
<div class="container">
  <div class="col-sm-7">
    <div class="row">
      
      <?php
      while ($donnee = $req->fetch())
  {
      ?>
      <div class="col-sm-12">
       <div class="well">
        <?php 
        $photo=$donnee['Photo'];
        echo $photo;
        if(!$photo) { $photo="../pic.jpg"; }
        echo '<img src = "'.$photo.' " class="img-circle" height="75" width="75" alt="Photo"/>';?>
        <h4>
        <?php 
        echo $donnee['name'];
        echo $donnee['First_name']; ?> </h4>
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
        <?php } ?>
         

        </div>
      </div>

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


    </div>
  </div>

  <!-- Liste des vendeurs en attente-->
   <div class="col-sm-5 well">
       <h4><span class ="glyphicon glyphicon-hourglass"></span>Prochaine(s) livraison(s)</h4>
       <p><strong>Fri. 27 November 2015</strong></p>
   </div>


 
</div>

<!-- Pied de page -->
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
