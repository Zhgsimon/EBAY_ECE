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
    /* Add a gray background color and some padding to the footer */

a{
  color: black;
}

nav{
  background-color: #070239 ;
}



footer {
  background-color: #E5E4EA ;
  color: black;
  padding: 30px 0 30px;
  footer {position: absolute; bottom: 0;}
}

.carousel-inner img {
  width: 800px;
  height: 400px;
}

/* Hide the carousel text when the screen is less than 600 pixels wide */
@media (max-width: 600px){
  .carousel-caption {
  display: none;
  }
}


#alink{
  color: black;
}

body {
  font-family: "Lato", sans-serif;
}

.main-head{
  height: 150px;
  background: #FFF;
}

.sidenav {
height: 100%;
background-color: #070239;
overflow-x: hidden;
padding-top: 20px;
}

.main {
  padding: 0px 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
}

@media screen and (max-width: 450px) {
  .login-form{margin-top: 5%;}
  .register-form{margin-top: 5%;}
}

@media screen and (min-width: 768px){
  .main{margin-left: 0%;}

.login-form{margin-top: 5%;}

.register-form{margin-top: 5%;}
}



.login-main-text{
  margin-top: 10%;
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

.containerblanc{
  color: white;
}


.col-sm-8{
  background-color: #E9E9E9;
}

input {
  display:block;
  width:150px;
  line-height:39px;
  text-align:center;
  vertical-align:middle;
  background-color:  #393939
  color:white;
  text-decoration:none;
  position: relative;
  left: 30%;
  float:left;
  margin:2px;
}


.img-responsive .centree {
  margin: 0 auto;
}


.roundedImage{
    overflow:hidden;
    -webkit-border-radius:50px;
    -moz-border-radius:50px;
    border-radius:50px;
    width:90px;
    height:90px;
}





</style>

<script>
    $(document).ready(function(){


      $("#1").click(function(){

          $("#2").css("display", "block");
          $("#3").css("display", "block");
      });

      $("#4").click(function(){

          $("#2").css("display", "none");
          $("#3").css("display", "none");

      });
    });
</script>


</head>
<body>




  <nav class="navbar navbar-inverse">
  <?php include('includes/nav.php') ?>
  </nav>
