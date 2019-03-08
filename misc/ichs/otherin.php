<?php
include('conn.php');

$descripton = $_POST["descripton"];
//$batch = $_POST["batchyear"];
$amount = $_POST["amount"];

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = mt_rand();
$newid = sprintf("OTH%X",$id);

$sql = "INSERT INTO otherincome values('$newid','$descripton','$amount',1,0,now());" ;

if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully";
    header("location: otherincome.php?sucess=1&a=".$amount."&b=".$batch."&d=".$donor);
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
	header("location: otherincome.php?batch_error=1&b=".$batch."");
}

$conn->close();
?>