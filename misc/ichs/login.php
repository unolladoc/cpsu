<?php

include('conn.php');

session_start();

$username = mysqli_real_escape_string($conn,$_POST['verifyUsername']);
$password = mysqli_real_escape_string($conn,$_POST['verifyPassword']); 
      
$sql = "SELECT * FROM user WHERE username = '$username' and password = md5('$password');";
$result = mysqli_query($conn,$sql);

if($result->num_rows > 0){

	$row = $result->fetch_assoc();
	$_SESSION['id'] = $row['id'];
	$_SESSION['username'] = $row['username'];

	header("location: dashboard.php");
}else{
    header("location: index.php?invalid=true");
  }



?>