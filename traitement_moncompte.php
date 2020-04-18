<?php
session_start();

$id_a_modif=$_POST['keytomodif'];
$name=$_POST['name'];
$Frist_name=$_POST['First_name'];
$tel=$_POST['tel'];
$num_rue=$_POST['num_rue'];
$nom_rue=$_POST['rue'];
$postal_code=$_POST['postal_code'];
$ville=$_POST['ville'];
$pays=$_POST['pays'];

try
{
  $bdd = new PDO('mysql:host=localhost;dbname=ece_ebay;charset=utf8', 'root', '',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
if(isset($_POST['Modifier'])) {
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
header('Location:moncompte_acheteur.php');

 ?>
