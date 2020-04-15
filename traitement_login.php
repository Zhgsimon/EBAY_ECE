<?php
session_start();

$login=$_POST['login'];
$password=$_POST['password'];
//$login=isset($_POST['user_mail']) ? $_POST['user_mail'] : "";
//$password = isset($_POST['password']) ? $_POST['password'] : "";


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
				header('Location: index.html');
			}
		}
	}
	if($found == FALSE) {echo '<div>Mauvais identifiants : veuillez réessayer.</div>' ;
		//echo $login;
		//echo $password;
	}
        $rep->closeCursor();

?>
