<?php 
include '../conn.php';

session_start();

$id = preg_replace('/\s/', '', $_POST['idno']);
//$aid = preg_replace('/\s/', '', $_POST['archived_idno']);
$pass = mysqli_real_escape_string($conn,$_POST['password']);

$username = $_SESSION['username'];

$sql = "SELECT * FROM user WHERE username = '$username' and password = md5('$pass');";
$result = mysqli_query($conn,$sql);

if($result->num_rows > 0){
					$sql3 = "DELETE from files where id ='$id';";
					if ($conn->query($sql3) === TRUE) {
						$filetodelete = "../" . $row2['file_path'];
						unlink($filetodelete);
						$sqll = "Insert into logs values(null, '".$_SESSION['name']." DELETED A Request File".$row2['file_name']." from DATABASE',CAST('$datenow' as datetime), ".$_SESSION['id'].", 'DELETE FILE',".$row2['id'].");";
						if ($conn->query($sqll) === TRUE) {}else{echo "Error: " . $sqll . "<br>" . $conn->error;}
						header("location: request.php?success=2");
					}
}else{
	header("location: request.php?error=5");
}

?>