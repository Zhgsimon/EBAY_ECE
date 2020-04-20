<?php
  session_start();
?>

<?php include('includes/header.php'); ?>
<script>


</script>
<style>

.aCat{
  color: black;
}

.carousel-inner img {
 width: 800px !important;
 height: 400px !important;
}

/* Hide the carousel text when the screen is less than 600 pixels wide */
@media (max-width: 600px) {
 .carousel-caption {
   display: none;
 }

}
.img-responsive {
     opacity: 1;
     display: block;
     width: 100%;
   height: auto;
     transition: .5s ease;
     backface-visibility: hidden;

}

.col-sm-2:hover .img-responsive{
 filter: brightness(35%);
}

.centered {
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
opacity: 0;
transition: .5s ease;
}

.centered1 {
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
opacity: 0;
transition: .5s ease;
}

.col-sm-2:hover .centered{
 opacity: 1;
}

li {
 display: inline;
}
.aI:link, .aI:visited, .aI:focus {
  background: rgba(255, 0, 0, 0.);
  width: 100%
}

.aI:hover {
  background: rgba(255, 0, 0, 0.);
  color: #E6E6E6
}

.aI:active {
  background: rgba(255, 0, 0, 0.);
  color: #E6E6E6 ;
}

.aI {
  outline: none;
  text-decoration: none;
  display: inline-block;
  width: 19.5%;
  margin-right: 0.625%;
  text-align: center;
  line-height: 3;
  color: white;
}


.col-sm-3:hover .img-responsive{
filter: brightness(35%);
}

.col-sm-3:hover .centered{
opacity: 1;
}


</style>
</head>


<body>

  <nav class="navbar navbar-inverse">
  <?php include('includes/nav.php'); ?>
  </nav>
<div>
  <form id="form_item" action="Détailitem.php" method="get">

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
                <div class="centered"><li><a href="./Détailitem.php?pic1=lingotdor.jpg" class="aI"><h3>Détails item</h3></a></li></div>

              </div>
            </div>

            <div class="item">
              <img  src="img_items/trainargenté.jpg" alt="Image">
              <div class="carousel-caption">
                <h3>Train en argent</h3>
                <div class="centered"><li><a href="./Détailitem.php?pic1=trainargenté.jpg" class="aI"><h3>Détails item</h3></a></li></div>

              </div>
            </div>




            <div class="item">
              <img src="img_items/tableau_lion.jpg" alt="Image">
              <div class="carousel-caption">
                <h3>Tableau lion</h3>
                <div class="centered"><li><a href="./Détailitem.php?pic1=tableau_lion.jpg" class="aI"><h3>Détails item</h3></a></li></div>


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
          <li ><a href="Catégorie.php?Catégorie=Ferraille ou Trésor" class="aCat">Ferraille ou Trésor</a></li>

        </div>
        <div class="well" style="position: relative; top: 50px">
           <li><a href="Catégorie.php?Catégorie=Bon pour le Musée" class="aCat">Bon pour le Musée</a></li>
        </div>
        <div class="well" style="position: relative; top: 70px">
          <li><a href="Catégorie.php?Catégorie=Accessoire VIP"class="aCat"> Accessoire VIP</a></li>
        </div>
      </div>


    </div>


    <hr>
    </div>

    <div class="container text-center">

      <div class="row">


        <div class="col-sm-3">
           <img src="img_items/cartevip.jpg" class="img-responsive" style="width:100%; margin-top: 24% " alt="Image">
           <p>Carte Vip : accès toilette illimité</p>
           <div class="centered"><li><a href="./Détailitem.php?pic1=cartevip.jpg" class="aI"><h3>Détails item</h3></a></li></div>
      </div>

      <div class="col-sm-3">
        <img src="img_items/lion_sculpture_bois.jpg" class="img-responsive" style="width:100%; height: 310px ; margin-top: 10%" alt="Image">
        <p>Tigrou des bois</p>
        <div class="centered"><li><a href="./Détailitem.php?pic1=lion_sculpture_bois.jpg" class="aI"><h3>Détails item</h3></a></li></div>
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
      <h3>Notre sélection du moment</h3>
      <br>
      <div class="row">

        <div class="col-sm-2">
          <img src="img_items/papier_toilette.jpg" class="img-responsive" style="width:140px; height: 140px;" alt="Image">
          <p>papier toilette insolite</p>
          <div class="centered"><li><a href="./Détailitem.php?pic1=papier_toilette.jpg" class="aI"><h3>Détails item</h3></a></li></div>


        </div>

        <div class="col-sm-2">
          <img src="img_items/ferraille.jpg" class="img-responsive" style="width:140px; height: 140px;" alt="Image">
          <p>8kg de ferraille</p>
          <div class="centered"><li><a href="./Détailitem.php?pic1=ferraille.jpg" class="aI"><h3>Détails item</h3></a></li></div>


        </div>


        <div class="col-sm-2">
          <img src="img_items/tableau-singe-poker-sylvain-binet.jpg" class="img-responsive" style="width:140px; height: 140px;" alt="Image">
          <p>Tableau : YOU</p>
          <div class="centered"><li><a href="./Détailitem.php?pic1=tableau-singe-poker-sylvain-binet.jpg" class="aI"><h3>Détails item</h3></a></li></div>

        </div>

        <div class="col-sm-2">
          <img src="img_items/cocaine.jpg" class="img-responsive" style="width:140px; height: 140px;" alt="Image">
          <p>Fake cocain, to shine in nightclub</p>
            <div class="centered"><li><a href="./Détailitem.php?pic1=cocaine.jpg" class="aI"><h3>Détails item</h3></a></li></div>
        </div>





        <div class="col-sm-2">
          <img src="img_items/briquet_beurette.jpg" class="img-responsive" style="width:140px; height: 140px;" alt="Image">
          <p>Briquet Beurette</p>
          <div class="centered"><li><a href="./Détailitem.php?pic1=briquet_beurette.jpg" class="aI"><h3>Détails item</h3></a></li></div>
        </div>



        <div class="col-sm-2">
          <img src="img_items/lv.jpg" class="img-responsive" style="width:140px; height: 140px;" alt="Image">
          <p>Tableau : Luki/Vist</p>
          <div class="centered"><li><a href="./Détailitem.php?pic1=lv.jpg" class="aI"><h3>Détails item</h3></a></li></div>
        </div>




      </div>
    </div><br>

  </form>
</div>
<?php include('includes/footer.php'); ?>
