<?php
  //historique d'achats
  session_start();

  if(isset($_SESSION['ID_user'])&& $_SESSION['User_privilege']==2)
  {
    //Si le vendeur est connecté
  }
  else {
    //Si il n'est pas connecté on le redirige vers la page de login
    header("Location:login.php?location=" . urlencode($_SERVER['REQUEST_URI']));
    // Note: $_SERVER['REQUEST_URI'] is your current page
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

    //On récupère tous les items vendus par le vendeur
    $liste_obj_vendus = $bdd->prepare("SELECT * FROM item WHERE ID_vendeur=? AND etat_vente='vendu'");
    $liste_obj_vendus->execute(array($_SESSION['ID_user']));
    $liste_obj_en_vente = $bdd->prepare("SELECT * FROM item WHERE ID_vendeur=? AND etat_vente='en_vente'");
    $liste_obj_en_vente->execute(array($_SESSION['ID_user']));




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
    <h2> Objets en vente </h2>


     <table class="table">
       <thead>
         <tr>
           <th>Item</th>
           <th>Catégorie</th>
           <th>Description</th>
           <th>Prix de vente</th>
           <th>Acheteur</th>
         </tr>
       </thead>

     <tbody>
       <?php     while ($donnee = $liste_obj_en_vente->fetch()):?>
         <tr>
           <td><?php $photo="img_items/".$donnee['pic1']; ?>

             <?php if ($donnee['pic1']): ?>
               <img src=<?php echo $photo; ?> style=" width: 200px !important;
                height: 200px !important;">
             <?php else: ?>
               <p><img src="img_projet/vendre.jpg" style=" width: 200px !important;
                height: 200px !important;"></p>
             <?php endif; ?>



           </td>
           <td><?php echo $donnee['Categorie'] ?></td>
           <td><?php echo $donnee['description'] ?></td>
           <td>
             <?php echo $donnee['prix_payé'] ?>
           </td>

           <?php
            $req_acheteur = $bdd->prepare("SELECT  name,First_name  FROM user WHERE ID_User=? ");
            $req_acheteur->execute(array($donnee['ID_acheteur']));

            $row_acheteur = $req_acheteur->fetch();
           ?>
           <td><?php
           echo $row_acheteur['First_name'];
           echo " ";
           echo $row_acheteur['name']; ?></td>



         </tr>






       <?php endwhile; ?>
     </tbody>

    </table>

    <h2> Objets vendus </h2>


     <table class="table">
       <thead>
         <tr>
           <th>Item</th>
           <th>Catégorie</th>
           <th>Description</th>
           <th>Prix de vente</th>
           <th>Acheteur</th>
         </tr>
       </thead>

     <tbody>
       <?php     while ($donnee = $liste_obj_vendus->fetch()):?>
         <tr>
           <td><?php $photo="img_items/".$donnee['pic1']; ?>

             <?php if ($donnee['pic1']): ?>
               <img src=<?php echo $photo; ?> style=" width: 200px !important;
                height: 200px !important;">
             <?php else: ?>
               <p><img src="img_projet/vendre.jpg" style=" width: 200px !important;
                height: 200px !important;"></p>
             <?php endif; ?>



           </td>
           <td><?php echo $donnee['Categorie'] ?></td>
           <td><?php echo $donnee['description'] ?></td>
           <td>
             <?php echo $donnee['prix_payé'] ?>
           </td>

           <?php
            $req_acheteur = $bdd->prepare("SELECT  name,First_name  FROM user WHERE ID_User=? ");
            $req_acheteur->execute(array($donnee['ID_acheteur']));

            $row_acheteur = $req_acheteur->fetch();
           ?>
           <td><?php
           echo $row_acheteur['First_name'];
           echo " ";
           echo $row_acheteur['name']; ?></td>



         </tr>






       <?php endwhile; ?>
     </tbody>

    </table>
  </div>

<?php include('includes/footer.php'); ?>
