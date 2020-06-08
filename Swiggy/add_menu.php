<?php
    session_start();
    $conn=mysqli_connect("localhost","root","","swiggy_prac");
    $name=$_POST['name'];
    $price=$_POST['price'];
    $desc=$_POST['desc'];
    $img="http://localhost/Swiggy/uploads/".$_FILES['img']['name'];
    $r_id=$_SESSION['r_id'];
    $status=$_POST['status'];
    $type=$_POST['type'];
    $allowed=array('jpg','jpeg','png','JPG','JPEG','PNG','jfif');
    $pos=strpos($_FILES['img']['name'],'.');
    $ext=substr($_FILES['img']['name'],$pos+1);
    if(in_array($ext,$allowed) AND $_FILES['img']['size']<=(1024*512))
    {
      $query="INSERT INTO menu (id,name,price,`desc`,img,r_id,status,type) VALUES (NULL,'$name','$price','$desc','$img',$r_id,$status,$type)";
      mysqli_query($conn,$query);
      move_uploaded_file($_FILES['img']['tmp_name'],"./uploads/".$_FILES['img']['name']);
      header("Location:restaurant_profile.php");
    }
    else
    {
        header("Location:Error.php");
    }
 ?>
