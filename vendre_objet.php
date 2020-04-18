<?php
  session_start();
?>

<?php include('includes/header.php'); ?>

<div class="container">

	<div class="containerblanc"><h2>lol je suis caché</h2></div>
  <div class="row"><div class="col-sm-12"><h2>Que voulez vous<b> Vendre </b> ?</h2></div></div>


  <div class="row">
    <div class="main">

      <div class="login-form">
        <form action="traitement_vendre_objet.php" method="POST">

          <div class="col-sm-6">
            <div class="form">
              <p style="margin-top: 95px"><b>Choissisez une image pour votre item</b></p>
              <input type="file" name="pic1" accept="image/png, image/jpeg, image/jpg" required style="margin-bottom: 30px; margin-top: 5px">
              <p><b>Choissisez une vidéo pour votre item (obtionnel)</b></p>
              <input type="file" name="video" >
            </div>
          </div>


          <div class="col-sm-6">

            <div class="form-group">
              <label>Nom item </label>
                <input type="text" class="form-control" placeholder="Nom item" required name="name_item">
            </div>

            <div class="form-group">
              <label>Description</label>
                <input type="text" class="form-control" placeholder="Description" required name="description">
            </div>

            <b >Catégorie</b>
            <div class="form-group">
              <input type="radio" name="Categorie" ><label style="margin-right: 35px; margin-top: 10px">Féraille et trésor</label>
              <input type="radio" name="Categorie" ><label style="margin-right: 35px">Bon pour le musée</label>
              <input type="radio" name="Categorie" ><label>VIP</label>
            </div>

            <div class="form-group">
              <label>Prix de vente Immédiat(en €)</label>
              <input type="number" class="form-control" required name="prix_immediat">
            </div>

            <div class="form-group">
              <input  type="radio" name="type enchères" id="1"><label style="margin-right: 35px" >Proposer aux enchères(en €)</label>
              <input type="radio" name="type négo" id="4"><label>Proposer de négocier</label>
            </div>

            <div class="form-group">
              <label id="1" style="display: none;">Prix initial</label>
              <input type="number" class="form-control"  required name="prix_nego_init" style="display: none;" id="2">
              <input type="number" class="form-control"  required name="prix_enchere_2" style="display: none;" id="3">
            </div>

            <button type="submit" id='submit'class="btn btn-black">Mettre en vente</button>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>

      <div class="container">

        <div class="row"><div class="col-sm-12"><h2>Les<b> Témoignages </b> de nos vendeurs</h2></div>


        </div>

        <div class="row">
          <div class="col-sm-12" style="padding-top: 2%">
          <div class="col-sm-4" style="background-color: #D4D4D4; padding-top: 2%">

           <center>  <img src="Capture.png" class="roundedImage" style="margin-bottom: 15px">
            </center>
            <p class="text-center" style="margin-bottom: 15px"><b> Jeau michel</b>, vendeur depuis 2 minutes</p>

            <p class="text-center">J'avoue que j'ai essayé pas mal de sites de vente en ligne. E-bay ECE a vraiment réussi à me convaincre. La mise en vente est simple et rapide. Je peux même vendre depuis mon smartphone.</p>


          </div>

          <div class="col-sm-4" style="background-color: #E2E2E2 ;padding-top: 2% ">

           <center>  <img src="Capture2.png" class="roundedImage" style="margin-bottom: 15px"></center>
            <p class="text-center" style="margin-bottom: 15px"><b> Caroline</b>, vendeur depuis 1 heur</p>


            <p class="text-center">Suite à un déménagement, j'avais du mobilier en trop. Il fallait que je fasse de la place rapidement. Un ami m'a conseillé E-bay ECE. D'abord sceptique, j'ai vite été convaincue. Le service « Meilleur Offre » est pratique !</p>


          </div>

          <div class="col-sm-4" style="background-color: #D4D4D4;padding-top: 2% ">

           <center> <img src="Capture3.png" class="roundedImage" style="margin-bottom: 15px"></center>
            <p class="text-center" style="margin-bottom: 15px"><b> Fabrist</b>, vendeur depuis le commencement</p>


            <p class="text-center">E6bay ECE est un bon site très bien, il y a un très large choix de produits, les vendeurs et acheteur sont très sérieux, la livraison est très rapide, pour les achats la qualité est au rendez-vous.</p>


          </div>



        </div>

        </div>





      </div>


      <div class="containerblanc"><h1>LE PLUS GRAND DES TESTS</h1></div>







<?php include('includes/footer.php') ?>
