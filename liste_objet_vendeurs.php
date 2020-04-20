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

    //on cherche dans la BDD si l'utilisateur a déjà un panier
    //On récupère les éléments du parnier qui appartient à l'utilisateur
    $stmt_panier = $bdd->prepare("SELECT * FROM panier WHERE ID_User=? LIMIT 1");
    $stmt_panier->execute(array($_SESSION['ID_user']));

    $row_panier = $stmt_panier->fetch();



    if ($row_panier)
    {
      $ID_panier=$row_panier['ID_panier'];

      //si son panier existe déjà
      echo "Assigned";

      //On récupère dans contient les items qui sont stockés dans le panier de l'utilisateur
      $req_panier_contient = $bdd->query("SELECT *
      FROM item
      INNER JOIN contient
      WHERE item.ID_item = contient.ID_item
      AND ID_panier = '$ID_panier' ");
    }
    else
    {
      echo "Panier vide";
    }



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

    <h2> Panier </h2>


     <table class="table">
       <thead>
         <tr>
           <th>Item</th>
           <th>Catégorie</th>
           <th>Description</th>
           <th>Prix</th>
           <th>Date</th>
           <th>Etat</th>
           <th>Plus de détails</th>
         </tr>
       </thead>

     <tbody>
       <?php while($donnee = $req_panier_contient->fetch()): ?>
         <tr>
           <td><?php $photo="img_items/".$donnee['pic1']; ?>

             <?php if ($donnee['pic1']): ?>
               <img src=<?php echo $photo; ?> style=" width: 200px !important;
                height: 200px !important;">
             <?php else: ?>
               <p>Pas de photos trouvé</p>
             <?php endif; ?>

           </td>
           <td><?php echo $donnee['Categorie'] ?></td>
           <td><?php echo $donnee['description'] ?></td>
           <td>
           <?php if(isset($donnee['prix_immediat'])): ?>
             <p>Achat immédiat:</p><?php echo $donnee['prix_immediat'] ?>
           <?php endif; ?>
           <?php if(isset($donnee['prix_immediat'])): ?>
             <p>Négociation:</p><?php echo $donnee['prix_nego_init'] ?>
           <?php endif; ?>
           <?php if(isset($donnee['prix_enchere_2'])): ?>
             <p>Enchère:</p><?php echo $donnee['prix_enchere_2'] ?>
           <?php endif; ?>
           </td>

           <td>
           <?php if(isset($donnee['date_enchere_fin'])): ?>
             <p>Fin de l'enchère:</p><?php echo $donnee['date_enchere_fin'] ?>
            <?php else: ?>
              <p>Pas disponible à l'enchère</p>
           <?php endif; ?>
           </td>

           <?php
            $req_vendeur = $bdd->prepare("SELECT  Pseudo FROM user WHERE ID_User=? LIMIT 1");
            $req_vendeur->execute(array($donnee['ID_vendeur']));

            $row_vendeur = $req_vendeur->fetch();
           ?>
           <td><?php echo $row_vendeur['Pseudo'] ?></td>

           <td><?php $url="./Détailitem.php?pic1=".$donnee['pic1']; ?>
           <li class="text-left" style="list-style-type: none;"><a href=<?php echo $url; ?> style="color : black; "><span class="glyphicon glyphicon-plus"></span></a></li></td>

         </tr>






       <?php endwhile; ?>
     </tbody>

    </table>
  </div>

<?php include('includes/footer.php'); ?>
