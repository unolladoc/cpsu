<?php 
include('conn.php');
header("Content-Type: application/json; charset=UTF-8");

$obj = $_POST["campus"];

// $conn = new mysqli("myServer", "myUser", "myPassword", "Northwind");
$conn = new mysqli($servername, $username, $password, $dbname);
$stmt = $conn->prepare("SELECT * from offices where campus = ?");
$stmt->bind_param("s", $obj);
$stmt->execute();
$result = $stmt->get_result();
$outp = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($outp);
//$obj = "test";
//echo json_encode($obj);
?>