<?php
  session_start();
  $conn=mysqli_connect("localhost","root","","swiggy_prac");
  $user_id=$_SESSION['user_id'];
  $r_id=$_POST['r_id'];
  $flag=$_POST['flag'];
  $menu_id=$_POST['menu_id'];
  $qty=$_POST['qty'];
  if($flag==0)
  {
    $order_id=uniqid();
    $query="INSERT INTO orders (order_id,user_id,r_id,order_time,status) VALUES ('$order_id',$user_id,$r_id,current_timestamp(),0) ";
    $query2="INSERT INTO order_details (menu_id,order_id,id,qty) VALUES ($menu_id,'$order_id',NULL,$qty)";
    try{
      mysqli_query($conn,$query);
      mysqli_query($conn,$query2);
      $response=array('response'=>1,'order_id'=>$order_id,'qty'=>$qty);
    }
    catch(Exception $e){
      $response=array('response'=>0);
    }
    $response=json_encode($response);
    print_r($response);


  }
  else
  {
      $order_id=$_POST['order_id'];
      $query2="INSERT INTO order_details (menu_id,order_id,id,qty) VALUES ($menu_id,'$order_id',NULL,$qty)";
      try
      {
        mysqli_query($conn,$query2);
        $response=array('response'=>1,'order_id'=>$order_id,'qty'=>$qty);
      }
      catch(Exception $e){
        $response=array('response'=>0);
      }
      $response=json_encode($response);
      print_r($response);

  }
   ?>
