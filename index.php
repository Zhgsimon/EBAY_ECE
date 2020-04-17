<?php
session_start();
if (isset($_SESSION['ID_user'])) {
  if ($_SESSION['User_privilege']=='1') {
    $my_profile = 'profile.php';
  }
  else {
    $my_profile = 'profile_t.php';
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Le E-commerce</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Add a gray background color and some padding to the footer */

     a{

color: black;
}
    nav{
       background-color: #070239 ;


    }


    footer {
      background-color: #E5E4EA ;
      color: #E5E4EA

       padding: 60px 0 30px;
       footer {position: absolute; bottom: 0;}

    }

    .carousel-inner img {
      width: 800px;
      height: 400px;
    }

    /* Hide the carousel text when the screen is less than 600 pixels wide */
    @media (max-width: 600px) {
      .carousel-caption {
        display: none;
      }




    }
  </style>
</head>
<body>

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
        <a class="navbar-brand" href="index.php">Logo</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav" id="menu">
          <li class="active"><a href="index.php">Home</a></li>
          <li><a href="Catégorie.php">Catégories</a></li>

          <?php if( isset($_SESSION['ID_user'])) :?>
            <?php if ($_SESSION['User_privilege']==1): ?>
              <!--Historique d'achats-->
              <li><a href="Achat.html">Achat</a></li>
              <!--Panier-->
              <li><a href="Panier.html">Panier</a></li>
              <!--Espace compte acheteur-->
              <li><a href="espacemoncompte_acheteur/moncompte_acheteur.php">Votre compte</a></li>
            <?php endif; ?>
          <?php endif; ?>

          <li><a href="Vendre.html">Vendre</a></li>


          <?php if( isset($_SESSION['ID_user'])) :?>
            <?php if ($_SESSION['User_privilege']==3): ?>
              <!--Espace compte admiin-->
              <li><a href="espace_admin/admin_vendeurs.php">Admin</a></li>
            <?php endif; ?>
          <?php endif; ?>
        </ul>

        <?php if(isset($_SESSION['ID_user'])): //si connecté?>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="traitement_deconnexion.php"><span class="glyphicon glyphicon-log-in"></span> Se déconnecter</a></li>
          </ul>

        <?php else: ?>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="Login.html"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          </ul>
        <?php endif; ?>

      </div>
    </div>
  </nav>

<div class="container">










<div class="row">


  <div class="col-sm-8" >

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">


        <div class="item active">
          <img  src="img_items/lingotdor.jpg" alt="Image">
          <div class="carousel-caption">
            <h3>Mini lingo d'or</h3>

          </div>
        </div>

        <div class="item">
          <img  src="img_items/trainargenté.jpg" alt="Image">
          <div class="carousel-caption">
            <h3>Train en argent</h3>

          </div>
        </div>




        <div class="item">
          <img src="img_items/tableau_lion.jpg" alt="Image">
          <div class="carousel-caption">
            <h3>Tableau lion</h3>



          </div>
        </div>
      </div>

      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

  </div>


  <div class="col-sm-4">
    <center><h2>Catégories</h2></center>

    <div class="well" style="position: relative; top: 30px">
      <li ><a href="Catégories Ferraille" >Ferraille ou Trésor</a></li>

    </div>
    <div class="well" style="position: relative; top: 50px">
       <li><a href="Catégories Musée">Bon pour le Musée</a></li>
    </div>
    <div class="well" style="position: relative; top: 70px">
      <li><a href="Catégories VIP"> Accessoire VIP</a></li>
    </div>
  </div>


</div>


<hr>
</div>

<div class="container text-center">

  <div class="row">


    <div class="col-sm-3">
      <img src="img_items/cartevip.jpg" class="img-responsive" style="width:100%" alt="Image">
      <div class="caption"><p>Carte Vip : accès toilette illimité</p></div>

    </div>

    <div class="col-sm-3">
      <img src="img_items/lion_sculpture_bois.jpg" class="img-responsive" style="width:100%" alt="Image">
      <p>Tigrou des bois</p>
    </div>

    <div class="col-sm-6">
      <div class="well">
       <p>Nous proposons<b> 3 méthodes</b> afin de pouvoir acquerir l'objet de votre désir</p>
      </div>
      <div class="well">
       <p><b>Les enchères</b>, Vous enchérissez pour un item et le plus offrant remporte la mise, peut etre vous ?</p>
      </div>

      <div class="well">
       <p><b>Acheté-le</b>, Maintenant, Just do it</p>
      </div>
      <div class="well">
       <p><b>Meilleure Offre</b>, négociez avec le vendeur, offre et contre-offre soyer rusée.  </p>
      </div>

    </div>
  <hr>
</div>
</div>

<div class="container text-center">
  <h3>Nos meilleures ventes</h3>
  <br>
  <div class="row">

    <div class="col-sm-2">
      <img src="img_items/papier_toilette.jpg" class="img-responsive" style="width:100%" alt="Image">
      <p>papier toilette insolite</p>
    </div>

    <div class="col-sm-2">
      <img src="img_items/ferraille.jpg" class="img-responsive" style="width:100%" alt="Image">
      <p>8kg de ferraille</p>
    </div>


    <div class="col-sm-2">
      <img src="img_items/tableau-singe-poker-sylvain-binet.jpg" class="img-responsive" style="width:100%" alt="Image">
      <p>Tableau : YOU</p>
    </div>

    <div class="col-sm-2">
      <img src="img_items/cocaine.jpg" class="img-responsive" style="width:100%" alt="Image">
      <p>Fake cocain, to shine in nightclub</p>
    </div>



    <div class="col-sm-2">
      <img src="img_items/briquet_beurette.jpg" class="img-responsive" style="width:100%" alt="Image">
      <p>Briquet Beurette</p>
    </div>

    <div class="col-sm-2">
      <img src="img_items/lv.jpg" class="img-responsive" style="width:100%" alt="Image">
      <p>Tableau : Luki/Vist</p>
    </div>


  </div>
</div><br>

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
