<?php 
include '../conn.php';

session_start();

$id = preg_replace('/\s/', '', $_POST['idno']);
$pass = mysqli_real_escape_string($conn,$_POST['password']);

$username = $_SESSION['username'];

$sql = "SELECT * FROM user WHERE username = '$username' and password = md5('$pass');";
$result = mysqli_query($conn,$sql);
if($result->num_rows > 0){

	$sqlu = "SELECT * FROM user WHERE id ='$id';";
	$resultu = mysqli_query($conn, $sqlu);
	
	if ($resultu->num_rows > 0) {
		$rowu = $resultu->fetch_assoc();
	
		$sqll = "Insert into logs values(null, '".$_SESSION['name']." REMOVED USER ".$rowu['name']." from DATABASE',CAST('$datenow' as datetime), ".$_SESSION['id'].", 'DELETED USER','');";
		if ($conn->query($sqll) === TRUE) {}else{echo "Error: " . $sqll . "<br>" . $conn->error;}
	}

		$sql2 = "DELETE from user where id ='$id';";
		$result2 = mysqli_query($conn,$sql2);
		header("location: members.php?success=2");

}else{
	header("location: members.php?error=5");
}
?>
