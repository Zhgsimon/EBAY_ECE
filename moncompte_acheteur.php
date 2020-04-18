<?php
ob_start();

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
/*
$req = bdd->query('SELECT name, First_name, login, password, pseudo, photo, Num_tel, Birthdate FROM user WHERE ID_User = '1' ');
$info=$req->fetch();
*/
$id_user=$_SESSION['ID_user'];
$req_adresse = $bdd->query("SELECT * FROM `adresse_livraison` WHERE `ID_user`='$id_user' AND `adresse_principale` = 1");


?>





<?php include('includes/header.php') ?>
<!-- jQuery Modal -->
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
</head>


<div class="container">
 <div class="row ">
   <div class="col-sm-3 well ">
     <div class="well text-center">
       <img src="pic.jpg" class="img-circle" height="65" width="65" alt="Photo">
       <h4>
         <?php
          echo $_SESSION['Pseudo'];
        ?>
      </h4>
       <p>
         <?php
          echo $_SESSION['First_name'] ;
          echo $_SESSION['Name'];
        ?>


       </p>
     </div>
     <div class="well text-left">
       <h4>Vos informations : </h4>
      <p> <span class ="glyphicon glyphicon-envelope"></span>
        <?php
         echo $_SESSION['login'];
         ?>
       </p>
       <p> <span class ="glyphicon glyphicon-earphone"></span>
         <?php
          echo $_SESSION['Num_tel'];
          ?>
        </p>
       <p><span class ="glyphicon glyphicon-gift"></span>
         <?php
          echo $_SESSION['Birthdate'];
          ?>
        </p>
     </div>

     <p><a href="#Aide"><span class ="glyphicon glyphicon-question-sign"></span> Aide</a></p>

     <p align="justify"><small> <strong>Rappel:</strong> Vous avez accepter la clause stipulant que si vous faites une
        offre sur un article, vous est êtes sous obligation légale de l'acheter si le vendeur accepte votre offre. </small></p>
   </div>


   <div class="col-sm-7">
     <div class="row">
			 <?php if ($adresse=$req_adresse->fetch()){ ?>

       <div class="col-sm-12 well">

					 <div class= "col-sm-7">

           <h3><span class ="glyphicon glyphicon-plane"></span> Vos informations de livraison </h3>
            <p>
              <strong>Nom</strong><br><?php echo $adresse['Nom']?><br>
              <strong>Prenom</strong><br><?php echo $adresse['Prenom']?><br>
              <strong>Numero de téléphone</strong><br>0<?php echo $adresse['Num_tel']?> <br>
              <strong>Adresse</strong><br> <?php echo $adresse['Num_rue']?>  <?php echo $adresse['Nom_rue']?> <br>
              <strong>Ville</strong> <br><?php echo $adresse['Ville']?><br>
              <strong>Code Postal</strong> <br><?php echo $adresse['Code_postal']?> <br>
              <strong>Pays</strong> <br> <?php echo $adresse['Pays']?>
            </p>

					</div>
					<div class="col-sm-5">
						<a href="#deleteModal" class ="btn btn-black" style="float: right;" rel="modal:open" role="button" name="sup" value="<?php $adresse['ID_adresse_livraison']?>"><span class="glyphicon glyphicon-trash"></span>Supprimer</a>
						<a href="#modifModal" class="btn btn-black" style="float: right;" rel="modal:open" role="button" name="modif" value="<?php $adresse['ID_adresse_livraison']?>"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>
					</div>

       </div>
		 <?php } ?>

       <div class="col-sm-12">
         <div class="well">
           <div id="options_paiement">
             <a href="#" class="btn btn-black" style="float: right;" role="button"><span class="glyphicon glyphicon-trash"></span> Supprimer</a>
             <a href="#" class="btn btn-black" style="float: right;" role="button"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>
          </div>
            <h3><span class ="glyphicon glyphicon-credit-card"></span> Vos informations de paiement </h3>
            <p>
              <strong>Nom présent sur la carte</strong><br>X Y<br>
              <strong>N° Carte </strong><br>XXXX XXXX XXXX XX12 <br>
              <strong>Date d'expiration</strong> <br>04/20<br>
            </p>
         </div>
       </div>



     </div>
   </div>

   <div class="col-sm-2 well">
       <h4><span class ="glyphicon glyphicon-hourglass"></span>Prochaine(s) livraison(s)</h4>
       <p><strong>Fri. 27 November 2015</strong></p>
   </div>


 </div>
</div>


<!-- Modal suppression adresse de livraison-->

