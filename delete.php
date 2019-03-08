<?php 
include 'conn.php';

session_start();

$id = preg_replace('/\s/', '', $_POST['idno']);
$pass = mysqli_real_escape_string($conn,$_POST['password']);

$username = $_SESSION['username'];

$sql = "SELECT * FROM user WHERE username = '$username' and password = md5('$pass');";
$result = mysqli_query($conn,$sql);

if($result->num_rows > 0){
	$sql2 = "SELECT * from files where id ='$id';";
	$result2 = mysqli_query($conn,$sql2);
	if($row2 = $result2->fetch_assoc()){
		$filetodelete = $row2['file_path'];
		unlink($filetodelete);
		$sql3 = "DELETE from files where id ='$id';";
		$result3 = mysqli_query($conn,$sql3);
		header("location: home.php?success=2");
	}else{

	}
}else{
	header("location: home.php?error=5");
}
?>
