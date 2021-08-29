<?php
    $conn=mysqli_connect("sql212.epizy.com","epiz_29386857","CiF2lMeHtN7","epiz_29386857_swiggy");
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
