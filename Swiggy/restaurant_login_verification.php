<?php
  session_start();
  $conn=mysqli_connect("sql212.epizy.com","epiz_29386857","CiF2lMeHtN7","epiz_29386857_swiggy");
  $email=$_POST['email'];
  $password=$_POST['password'];
  $password=md5($password);
  $query="SELECT * FROM resturants WHERE r_email LIKE '$email' AND password LIKE '$password' ";
  $result=mysqli_query($conn,$query);
  $new_result=mysqli_fetch_array($result);
//  print_r($new_result);
  $count=mysqli_num_rows($result);
  if($count==1)
  {
    $_SESSION['is_loggedin']=1;
    $query1="SELECT * FROM resturants WHERE r_email LIKE '$email'";
    $result1=mysqli_query($conn,$query1);
    $result1=mysqli_fetch_array($result1);
    $_SESSION['r_id']=$result1['r_id'];
    $_SESSION['r_name']=$result1['r_name'];
    header('Location:restaurant_profile.php');
  }
  else
  {
    header('Location:restaurant_login.php');
  }
 ?>
