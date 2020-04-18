<?php
  session_start();
?>
<?php include('includes/header.php') ?>

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
<?php include('includes/footer.php'); ?>
