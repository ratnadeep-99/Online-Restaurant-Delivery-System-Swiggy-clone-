<?php
  session_start();
  if(empty($_SESSION))
  {
    header('Location:login_prac.php');
  }
  $conn=mysqli_connect("sql212.epizy.com","epiz_29386857","CiF2lMeHtN7","epiz_29386857_swiggy");
  $id=$_GET['id'];
  $query="SELECT * FROM resturants WHERE r_id=".$id;
  $result=mysqli_query($conn,$query);
  $query2="SELECT * FROM menu WHERE r_id=".$id." AND status=1";
  $result2=mysqli_query($conn,$query2);
  $result=mysqli_fetch_array($result);
  if(empty($result))
  {
    header('Location:Error.php');
  }
  include 'header1.php';
 ?>
  <script>
    $(document).ready(function(){
      var flag=0;
      var order_id=0;
      var id=<?php echo $id; ?>;
      $(".itm_card").hide();
      $(".itm_add").click(function(){
        var itm_id=$(this).data('id');
        var itm_name=$(".itm_name"+itm_id).text();
        var itm_price=$(".pr"+itm_id).text();
        var qty=$('.qty'+itm_id).val();
        $.ajax({
          url:"add_order.php",
          type:"POST",
          data:{'r_id':id,'menu_id':itm_id,'flag':flag,'order_id':order_id,'qty':qty},
          success:function(data){
              console.log(data);
              flag=1;
              var data=JSON.parse(data);
              order_id=data.order_id;
          },
          error:function(){
            alert("An Unknown Error Ocuured");
          }


        });
        $(".itm_card").show();
        itm_price=itm_price*qty;
        $(".itm_lst").append('<p class="text-dark lead">'+itm_name+' X'+qty+'<span style="float:right">Rs '+itm_price+'</span></p><br/>');
      });
      $("#pay").click(function(){
        window.location.href="order_details.php?order_id="+order_id;
      });
    });
  </script>
  <body id="bg-img">
    <nav class=" navbar-color " style="padding-left:15px;padding-right:15px;padding-bottom: 5px;position:fixed;width:100%;z-index:1">
      <a href="index.php"><h2 class="text-light navbar-brand" style = "font-size : 30px; margin-bottom:0px; padding-bottom:0px" >Swiggy</h2></a><br>
      <span class="text-light lead" style="float:left; font-size:20px;padding-bottom:0px; margin-bottom:0px">West Bengal,India</span>
      <span style="float:right"><a href="profile.php" class="lead text-light" >Hi <?php echo $_SESSION['name']; ?></a></span>
    </nav>
    <?php
      echo '<br/><br/><br/>
    <div class="jumbotron jumbo-order-bg" style="padding-left:70px;padding-top:35px;padding-bottom:35px">
      <div class="row">
        <div class="col-md-4">
          <img src="'.$result['r_logo'].'" height="170" width="250"/>
        </div>
        <div class="col-md-5">
          <h2 class="text-light">'.$result['r_name'].'</h2><br/>
          <span class="text-light">'.$result['r_cusine'].'<br/>Central Kolkata</span>
          <div class="row mt-2">
            <div class="col-md-3" style="border-right:1px solid white">
              <span class="text-light"><h5 class="badge badge-success">'.$result['r_rating'].'</h5><br/>'.$result['r_num_rating'].'+ Ratings</span>
            </div>
            <div class="col-md-3"style="border-right:1px solid white">
                <span class="text-light"><h5>'.$result['r_delivery_time'].' mins</h5>Delivery Time</span>
            </div>
            <div class="col-md-3" style="padding-left:30px">
              <img src="https://res.cloudinary.com/swiggy/image/upload/fl_lossy,f_auto,q_auto,w_220,h_220/HygieneGoodWhite_kviidn" height="50" width="50"/>
            </div>
            <div class="col-md-3">

            </div>
          </div>
        </div>
        <div class="col-md-3">

        </div>

      </div>
    </div>
    <div class="container">
      <div class="row menu_itm">';
      while($rows=mysqli_fetch_array($result2))
      {
          echo '<div class="col-md-4">
          <div class="card mt-2" style="width:321px">
            <div class="card-body">
              <img src="'.$rows['img'].'" height="150" width="275"/>
              <h5 class="itm_name'.$rows['id'].'">'.$rows['name'].'</h5>
              <small style="color:grey">'.$rows['desc'].'</small><br/>
               Rs <span class="pr'.$rows['id'].'">'.$rows['price'].'</span>  <input type="number" class="qty'.$rows['id'].'" size="3" value="1" min="1" name="qty"/>

               <button data-id='.$rows['id'].' class="btn btn-sm itm_add mt-3" style="border:1px solid;float:right;color:green">Add +</button>
            </div>
          </div>
        </div>';
      }

    ?>
    <div class="col-md-4 itm_card">
    <div class="card mt-2" style="width:321px;padding:10px;border: 4px solid orange; border-radius:10px">
      <div class="card-body itm_lst" style="background-color:white">

      </div>
      <button type="button" id="pay" name="button" class="navbar-color btn btn-sm btn-box">Place Order</button>
    </div>
  </div>


  </div>

  </div>
  <?php include 'footer1.php';?>
  </body>
</html>
