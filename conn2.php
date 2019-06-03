<?php

$servername = "43.255.154.8";
$username = "cpsuadmin";
$password = "cpsuadmin2019";
$dbname = "cpsu";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//date_default_timezone_set('America/Los_Angeles');
date_default_timezone_set('Asia/Manila');
$datenow = date('Y-m-d H:i:s');
//echo $now;
$email = "no-reply@cpsu.cf";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>