<div id="deleteModal" class="modal">
	<div class="modal-header">
		<h4 class="modal-title"><strong><center>Êtes-vous sur de vouloir supprimer cette adresse?</center></strong></h5>
	</div>
	<div class="modal-body">
		<center>Cette adresse est enregistrée comme votre adresse principale. Si vous la supprimer, elle ne vous sera plus suggérée lors de vos prochains achats.</center>
	</div>

	<div class="modal-footer">
		<form class="" role ="form" method="post">
		<div>
			 <input type="hidden" name="keytodelete" value="<?php echo $adresse['ID_adresse_livraison']; ?>" required>
			<input type="submit" class="btn btn-black" name="supprimer" value="Valider"></input> </div>
		<input type="submit" class="btn btn-black" name="annuler" value="Annuler"></input>
	</form>

	<?php
	if(isset($_POST['supprimer'])) {
		$id_a_supprimer=$_POST['keytodelete'];
		$query = $bdd->prepare('DELETE FROM adresse_livraison WHERE ID_adresse_livraison = :ID_adresse_livraison AND adresse_principale = :adresse_principale');
		$success = $query->execute(array(
			':ID_adresse_livraison' => $id_a_supprimer,
			':adresse_principale' => 1
				));


		header('Location:moncompte_acheteur.php');

	}

	?>
	</div>
</div>



<!-- Modal modification adresse de livraison-->

<div id="modifModal" class="modal">
	<div class="modal-header">
		<h4 class="modal-title"><strong><center>Modification de votre adresse principale</center></strong></h5>
	</div>
	<div class="modal-body">
		<form action="traitement_moncompte.php" method="post">

		            <div class="form-group">
		              <label for="name"><span class="glyphicon glyphicon-user"></span> Nom</label>
		              <input type="text" class="form-control" required name="name" placeholder="Némar">
		            </div>
								<div class="form-group">
		              <label for="First_name"><span class="glyphicon glyphicon-user"></span> Prénom</label>
		              <input type="text" class="form-control" required name="First_name" placeholder="Jean">
		            </div>
								<div class="form-group">
		              <label for="num"><span class="glyphicon glyphicon-phone"></span> Numéro de téléphone</label>
		              <input type="number" class="form-control" required name="tel" placeholder="0600000000">
		            </div>
								<div class="form-group">
		              <label for="num_rue"><span class="glyphicon glyphicon-envelope"></span> N° de rue</label>
		              <input type="number" class="form-control" required name="num_rue" placeholder="20">
		            </div>
								<div class="form-group">
		              <label for="rue"><span class="glyphicon glyphicon-envelope"></span> Nom de la rue</label>
		              <input type="text" class="form-control" required name="rue" placeholder="rue de la piscine">
		            </div>
								<div class="form-group">
		              <label for="postal_code"><span class="glyphicon glyphicon-envelope"></span> Code postal</label>
		              <input type="number" class="form-control" required name="postal_code" placeholder="75015">
		            </div>
								<div class="form-group">
		              <label for="ville"><span class="glyphicon glyphicon-envelope"></span> Ville</label>
		              <input type="text" class="form-control" required name="ville" placeholder="Paris">
		            </div>
								<div class="form-group">
		              <label for="pays"><span class="glyphicon glyphicon-globe"></span> Pays</label>
		              <input type="text" class="form-control" required name="pays" placeholder="France">
		            </div>

		         	</div>

	<div class="modal-footer">
		<div>
			 <input type="hidden" name="keytomodif" value="<?php echo $adresse['ID_adresse_livraison']; ?>" required>
			<input type="submit" class="btn btn-black" name="Modifier" value="Valider"></input> </div>
		<a href="moncompte_acheteur.php" id="alink"target="blank"><button type="button" id='cancel' class="btn btn-black" name="annuler" value="Annuler">Annuler</input>


	</form>
	<?php/*
	if(isset($_POST['Modifier'])) {
		echo "je suis la";
		$id_a_modif=$_POST['keytomodif'];
		$query = $bdd->prepare('UPDATE adressse_livraison SET Nom =:nom, Prenom =:prenom, Num_tel=:num_tel, Num_rue=:num_rue,Nom_rue=:nom_rue, Code_postal=:code_postal,Ville=:ville,Pays=:pays WHERE ID_adresse_livraison =:ID_adresse_livraison');

		$success = $query->execute(array(
			':ID_item' => $id_a_modif,
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
*/
	?>

	</div>
</div>
















<?php
ob_end_flush();
include('includes/footer.php') ?>



</body>
</html>
