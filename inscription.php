<?php
  session_start();
?>

<?php include('includes/header.php'); ?>
<style>


.login-form{
    margin-top: 5%;
}

.btn-black{
background-color: #000 !important;
color: #fff;
}

</style>

</head>
<body>

  <nav class="navbar navbar-inverse">
  <?php include('includes/nav.php'); ?>
  </nav>

<!--login-->
<div class="container">

    <div class="row">

      <div class="col-sm-12">
        <h1 class="text-center">Register</h1>
    </div>

  </div>



    <div class="row">
      <div class="main">

            <div class="login-form">
              <form action="traitement_inscription.php" method="POST">

              <div class="col-sm-6">

                  <div class="form-group">
                     <label>Nom  <span class="glyphicon glyphicon-user"></label>
                     <input type="text" class="form-control" placeholder="Nom" required name="Name">
                  </div>

                  <div class="form-group">
                     <label>Prenom  <span class="glyphicon glyphicon-user"></label>
                     <input type="text" class="form-control" placeholder="Prenom" required name="First_name">
                  </div>

                  <div class="form-group">
                     <label>Date de Naissance  <span class="glyphicon glyphicon-gift"></label>
                     <input type="Date" class="form-control" placeholder="Date de naissance" required name="Birthdate">
                  </div>

                  <div class="form-group">
                     <label>E-mail  <span class="glyphicon glyphicon-envelope"></label>
                     <input type="text" class="form-control" placeholder="E-mail" required name="login">
                  </div>

                </div>
                <div class="col-sm-6">


                  <div class="form-group">
                     <label>Pseudo  <span class="glyphicon glyphicon-user"</label>
                     <input type="text" class="form-control" placeholder="Pseudo" required name="Pseudo">
                  </div>

                  <div class="form-group">

                     <label>Téléphone  <span class="glyphicon glyphicon-phone-alt"></label>
                     <input type="tel" class="form-control" placeholder="Téléphone" name="Num_tel" required>
                  </div>

                  <div class="form-group">
                     <label>Mot de passe  <span class="glyphicon glyphicon-eye-close"></label>
                     <input type="password" class="form-control" placeholder="Mot de passe" required name="password1">
                  </div>

                  <div class="form-group">
                     <label>Confirmer mot de passe  <span class="glyphicon glyphicon-eye-open"></label>
                     <input type="password" class="form-control" placeholder="Mot de passe" required name="password2">
                  </div>




                  <button type="submit" id='submit'class="btn btn-black">Register</button>

                 </div>


               </form>
            </div>
         </div>
      </div>

    <div class="containerblanc">


      <h1>Je suis OK</h1>
      <h1>J'aime les bananes</h1>

     </div>


</div>


<?php include('includes/footer.php'); ?>
