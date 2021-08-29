<?php
session_start();
$conn=mysqli_connect("sql212.epizy.com","epiz_29386857","CiF2lMeHtN7","epiz_29386857_swiggy");
$name=$_FILES['pic']['name'];
$r_id=$_SESSION['r_id'];
$path="http://localhost/Swiggy/uploads/".$_FILES['pic']['name'];
$allowed=array('jpg','jpeg','png','JPG','JPEG','PNG','jfif');
$pos=strpos($name,'.');
$ext=substr($name,$pos+1);
if(in_array($ext,$allowed) AND $_FILES['pic']['size']<=(1024*512))
{
  $query="UPDATE resturants SET `r_logo`='$path' WHERE `r_id`=$r_id";
  mysqli_query($conn,$query);
  move_uploaded_file($_FILES['pic']['tmp_name'],"./uploads/".$name);
  header("Location:restaurant_profile.php");
}
else
{
  header("Location:uploads_error.php");
}
 ?>
