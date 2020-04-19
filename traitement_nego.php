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

//L'acheteur a pris une decision
if(isset($_POST['ModifierA'])){
  $id_a_modif=$_POST['keytomodifA'];
  if(isset($_POST['refuse'])){ //l'offre est refusée
    $req_NB_PR=$bdd->query("SELECT `Nb_propositions_restantes` FROM `nego` WHERE `ID_nego`='$id_a_modif'");
    $fetch_NB_PR=$req_NB_PR->fetch();
    $NB_PR=$fetch_NB_PR['Nb_propositions_restantes'] -1;
    $query = $bdd->prepare('UPDATE nego SET tour =:tour, Nb_propositions_restantes =:Nb_propositions_restantes, prix_acheteur=:prix_acheteur WHERE ID_nego =:ID_nego');
    $success=$query->execute(array(
      ':ID_nego'=> $id_a_modif,
      'tour'=>'1',
      ':Nb_propositions_restantes'=>$NB_PR,
      ':prix_acheteur'=>$_POST['nv_offre']
    ));

  }
  else { //l'offre est acceptée

  }

  header('Location:negociation_acheteur.php');

}

//Le vendeur a pris une decision
if(isset($_POST['ModifierV'])){
  $id_a_modif=$_POST['keytomodifV'];
  if(isset($_POST['refuse'])){ //l'offre est refusée
    $query = $bdd->prepare('UPDATE nego SET tour =:tour, prix_vendeur=:prix_vendeur WHERE ID_nego =:ID_nego');
    $success=$query->execute(array(
      ':ID_nego'=> $id_a_modif,
      'tour'=>'0',
      ':prix_vendeur'=>$_POST['nv_offre']
    ));

  }
  else { //l'offre est acceptée

  }

  header('Location:negociation_acheteur.php');

}



 ?>
