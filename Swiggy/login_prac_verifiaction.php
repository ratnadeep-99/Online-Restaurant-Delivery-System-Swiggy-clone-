<?php
  session_start();
  $conn=mysqli_connect("sql212.epizy.com","epiz_29386857","CiF2lMeHtN7","epiz_29386857_swiggy");
  $email=$_POST['email'];
  $password=$_POST['password'];
  $password=md5($password);
  $query="SELECT * FROM users WHERE email LIKE '$email' AND password LIKE '$password' ";
  $result=mysqli_query($conn,$query);
  $new_result=mysqli_fetch_array($result);
//  print_r($new_result);
  $count=mysqli_num_rows($result);
  if($count==1)
  {
    $_SESSION['is_loggedin']=1;
    $query1="SELECT * FROM users WHERE email LIKE '$email'";
    $result1=mysqli_query($conn,$query1);
    $result1=mysqli_fetch_array($result1);
    $_SESSION['user_id']=$result1['user_id'];
    $_SESSION['name']=$result1['name'];
    header('Location:profile.php');
  }
  else
  {
    header('Location:login_prac.php');
  }
 ?>
