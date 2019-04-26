<?php 
include('../conn.php');

header("Content-Type: application/json; charset=UTF-8");
$obj = $_POST["fid"];

$output = array();

//$conn = new mysqli("myServer", "myUser", "myPassword", "Northwind");
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT * FROM files WHERE id = '$obj'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $file_name = $row['file_name'];
}

$stmt2 = $conn->prepare("SELECT * FROM logs WHERE description LIKE '%DOWNLOADED%' AND description LIKE '%$file_name%' ORDER BY time DESC;");
$stmt2->execute();
$stmt2->bind_result($id, $description, $time);
$tmp = array();

while ($stmt2->fetch()) {
    $tmp["id"] = $id;
    $tmp["description"] = $description;
    $tmp["time"] = $time;
    array_push($output, $tmp);
}

// $result2 = $stmt2->get_result();
// $outp2 = $result2->fetch_all(MYSQLI_ASSOC);

echo json_encode($output);
?>