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
$sql="SELECT ID_user, Name, First_name, login, Pseudo  FROM user WHERE User_privilege = '2' AND User_probation = '0'";
$req_vendeur_good = $bdd->query($sql);
//$req_vendeur_attente = $bdd->query('SELECT name, First_name, login, pseudo, Photo  FROM user WHERE User_privilege = \'2\' AND User_probation = \'1\' ');
//$req_vendeur_signale = $bdd->query('SELECT name, First_name, login, pseudo, Photo  FROM user WHERE User_privilege = \'2\' AND User_probation = \'2\' ');

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








<div class = "container col-sm-12 well">
  <div class="col-sm-2">

  </div>
  <div class="col-sm-8">
    <h3><center><strong> Liste des vendeurs actuels</strong></center> </h3>
    <table class="table table-condensed table-bordered">
      <tr>
        <th>ID_user</th>
        <th>First_name</th>
        <th>Name</th>
        <th>login</th>
        <th>Pseudo</th>
        <th>Select</th>
        <th>Delete</th>
      </tr>

      <?php while ($donnee = $req_vendeur_good->fetch()): ?>
        <tr>
          <form class="" role="form" method="post">
            <td><?php echo $donnee['ID_user']; ?></td>
            <td><?php echo $donnee['First_name']; ?></td>
            <td><?php echo $donnee['Name']; ?></td>
            <td><?php echo $donnee['login']; ?></td>
            <td><?php echo $donnee['Pseudo']; ?></td>
            <td><input type="checkbox" name="keytodelete" value="<?php echo $donnee['ID_user']; ?>" required>  </td>
            <td><input type="submit" name="submitDeletebutton" class="btn btn-info" value="Supprimer"> </td>

          </form>
        </tr>

      <?php endwhile; ?>

      <?php
          if (isset($_POST['submitDeletebutton'])) {
            $id_a_supprimer=$_POST['keytodelete'];

            $req_vendeur_existe = $bdd->query("SELECT * FROM user WHERE ID_user='$id_a_supprimer'");

            $count = $req_vendeur_existe->rowCount();

            if ($count>0) {

            //si l'array est rempli d'au moins 1 on supprime de la liste des vendeurs autorisés
            //  $req_supp_vendeur=$bdd->query('UPDATE user SET User_probation=3 WHERE ID_user=\'$id_a_supprimer\' ');
              $query = $bdd->prepare('UPDATE user SET User_probation = :User_probation WHERE ID_user = :ID_user');

              $success = $query->execute(array(
                ':ID_user' => $id_a_supprimer,
                ':User_probation' => '3'
              ));

              //$req_supp_vendeur = $bdd->query('UPDATE user SET User_probation =\'3\' WHERE  ID_user=\'$id_a_supprimer\' ');
              echo '<div class="alert alert-success"> <p>La ligne a été supprimé</p> </div>';
              header('Location:admin_vendeurs.php');

            }
            else {
              ///warning la ligne n'existe pas
              echo '<div class="alert alert-warning"> <p>La ligne n'.'existe pas</p> </div>';
            }

          }
      ?>

    </table>



  <div class="col-sm-2">

  </div>

</div> <!-- container ligne 112-->




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
