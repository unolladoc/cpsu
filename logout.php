<?php
include('session.php');

$sqll = "Insert into logs values(null, '".$_SESSION['name']." logged out',CAST('$datenow' as datetime));";
if ($conn->query($sqll) === TRUE) {}else{echo "Error: " . $sqll . "<br>" . $conn->error;}

session_destroy();
header("Location: index.php");

?>