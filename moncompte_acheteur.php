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
$req_cb= $bdd->query("SELECT * FROM `infobancaire` WHERE `ID_user`='$id_user' AND `infobancaire_principale` = 1");

?>





<?php include('includes/header.php') ?>
<nav class="navbar navbar-inverse">
<?php include('includes/nav.php'); ?>
</nav>
<!-- jQuery Modal -->
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<style>
.btn-black{
	background-color: #000 !important;
	color: #fff;
	margin-bottom: 5px ;
	margin-right: 5px;
	float: right;
}
</style>
</head>


<div class="container">
 <div class="row ">
   <div class="col-sm-4 well" style="margin-right:10px !important;" >
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
<?php if ($cb=$req_cb->fetch()){ ?>
       <div class="col-sm-12 well">
         <div class="col-sm-7">

            <h3><span class ="glyphicon glyphicon-credit-card"></span> Vos informations de paiement</h3>
            <p>
							<strong>Type de carte</strong><br><?php echo $cb['type_carte'] ?><br>
							<strong>Nom présent sur la carte</strong><br><?php echo $cb['nom_carte'] ?><br>
              <strong>N° Carte </strong><br><?php echo $cb['num_carte'] ?> <br>
              <strong>Date d'expiration</strong> <br><?php echo $cb['date_expir'] ?><br>
            </p>
         </div>
				 <div class="col-sm-5">
					 <a href="#deleteCBModal" class="btn btn-black" style="float: right;" rel="modal:open" role="button" name="supCB" value="<?php $cb['ID_infobancaire']?>"><span class="glyphicon glyphicon-trash"></span> Supprimer</a>
					 <a href="#modifCBModal" class="btn btn-black" style="float: right;" rel="modal:open" role="button" name="modifCB"  value="<?php $cb['ID_infobancaire']?>"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>
				</div>
       </div>

		 <?php } ?>



     </div>
   </div>




 </div>
</div>


<!-- Modal suppression adresse de livraison-->

<div id="deleteModal" class="modal">
	<div class="modal-header">
		<h4 class="modal-title"><strong><center>Êtes-vous sur de vouloir supprimer cette adresse?</center></strong></h5>
	</div>
	<div class="modal-body">
		<center>Cette adresse est enregistrée comme votre adresse principale. Si vous la supprimez, elle ne vous sera plus suggérée lors de vos prochains achats.</center>
	</div>

	<div class="modal-footer">
		<form class="" role ="form" method="post">
		<div>
			 <input type="hidden" name="keytodelete" value="<?php echo $adresse['ID_adresse_livraison']; ?>" required>
			<input type="submit" class="btn btn-black" style="float: right;" name="supprimer" value="Valider"></input> </div>
		<input type="submit" class="btn btn-black" style="float: left;"name="annuler" value="Annuler"></input>
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
			<button type="submit" class="btn btn-black pull-right" name="Modifier" value="Valider"> <span class="glyphicon glyphicon-ok"></span> Valider</button> </div>
			<button type="submit" class="btn btn-black pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Annuler</button>


	</form>


	</div>
</div>


<!-- Modal suppression CB-->

<div id="deleteCBModal" class="modal">
	<div class="modal-header">
		<h4 class="modal-title"><strong><center>Êtes-vous sur de vouloir supprimer cette carte?</center></strong></h5>
	</div>
	<div class="modal-body">
		<center>Cette carte est enregistrée comme votre carte principale. Si vous la supprimez, elle ne vous sera plus suggérée lors de vos prochains achats.</center>
	</div>

	<div class="modal-footer">
		<form class="" role ="form" method="post">
		<div>
			 <input type="hidden" name="keytodelete" value="<?php echo $cb['ID_infobancaire']; ?>" required>
			<input type="submit" class="btn btn-black" style="float: right;" name="supprimer" value="Valider"></input> </div>
		<input type="submit" class="btn btn-black" style="float: left;" name="annuler" value="Annuler"></input>
	</form>

	<?php
	if(isset($_POST['supprimer'])) {
		$id_a_supprimer=$_POST['keytodelete'];
		$query = $bdd->prepare('DELETE FROM infobancaire WHERE ID_infobancaire = :ID_infobancaire AND infobancaire_principale = :infobancaire_principale');
		$success = $query->execute(array(
			':ID_infobancaire' => $id_a_supprimer,
			':infobancaire_principale' => 1
				));


		header('Location:moncompte_acheteur.php');

	}

	?>
	</div>
</div>

<!-- Modal modification adresse de livraison-->

<div id="modifCBModal" class="modal">
	<div class="modal-header">
		<h4 class="modal-title"><strong><center>Modification de votre carte principale</center></strong></h5>
	</div>
	<div class="modal-body">
		<form action="traitement_moncompte.php" method="post">

		            <div class="form-group">
		              <label for="name"><span class="glyphicon glyphicon-user"></span> Nom sur la carte</label>
		              <input type="text" class="form-control" required name="name" placeholder="Jean Némar">
		            </div>
								<div class="form-group">
		              <label for="type"><span class="glyphicon glyphicon-credit-card"></span> Type</label>
		              <input type="text" class="form-control" required name="type" placeholder="Visa">
		            </div>
								<div class="form-group">
		              <label for="num"><span class="glyphicon glyphicon-credit-card"></span> Numéro de carte</label>
		              <input type="text" class="form-control" required name="num" placeholder="1111 2222 3333 4444">
		            </div>
								<div class="form-group">
		              <label for="date_exp"><span class="glyphicon glyphicon-calendar"></span> Date d'expiration</label>
		              <input type="text" class="form-control" required name="date_exp" placeholder="05/20">
		            </div>
								<div class="form-group">
		              <label for="CVV"><span class="glyphicon glyphicon-credit-card"></span> CVV</label>
		              <input type="number" class="form-control" required name="cvv" placeholder="357">
		            </div>


		         	</div>

	<div class="modal-footer">
		<div>
			 <input type="hidden" name="keytomodifCB" value="<?php echo $cb['ID_infobancaire']; ?>" required>
			<button type="submit" class="btn btn-black pull-right" name="ModifierCB" value="Valider"> <span class="glyphicon glyphicon-ok"></span> Valider</button> </div>
			<button type="submit" class="btn btn-black pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Annuler</button>


	</form>


	</div>
</div>











<?php
ob_end_flush();
include('includes/footer.php') ?>



</body>
</html>
