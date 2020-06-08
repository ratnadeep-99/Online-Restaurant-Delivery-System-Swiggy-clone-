<?php
    $conn=mysqli_connect("localhost","root","","swiggy_prac");
    $order_id=$_POST['order_id'];
    $query="SELECT * FROM order_details o JOIN menu m ON o.menu_id=m.id WHERE o.order_id='$order_id'";
    $result=mysqli_query($conn,$query);
    $c=0;
    while($row=mysqli_fetch_array($result))
    {
      $arr[$c]=array('1'=>$row['name'],'2'=>$row['qty']);
      $c++;
    }
    $result=json_encode($arr);
    print_r($result);
 ?>
