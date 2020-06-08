<?php
  session_start();
  if(empty($_SESSION))
  {
    header("Location:restaurant_login.php");
  }
  $conn=mysqli_connect("localhost","root","","swiggy_prac");
  $r_id=$_SESSION['r_id'];
  $query="SELECT * FROM orders WHERE r_id=$r_id AND status=1";
  $result=mysqli_query($conn,$query);
  $query2="SELECT * FROM resturants WHERE r_id=$r_id";
  $result2=mysqli_query($conn,$query2);
  $result2=mysqli_fetch_array($result2);
  $query3="SELECT * FROM menu WHERE r_id=$r_id";
  $result3=mysqli_query($conn,$query3);
  $query4="SELECT * FROM orders o JOIN users u ON u.user_id=o.user_id WHERE r_id=$r_id AND delivery_status=0 AND status=1";
  $result4=mysqli_query($conn,$query4);
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Welcome To Swiggy</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="login_prac_style.css"/>
    <script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </head>
  <script>
  $(document).ready(function(){
    $('.order_id').click(function(){
      var order_id=$(this).text();
      var count=0;

      $.ajax({
        url:'order_list.php',
        type:"POST",
        data:{'order_id':order_id},
        success:function(data){
          $('#append').empty();
          //console.log(data);
          data=JSON.parse(data);
          $.each(data,function(i,item){
            $('#append').append('<tr><td>'+(count+1)+'</td><td>'+data[count][1]+'</td><td>'+data[count][2]+'</td></tr>');
            count++;
          });

        },
        error:function(){
          alert("Somne Error Occured");
        }
      });
    });

    $('.check').click(function(){
      var id=$(this).data('id');
      $.ajax({
        url:'status.php',
        data:{'id':id},
        type:"POST",
        success:function(){
          alert('Status Updated Successfully');
        },
        error:function(){
          alert('Some Error Occured');
        }
      });
    });
  });
  </script>
  <body id="bg-img">
    <nav class=" navbar navbar-color " style="padding-left:75px;padding-right:15px;padding-bottom: 15px;">
      <h3 class="text-light">Swiggy</h3>
      <span style="float:right" class="lead text-light">Welcome <?php echo $_SESSION['r_name']; ?> Admin</span>
      <a href="logout.php" class="btn btn-light">Logout</a>
    </nav>
    <div class="container" style="padding-left:0px">
      <div class="row" >
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-3">
              <div class="card mt-3">
                <div class="card-body jumbotron-background">
                  <?php
                    $amt=0;
                      while($row=mysqli_fetch_array($result))
                      {
                        if($row['delivery_status']==1)
                          $amt+=$row['amount'];
                      }
                      echo '<h2 style="text-align:center">Total Income <br/>Rs '.$amt.'</h2>';
                   ?>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card mt-3">
                <div class="card-body jumbotron-background">
                  <?php
                    $c=0;
                    $result=mysqli_query($conn,$query);
                    while($row=mysqli_fetch_array($result))
                    {
                      if($row['r_id']==$r_id)
                        $c+=1;
                    }
                    echo '<h2 style="text-align:center">Total Orders<br/>'.$c.'</h2>';
                   ?>
                </div>

              </div>
            </div>
            <div class="col-md-3">
              <div class="card mt-3">
                <div class="card-body jumbotron-background">
                  <?php
                      $c=0;
                      $result=mysqli_query($conn,$query);
                      while($row=mysqli_fetch_array($result))
                      {
                        if($row['r_id']==$r_id AND $row['delivery_status']==0)
                          $c+=1;
                      }
                      echo '<h2 style="text-align:center">Pending Orders<br/>'.$c.'</h2>';
                   ?>
                </div>

              </div>
            </div>
            <div class="col-md-3">
              <div class="card mt-3">
                <div class="card-body jumbotron-background">
                  <?php
                        $r=0;
                        $c=0;
                        $result=mysqli_query($conn,$query);
                        while($row=mysqli_fetch_array($result))
                        {
                          if($row['r_id']==$r_id AND $row['delivery_status']==1)
                          {
                            $r+=$row['rating'];
                            $c+=1;
                          }

                        }
                        $r=floor($r/$c);
                        $qury="UPDATE resturants SET `r_rating`=$r WHERE `r_id`=$r_id";
                        mysqli_query($conn,$qury);
                        echo '<h2 style="text-align:center">Rating<br/>'.$r.'</h2>';
                   ?>

                </div>

              </div>

            </div>

          </div>
          <div class="col-md-12">
            <div class="row">

              <div class="col-md-2 float-left" >
                <div class="card mt-2">
                  <div class="card-body">
                    <h3 style="color:orange"><em>Logo:-</em></h3>
                    <img src="<?php echo $result2['r_logo'];?>" width="120" height="100" /><br/><br/>
                    <button  data-toggle="modal" data-target="#logomodal" class="btn navbar-color btn-block text-light">Edit Logo</button>

                  </div>

                </div>
              </div>
              <div class="col-md-5">
                <div class="card mt-2">
                  <div class="card-body card-bg">
                      <h2><u>MENU:-</u> <button data-toggle="modal" data-target="#addmenu" class="btn navbar-color float-right text-light">Add Menu</button><br/></h2>
                    <?php
                      while($row=mysqli_fetch_array($result3))
                      {
                        if($row['status']==1)
                        {
                          echo '<div class="card mt-3">
                            <div class="card-body">
                              <img src="'.$row['img'].'" width="80" height="80"/><span class="card-title lead">&nbsp&nbsp'.$row['name'].'</span>
                              <input class="float-right check" type="checkbox"  name="" id="status'.$row['name'].'" data-id='.$row['id'].' checked value="Available">
                            </div>
                          </div>';
                        }
                        else
                       {
                         echo '<div class="card mt-3">
                           <div class="card-body">
                             <img src="'.$row['img'].'" width="80" height="80"/><span class="card-title lead">&nbsp&nbsp'.$row['name'].'</span>
                             <input class="float-right check" type="checkbox" name="" id="status'.$row['id'].'" data-id='.$row['id'].' value="Available">
                           </div>
                         </div>';
                       }

                      }
                     ?>
                  </div>

                </div>

               </div>

              <div class="col-md-5">
                <div class="card mt-5">
                  <div class="card-body card-bg">
                    <table class="table">
                      <tr>
                        <th>S No.</th>
                        <th>Order Id</th>
                        <th>Customer Name</th>
                        <th>Amount(Rs)</th>
                      </tr>
                      <?php
                        $c=0;
                        while($row=mysqli_fetch_array($result4))
                        {
                          $c+=1;
                          echo '<tr>
                            <td>'.$c.'</td>
                            <td><a href="#" class="order_id" data-id="'.$row['order_id'].'" data-toggle="modal" data-target="#orderModal">'.$row['order_id'].'</a></td>
                            <td>'.$row['name'].'</td>
                            <td>'.$row['amount'].'</td>
                          </tr>';
                        }
                       ?>
                    </table>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </div>

      </div>

    </div>
    <!-- Modal-1 -->
    <div class="modal fade" id="logomodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
         <div class="modal-header navbar-color">
           <h5 class="modal-title text-light" id="exampleModalLongTitle">Restaurant Logo</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <form action="upload_logo.php" method="POST" enctype="multipart/form-data">
             <label style="color:orange">Choose your Restaurant Logo(jpg/jpeg/png/jfif):</label>
             <input type="file" class="form-control" name="pic"/><br/>
             <input type="submit" class="btn navbar-color text-light" id="submit" name="" value="Upload"/>
           </form>
         </div>
       </div>
     </div>
    </div>
    <!-- Modal-2 -->
    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header  navbar-color">
        <h5 class="modal-title" id="exampleModalLabel">Order Details:-</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body card-bg">
            <div id="display_menu">

              <table class="table">
                <tr>
                  <th>S No.</th>
                  <th>Name</th>
                  <th>Qty</th>
                </tr>
                <tbody id="append">
                </tbody>

              </table>
            </div>
      </div>

    </div>
    </div>
    </div>
    <!-- Modal 3 -->
    <div class="modal fade" id="addmenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header navbar-color" id="body">
            <h5 class="modal-title text-light" id="exampleModalCenterTitle">Add Menu</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="background-color:linen">
            <form action="add_menu.php" method="POST" enctype="multipart/form-data">
              <label>Name:</label><br/>
              <input type="text" name="name" value="" class="form-control" required><br/><br/>
              <label>Price:</label><br/>
              <input type="text" name="price" class="form-control" required/><br/><br/>
              <label>Description:</label><br/>
              <textarea name="desc" class="form-control" required></textarea><br/>
              <label>Status:</label><br/>
              <input type="number" min="0" max="1" class="form-control" name="status" required/><br/><br/>
              <label>type:(0 for veg/1 for non-veg )</label><br/>
              <input type="number" min="0" max="1" name="type" class="form-control" required/><br/><br/>
              <label>Upload Image:</label><br/>
              <input type="file" name="img" class="form-control" required/><br/><br/>
              <input type="submit" name="submit" class="btn btn-primary"  value="Add Menu">
            </form>
          </div>
        </div>
      </div>
    </div>

  </body>
</html>
