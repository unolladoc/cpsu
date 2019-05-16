<?php 
include('conn.php');
header("Content-Type: application/json; charset=UTF-8");
//$obj = $_POST["campus"];

$tmpoutput = array();
$tmpoutput2 = array();
$output = array();

$conn = new mysqli($servername, $username, $password, $dbname);
$stmt = $conn->prepare("SELECT id, campus from campuses");
$stmt2 = $conn->prepare("SELECT offices.id, offices.office, campuses.campus from offices inner join campuses on offices.campus=campuses.id");
//$stmt->bind_param("s", $obj);
$stmt->execute();
$stmt->bind_result($id, $campus);

/* fetch values */
$tmp = array();
$tmp2 = array();

while ($stmt->fetch()) {
    $tmp["value"] = $id;
    $tmp["text"] = $campus;
    array_push($tmpoutput, $tmp);
}

$stmt2->execute();
$stmt2->bind_result($id2, $office2, $campus2);

while ($stmt2->fetch()) {
    $tmp2["value"] = $id2;
    $tmp2["text"] = $office2 . " (".$campus2.")";
    array_push($tmpoutput2, $tmp2);
}

$output = array_merge($tmpoutput,$tmpoutput2);
//$stmt-> bind_result($token);
//$result = $stmt->get_result();
//$outp = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($output);

?>