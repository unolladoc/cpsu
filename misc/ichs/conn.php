<?php

$servername = "43.255.154.26";
$username = "ichsalumni2018";
$password = "ichsalumni2018";
$dbname = "ichsalumni";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>