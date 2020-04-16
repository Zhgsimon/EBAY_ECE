<?php
try
{
	// On se connecte à MySQL
  $database = "EBAY_ECE";
	//connectez-vous dans votre BDD
	$db_handle = mysqli_connect('localhost', 'root', '');
	$db_found = mysqli_select_db($db_handle, $database);

}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

// Si tout va bien, on peut continuer

// On récupère tout le contenu
/*
$ID_User = 1;
$name = $bdd->query('SELECT name FROM user WHERE ID_user==ID_User ');
$first_name = $bdd->query('SELECT First_name FROM user');
$login = $bdd->query('SELECT login FROM user');
$password = $bdd->query('SELECT password FROM user');
$pseudo = $bdd->query('SELECT pseudo FROM user');
$Photo = $bdd->query('SELECT photo FROM user');
$Num_tel = $bdd->query('SELECT Num_tel FROM user');
$Birthdate = $bdd->query('SELECT Birthdate FROM user');*/



//Qd on aua la méthode GET[ID_user] pour l'instant je le met en dur
//$req = $database->prepare('SELECT name, First_name, login, password, pseudo, photo, Num_tel, Birthdate prix FROM user WHERE ID_User = ? ');
//$req->execute(array($_GET['ID_user']));

$info = $database->prepare('SELECT name, First_name, login, password, pseudo, photo, Num_tel, Birthdate prix FROM user WHERE ID_User = \'1\' ');

echo '<ul>';
//while ($donnees = $req->fetch())
//{
	echo '<li>' . $info['name'] . ' (' . $info['First_name'] . ' )</li>';
//}
echo '</ul>';

$reponse->closeCursor(); // Termine le traitement de la requête

?>
