<?php
// Starting session
session_start();

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

//On sélectionne tous les items qui sont en état de vente
$rep = $bdd->query('SELECT ID_item FROM item WHERE etat_vente="en_vente"');

//on stocke dans des array les id des items
$ID_item = array();

//je parcours ma table item
while ($donnees = $rep->fetch())
{

  //je remplis mon array d'informations
  $ID_item [] = $donnees ['ID_item'];
}

//pagination automatique
//Compter le nombre de pages
$count=count($ID_item);

$nombre_item_par_page=10;
//nombre entier supérieur
$nombre_de_page=ceil($count/$nombre_item_par_page);



if(isset($_GET['page'])) // Si la variable $_GET['page'] existe...
{
     $pageActuelle=intval($_GET['page']);

     if($pageActuelle>$nombre_de_page) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
     {
          $pageActuelle=$nombre_de_page;
     }

}
else // Sinon
{
     $pageActuelle=1; // La page actuelle est la n°1
}

$premiereEntree=($pageActuelle-1)*$nombre_item_par_page; // On calcul la première entrée à lire

// La requête sql pour récupérer les items de la page actuelle.
$item_page_actuelle=$bdd->query('SELECT * FROM item WHERE etat_vente="en_vente" ORDER BY ID_item DESC LIMIT '.$premiereEntree.', '.$nombre_item_par_page.'');



?>


<?php include('includes/header.php'); ?>
<style>

/* Pensez à ajouter également les versions avec préfixes pour être compatibles avec le plus de navigateurs possibles */
.row {
 display: -webkit-box;
 display: -webkit-flex;
 display: -ms-flexbox;
 display: flex;
}




.container {
display: block;

padding-left: 35px;
margin-bottom: 12px;
cursor: pointer;
font-size: 22px;
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
position: absolute;
opacity: 0;
cursor: pointer;
height: 0;
width: 0;
}

/* Create a custom checkbox */
.checkmark {
position: absolute;
top: 0;
left: 0;
height: 25px;
width: 25px;
background-color: #eee;
}


/* When the checkbox is checked, add a black background */
.container input:checked ~ .checkmark {
background-color: #070239;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
content: "";
position: absolute;
display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
left: 9px;
top: 5px;
width: 5px;
height: 10px;
border: solid white;
border-width: 0 3px 3px 0;
-webkit-transform: rotate(45deg);
-ms-transform: rotate(45deg);
transform: rotate(45deg);
}

.submit {
background-color: gold



}

.space {
position: relative;
top: 20px;
}

.col-sm-8{
background-color: #E9E9E9;
margin-bottom: 40px;
}

.col-sm-4{
margin-bottom: 40px;

}
</style>
</head>
<body>

  <nav class="navbar navbar-inverse">
  <?php include('includes/nav.php'); ?>
  </nav>

      <div class="container">






        <div class="row">

          <div class="col-sm-12">
            <center><h1>Catégories</h1></center>
          </div>

        </div>



            <form action="TraitementCatégorie.php">

              <div class="row" class="space">

                <div class="col-sm-4">
              <label class="container">Ferraille ou Trésor <input type="checkbox" name="Catégories1" value="ferraille"><span class="checkmark"></span> </label><br>
                </div>

                <div class="col-sm-4">
             <label class="container">Bon pour le Musée<input type="checkbox" name="Catégories2" value="musée"><span class="checkmark"></span> </label><br>
                </div>

                <div class="col-sm-4">
              <label class="container">Accessoire VIP<input type="checkbox" name="Catégories3" value="vip"><span class="checkmark"></span></label><br><br>
                </div>

              </div>

              <div class="row" class="space">

                <div class="col-sm-4">
              <label class="container">Acheté Maintenant <input type="checkbox" name="Catégories4" value="Achatimm"><span class="checkmark"></span> </label><br>
                </div>

                <div class="col-sm-4">
             <label class="container">Enchère<input type="checkbox" name="Catégories5" value="Enchère"><span class="checkmark"></span> </label><br>
                </div>

                <div class="col-sm-4">
              <label class="container">Meilleur Prix<input type="checkbox" name="Catégories6" value="MeilleurPrix"><span class="checkmark"></span></label><br><br>
                </div>

              </div>

              <div class="row">
               <div class="col-sm-12">
                <div align="right">
            <label class="submit">GO<input type="submit" value="Submit"><span class="submit"></span></label><br><br>
                </div>
                </div>

              </div>

            </form>







            <!--Affichage de 10 items par page-->
            <div class="container text-center">
              <?php while ($donnees = $item_page_actuelle->fetch()): ?>
                <div class="row">
                       <div class="col-sm-4">
                         <img src="img_items/<?php echo $donnees['pic1']; ?>" class="img-responsive" style=" width: 200px !important;
                          height: 200px !important;" alt="Image">
                       </div>

                       <div class="col-sm-8">
                         <u><p class="text-left"> <?php echo $donnees['name_item']; ?></p></u>
                         <h4><?php echo $donnees['description']; ?></h4>
                         <h4> Catégorie:  <?php echo $donnees['Categorie']; ?></h4>


                         <?php if(isset($donnees['prix_immediat'])): //Si il a un prix immédiat?>
                           <h4> Prix d'achat immédiat: <?php echo $donnees['prix_immediat'] ; ?>€</h4>
                         <?php endif; ?>

                         <?php if (isset($donnees['prix_nego_init'])): //Si il ya un prix de nego initial ?>
                           <h4> Négociation possible à partir de: <?php echo $donnees['prix_nego_init']; ?>€</h4>
                         <?php endif; ?>

                         <?php if(isset($donnees['prix_enchere_2'])): //si il est aux enchères?>
                           <?php $date_enchere_fin = new DateTime($donnees['date_enchere_fin']); ?>
                           <?php if (!isset($donnees['prix_enchere_1'])): //Si personne n'a encore enchéri =>enchere2 est le prix actuel le plus haut ?>
                             <h4> Prix aux enchères actuellement: <?php echo $donnees['prix_enchere_2'] ?></h4>
                             <h4> Date de fin des enchères /countdown :<?php echo $date_enchere_fin->format('Y-m-d H:i:s');?></h4>
                           <?php else: //on a déjà enchéri sur l'item => le prix le plus haut est prix_enchere_1?>
                             <h4> Prix aux enchères actuellement: <?php echo $donnees['prix_enchere_1'] ?></h4>
                             <h4> Date de fin des enchères /countdown :<?php echo $date_enchere_fin->format('Y-m-d H:i:s');?> </h4>
                           <?php endif; ?>
                         <?php endif; ?>

                         <?php $url="./Détailitem.php?pic1=".$donnees['pic1']; ?>
                         <li class="text-left"  style="list-style-type: none;"><a href=<?php echo $url; ?> style="color : black;" class="aI"><span class="glyphicon glyphicon-plus" ></a></li>


                       </div>

                    </div>
                     <hr size="4">
                <?php endwhile; ?>








            <div class="containerblanc">
              <h2>AEZFAZEFAZ</h2>

              <p align="center">Page :
              <?php for($i=1; $i<=$nombre_de_page; $i++): ?>

                <?php if ($i==$pageActuelle):  ?>
                   [<?php echo $i; ?>]

                <?php else: ?>
                  <a href="Catégorie.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php endif ?>

              <?php endfor; ?>





            </div>
          </div>

            <hr width="75%" size="4" color="#070239">





        </div>

<?php include('includes/footer.php'); ?>
