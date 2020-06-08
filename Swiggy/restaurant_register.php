<?php
  $conn=mysqli_connect("localhost","root","","swiggy_prac");
  $r_name=$_POST['name'];
  $r_email=$_POST['email'];
  $password=md5($_POST['password']);
  $owner_name=$_POST['owner_name'];
  $owner_contact=$_POST['contact'];
  $owner_address=$_POST['home'];
  $r_address=$_POST['work'];
  $r_cusine=$_POST['cusine'];
  $logo="https://www.google.com/imgres?imgurl=https%3A%2F%2Fforum.skylords.eu%2Fuploads%2Fmonthly_2018_03%2FR_member_20893.png&imgrefurl=https%3A%2F%2Fforum.skylords.eu%2Findex.php%3F%2Fprofile%2F20893-ropson%2F&tbnid=vBtQ5TWvggxaXM&vet=12ahUKEwiCh5m1uOvpAhUp8TgGHXosB3MQMygiegUIARCJAg..i&docid=llHHucmKoA45bM&w=500&h=500&q=R%20profile%20pic&client=firefox-b-d&ved=2ahUKEwiCh5m1uOvpAhUp8TgGHXosB3MQMygiegUIARCJAg";
  $query="INSERT INTO resturants (r_id,owner_name,r_email,password,owner_contact,owner_address,r_address,r_name,r_cusine,r_delivery_time,r_logo,r_rating,r_num_rating,r_num_reviews) VALUES (NULL,'$owner_name','$r_email','$password',$owner_contact,'$owner_address','$r_address','$r_name','$r_cusine',10,'$logo',0,0,0)";
  mysqli_query($conn,$query);
  echo $query;
  header("Location:restaurant_login.php");
 ?>
