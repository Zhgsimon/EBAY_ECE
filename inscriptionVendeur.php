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
                     <label>Pseudo  <span class="glyphicon glyphicon-user"></label>
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




                  <button type="submit" id='submit' name="submit" class="btn btn-black">Register</button>

                 </div>


               </form>
            </div>
         </div>
      </div>

      <div class="row">
          <div class="col-xs-12 col-md-4">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">
                  Détails paiement
                </h3>

              </div>
              <div class="panel-body">


                  <div class="form-group">
                    <label for="cardNumber">
                      NUMERO CARTE</label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="num_carte" id="cardNumber" placeholder="NUM CARD"
                        required  />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-7 col-md-7">

                        <div class="form-group">
                          <label for="expityMonth">
                            DATE D'EXPIRATION</label>
                            <div class="col-xs-6 col-lg-6 pl-ziro">
                              <input type="text" class="form-control" name="expiryMonth" id="expiryMonth" placeholder="MM" required />
                            </div>
                            <div class="col-xs-6 col-lg-6 pl-ziro">
                              <input type="text" class="form-control" name="expiryYear" id="expiryYear" placeholder="YY" required /></div>
                            </div>
                          </div>
                          <div class="col-xs-5 col-md-5 pull-right">
                            <div class="form-group">
                              <label for="cvCode">
                                CRYPTOGRAME</label>
                                <input type="password" class="form-control" name="CVV" id="cvCode" placeholder="CVV" required />
                              </div>
                            </div>
                          </div>


                                <div class="form-group">
                                  <label for="Name">Nom carte</label>
                                    <input type="text" class="form-control" name="nom_carte" id="Name" placeholder="Nom carte" required />
                                </div>
                        </div>
                       </div>
                      </div>
                  </div>

    <div class="containerblanc">


      <h1>Je suis OK</h1>
      <h1>J'aime les bananes</h1>

     </div>


</div>


<?php include('includes/footer.php'); ?>
