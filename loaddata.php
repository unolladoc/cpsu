<?php 
include('conn.php');

header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_POST["x"], false);

//$conn = new mysqli("myServer", "myUser", "myPassword", "Northwind");
$conn = new mysqli($servername, $username, $password, $dbname);
$stmt = $conn->prepare("SELECT * from offices where campus = ?");
$stmt->bind_param("s", $obj->campus);
$stmt->execute();
$result = $stmt->get_result();
$outp = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($outp);

// if(isset($_POST['cid'])) {
//    // $sql = "SELECT * from offices where campus=" . $_POST['cid'];
//    // $result = $conn->query($sql);
//    $stmt = $conn->prepare("SELECT * from offices where campus=" . $_POST['cid']);
//    $stmt->execute();
//    $result = $stmt->get_result();
//    $row = $result->fetch_assoc();
//    echo json_encode($row);  
// }

?>