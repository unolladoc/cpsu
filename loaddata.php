<?php 
include('conn.php');

if(isset($_POST['cid'])) {
   // $sql = "SELECT * from offices where campus=" . $_POST['cid'];
   // $result = $conn->query($sql);
   $stmt = $conn->prepare("SELECT * from offices where campus=" . $_POST['cid']);
   $stmt->execute();
   $result = $stmt->get_result();
   $row = $result->fetch_assoc(MYSQLI_ASSOC);
   echo json_encode($row);

   
}

?>