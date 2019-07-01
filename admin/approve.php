<?php 
include '../conn.php';

session_start();

$id = preg_replace('/\s/', '', $_POST['idno2']);
$pass = mysqli_real_escape_string($conn, $_POST['password2']);

$username = $_SESSION['username'];

$sql = "SELECT * FROM user WHERE username = '$username' and password = md5('$pass');";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
	$sql2 = "UPDATE user set type = 2 where id ='$id';";
	if($conn->query($sql2) === TRUE){
		header("location: members.php?success=1");
	}
	
} else {
	header("location: members.php?error=5");
}

$sqlu = "SELECT * FROM user WHERE id ='$id';";
$resultu = mysqli_query($conn, $sqlu);

if ($resultu->num_rows > 0) {
	$rowu = $resultu->fetch_assoc();

	$sqll = "Insert into logs values(null, '".$_SESSION['name']." approved ".$rowu['name']." as user',CAST('$datenow' as datetime), ".$_SESSION['id'].", 'USER APPROVAL','');";
	if ($conn->query($sqll) === TRUE) {}else{echo "Error: " . $sqll . "<br>" . $conn->error;}
}

?>