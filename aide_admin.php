
<?php
ob_start();
session_start();

if(isset($_SESSION['ID_user'])&& $_SESSION['User_privilege']==3)
{
  //Si l'admin est conecté
}
else {
  //Si il n'est pas connecté on le redirige vers la page de login
  header("Location:login.php?location=" . urlencode($_SERVER['REQUEST_URI']));
  // Note: $_SERVER['REQUEST_URI'] is your current page
}


include('includes/header.php') ?>
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

  <div class="container" style="margin-bottom : 150px">
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







<?php include('includes/footer.php');
ob_end_flush();
 ?>



  </body>
  </html>
