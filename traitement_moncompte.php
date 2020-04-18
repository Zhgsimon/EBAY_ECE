<?php
session_start();


try
{
  $bdd = new PDO('mysql:host=localhost;dbname=ece_ebay;charset=utf8', 'root', '',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

//Modification adresse
if(isset($_POST['Modifier'])) {
  $id_a_modif=$_POST['keytomodif'];
$query = $bdd->prepare('UPDATE adresse_livraison SET Nom =:nom, Prenom =:prenom, Num_tel=:num_tel, Num_rue=:num_rue, Nom_rue=:nom_rue, Code_postal=:code_postal, Ville=:ville, Pays=:pays WHERE ID_adresse_livraison =:ID_adresse_livraison');

$success = $query->execute(array(
  ':ID_adresse_livraison' => $id_a_modif,
  ':nom' => $_POST['name'],
  ':prenom' => $_POST['First_name'],
  ':num_tel' => $_POST['tel'],
  ':num_rue' => $_POST['num_rue'],
  ':nom_rue' => $_POST['rue'],
  ':code_postal' => $_POST['postal_code'],
  ':ville' => $_POST['ville'],
  ':pays' => $_POST['pays']

));
}

//Modification CB
if(isset($_POST['ModifierCB'])) {
  $id_a_modif_CB=$_POST['keytomodifCB'];

$query = $bdd->prepare('UPDATE infobancaire SET nom_carte =:nom, type_carte =:type, num_carte=:num, date_expir=:date_exp, CVV=:CVV WHERE ID_infobancaire =:ID_CB');

$success = $query->execute(array(
  ':ID_CB' => $id_a_modif_CB,
  ':nom' => $_POST['name'],
  ':type' => $_POST['type'],
  ':num' => $_POST['num'],
  ':date_exp' => $_POST['date_exp'],
  ':CVV' => $_POST['cvv']

));
}
header('Location:moncompte_acheteur.php');

 ?>
