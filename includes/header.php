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

  footer {
    background-color: #E5E4EA ;
  }

  body {
    font-family: "Lato", sans-serif;
  }


  .containerblanc{
    color: white;
  }

</style>

<script>
    $(document).ready(function(){


      $("#1").click(function(){

          $("#2").css("display", "block");
          $("#3").css("display", "none");
      });

      $("#4").click(function(){

          $("#2").css("display", "none");
          $("#3").css("display", "block");

      });
    });
</script>
