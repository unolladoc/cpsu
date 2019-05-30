<?php
include('conn.php');
session_start();

header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_POST["x"], false);

//$conn = new mysqli("myServer", "myUser", "myPassword", "Northwind");
$conn = new mysqli($servername, $username, $password, $dbname);
$stmt = $conn->prepare("UPDATE files SET downloads = downloads + 1 WHERE  id = ?;");
$stmt->bind_param("s", $obj->fid);
$stmt->execute();

$sqlu = "SELECT * FROM files WHERE id ='$obj->fid';";
$resultu = mysqli_query($conn, $sqlu);

if ($resultu->num_rows > 0) {
	$rowu = $resultu->fetch_assoc();

	$sqll = "Insert into logs values(null, '".$_SESSION['name']." DOWNLOADED ".$rowu['file_name']."',CAST('$datenow' as datetime), '".$_SESSION['id']."', 'DOWNLOAD');";
	if ($conn->query($sqll) === TRUE) {}else{echo "Error: " . $sqll . "<br>" . $conn->error;}
}

?>
