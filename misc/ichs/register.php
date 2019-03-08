<?php
include('conn.php');

$batch = $_POST["batchyear"];
$amount = $_POST["amount"];

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = mt_rand();
$newid = sprintf("REG%X",$id);

$sql = "INSERT INTO registration values('$newid','$batch','$amount',1,0,now());" ;

if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully";
    header("location: registration.php?registration_sucess=1&a=".$amount."&b=".$batch."");
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
	header("location: registration.php?batch_error=1&b=".$batch."");
}

$conn->close();
?>