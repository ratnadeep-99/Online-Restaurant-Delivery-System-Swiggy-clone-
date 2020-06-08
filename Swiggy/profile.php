<?php
  session_start();
  if(empty($_SESSION['is_loggedin']))
  {
    header('Location:login_prac.php');
  }
  $user_id=$_SESSION['user_id'];
  $conn=mysqli_connect("localhost","root","","swiggy_prac");
  $query="SELECT * FROM users WHERE user_id='$user_id'";
  $result=mysqli_query($conn,$query);
  $result=mysqli_fetch_array($result);
  $query2="SELECT * FROM orders WHERE user_id='$user_id' AND status=1";
  $result2=mysqli_query($conn,$query2);
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Free Web tutorials">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="Ratnadeep Bhattacharya">
    <title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="login_prac_style.css"/>
    <script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </head>
  <script>
  $(document).ready(function(){
    $('#edit_dp').hide();
    $('#img').mouseenter(function(){
      $('#edit_dp').show();
    });
    $('#img').mouseleave(function(){
      $('#edit_dp').hide();
    });
    $("#save").click(function(){
      var name=$("#name").val();
      var email=$("#email").val();
      var pass=$("#password").val();
      var phone=$("#phone").val();
      var work=$("#work").val();
      var home=$("#home").val();
      var user_id=<?php echo $_SESSION['user_id']; ?>;
      $.ajax({
        url:'edit_profile.php',
        type:'POST',
        data:{'name':name,'email':email,'password':pass,'phone':phone,'work':work,'home':home,'user_id':user_id},
        success:function(){
          alert('Changes Saved Successfully');
          window.location.href="profile.php";
        },
        error:function(){
          alert('Some Error Occured');
        }
      });
    });
    $(".rate").click(function(){
      var order_id=$(this).data('id');
      $("#ratemodal").modal();
      $("#submit").click(function(){
        var rating=$("#rate_order").val();
        var review=$("#review_order").val();

        $("#ratemodal").modal('hide');
         window.location.href="profile.php";
        $.ajax({
          url:'rate_order.php',
          type:"POST",
          data:{'order_id':order_id,'rating':rating,'review':review},
          success:function(){
            alert('Thanks For Rating');
          },
          error:function(){
            alert("Some Error Occured");
          }
        })
        });


      });

    });
  </script>
  <body id="bg-img">
    <nav class=" navbar navbar-color " style="padding-left:75px;padding-right:15px;padding-bottom: 15px;">
      <h3 class="text-light">Swiggy</h3>
      <span style="float:right" class="lead text-light">Hi <?php echo $_SESSION['name']; ?></span>
    </nav>
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="card mt-3">
            <a href="#" data-toggle="modal" data-target="#dpmodal"><i class="fa fa-3x fa-edit text-dark" id="edit_dp"></i></a>
            <img id="img" class="card-img-top" src="<?php echo $result['img'];  ?>"/>
            <div class="card-body" style="border:2px orange solid">
              <h5 class="card-title"><?php echo $_SESSION['name']; ?></h5>
              <ul class="list-group list-group-flush">
                <li class="list-group-item" style="border-top:3px orange solid" ><?php echo $result['email']; ?></li>
                <li class="list-group-item" style="border-top:3px orange solid" ><?php echo $result['phone'] ?></li>
                <li class="list-group-item" style="border-top:3px orange solid"><a href="index.php">Place Order</li>
                <li class="list-group-item" style="border-top:3px orange solid"><a href="#">Track Order</a></li>
                <li class="list-group-item" style="border-top:3px orange solid"><a href="logout.php">Logout</a></li>
                <a href="#" class="btn btn-block navbar-color text-light" data-toggle="modal" data-target="#edit">Edit Profile</a>

              </ul>

            </div>

          </div>
        </div>
        <div class="col-md-6">
          <?php
            while($row=mysqli_fetch_array($result2))
            {
              $r_id=$row['r_id'];
              $q="SELECT * FROM resturants WHERE r_id=$r_id";
              $r=mysqli_query($conn,$q);
              $r=mysqli_fetch_array($r);
              $c=1;
              echo '<div class="card mt-3">
                <div class="card-body card-bg" style="border:2px orange solid">
                  <h4 class="card-title" style="color:orange">'.$r['r_name'].'</h4>
                  <p>date & time :'.$row['order_time'].'<span class="float-right">Total :'.$row['amount'].'</span></p>
                  <table class="table">';
                    $curr_order_id=$row['order_id'];
                    $query3="SELECT * FROM order_details o JOIN menu m ON m.id=o.menu_id WHERE o.order_id LIKE '$curr_order_id'";
                    $result3=mysqli_query($conn,$query3);
                    while($row2=mysqli_fetch_array($result3))
                    {
                      echo '<tr>
                        <td>'.$row2['name'].'</td>
                        <td class="float-right">2pcs</td>
                      </tr>';
                    }

                  if($row['rating']==0)
                  {
                    echo '</table>
                    <button type="button" data-id="'.$curr_order_id.'" name="button" class="rate btn btn-lg navbar-color float-right text-light">Rate Order</button>
                    </div>
                    </div>';
                  }
                  else
                  {
                    echo '</table>
                    </div>
                    </div>';
                  }



            }
           ?>

        </div>
        <div class="col-md-3">
          <div class="row">
            <div class="col-md-12">
              <div class="card mt-3">
                <div class="card-body card-bg" style="overflow-y:scroll;height:360px">
                  <h3 class="catd-title" style="color:orange;">Reviews</h3>
                  <?php
                    $qu="SELECT * FROM  orders WHERE user_id=$user_id";
                    $res=mysqli_query($conn,$qu);
                    while($r=mysqli_fetch_array($res))
                    {
                      if($r['rating']!=0)
                      {
                        $r_id=$r['r_id'];
                        $q2="SELECT r_name FROM resturants WHERE r_id=$r_id";
                        $res2=mysqli_query($conn,$q2);
                        $res2=mysqli_fetch_array($res2);
                        echo '<br/><small class="text-muted">'.$res2['r_name'].'</small>&nbsp&nbsp<span class="badge badge-success">'.$r['rating'].'</span>
                        <p>
                          '.$r['reviews'].'</p>';
                      }

                    }
                   ?>

                </div>

              </div>
            </div>

          </div>
          <div class="col-md-12">
            <div class="card mt-3" style="height:360px">
              <div class="card-body card-bg"style="overflow-y:scroll">
                <h4 class="card-title" style="color:orange">Address :</h4>
                <small class="badge badge-dark">Work</small>
                <p><?php echo $result['work_address']; ?></p>
                <small class="badge badge-dark">Home</small>
                <p><?php echo $result['home_address'] ?></p>

              </div>

            </div>
          </div>
        </div>

      </div>

    </div>
    <!-- modal 1 -->
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header navbar-color" id="body">
            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Profile</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="background-color:linen">
            <form>
              <label>Name:</label><br/>
              <input id="name" type="text" value="<?php echo $_SESSION['name']?>" name=""/><br/><br/>
              <label>E-mail:</label><br/>
              <input id="email" type="email" name="" value="<?php echo $result['email'] ?>"/><br/><br/>
              <label>Password( Enter old password if no change)<span style="color:red">*</span>:</label><br/>
              <input id="password" type="password" name="" placeholder="compulsory" required/><br/><br/>
              <label>Contact no.:</label><br/>
              <input id="phone" type="text" name="" value="<?php echo $result['phone']; ?>"/><br/><br/>
              <label>Work Address:</label><br/>
              <textarea id="work" name="name" ><?php echo $result['work_address'] ?></textarea><br/>
              <label>Home Address:</label><br/>
              <textarea  id="home" name="name" ><?php echo $result['home_address'] ?></textarea>
            </form>
          </div>
          <div class="modal-footer navbar-color" id="body">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="save" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </div>
<!-- Modal2 -->
<div class="modal fade" id="ratemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <label>Rating:</label><br/>
          <input id="rate_order" type="number" min="1" max="5" name="" class="from-control"/><br/>
          <label>Review:</label><br/>
          <textarea id="review_order" class="form-control"></textarea>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn navbar-color text-light" id="submit">Submit</button>
      </div>
    </div>
  </div>
 </div>

 <!--modal 3-->
 <div class="modal fade" id="dpmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header navbar-color">
        <h5 class="modal-title" id="exampleModalLongTitle">Choose a Profile Pic</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="uploads.php" method="POST" enctype="multipart/form-data">
          <label style="color:orange">Choose a prifile pic.(jpg/jpeg/png/jfif)</label>
          <input type="file" class="form-control" name="pic"/><br/>
          <input type="submit" class="btn navbar-color text-light" id="submit" name="" value="Upload"/>
        </form>
      </div>
    </div>
  </div>
 </div>
  </body>
</html>
