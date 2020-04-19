<?php
session_start();
echo "ID_user=".$_SESSION['ID_user'];

$test = false;

if (isset($_POST['submit'])) {
  //si j'ai appuyé sur submit

  $file=$_FILES['pic1'];

  $file_name=$_FILES['pic1']['name'];
  $file_tmpName=$_FILES['pic1']['tmp_name'];
  $file_size=$_FILES['pic1']['size'];
  $file_error=$_FILES['pic1']['error'];

  $file_ext=explode('.',$file_name);
  $file_actual_ext=strtolower(end($file_ext));

  $allowed=array('jpg','jpeg','png');
  echo $file_error;

  if (in_array($file_actual_ext, $allowed)) {
    if ($file_error===0) {
      // il n'y a pas d'erreurs
      if ($file_size<100000) {
        // taille ok
        $file_name_new=uniqid('',true).".".$file_actual_ext;
        $file_destination='img_items/'.$file_name_new;
        move_uploaded_file($file_tmpName,$file_destination);
        $test = true;
        echo "upload successful";
        //header("Location: test_vendre_objets.php?uploadsuccess");
      }
      else {
        echo "La taille du fichier est trop grande";
      }
    }
    else {
      // il y a une erreur
      echo "Une erreur est survenue quand vous uploadez votre fichier";
    }

  }
  else {
    echo "Fichier de ce type pas pris en charge";
  }

  $name_item=$_POST['name_item'];
  $pic1=$file_name_new;
  $description=$_POST['description'];
  $Categorie=$_POST['Categorie'];
  $prix_nego_init=$_POST['prix_nego_init'];
  $prix_immediat=$_POST['prix_immediat'];
  $prix_enchere_2=$_POST['prix_enchere_2'];

  $duree_vente=$_POST['duree_vente'];


  if ($test==false) {
    echo "Upload unsuccessful";
  }
  else {
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


    $req = $bdd->prepare('INSERT INTO item(name_item, pic1, video, description, Categorie, etat_vente, prix_nego_init,prix_immediat,prix_enchere_2,ID_vendeur, duree_vente)
    VALUES (:name_item, :pic1, :video, :description, :Categorie, :etat_vente, :prix_nego_init, :prix_immediat, :prix_enchere_2, :ID_vendeur, :duree_vente)'); // préparation de la requête

      if ($req->execute(array(
      'name_item' => $name_item,
      'pic1' => $pic1,
      'video' => NULL,
    	'description' => $description,
      'Categorie' => $Categorie,

      'etat_vente' => 'en_attente',
      'prix_nego_init' => $prix_nego_init,
      'prix_immediat' => $prix_immediat,
      'prix_enchere_2'=> $prix_enchere_2,
      'ID_vendeur' => $_SESSION['ID_user']),
      'duree_vente' => $_SESSION['duree_vente'])
      ))
      {
       // it worked
       //header('Location: objet_en_vente.php');
       echo "OKKK";
      }

      else {
       // it didn't
       echo "Cela n'a pas marché";
     }
  }



}





?>
