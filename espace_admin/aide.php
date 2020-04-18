<html lang="en">
<head>
  <title>Mon compte</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="moncompte_acheteur.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
          <li><a href="admin_item.php">Item</a></li>
          <li class="active"><a href="aide.php">Aide</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="../index.php"><span class="glyphicon glyphicon-log-out"></span> Quitter mon espace admin</a></li>
        </ul>
      </div>
    </div>
  </nav>


  <div class="container">
    <div class="row">
      <div class="col-sm-12 well">
        <h1><center><span class="glyphicon glyphicon-question-sign"></span> F.A.Q</center></h1>
      </div>
      <div class="col-sm-12 ">
        <div class="panel-group" id="accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">1. Comment est organisé l'espace administrateur ?</a>
              </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse out">
              <div class="panel-body">
                Dans l'espace administrateur, vous trouverez deux onglets:<br>- <strong>Vendeurs</strong> :gestion des vendeurs (<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">question 2</a>).
                  <br>- <strong>Item</strong>: gestion des items (<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">cf question 3</a>).
              </div>
            </div>
          </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">2. Comment est organisé l'onglet vendeur ?</a>
                  </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse out">
                  <div class="panel-body">
                  Dans cet onglet, les vendeurs sont dispersés en 3 catégories :<br>- La <strong>liste des vendeurs</strong>: ce sont les vendeurs qui peuvent actuellement
                  vendre. Vous avez la possibilité de les <strong> supprimer</strong> en appuyant sur le bouton supprimer.<br>- Les <strong>vendeurs en attente</strong>
                   viennent de s'inscire et attendent votre approbation pour commencer à vendre. Vous pouvez <strong>accepter </strong>ou <strong>refuser </strong>
                  qu'ils deviennent vendeurs.<br>- Les <strong>vendeurs signalés</strong> sont des vendeurs qui ont été signalés par les acheteurs, vous pouvez <strong>
                    ignorer ce signalement</strong> en cliquant sur ignorer ou <strong>supprimer </strong> le vendeur de la plateforme en cliquant sur supprimer.
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">3. Comment est organisé l'onglet item ?</a>
                </h4>
              </div>
              <div id="collapseThree" class="panel-collapse collapse out">
                <div class="panel-body">
                Dans cet onglet, les items sont dispersés en 3 catégories :<br>- La <strong>liste des items</strong>: ce sont les items qui sont actuellement
                en vente. Vous avez la possibilité de les <strong> supprimer</strong> en appuyant sur le bouton supprimer.<br>- Les <strong>items en attente</strong>
                viennent d'être ajoutés et ont besoin de votre approbation pour être mis en vente. Vous pouvez <strong>accepter </strong>ou <strong>refuser </strong>
                qu'ils soient mis en vente.<br>- Les <strong>items signalés</strong> sont des items qui ont été signalés par les acheteurs, vous pouvez <strong>
                  ignorer ce signalement</strong> en cliquant sur ignorer ou <strong>supprimer </strong> l'item de la plateforme en cliquant sur supprimer.
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">4. Comment sortir de mon espace ?</a>
              </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse out">
              <div class="panel-body">
            En cliquant sur <strong>"Quitter mon espace admin"</strong> vous serez redirigés vers la page d'accueil.
            </div>
          </div>
        </div>
          </div>
        </div>
      </div>
    </div>







<?php include('../includes/footer.php') ?>



  </body>
  </html>
