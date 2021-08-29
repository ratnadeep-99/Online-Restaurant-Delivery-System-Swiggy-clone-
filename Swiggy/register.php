<?php
  $conn=mysqli_connect("sql212.epizy.com","epiz_29386857","CiF2lMeHtN7","epiz_29386857_swiggy");
  $name=$_POST['name'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $password=md5($password);
  $contact=$_POST['contact'];
  $home=$_POST['home'];
  $img="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBwgHBgkIBwgKCgkLDRYPDQwMDRsUFRAWIB0iIiAdHx8kKDQsJCYxJx8fLT0tMTU3Ojo6Iys/RD84QzQ5OjcBCgoKDQwNGg8PGjclHyU3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3N//AABEIAJkAkgMBIgACEQEDEQH/xAAbAAEAAwADAQAAAAAAAAAAAAAABAUGAQIDB//EADMQAQACAQIEAgYKAwEAAAAAAAABAgMEEQUSITFRYSIjQVKRwRMyMzRCYnFygbGh8PEV/8QAGAEBAAMBAAAAAAAAAAAAAAAAAAECAwT/xAAcEQEBAAMAAwEAAAAAAAAAAAAAAQIRMQMSUSH/2gAMAwEAAhEDEQA/APogDpYgAAAAAAAAAAAAAAAAAAAAAAAAO+LFkzXimKk2nyRbpLobrTFwe0x67LFfKsbvb/xsO32l91feJ9apZIWWbhGSsTOHJF/yzG0q+1bUtNb1mto7xKZlLxGnUBZAAAAAAAAAAACfwakX1VuaImIpPdFuomTaLp9Pk1OTlx1369ZntDQ6TTU02Llp37zbxl61rWsbViIjydmOWVq8mgBVYV/FdJ9Pim9I9ZSOnnHgsHGxLqjJix4zpox5K5qRtF+lo81dDfG7jKzQAsgAAAAAAAAWXA/vOSPyfNWpvCL8murE/iiY+fyVy4mdaAcQ5YNQAAAEPitebQ5PLaY+LPNDxa/LocnntEfFnmvj4pkANFAAAAAAAAB7aSuS+qxxhiOeJ3jeXilcLty6/Fv7d4/wjLiZ1owHO1AAAAVXHZv9FiiI9CbTv+v+7qeOy347b0MNPGZn4f8AVQ2w4zy6ALqgAAAAAAADtS848lb171neHU2EtTgzUz44vjtvWXop+BZvtMM/ur81w57NVpKAISOJmIiZn2OUTiWX6HSZJ9to5Y/WSfoqOJ6iuo1O9J3rWNon+0QHRJplQBKAAAAAAAAAAS9dPmnT5qZY/DPWPGGmrO9d/FlYjeYjxlq6xtWI8GPkXxcgKLEqLjWfnzxhj6uPv5zK9Z/i9YjXWn3oiV8Oq5cQgGzMAAAAAAAAAAB7afS5tRPq6Tt709IRvSYmcFwUyzktkxxbl25d47T1XUI+h08abBGPfee8z4yksMrutJABCSUHimCl9NkyckTesdLe2E5xaItExMbxPsBkxN1XDs2GZmleensmvWf5QnRLKy1oASgAAAABI02kzamfV19H3p7It0lHe+n0mbUT6uk7e9bpC203C8OLacvrLefb4J8RG3ZS5/Fpir9NwrDj65fWW8J7J9Y2jaIiI8IdhnbauAIAAAABE1Ogw6jravLf3q9JSwGf1PDc2HeaR9JX8vf4IX8S1myNqdDg1HW1Nre9XpLSZ/VLj8ZwTtVwzNh3tT1lPKOvwQWksqugBIk8OwV1OprW/wBWI5pjxaKtYrG0RtHkpOC/e5/ZP9wvWOfV8eACiwAAAAAAAAAAADhUca01axXPX0Zmdrbe1cK7jf3OP3wnHqLxRgN2W3//2Q==";
  $work=$_POST['work'];
  $query="INSERT INTO users (user_id,name,email,password,work_address,home_address,phone,img) VALUES (NULL,'$name','$email','$password','$work','$home','$contact','$img')";
  mysqli_query($conn,$query);
  header('Location:login_prac.php');
 ?>
