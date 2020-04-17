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
          <li><a href="admin_vendeurs.php">Vendeurs</a></li>
          <li><a href="admin_item.php">Item</a></li>
          <li class="active"><a href="aide.html">Aide</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="../index.html"><span class="glyphicon glyphicon-log-out"></span> Quitter mon espace admin</a></li>
        </ul>
      </div>
    </div>
  </nav>


  <div class="container">
    <div class="row">
      <div class="col-sm-12 well">
        <h1><center>F.A.Q</center></h1>
      </div>
      <div class="col-sm-12 ">
        <div class="panel-group" id="accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">1. Comment est organisé l'espace administrateur ?</a>
              </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
              <div class="panel-body">
                Dans l'espace administrateur, vous trouverez deux onglets:<br>- <strong>Vendeurs</strong> :gestion des vendeurs (cf question 2).
                  <br>- <strong>Item</strong>: gestion des items (cf question 3).
              </div>
            </div>
          </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Is rezr registration required?</a>
                  </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse in">
                  <div class="panel-body">
                    Account registration at <strong>PrepBootstrap</strong> is only required if you will be selling or buying themes.
                    This ensures a valid communication channel for all parties involved in any transactions.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>







<?php include('../includes/footer.php') ?>



  </body>
  </html>
