<?php
include('conn.php');

$donor = $_POST["donor"];
$batch = $_POST["batchyear"];
$amount = $_POST["amount"];

if($_POST["batchyear"] == ''){
	$batch = 0000;
}else{
	$batch = $_POST["batchyear"];
}

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = mt_rand();
$newid = sprintf("DON%X",$id);

$sql = "INSERT INTO donation values('$newid','$donor',$batch,'$amount',1,0,now());" ;

if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully";
    header("location: donation.php?sucess=1&a=".$amount."&b=".$batch."&d=".$donor);
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
	header("location: donation.php?batch_error=1&b=".$batch."");
}

$conn->close();
?>