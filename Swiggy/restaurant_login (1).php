<?php
  session_start();
  if(!empty($_SESSION))
  {
    header('Location:restaurant_profile.php');
  }
  include 'header1.php';
 ?>

  <script>
  $(document).ready(function(){
    $('#msg').hide();
    $("#contact").focus(function(){
      var pass1=$('#pass1').val();
      var pass2=$('#pass2').val();
      if(pass1!=pass2)
      {
        $('#signup').hide();
        $('#msg').show();
      }

    });
    $('#pass2').focus(function(){
      $('#signup').show();
      $('#msg').hide();
    });
  });
  </script>
  <body id="bg-img">
    <nav class="navbar navbar-color">
      <a href="index.php"><h2 class="text-light navbar-brand" style = "font-size : 30px" >Swiggy</h2></a>
      <a href="login_prac.php" class="btn btn-light">User Login/Signup</a>
    </nav>
    <div class="container">
      <div class="row">
        <div class="col-md-8 mt-2">
          <h1 class="display-1 text-light">Boost Your Restaurant Buisness Via Swiggy</h1>
        </div>
        <div class="col-md-4">
          <div class="card mt-5">
            <div class="card-body card-bg">
              <h3 class="card-title lead">Restaurant Login</h3>
              <form action="restaurant_login_verification.php" method="POST">
                <label>E-mail:</label><br/>
                <input type="email" name="email"  class="form-control" placeholder ="abc@gmail.com" required/><br/><br/>
                <label>Password:</label><br/>
                <input type="password" class="form-control" name="password" required/><br/><br/>
                <input type="submit" name="" class="btn btn-lg btn-block navbar-color" value="Login"/><br/><br/>
              </form>
              Not a member?Signup <a href="#" data-toggle="modal" data-target="#exampleModalCenter">here</a>
            </div>

          </div>

        </div>

      </div>

    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header navbar-color" id="body">
            <h5 class="modal-title" id="exampleModalCenterTitle">Sign up</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="background-color:linen">
            <form action="restaurant_register.php" method="POST">
              <label>Restaurant Name:</label><br/>
              <input type="text" name="name" class="form-control" required/><br/><br/>
              <label>Restaurant E-mail:</label><br/>
              <input type="email" name="email" placeholder="abc@gmail.com" class="form-control" required/><br/><br/>
              <label>Password:</label><br/>
              <input type="password" name="password" id="pass1" class="form-control" required/><br/><br/>
              <label>Re-type Password:</label><br/><span id="msg" style="color:red">Passwords didnt match<br/></span>
              <input type="password" name="re-password" id="pass2" class="form-control" required/><br/><br/>
              <label>Owner Name:</label><br/>
              <input type="text" name="owner_name" id="contact" class="form-control" required/><br/><br/>
              <label>Owner's Contact no.:</label><br/>
              <input type="text" name="contact" class="form-control" required/><br/><br/>
              <label>Owner's Home Address:</label><br/>
              <textarea name="home" class="form-control"></textarea><br/>
              <label>Restaurant Address:</label><br/>
              <textarea name="work" class="form-control"></textarea><br/><br/>
              <label>Cuisine:</label>
              <input type="text" name="cusine" class="form-control" required/><br/><br/>
              <input type="submit" name="submit" class="btn btn-primary" id="signup" value="Sign up">
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php include 'footer1.php';?>
  </body>
</html>
