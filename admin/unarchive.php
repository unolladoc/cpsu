<?php 
include '../conn.php';

session_start();

$id = preg_replace('/\s/', '', $_POST['una_idno']);
//$aid = preg_replace('/\s/', '', $_POST['archived_idno']);
$pass = mysqli_real_escape_string($conn,$_POST['password']);

$username = $_SESSION['username'];

$sql = "SELECT * FROM user WHERE username = '$username' and password = md5('$pass');";
$result = mysqli_query($conn,$sql);

if($result->num_rows > 0){
	$sql2 = "SELECT * from files where id ='$id';";
	$result2 = mysqli_query($conn,$sql2);
	if($row2 = $result2->fetch_assoc()){
		$sql4 = "UPDATE files SET archive = '0' WHERE id= '$id'";
				if ($conn->query($sql4) === TRUE) {
						$sqll = "Insert into logs values(null, '".$_SESSION['name']." UNARCHIVED ".$row2['file_name']."',CAST('$datenow' as datetime), ".$_SESSION['id'].", 'UNARCHIVED FILE','".$row2['id']."');";
						if ($conn->query($sqll) === TRUE) {}else{echo "Error: " . $sqll . "<br>" . $conn->error;}
						header("location: archive.php?success=3");
				}else {
					echo "Error: " . $sql4 . "<br>" . $conn->error;
				}	
							
	}else{

	}
}else{
	header("location: index.php?error=5");
}

?>