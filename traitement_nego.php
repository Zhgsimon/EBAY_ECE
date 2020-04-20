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
echo"je suis la";

if(isset($_POST['itemnego'])){
  
}

//L'acheteur a pris une decision
if(isset($_POST['ModifierA'])){
  $id_a_modif=$_POST['keytomodifA'];
  $req_NB_PR=$bdd->query("SELECT `Nb_propositions_restantes` FROM `nego` WHERE `ID_nego`='$id_a_modif'");
  $fetch_NB_PR=$req_NB_PR->fetch();
  $NB_PR=$fetch_NB_PR['Nb_propositions_restantes'] ;
  if($NB_PR>=0){ //si il reste des tentatives
    if(isset($_POST['qst'])){
      if($_POST['qst']=='refuse'){ //l'offre est refusée
        $NB_PR=$NB_PR-1;
        $query = $bdd->prepare('UPDATE nego SET etat =:etat, Nb_propositions_restantes =:Nb_propositions_restantes, prix_acheteur=:prix_acheteur WHERE ID_nego =:ID_nego');
        $success=$query->execute(array(
          ':ID_nego'=> $id_a_modif,
          'etat'=>'2',
          ':Nb_propositions_restantes'=>$NB_PR,
          ':prix_acheteur'=>$_POST['nv_offre']
        ));
      }
      else { //l'offre est acceptée par l'acheteur
        $prix_vendeur=$_POST['prix_vendeur'];
        $query = $bdd->prepare('UPDATE nego SET etat =:etat, prix_acheteur=:prix_acheteur,prix_final=:prix_final WHERE ID_nego =:ID_nego');
        $success=$query->execute(array(
          ':ID_nego'=> $id_a_modif,
          'etat'=>'3',
          ':prix_acheteur'=>$prix_vendeur,
          ':prix_final'=>$prix_vendeur
        ));
      }
    }
  }
  if($NB_PR<0){ //si il ne reste plus de tentatives
    $query = $bdd->query("DELETE from nego WHERE ID_nego='$id_a_modif'");
  echo "je vais etre supp";
  }
  header('Location:negociation_acheteur.php');

}

//Le vendeur a pris une decision
if(isset($_POST['ModifierV'])){
  $id_a_modif=$_POST['keytomodifV'];
  if(isset($_POST['qst'])){
  if($_POST['qst']=='refuse'){ //l'offre est refusée
    $query = $bdd->prepare('UPDATE nego SET etat =:etat, prix_vendeur=:prix_vendeur WHERE ID_nego =:ID_nego');
    $success=$query->execute(array(
      ':ID_nego'=> $id_a_modif,
      'etat'=>'1',
      ':prix_vendeur'=>$_POST['nv_offre']
    ));
  }
  else { //l'offre est acceptée par le vendeur
    $prix_acheteur=$_POST['prix_acheteur'];
    $query = $bdd->prepare('UPDATE nego SET etat =:etat, prix_vendeur=:prix_vendeur,prix_final=:prix_final WHERE ID_nego =:ID_nego');
    $success=$query->execute(array(
      ':ID_nego'=> $id_a_modif,
      'etat'=>'3',
      ':prix_vendeur'=>$prix_acheteur,
      ':prix_final'=>$prix_acheteur
    ));

  }
}
  header('Location:negociation_vendeur.php');

}


 ?>
