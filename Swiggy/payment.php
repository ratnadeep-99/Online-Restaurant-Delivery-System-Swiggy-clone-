<?php
  $conn=mysqli_connect("localhost","root","","swiggy_prac");
  $order_id=$_GET['order_id'];
  $amt=$_GET['amount'];
  $query="UPDATE orders SET amount='$amt',status=1 WHERE order_id='$order_id' ";
  try
  {
      mysqli_query($conn,$query);
      header('Location:success.php');
  }
  catch(Exception $e)
  {
    header('Location:Error.php');
  }
 ?>
