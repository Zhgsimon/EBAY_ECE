<?php include('includes/header.php') ?>

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
      <h4>AEZFAZEFAZ</h4>



     </div>


</div>


<?php include('includes/footer.php') ?>
