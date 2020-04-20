<?php
  ob_start();
  session_start();
  if(isset($_GET["pic1"]))
  {
      $pic1 = $_GET["pic1"];
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


$stmt = $bdd->prepare("SELECT * FROM item WHERE pic1=? LIMIT 1");
$stmt->execute(array($pic1));
$row = $stmt->fetch();

$img="img_items/".$row['pic1'];




//$date_enchere_debut=$row['date_enchere_debut'];
//$date_enchere_fin=$row['date_enchere_fin'];


?>
<?php include('includes/header.php'); ?>

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


  .col-sm-8{

    background-color: #E9E9E9;
  }



  button {
  display:block;
  width:150px;
  line-height:39px;
  text-align:center;
  vertical-align:middle;
  background-color:  #393939
  color:white;
  text-decoration:none;
  position: relative;
  left: 18%;
  float:left;
  margin:2px;
  }

  </style>


</head>

<body>
  <nav class="navbar navbar-inverse">
  <?php include('includes/nav.php'); ?>
  </nav>


<div class="container text-center">

	<div class="containerblanc"><h2>AEZFAZEFAZ</h2>
<h2>AEZFAZEFAZ</h2>
</div>

            <div class="row">
              <div class="col-sm-4">

                <img src=<?php echo $img; ?> class="img-responsive" style="width:100%" alt="Image">


              </div>

              <div class="col-sm-8">

              <u><h3 class="text-left"> <?php echo $row['name_item']; ?></h3></u>
              <h4> <?php echo $row['description']; ?></h4>

              <?php if (isset($row['prix_immediat'])): ?>
                <h4> Prix d'achat immédiat: <?php echo $row['prix_immediat'] ; ?></h4>
              <?php endif; ?>

              <?php if (isset($row['prix_nego_init'])): ?>
                <h4> Négociation possible à partir de: <?php echo $row['prix_nego_init']; ?></h4>
              <?php endif; ?>

              <?php if(isset($row['prix_enchere_2'])): //si il est aux enchères?>
                <?php $date_enchere_fin = new DateTime($row['date_enchere_fin']); ?>
                <?php if (!isset($row['prix_enchere_1'])): //Si personne n'a encore enchéri =>enchere2 est le prix actuel le plus haut ?>
                  <h4> Prix aux enchères actuellement: <?php echo $row['prix_enchere_2'] ?></h4>
                  <h4> Date de fin des enchères /countdown :<?php echo $date_enchere_fin->format('Y-m-d H:i:s');?></h4>
                <?php else: //on a déjà enchéri sur l'item => le prix le plus haut est prix_enchere_1?>
                  <h4> Prix aux enchères actuellement: <?php echo $row['prix_enchere_1'] ?></h4>
                  <h4> Date de fin des enchères /countdown :<?php echo $date_enchere_fin->format('Y-m-d H:i:s');?> </h4>
                <?php endif; ?>
              <?php endif; ?>


              <div class="text-center">
                <form action="traitement_ajout_panier.php" method="POST">
                  <button type="submit" name="submit_action" value=<?php echo $pic1; ?>>Ajouter au panier</button>
                  <!--<input  type="submit" name="submit_action" value= placeholder="Ajouter au panier">-->
                </form>

                <?php if (isset($row['prix_immediat'])): ?>
                  <form action="paiement.php" method="get">
                    <input type="hidden" name="type_achat" value="achat_immediat">
                    <button type="submit" name="submit_action" value=<?php echo $pic1; ?>>Achat Immédiat</button>
                   <!--<input type="submit" name="submit_action" value= placeholder="Achat Immédiat">-->
                 </form>
                <?php endif; ?>

                <?php if (isset($row['prix_nego_init'])):
                  ?>
                  <a href="#negoModal" class="btn btn-black" rel="modal:open" role="button" name="modif" value="<?php $row['ID_item']?>"><span class="glyphicon glyphicon-plus"></span> Negocier</a>

                <?php endif; ?>

                <?php if (isset($row['prix_enchere_2'])): ?>
                  <form action="traitement_enchere.php" method="get">
                    <button type="submit" name="submit_action" value=<?php echo $pic1; ?>>Enchérir</button>
                   <!--<input type="submit" name="submit_action" value= placeholder="Enchérir">-->
                 </form>
                <?php endif; ?>

              </div>

            </div>

          </div>

        <div class="containerblanc">
          <h2>AEZFAZEFAZ</h2>
          <h2>AEZFAZEFAZ</h2>

<h2>AEZFAZEFAZ</h2>

<h2>AEZFAZEFAZ</h2>




<!-- Modalnouvelle nego-->

<div id="negoModal" class="modal">
	<div class="modal-header">
		<h4 class="modal-title"><strong><center>Negocier pour cet item</center></strong></h5>
	</div>
	<div class="modal-body">
		<form action="traitement_nego.php" method="post">
      <p>Le prix de négociation de base par le vendeur est <strong> <?php echo  $row['prix_nego_init']; ?> €</strong></p>
		            <div class="form-group">
		              <label for="prix_propose"><span class="glyphicon glyphicon-euro"></span> Prix proposé</label>
		              <input type="number" class="form-control" required name="prix_propose" placeholder="Votre proposition">
		            </div>


		         	</div>

	<div class="modal-footer">
		<div>
			 <input type="hidden" name="itemnego" value="<?php echo $row['ID_item']; ?>" required>
       <input type="hidden" name="vendeurnego" value="<?php echo $row['ID_vendeur']; ?>" required>
			<button type="submit" class="btn btn-black " name="Négocier" value="Valider"> <span class="glyphicon glyphicon-ok"></span> Valider</button> </div>
			<button type="submit" class="btn btn-black " data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Annuler</button>


	</form>


	</div>
</div>






























            </div>





        </div>


<?php
ob_end_flush();
include('includes/footer.php'); ?>
