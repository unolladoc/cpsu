<?php
include('conn.php');

$rname = $_POST['caName'];
$rusername = $_POST['caUsername'];
$rpassword = $_POST['caPassword'];

$sql = "insert into user values(null,'$rusername',md5('$rpassword'),'$rname',0);";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {

    if ($conn->query($sql) === true) {
        //copy($filepath, $destinationpath);
        //echo "New record created successfully";
        header("location: index.php?register=1");
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
        //header("location: home.php?error=1");
        header("location: index.php?register=0");
    }
}
?> 