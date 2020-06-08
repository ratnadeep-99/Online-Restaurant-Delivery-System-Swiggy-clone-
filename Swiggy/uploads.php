<?php
    session_start();
    $conn=mysqli_connect("localhost","root","","swiggy_prac");
    $name=$_FILES['pic']['name'];
    $user_id=$_SESSION['user_id'];
    $path="http://localhost/Swiggy/uploads/".$_FILES['pic']['name'];
    $allowed=array('jpg','jpeg','png','JPG','JPEG','PNG');
    $pos=strpos($name,'.');
    $ext=substr($name,$pos+1);
    if(in_array($ext,$allowed) AND $_FILES['pic']['size']<=(1024*512))
    {
      $query="UPDATE users SET `img`='$path' WHERE `user_id`=$user_id";
      mysqli_query($conn,$query);
      move_uploaded_file($_FILES['pic']['tmp_name'],"./uploads/".$name);
      header("Location:profile.php");
    }
    else
    {
      header("Location:uploads_error.php");
    }
 ?>
