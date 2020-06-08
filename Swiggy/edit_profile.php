<?php
  $conn=mysqli_connect("localhost","root","","swiggy_prac");
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
