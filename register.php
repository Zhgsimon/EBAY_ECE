<?php include('includes/header.php'); ?>
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
              <div class="col-sm-6">
               <form>

                  <div class="form-group">
                     <label>Nom</label>
                     <input type="text" class="form-control" placeholder="Nom" required name="Nom">
                  </div>

                  <div class="form-group">
                     <label>Prenom</label>
                     <input type="text" class="form-control" placeholder="Prenom" required name="Prenom">
                  </div>

                  <div class="form-group">
                     <label>Date de Naissance</label>
                     <input type="Date" class="form-control" placeholder="Date de naissance" required name="Birthdate">
                  </div>

                  <div class="form-group">
                     <label>E-mail</label>
                     <input type="text" class="form-control" placeholder="E-mail" required name="login">
                  </div>

                </div>
                <div class="col-sm-6">






                  <div class="form-group">
                     <label>Pseudo </label>
                     <input type="text" class="form-control" placeholder="Pseudo" required name="Pseudo">
                  </div>

                  <div class="form-group">
                     <label>Téléphone</label>
                     <input type="tel" class="form-control" placeholder="Numéro de Téléphone" required name="Num_Tel" maxlength="10">
                  </div>

                  <div class="form-group">
                     <label>Mot de passe</label>
                     <input type="password" class="form-control" placeholder="Mot de passe" required name="password1">
                  </div>

                  <div class="form-group">
                     <label>Confirmer mot de passe</label>
                     <input type="password" class="form-control" placeholder="Mot de passe" required name="password2">
                  </div>




                  <button type="submit" id='submit'class="btn btn-black">Register</button>

                 </div>


               </form>
            </div>
         </div>
      </div>
    </div>

    <div class="containerblanc">


      <h1>AEZFAZEFAZ</h1>

     </div>


</div>


<?php include('includes/footer.php'); ?>
