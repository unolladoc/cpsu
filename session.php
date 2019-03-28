<?php
include('conn.php');
session_start();

$sql = "SELECT * FROM user WHERE id = '$username' and password = md5('$password');";

$result = mysqli_query($conn, $sql);

if (isset($_SESSION['id'])) {

  $id = $_SESSION['id'];
  $sql = "SELECT * FROM user WHERE id = '$id';";
  $result = mysqli_query($conn, $sql);

  if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();
    $_SESSION['type'] = $row['type'];
    
    if ($row['type'] == 0) {
      session_destroy();
      header("location: index.php?error");
      }
    }


} else {
  header("location: index.php?error");
}
 