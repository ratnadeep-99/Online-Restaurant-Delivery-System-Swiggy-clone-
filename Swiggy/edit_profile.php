<?php
  $conn=mysqli_connect("sql212.epizy.com","epiz_29386857","CiF2lMeHtN7","epiz_29386857_swiggy");
  $name=$_POST['name'];
  $email=$_POST['email'];
  $pass=md5($_POST['password']);
  $phone=$_POST['phone'];
  $work=$_POST['work'];
  $home=$_POST['home'];
  $user_id=$_POST['user_id'];
  $query="UPDATE users SET `name`='$name',`email`='$email',`password`='$pass',`phone`='$phone',`work_address`='$work',`home_address`='$home' WHERE `user_id`='$user_id'";
  mysqli_query($conn,$query);
 ?>
