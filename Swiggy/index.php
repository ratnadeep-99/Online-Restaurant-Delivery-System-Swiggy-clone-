<?php
  session_start();
  $conn=mysqli_connect("localhost","root","","swiggy_prac");
  $query="SELECT * FROM resturants";
  $result=mysqli_query($conn,$query);

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8"/>
    <title>SWIGGY</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="login_prac_style.css"/>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </head>
  <body  id="bg-img">
    <nav class="navbar navbar-color" style="position:fixed;width:100%;z-index:1">
      <h3 class="text-light">Swiggy</h3>
      <?php
        if(!empty($_SESSION['is_loggedin']))
          echo '<span class="text-light lead" style="float:right">Hi&nbsp'.$_SESSION['name'].'</span>';
        else
        {
            echo '<span  style="float:right"><a href="login_prac.php" class="btn btn-light">Sign up/Log in</a></span>';
        }
       ?>
    </nav>
    <div class="jumbotron jumbotron-background">
      <h1 class="text-md-center display-1">Hungry?Order Now....</h1>
      <h5 class="text-md-center lead">30 resturants delevering now</h5>
    </div>
    <div class="container" >
      <h4 class="text-dark">Order food online in Durgapur</h4>
      <div class="row">
        <?php
          while($rows=mysqli_fetch_array($result))
          {
            echo '<div class="col-md-6" style="margin-top:25px">
              <div class="card" style="height:180px">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-3">
                          <img src="'.$rows['r_logo'].'" style="height:80px;width:80px" >
                        </div>
                        <div class="col-md-7">
                          <h3 style="color:orange">'.$rows['r_name'].'</h3>
                          <p>'.$rows['r_cusine'].'<br/><span style="color:grey;font-size:12px">delevery in '.$rows['r_delivery_time'].' mins</span></p>
                        </div>
                        <div class="col-md-2">';
                        if($rows['r_rating']>=4)
                        {
                          echo '<span class="badge badge-success" style="float:right">'.$rows['r_rating'].'</span>';
                        }
                        else if($rows['r_rating']>=2)
                        {
                          echo '<span class="badge badge-warning" style="float:right">'.$rows['r_rating'].'</span>';
                        }
                        else
                        {
                            echo '<span class="badge badge-danger" style="float:right">'.$rows['r_rating'].'</span>';
                        }
                          echo '<br/><small style="text-align:right">'.$rows['r_num_rating'].' ratings '.$rows['r_num_reviews'].' reviews</small>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <a class="btn btn-sm  text-light navbar-color" style="float:right" href="order.php?id='.$rows['r_id'].'">Order Now</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>';
          }
         ?>
      </div>
    </div>
  </body>
</html>
