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

  if (isset($_POST["submit"])) {
    $log_supp=$donnee['login'];
    $req_supp_vendeur = $bdd->query('UPDATE user SET User_probation = \'3\' WHERE login=\'$log_supp\'');
    $req_supp_vendeur->closeCursor();
    echo "here";
  }





?>
