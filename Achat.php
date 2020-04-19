<?php
  session_start();
  //historique d'achats
  //requete pour selectionner tous les items acheté par l'acheteur
  //boucle fetch

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


    $ID_user=$_SESSION['ID_user']; //ID_user good

  //selectionner l'historique d'achat d'un acheteur
  $req_historique_achat = $bdd->query("SELECT *  FROM item WHERE ID_acheteur = '$ID_user' AND etat_vente ='vendu'" );

?>

<?php include('includes/header.php'); ?>
<style>

</style>
</head>
<body>

  <nav class="navbar navbar-inverse">
  <?php include('includes/nav.php'); ?>
  </nav>

  <div class="container">
    <h2> Historique d'achat </h2>


     <table class="table">
     <thead>
     <tr>
    <th>     </th>
     <th>Item</th>
     <th>Catégorie</th>
     <th>Description</th>
     <th>Prix</th>
     <th><!--Date--></th>
     <th>Vendeur</th>
     </tr>
     </thead>

     <tbody>
       <?php
       while ($donnee = $req_historique_achat->fetch()):
       ?>
       <tr>
         <td> <?php
          $photo=$donnee['pic1'];
            if(!$photo) {
              echo '<img src = "img_projet/vente.jpg" class="img-circle" height="80" width="80" alt="Photo"/>';
            }
            else{
            echo '<img src = "img_items/'.$photo.' " class="img-circle" height="80" width="80" alt="Photo"/>';
          }
         ?> </td>
         <td><strong> <?php echo $donnee['name_item'];?></strong> </td>
         <td> <?php echo $donnee['Categorie'];?> </td>
         <td> <?php echo $donnee['description'];?> </td>
         <td> <?php echo $donnee['prix_payé']; echo "€";?> </td>
         <td> <?php //echo $donnee['name_item'];//faire date?> </td>
         <td> <?php
         $ID_vendeur= $donnee['ID_vendeur'];
         $req_vendeur=$bdd->query("SELECT Name,First_name  FROM user WHERE ID_user = '$ID_vendeur'" );
         $res=$req_vendeur->fetch();
         echo $res ['First_name'];
         echo " ";
         echo $res ['Name'];
         ?> </td>
       </tr>
      <?php endwhile;?>


     </tbody>

</table>

</div>






<?php include('includes/footer.php'); ?>
