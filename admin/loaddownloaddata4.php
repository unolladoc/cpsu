<?php
include('../conn.php');

header("Content-Type: application/json; charset=UTF-8");
$obj = $_POST["uid"];

$output = array();
$tmpoutput = array();
$tmp2output = array();
$tmp = array();
$tmp2 = array();

$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT * FROM user WHERE id = '$obj'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $campus = $row['campus'];
    $office = $row['office'];
}

$stmt = $conn->prepare("SELECT id,file_name,destination FROM files WHERE finout = 0 AND archive = 0;");

$stmt2 = $conn->prepare("SELECT id FROM files WHERE NOT EXISTS (Select * FROM logs WHERE logs.file_id = files.id AND logs.author = ?) AND finout = 0 AND archive = 0;");
$stmt2->bind_param("s", $obj);

$stmt->execute();
$stmt->bind_result($id, $filename, $destination);

while ($stmt->fetch()) {
    if (in_array(0, json_decode($destination)) || in_array($campus, json_decode($destination)) || in_array($office, json_decode($destination))) {
        $tmp["id"] = $id;
        $tmp["filename"] = $filename;
        $tmp["status"] = "Downloaded";
        array_push($tmpoutput, $tmp);
    }
}

$stmt2->execute();
$stmt2->bind_result($id2);
$status = "Downloaded";

while ($stmt2->fetch()) {
    $key = array_search($id2, array_column($tmpoutput, 'id'));
    if ($key !== false) {
        // $status = "Received";
        // $tmp2["key"] = $key;
        // $tmp2["status"] = $status;
        // array_push($tmp2output, $tmp2);
        $tmpoutput[$key]['status'] = "Received";
    }
}
$output = array_merge($tmpoutput, $tmp2output);

echo json_encode($output);
