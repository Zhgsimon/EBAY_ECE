<?php
session_start();

if(isset($_SESSION['ID_user']))
{
  //Si l'acheteur est connecté on lui affiche les moyens de paiement
}
else {
  //Si il n'est pas connecté on le redirige vers la page de login
  header("Location:login.php?location=" . urlencode($_SERVER['REQUEST_URI']));
  // Note: $_SERVER['REQUEST_URI'] is your current page
}
$pic1=$_GET['submit_action'];

//Si il a appuyé sur ajout dans le panier
  try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=ece_ebay;charset=utf8', 'root', '',
					array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}

	catch (Exception $e)
	{
			die('Erreur : ' . $e->getMessage());
	}

  //on cherche dans la BDD si l'utilisateur a déjà un panier
  $stmt_panier = $bdd->prepare("SELECT * FROM panier WHERE ID_User=? LIMIT 1");
  $stmt_panier->execute(array($_SESSION['ID_user']));
  $row_panier = $stmt_panier->fetch();

  $stmt_item = $bdd->prepare("SELECT * FROM item WHERE pic1=? LIMIT 1");
  $stmt_item->execute(array($pic1));
  $row_item = $stmt_item->fetch();


  if ($row_panier)
  {
    //si son panier existe déjà on rajoute dans contient les item_id lié au panier ID
    //echo "Assigned";

    $req = $bdd->prepare('INSERT INTO contient(ID_panier, ID_item)
    VALUES (:ID_panier, :ID_item)'); // préparation de la requête
    //$req->execute(array($row_panier['ID_panier'], $row_item['ID_item'] ));
    $req->execute(array(':ID_panier'=> $row_panier['ID_panier'],
                        ':ID_item'=> $row_item['ID_item']));

  }
  else
  {
    //sinon on créer son panier et déjà on rajoute dans contient les item_id
    //echo "Available";

    //Création du nouveau panier
    $new_panier = $bdd->prepare('INSERT INTO panier(ID_User)
    VALUES (:ID_User)'); // préparation de la requête
    //$new_panier = $bdd->prepare('INSERT INTO panier(ID_User) VALUES (:ID_User)');
    //on rajoute un panier lié avec l'id de l'utilisateur
    $new_panier->execute(array(':ID_User'=> $_SESSION['ID_user']));


    //On re-va dans la bdd pour chercher l'id du panier lié à l'utilisateur
    $stmt_panier_new = $bdd->prepare("SELECT * FROM panier WHERE ID_User=? LIMIT 1");
    $stmt_panier_new->execute(array($_SESSION['ID_user']));
    $row_panier_new = $stmt_panier_new->fetch();

    //on rajoute l'item dans contient avec l'id du panier et l'id de l'item
    $req = $bdd->prepare('INSERT INTO contient(ID_panier, ID_item)
    VALUES (:ID_panier, :ID_item)'); // préparation de la requête
    $req->execute(array(':ID_panier'=> $row_panier_new['ID_panier'],
                        ':ID_item'=> $row_item['ID_item']));
  }
  header('Location: Panier.php');
?>
