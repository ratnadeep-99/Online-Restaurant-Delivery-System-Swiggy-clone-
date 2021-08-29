<?php
 session_start();
  if(empty($_SESSION))
  {
    header('Location:login_prac.php');
  }
 $order_id=$_GET['order_id'];
 $conn=mysqli_connect("sql212.epizy.com","epiz_29386857","CiF2lMeHtN7","epiz_29386857_swiggy");
 $query="SELECT * FROM orders WHERE order_id LIKE '$order_id'";
 $result1=mysqli_query($conn,$query);
 $result1=mysqli_fetch_array($result1);
 $r_id=$result1['r_id'];
 $query2="SELECT * FROM resturants WHERE r_id=".$r_id;
 $result2=mysqli_query($conn,$query2);
 $result2=mysqli_fetch_array($result2);
 $r_name=$result2['r_name'];
 $query3="SELECT name,price FROM menu m JOIN order_details o ON o.menu_id=m.id WHERE o.order_id LIKE '$order_id'";
 $q="SELECT qty FROM order_details WHERE order_id='$order_id'";
 $res=mysqli_query($conn,$q);
 $result3=mysqli_query($conn,$query3);
 include 'header1.php';
?>

  <script>
  $(document).ready(function(){

      $("#apply").click(function(){
        var id=$("#discount").val();
        $.ajax({
          url:"discount.php",
          type:"POST",
          data:{'id':id},
          success:function(data){
            console.log(data);
            data=JSON.parse(data);
            if(data.response!=0)
            {
              var d=data.discount;
              console.log(data.discount);
              var total=$("#total").text();
              var disc=Math.floor((d/100)*total);
              var amt= total-disc;
              $("#disc").text(disc);
              $("#amount").text(amt);
              $("#disp").html("<span style='color:green'>Applied Successfully</span>");
            }
            else if(data.response==0)
            {
                $("#disp").html("<span style='color:red'>Invalid coupon code</span>");
            }
          }
        });
      });
      $('#pay').click(function(){
        var order_id='<?php echo $order_id; ?>';
        var amt=$('#amount').text();
        window.location.href="payment.php?order_id="+order_id+"&amount="+amt;

      });
  });

  </script>
  <body id="bg-img">
    <nav class=" navbar-color " style="height:90px;padding-left:15px;padding-right:15px;padding-bottom: 5px;">
      <a href="index.php"><h2 class="text-light navbar-brand" style = "font-size : 25px; margin-bottom:0px" >Swiggy</h2></a><br/>
      <span class="text-light lead" style="float:left;font-size:20px">  West Bengal,India</span>
      <span style="float:right"><a href="profile.php"  class="lead text-light">Hi <?php echo $_SESSION['name']; ?></a></span>
    </nav>
    <div class="container ">
      <div class="row">
      <div class="col-md-8 mt-3">
        <div class="card">
          <div class="card-body">
            <h3><?php echo $r_name; ?></h3>
            <table class="table">
            <?php
            $total=0;
              while($row=mysqli_fetch_array($result3))
              {
                $qty=mysqli_fetch_array($res);
                echo '<tr>
                    <td>'.$row['name'].'</td>
                    <td>'.$qty['qty'].'</td>
                    <td>Rs '.$row['price'].'</td>
                  </tr>';
                $total=$total+($row['price']*$qty['qty']);
              }
             ?>
             </table>
             <span id="disp">Apply coupon:<br/></span>
            <input type="text" id="discount" name="" class="form-control"/>
            <button  id ="apply" class="btn navbar-color mt-1">Apply</button>
          </div>

        </div>

      </div>
      <div class="col-md-3 mt-5">
        <div class="card">
          <div class="card-body">
            <table class="table">
              <?php
                echo '<tr>
                  <td>TOTAL</td>
                  <td>Rs <span id="total">'.$total.'</span></td>
                </tr>
                <tr>
                  <td>Discount</td>
                  <td id="disc">0</td>
                </tr>
                <tr>
                  <td>Final Amount</td>
                  <td>Rs <span id="amount">'.$total.'</td>
                </tr>';

              ?>
            </table>
            <button id="pay" class="btn navbar-color btn-block mt-1">Place Order</button>
          </div>

        </div>
      </div>
      </div>
    </div>
    <?php include 'footer1.php';?>
  </body>
</html>
