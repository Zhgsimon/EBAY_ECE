<?php
  session_start();
?>

<?php include('includes/header.php'); ?>
<style>

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


</style>
</head>
<body>

  <nav class="navbar navbar-inverse">
  <?php include('includes/nav.php'); ?>
  </nav>

<div class="container text-center">

	<div class="containerblanc"><h2>AEZFAZEFAZ</h2>

  </div>


	<h1 style="background-color: #494949 ; color: white">Les Enchères !</h1>

      <div class="row">
        <div class="col-sm-4">

          <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive center block" style="width:100%" alt="Image">

        </div>

        <div class="col-sm-8">

              <u><h3 class="text-left"> titre</h3></u>
              <h4> Un type d'infomation précis 1</h4>
              <h4> Un type d'infomation précis 2</h4>
              <h4> Un type d'infomation précis 3</h4>

              <div class="text-center">

                <form>
                	<input type="submit" name="oui" value ="enchérire jusqu'a :">
                  <input  type="number" name="enchérire2" value="">
                </form>

                </div>

          </div>

        </div>
       </div>
       <div class="containerblanc"><h2>AEZFAZEFAZ</h2>
       	<div class="containerblanc"><h2>AEZFAZEFAZ</h2>
       		<div class="containerblanc"><h2>AEZFAZEFAZ</h2>
          </div>
        </div>
      </div>


<?php include('includes/footer.php'); ?>
