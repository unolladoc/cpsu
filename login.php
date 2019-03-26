<?php

include('conn.php');

session_start();

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$sql = "SELECT * FROM user WHERE username = '$username' and password = md5('$password');";

$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {

	$row = $result->fetch_assoc();

	if ($row['type'] != 0) {
		if ($row['type'] == 1) {
			$_SESSION['id'] = $row['id'];
			$_SESSION['name'] = $row['name'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['type'] = $row['type'];
			header("location: admin/");
		} else if ($row['type'] == 2){
			$_SESSION['id'] = $row['id'];
			$_SESSION['name'] = $row['name'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['type'] = $row['type'];
			header("location: member/");
		}
	}else{
			header("location: index.php?error");
	}
} else {
	header("location: index.php?invalid=true");
}
 