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
$item_page_actuelle=$bdd->query('SELECT * FROM item ORDER BY ID_item DESC LIMIT '.$premiereEntree.', '.$nombre_item_par_page.'');


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Le E-commerce</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>

    .container {
  display: block;
  position: relative;
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

#space {

  position: relative;
  top: 20px






}

footer {
      background-color: #E5E4EA ;
      color: #E5E4EA

       padding: 60px 0 30px;

    }







  </style>
</head>

<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html">Logo</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav" id="menu">
          <li class="active"><a href="index.html">Home</a></li>
          <li><a href="Catégorie.html">Catégories</a></li>
          <li><a href="Achat.html">Achat</a></li>
          <li><a href="login_vendeur.html">Vendre</a></li>
          <li><a href="Votre compte.html">Votre compte</a></li>
          <li><a href="Panier.html">Panier</a></li>
          <li><a href="login_anim.html">Admin</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="Login.html"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
      </div>
    </div>
  </nav>

      <div class="container">






        <div class="row">

          <div class="col-sm-12">
            <center><h1>Catégories</h1></center>
          </div>

        </div>



            <form action="TraitementCatégorie.php">

              <div class="row" id="space">

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

              <div class="row" id="space">

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
                         <img src="img_items/<?php echo $donnees['pic1']; ?>" class="img-responsive" style="width:100%" alt="Image">
                       </div>

                       <div class="col-sm-8">
                         <u><p class="text-left"> <?php echo $donnees['name_item']; ?></p></u>
                         <h4> <?php echo $donnees['description']; ?></h4>
                         <h4> <?php echo $donnees['Categorie']; ?></h4>

                         <?php if(!isset($donnees['prix_nego_init'])): ?>
                         <h4> Prix de Négociation initial: <?php echo $donnees['prix_nego_init']; ?>€</h4>
                        <?php endif; ?>

                         <?php if(!isset($donnees['prix_immediat'])): ?>
                         <h4> Prix d'achat immédiat: <?php echo $donnees['prix_immediat']; ?>€</h4>
                       <?php endif; ?>

                         <?php if(!isset($donnees['prix_enchere_2'])): ?>
                         <h4> Début des enchères à partir de: <?php echo $donnees['prix_enchere_2']; ?>€</h4>
                       <?php endif; ?>

                         <h4> Un type d'infomation précis 3</h4>
                         <li class="text-left"><a href="Détailitem.html" class="aI">Plus de détails</a></li>

                       </div>
                    </div>
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



<footer class="container-fluid text-center">

  <div class="container1">
 <div class="row">
 <div class="col-lg-8 col-md-8 col-sm-12">
 <h6><b>Information additionnelle</b></h6>
 <p>
Adolf Hitler [ˈadɔlf ˈhɪtlɐ]3 Écouter est un idéologue et homme d'État allemand, né le 20 avril 1889 à Braunau am Inn en Autriche-Hongrie (aujourd'hui en Autriche et toujours ville-frontière avec l’Allemagne) et mort par suicide le 30 avril 1945 à Berlin. Fondateur et figure centrale du nazisme, il prend le pouvoir en Allemagne en 1933 et instaure une dictature totalitaire, impérialiste, antisémite et raciste désignée sous le nom de Troisième Reich.
</p>
 <p>
 L’antisémitisme est le nom donné de nos jours à la discrimination et à l'hostilité manifestées à l'encontre des Juifs
 </p>
 </div>
 <div class="col-lg-4 col-md-4 col-sm-12">
 <h6><b>Contact</b></h6>
 <p>
 37, quai de Grenelle, 75015 Paris, France <br>
 info@webDynamique.ece.fr <br>
 +33 01 02 03 04 05 <br>
 +33 01 03 02 05 04
 </p>
 </div>
 </div>
 <div class="footer-copyright text-center">&copy; 2019 Copyright | Droit d'auteur: webDynamique.ece.fr</div>
</footer>






</body>
</html>
