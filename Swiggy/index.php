<?php
  session_start();
  $conn=mysqli_connect("sql212.epizy.com","epiz_29386857","CiF2lMeHtN7","epiz_29386857_swiggy");
  $query="SELECT * FROM resturants";
  $result=mysqli_query($conn,$query);

 ?>
  <?php
  include 'header1.php';
  ?>
  <body  id="bg-img">
    <nav class="navbar navbar-color" style="position:fixed;width:100%;z-index:1">
      <h3 class="text-light">Swiggy</h3>
      <?php
        if(!empty($_SESSION['is_loggedin']))
          echo '<span style="float:right"><a href="profile.php" class="text-light lead">Hi '.$_SESSION['name'].'</a></span>';
        else
        {
            echo '<span  style="float:right"><a href="login_prac.php" class="btn btn-light">Sign up/Log in</a></span>';
        }
       ?>
    </nav>
    <div class="jumbotron jumbotron-background">
      <h1 class="text-md-center display-1">Hungry?Order Now....</h1>
      <h5 class="text-md-center lead">30 resturants delivering now</h5>
    </div>
    <div class="container" >
      <h4 class="text-light">Order food online in Durgapur</h4>
      <div class="row">
        <?php
          while($rows=mysqli_fetch_array($result))
          {
            echo '<div class="col-md-6" style="margin-top:25px">
              <div class="card" style="height:200px;">
                <div class="card-body">
                  <div class="row" style = "padding-bottom : 50px">
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
                      <a class="btn btn-sm  text-light navbar-color mt-2" style="float:right" href="order.php?id='.$rows['r_id'].'">Order Now</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>';
          }
         ?>
      </div>
    </div>
    <?php
    include 'footer1.php';
    ?>
  </body>
</html>
