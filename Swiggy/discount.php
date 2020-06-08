<?php
  $conn=mysqli_connect("localhost","root","","swiggy_prac");
  $code=$_POST['id'];
  $query="SELECT discount,status FROM discounts WHERE code LIKE '$code'";
  $result=mysqli_query($conn,$query);
  $result=mysqli_fetch_array($result);
  if((!empty($result)) AND $result['status']==1)
  {

        $d=$result['discount'];
        $response=array("response"=>1,"discount"=>$d);
        $response=json_encode($response);
        print_r($response);

  }
  else if(empty($result))
  {
      $response=array("response"=>0,"code"=>$code);
      $response=json_encode($response);
      print_r($response);
  }
 ?>
