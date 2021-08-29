<?php
  $conn=mysqli_connect("sql212.epizy.com","epiz_29386857","CiF2lMeHtN7","epiz_29386857_swiggy");
  $id=$_POST['id'];
  $query="SELECT status FROM menu WHERE id=$id";
  $result=mysqli_query($conn,$query);
  $status=mysqli_fetch_array($result);
  $status=($status['status']+1)%2;
  $query="UPDATE menu SET `status`=$status WHERE `id`=$id";
  mysqli_query($conn,$query);
?>
