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
  color: #E5E4EA
  padding: 60px 0 30px;
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

</style>


</head>
<body>




  <nav class="navbar navbar-inverse">
  <?php include('includes/nav.php') ?>
  </nav>
