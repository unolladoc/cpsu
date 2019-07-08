<?php
include('../conn.php');
header("Content-Type: application/json; charset=UTF-8");
//$obj = $_POST["campus"];
$query =  $_POST["uid"];

$conn = new mysqli($servername, $username, $password, $dbname);

$output = array();
$tmp = array();
$tmp2 = array();

$sql = "SELECT id,file_name,destination FROM files WHERE finout = 0 AND archive = 0;";
$result = mysqli_query($conn, $sql);

$stmt = $conn->prepare("SELECT campus, office FROM user WHERE id = ?");
$stmt->bind_param("s", $query);


if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $rid = $row['id'];
        $filename = $row['file_name'];
        $destination = $row['destination'];

        $stmt->execute();
        $stmt->bind_result($campus, $office);

        while ($stmt->fetch()) {
            if (in_array(0, json_decode($destination)) || in_array($campus, json_decode($destination)) || in_array($office, json_decode($destination))) {
                $tmp["id"] = $rid;
                $tmp["filename"] = $filename;
                $tmp["status"] = "Downloaded";
                array_push($output, $tmp);      
            }
        }
    }
}
$stmt2 = $conn->prepare("SELECT id FROM files WHERE NOT EXISTS (Select id FROM logs WHERE logs.file_id = files.id AND logs.author = ?) AND finout = 0 AND archive = 0;");
$stmt2->bind_param("s", $query);
$stmt2->execute();
$stmt2->bind_result($id2);

while ($stmt2->fetch()) {
    $key = array_search($id2, array_column($output, 'id'));
    if ($key !== false) {
        // $status = "Received";
        // $tmp2["key"] = $key;
        // $tmp2["status"] = $status;
        // array_push($tmpoutput, $tmp2);
        $output[$key]['status'] = "Received";
    }
}
echo json_encode($output);
?>