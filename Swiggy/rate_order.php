<?php
  $conn=mysqli_connect("sql212.epizy.com","epiz_29386857","CiF2lMeHtN7","epiz_29386857_swiggy");
  $rating=$_POST['rating'];
  $review=$_POST['review'];
  $order_id=$_POST['order_id'];
  $query="UPDATE orders SET `rating`=$rating,`reviews`='$review',`delivery_status`=1 WHERE `order_id`='$order_id'";
  mysqli_query($conn,$query);
  $q="SELECT r_id FROM orders WHERE order_id='$order_id'";
  $res=mysqli_query($conn,$q);
  $res=mysqli_fetch_array($res);
 ?>
