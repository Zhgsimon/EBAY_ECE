<?php
session_start();

$login=isset($_POST['login']) ? $_POST['login']:"";
$password1=isset($_POST['password1']) ? $_POST['password1']:"";
$password2=isset($_POST['password2']) ? $_POST['password2']:"";
$Name=isset($_POST['Name']) ? $_POST['Name']:"";
$First_name=isset($_POST['First_name']) ? $_POST['First_name']:"";
$Pseudo=isset($_POST['Pseudo']) ? $_POST['Pseudo']:"";
//$Num_tel=isset($_POST['Num_tel']) ? $_POST['Num_tel']:"";
$Birthdate=isset($_POST['Birthdate']) ? $_POST['Birthdate']:"";
//$Num_tel=$_POST['Num_tel'];

$numcarte=$_POST['num_carte'];

$expiryMonth=$_POST['expiryMonth'];
$expiryYear=$_POST['expiryYear'];

$date_expir=$expiryMonth."/".$expiryYear;


//si j'ai appuyé sur le bouton submit
if($_POST['submit'])
{
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


	$test = true;

	//si les champs ne sont pas vides
	if (!empty($_POST['password1'])&& !empty($_POST['password2']&& !empty($_POST['login'])&&!empty($_POST['Name'])
	&&!empty($_POST['First_name']))) {

	  //si les mdp saisis sont les mêmes
	  if ($_POST['password1']==$_POST['password2']){
			echo "ok2";
	    $rep = $bdd->query('SELECT * FROM user');
	    //je parcours ma table user
	    while ($donnees = $rep->fetch())
	    {
	      //et que l'email et déjà utilisé
	      if($_POST['login']==$donnees['login']) {
	        $test = false;
	        $erreur = "L'adresse e-mail est déjà utilisé. Veuillez fournir une adresse e-mail valide." ;
	      }
	    }
	  }
	  else {
	    $test = false;
	    $erreur = "Les mots de passe doivent être identiques";

	  }

	}
	else {

	  $test = false;
	  $erreur = "Tous les champs doivent être remplis";
	}

	//on écrit dans la base de données
	$req = $bdd->prepare('INSERT INTO user(login, password, Name, First_name, Pseudo, Num_tel, Birthdate, User_privilege, User_probation)
	VALUES (:login, :password, :Name, :First_name, :Pseudo, :Num_tel, :Birthdate, :User_privilege, :User_probation)'); // préparation de la requête
	echo $test."  est la valeur de test";
	if ($test==true) {
		echo "ok4";
	  // écriture dans la base de données
	  $req->execute(array(
	  'login' => $_POST['login'],
	  'password' => $_POST['password1'],
	  'Name' => $_POST['Name'],
		'First_name' => $_POST['First_name'],
	  'Pseudo' => $_POST['Pseudo'],
	  'Num_tel' => $_POST['Num_tel'],
	  'Birthdate' => $_POST['Birthdate'],
	  'User_privilege'=> '2',
		'User_probation' =>'1'
	  ));
		//Une fois rajouté on récup son ID_User
		$stmt = $bdd->prepare("SELECT ID_user FROM user WHERE login=? LIMIT 1");
		$stmt->execute(array($_POST['login']));
		$row = $stmt->fetch();


		$req_infobancaire_vendeur = $bdd->prepare('INSERT INTO infobancaire(type_carte, num_carte, nom_carte, date_expir, CVV, infobancaire_principale,ID_user)
		VALUES (:type_carte, :num_carte, :nom_carte, :date_expir, :CVV, :infobancaire_principale, :ID_user )'); // préparation de la requête

		//on rajoute la carte dans la base de données
		  // écriture dans la base de données
		  $req_infobancaire_vendeur->execute(array(
		  'type_carte' => $_POST['type_carte'],
		  'num_carte' => $_POST['num_carte'],
		  'nom_carte' => $_POST['nom_carte'],
			'date_expir' => $date_expir,
		  'CVV' => $_POST['CVV'],
		  'infobancaire_principale' => '1',
		  'ID_user' => $row['ID_user']

		  ));


	  header('Location: login.php');
	}

}
else {
	//accès refusé
	header("Location:erreur404.php");
}





?>
