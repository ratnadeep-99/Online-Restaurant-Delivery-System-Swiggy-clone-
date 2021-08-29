<?php
  session_start();
  if(!empty($_SESSION['is_loggedin']))
  {
    header('Location:profile.php');
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
        alert(pass1);
        alert(pass2);
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
      <a href="restaurant_login.php" class="btn btn-light">Restaurant Login/Signup</a>
    </nav>
    <div class="container mt-60" style="height:100%">
      <div class="row">
        <div class="col-md-8">
          <h1 class="display-1 text-light">Craving for Food?.....Explore Now.... Eat fresh</h2>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body card-bg">
              <h4 class="card-title lead">User Login</h4>
              <form action="login_prac_verifiaction.php" method="POST">
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
            <form action="register.php" method="POST">
              <label>Name:</label><br/>
              <input type="text" class = "form-control" name="name" required/><br/><br/>
              <label>E-mail:</label><br/>
              <input type="email"  class = "form-control" name="email" placeholder="abc@gmail.com" required/><br/><br/>
              <label>Password:</label><br/>
              <input type="password" class = "form-control" name="password" id="pass1" required/><br/><br/>
              <label>Re-type Password:</label><br/><span id="msg" style="color:red">Passwords didnt match<br/></span>
              <input type="password" class = "form-control" name="re-password" id="pass2" required/><br/><br/>
              <label>Contact no.:</label><br/>
              <input type="text" class = "form-control" name="contact" id="contact" required/><br/><br/>
              <label>Home Address:</label><br/>
              <textarea class = "form-control" name="home"></textarea><br/>
              <label>Work Address:</label><br/>
              <textarea class = "form-control" name="work"></textarea><br/><br/>
              <input type="submit" name="submit" class="btn btn-primary" id="signup" value="Sign up">
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php
    include 'footer1.php';
    ?>
  </body>
</html>
