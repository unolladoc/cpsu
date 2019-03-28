<?php 
include '../conn.php';

session_start();

$id = preg_replace('/\s/', '', $_POST['idno4']);
$pass = mysqli_real_escape_string($conn, $_POST['password4']);

$username = $_SESSION['username'];

$sql = "SELECT * FROM user WHERE username = '$username' and password = md5('$pass');";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
	$sql2 = "UPDATE user set type = 1 where id ='$id';";
	//echo $sql2;
	$result2 = mysqli_query($conn,$sql2);
	header("location: members.php?success=4");
} else {
	header("location: members.php?error=5");
}
 