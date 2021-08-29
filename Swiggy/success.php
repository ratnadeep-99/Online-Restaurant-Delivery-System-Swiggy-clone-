<!DOCTYPE html>
<?php
  session_start();
  if(empty($_SESSION))
  {
    header('Location:login_prac.php');
  }
  include 'header1.php';
?>

  <body class="jumbotron-background">
    <nav class=" navbar navbar-color " style="padding-left:15px;padding-right:15px;padding-bottom: 15px;">
      <a href="index.php"><h2 class="text-light navbar-brand" style = "font-size : 30px" >Swiggy</h2></a>
      <span style="float:right" class="lead text-light"><a href="profile.php" class="btn btn-light">Back to Profile</a></span>
    </nav>
    <h3 style="color:green;text-align:center">ORDER PLACED SUCCESSFULLY</h3><br/>
    <img style="padding-left:530px" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcS1U-Gjwj7AsGkYhkFOKSl4lhHjZ13w1oCjILhiy1DWwS5M1Y7s&usqp=CAU"/>
    <?php
    include 'footer.php';
    ?>
  </body>
</html>
