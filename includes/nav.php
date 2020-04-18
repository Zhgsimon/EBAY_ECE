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
    <a class="navbar-brand" href="index.php">Logo</a>
  </div>
  <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav" id="menu">
      <li class="active"><a href="index.php">Home</a></li>
      <li><a href="Catégorie.php">Catégories</a></li>

      <?php if(!isset($_SESSION['ID_user'])) :?>
        <li><a href="inscription.php">Inscription</a></li>
      <?php endif; ?>

      <?php if( isset($_SESSION['ID_user'])) :?>
        <?php if ($_SESSION['User_privilege']==1): ?>
          <!--affichage pour les acheteurs-->

          <!--Historique d'achats-->
          <li><a href="Achat.php">Achat</a></li>
          <!--Panier-->
          <li><a href="Panier.php">Panier</a></li>
          <!--Espace compte acheteur-->
          <li><a href="espacemoncompte_acheteur/moncompte_acheteur.php">Votre compte</a></li>

        <?php endif; ?>
      <?php endif; ?>

      <?php if( isset($_SESSION['ID_user'])) :?>
        <?php if ($_SESSION['User_privilege']==2): ?>
          <!--affichage pour les vendeurs-->

          <!--Mettre en vente un objet-->
          <li><a href="vendre_objets.php">Vendre un objet</a></li>
          <!--Liste de vos items en vente-->
          <li><a href="objet_en_vente.php">Vos objets en vente</a></li>
          <!--Onglet Négociation-->
          <li><a href="négociation.php">Négocier</a></li>

        <?php endif; ?>
      <?php endif; ?>





      <?php if( isset($_SESSION['ID_user'])) :?>
        <?php if ($_SESSION['User_privilege']==3): ?>
          <!--affichage pour les admins-->

          <!--Liste des vendeurs actifs-->
          <li><a href="espace_admin/admin_vendeurs.php">Vendeurs actifs</a></li>
          <!--Liste des vendeurs en attente-->
          <li><a href="espace_admin/admin_vendeurs_attente.php">Vendeurs en attente</a></li>
          <!--Liste des vendeurs signalés-->
          <li><a href="espace_admin/admin_vendeurs_signale.php">Vendeurs signalés</a></li>
          <!--Liste des objets en vente actifs-->
          <li><a href="espace_admin/admin_items.php">Objets en vente</a></li>


        <?php endif; ?>
      <?php endif; ?>
    </ul>

    <?php if(isset($_SESSION['ID_user'])): //si connecté?>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="traitement_deconnexion.php"><span class="glyphicon glyphicon-log-in"></span> Se déconnecter</a></li>
      </ul>

    <?php else: ?>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="Login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    <?php endif; ?>

  </div>
</div>

>
