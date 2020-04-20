<?php
session_start();


$type_carte=$_POST['type_carte'];
$num_carte=$_POST['num_carte'];
$nom_carte=$_POST['nom_carte'];
$CVV=$_POST['CVV'];

$expiryMonth=$_POST['expiryMonth'];
$expiryYear=$_POST['expiryYear'];

$date_expir=$expiryMonth."/".$expiryYear;

$pic1=$_POST['pic1'];
$type_achat=$_POST['type_achat'];
$somme_totale=$_POST['somme_totale'];



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


///ACHETEUR INFOS
//on check si il a dejà des infos bancaire dans la BDD
$stmt = $bdd->prepare("SELECT infobancaire_principale FROM infobancaire WHERE ID_user=? LIMIT 1");
$stmt->execute(array($_SESSION['ID_user']));
$row = $stmt->fetch();
if ($row['infobancaire_principale']==1) {
  //alors il a déjà une carte par défaut
  $infobancaire_priority=0;
}
else {
  //il en a pas cette carte devient la carte par défaut
  $infobancaire_priority=1;
}
//on rajoute les infos bancaires dans la BDD
$req = $bdd->prepare('INSERT INTO infobancaire(type_carte, num_carte, nom_carte, date_expir, CVV, infobancaire_principale,ID_user)
VALUES (:type_carte, :num_carte, :nom_carte, :date_expir, :CVV, :infobancaire_principale, :ID_user )'); // préparation de la requête

//on rajoute la carte dans la base de données
  // écriture dans la base de données
  $req->execute(array(
  'type_carte' => $type_carte,
  'num_carte' => $num_carte,
  'nom_carte' => $nom_carte,
	'date_expir' => $date_expir,
  'CVV' => $CVV,
  'infobancaire_principale' => $infobancaire_priority,
  'ID_user' => $_SESSION['ID_user']

  ));

if ($type_achat=='achat_immediat'||$type_achat=='achat_enchère'||$type_achat=='achat_nego') {
  //pas payer par le panier
  $panier=NULL;

  ///VENDEUR INFOS
  //On recherche l'id du vendeur à qui appartient l'item
  $stmt_vendeur = $bdd->prepare("SELECT ID_vendeur FROM item WHERE pic1=? LIMIT 1");
  $stmt_vendeur->execute(array($pic1));
  $row_vendeur = $stmt_vendeur->fetch();

  //On recherche les infos bancaire du vendeur à qui appartient l'item
  $stmt_infobancaire_vendeur = $bdd->prepare("SELECT ID_infobancaire FROM infobancaire WHERE ID_user=? LIMIT 1");
  $stmt_infobancaire_vendeur->execute(array($row_vendeur['ID_vendeur']));
  $row_infobancaire_vendeur = $stmt_infobancaire_vendeur->fetch();

  //On recherche les infos bancaire de l'acheteur à qui achète l'item
  $stmt_infobancaire_acheteur = $bdd->prepare("SELECT ID_infobancaire FROM infobancaire WHERE ID_user=? AND num_carte=? LIMIT 1");
  $stmt_infobancaire_acheteur->execute(array($_SESSION['ID_user'], $num_carte));
  $row_infobancaire_acheteur = $stmt_infobancaire_acheteur->fetch();
}


//est-ce qu'on a voulu ré

  //on vérifie si le paiement est effectué avec la banque imaginaire
  //on rajoute le paiement dans la BDD

  $req = $bdd->prepare('INSERT INTO paiement(date_paiement, ID_User_acheteur, ID_User_vendeur, ID_panier, ID_infobancaire_acheteur, prix_paiement, ID_infobancaire_vendeur)
  VALUES (:date_paiement, :ID_User_acheteur, :ID_User_vendeur, :ID_panier, :ID_infobancaire_acheteur, :prix_paiement, :ID_infobancaire_vendeur )');

  $date_paiement=date("Y-m-d H:i:s");

  $req->execute(array(
  'date_paiement' => $date_paiement,
  'ID_User_acheteur' => $_SESSION['ID_user'],
  'ID_User_vendeur' => $row_vendeur['ID_vendeur'],

	'ID_panier' =>  $panier,
  'ID_infobancaire_acheteur' => $row_infobancaire_acheteur['ID_infobancaire'],
  'prix_paiement' =>$somme_totale,
  'ID_infobancaire_vendeur' => NULL
  ));

	//et on update l'état de l'item
	$stmt_update_item = $bdd->prepare("UPDATE item SET etat_vente=?  WHERE pic1=?");
  $stmt_update_item->execute(array('vendu',$pic1));



  header('Location: Achat.php');

?>
