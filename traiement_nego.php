<?php
session_start();

//connexion BDD
try
{
  $bdd = new PDO('mysql:host=localhost;dbname=ece_ebay;charset=utf8', 'root', '',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

if(isset($_POST[]))

 ?>
