<?php 
include('conn.php');
header("Content-Type: application/json; charset=UTF-8");
$obj = $_POST["campus"];

$output = array();

$conn = new mysqli($servername, $username, $password, $dbname);
$stmt = $conn->prepare("SELECT id, office from offices where campus = ? order by office asc");
$stmt->bind_param("s", $obj);
$stmt->execute();
$stmt->bind_result($id, $office);
/* fetch values */
$tmp = array();

while ($stmt->fetch()) {
    $tmp["id"] = $id;
    $tmp["office"] = $office;
    array_push($output, $tmp);
}

//$stmt-> bind_result($token);
//$result = $stmt->get_result();
//$outp = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($output);

?>