<?php
  session_start();
?>

<?php include('includes/header.php'); ?>
<style>
#alink{
color: black;
}




.main {
padding: 0px 10px;
}


@media screen and (max-width: 450px) {
  .login-form{
  margin-top: 10%;
  }
}

@media screen and (min-width: 768px){
  .main{margin-left: 40%;}
  .login-form{margin-top: 10%;}
}


.login-main-text{
margin-top: 20%;
padding: 60px;
color: #fff;
}

.login-main-text h2{
font-weight: 300;
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
        <h1 class="text-center">Login</h1>
      </div>
    </div>



    <div class="row">
      <div class="main">
         <div class="col-md-6 col-sm-12">
            <div class="login-form">
               <form action="traitement_login.php" method="POST">

                  <div class="form-group">
                     <label>Email</label>
                     <input type="text" class="form-control" placeholder="Email" required name="login">
                  </div>

                  <div class="form-group">
                     <label>Mot de passe</label>
                     <input type="password" class="form-control" placeholder="Mot de passe" required name="password">
                  </div>


                  <button type="submit" id='submit'class="btn btn-black">Login</button>

                  <a href="register.html" id="alink"target="blank"><button type="button" id='register'class="btn btn-secondary">Register</button></a>


               </form>
            </div>
         </div>
      </div>
    </div>

    <div class="containerblanc">


      <h1>AEZFAZEFAZ</h1>
      <h1>AEZFAZEFAZ</h1>
      <h2>AEZFAZEFAZ</h2>
      <h2>AEZFAZEFAZ</h2>
      <h4>AEZFAZEFAZ</h4>



     </div>


</div>


<?php include('includes/footer.php'); ?>
