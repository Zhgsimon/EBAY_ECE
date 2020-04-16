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
$req_vendeur_good = $bdd->query('SELECT name, First_name, login, pseudo, Photo  FROM user WHERE User_privilege = \'2\' AND User_probation = \'0\' ');
$req_vendeur_attente = $bdd->query('SELECT name, First_name, login, pseudo, Photo  FROM user WHERE User_privilege = \'2\' AND User_probation = \'1\' ');
$req_vendeur_signale = $bdd->query('SELECT name, First_name, login, pseudo, Photo  FROM user WHERE User_privilege = \'2\' AND User_probation = \'2\' ');

?>






<!DOCTYPE html>
<html lang="en">
<head>
  <title>Mon compte</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Remember to include jQuery :) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
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








<div class = "container">
  <div class="row">

    <div class = "col-sm-6 well">
      <div class = "well">
        <h3><center><strong> Liste des vendeurs actuels</strong></center> </h3>
      </div><!-- well ligne 73 encadré du titre-->

      <?php
        while ($donnee = $req_vendeur_good->fetch())
          {
      ?>


        <div class = "col-sm-3 text-center">
          <?php
           $photo=$donnee['Photo'];
             echo $photo;
             if(!$photo) { $photo="../pic.jpg"; }
             echo '<img src = "'.$photo.' " class="img-circle" height="80" width="80" alt="Photo"/>';
          ?>
        </div><!-- col-sm-3 ligne 84-->

        <div class="col-sm-7 ">
            <h4><strong>
              <?php
                echo $donnee['First_name'];
                echo $donnee['name']; ?>
            </strong></h4>
            <p><?php echo $donnee['login'];?>
                <br><?php echo $donnee['pseudo'];?></p>
        </div><!-- col-sm-7 ligne 95-->

        <div class="col-sm-2">
          <form method="post">

          <a href="#deleteModal" class ="btn btn-black" rel="modal:open" role="button"> <span class="glyphicon glyphicon-trash"></span></a>

          <!-- Modal supprimer -->
          <div id="deleteModal" class="modal">
            <div class="modal-header">
              <h4 class="modal-title"><strong><center>Êtes-vous sur de vouloir supprimer ce vendeur?</center></strong></h5>
            </div>
            <div class="modal-body">
              <center>En supprimant ce vendeur, vous supprimerez également ses items en cours et la possibilité pour lui de re-vendre des choses.</center>
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-black" name="valider" value="Valider"> <input type="hidden" name="sup" value="<?php echo $donnee['login']; ?>"></input></input>
              <input type="submit" class="btn btn-black" name="annuler" value="Annuler"></input>
          <p>
                <?php

                        echo $_POST['sup'];
                        if(isset($_POST['valider'])) {
                          if (isset($_POST)){
                            echo "je suis la";
                            $log_supp=$_POST['sup'];
                            echo $log_supp;
                            $req_supp_vendeur = $bdd->prepare('UPDATE user SET User_probation = \'3\' WHERE login= ? ');
                            $req_supp_vendeur->execute(array($log_supp));
                          }


                        }
                        //$sup=0 faudrait reset la

                    ?>

                  </p>
            </form>
            </div>
          </div> <!-- fin modal-->

          <a href="#infoModal" class="btn btn-black" rel="modal:open" role="button"> + d'infos</a>
        </div><!-- col-sm-2 ligne 103-->

      <?php } ?>
    </div><!-- col-sm-6 well ligne 72-->


    <div class="col-sm-6">
      <div class="row">
        <div class ="col-sm-12 well">
          <h4><center>Nouveaux vendeurs en attente</center></h4>
          <h4><span class ="glyphicon glyphicon-hourglass"></span>Prochaine(s) livraison(s)</h4>
          <p><strong>Fri. 27 November 2015</strong></p>

        </div>




        <div class ="col-sm-12 well">
          <h4><center>Vendeurs signalés</center></h4>
        </div>


     </div>
    </div>

  </div><!-- row ligne 71-->
</div> <!-- container ligne 70-->




<!-- Modal info -->
<div id="infoModal" class="modal">
  <div class="modal-header">
    <h4 class="modal-title"><strong><center>Articles mis en vente par cet acheteur</center></strong></h5>
  </div>
  <div class="modal-body">
    <center>
      En supprimant ce vendeur, vous supprimerez également ses items en cours et la possibilité pour lui de re-vendre des choses.
    </center>
  </div>
  <div class="modal-footer">
    <form method="post">
    <input type="submit" class="btn btn-black" name="valider" value="Valider"></input>
    <input type="submit" class="btn btn-black" name="annuler" value="Annuler"></input>

      <?php

              if(isset($_POST['valider'])) {
                $log_supp=$donnee['login'];
                echo $log_supp;
                $req_supp_vendeur = $bdd->query('UPDATE user SET User_probation = \'3\' WHERE login=\'$log_supp\'');
              }


          ?>
  </form>
  </div>
</div> <!-- fin modal-->









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
