<?php
session_start();

$login=$_POST['login'];
$password=$_POST['password'];

$redirect = NULL;
if($_POST['location'] != '') {
		$redirect = $_POST['location'];
		echo $redirect;
}

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

	//lecture dans la base

	$rep = $bdd->query('SELECT * FROM user');

	$found = FALSE;
  while ($donnees = $rep->fetch())
	{
		if($donnees['login'] == $login)
		{
			if($donnees['password'] == $password)
			{
				$found = TRUE;
				//récupération des données utilisateurs
        $_SESSION['ID_user'] = $donnees['ID_user'];
        $_SESSION['login'] = $donnees['login'];
        $_SESSION['password'] =$donnees['password'];
        $_SESSION['First_name'] = $donnees['First_name'];
				$_SESSION['Name'] = $donnees['Name'];
        $_SESSION['Pseudo'] =$donnees['Pseudo'];
        $_SESSION['Num_tel'] =$donnees['Num_tel'];
        $_SESSION['Birthdate'] =$donnees['Birthdate'];
				$_SESSION['User_privilege'] =$donnees['User_privilege'];


				//récuperation de la photo de profile
				$_SESSION['Photo'] = $donnees['Photo'];

				// if login is successful and there is a redirect address, send the user directly there
				if($redirect)
				{
				 header("Location:". $redirect);
			 	}
				else
				{
				 	header('Location: index.php');
				}
				exit();
			}
		}
	}
	if($found == FALSE) {echo '<div>Mauvais identifiants : veuillez réessayer.</div>' ;
		//Si les champs sont vides alors on est toujours pas connecté
		if((empty($login) OR empty($password) AND !isset($_SESSION['ID_user']))) {
		    $url = 'login.php?p=1';
		    // if we have a redirect URL, pass it back to login.php so we don't forget it
		    if(isset($redirect)) {
		        $url .= '&location=' . urlencode($redirect);
		    }
		   header("Location: " . $url);
		   exit();
		}



	}

  $rep->closeCursor();

?>
