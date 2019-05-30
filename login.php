<?php
include('conn.php');
session_start();

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$sql = "SELECT * FROM user WHERE username = '$username' and password = md5('$password');";

$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {

	$row = $result->fetch_assoc();

	$sql2 = "SELECT campus FROM campuses where id = " . $row['campus'];
	$result2 = $conn->query($sql2);
	$rcampus = "-";
	if ($result2->num_rows > 0) {
		$row2 = $result2->fetch_assoc();
		$rcampus = $row2['campus'];
	}
	$sql3 = "SELECT office FROM offices where id = " . $row['office'];
	$result3 = $conn->query($sql3);
	$roffice = "-";
	if ($result3->num_rows > 0) {
		$row3 = $result3->fetch_assoc();
		$roffice = $row3['office'];
	}

	if ($row['type'] != 0) {
		if ($row['type'] == 1) {
			$_SESSION['id'] = $row['id'];
			$_SESSION['name'] = $row['name'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['type'] = $row['type'];
			$_SESSION['campus'] = $rcampus;
			$_SESSION['office'] = $roffice;
			$_SESSION['campusid'] = $row['campus'];
			$_SESSION['officeid'] = $row['office'];
			header("location: admin/");
		} else if ($row['type'] == 2) {
			$_SESSION['id'] = $row['id'];
			$_SESSION['name'] = $row['name'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['type'] = $row['type'];
			$_SESSION['campus'] = $rcampus;
			$_SESSION['office'] = $roffice;
			$_SESSION['campusid'] = $row['campus'];
			$_SESSION['officeid'] = $row['office'];
			header("location: member/");
		}

		$sqll = "Insert into logs values(null, '".$_SESSION['name']." logged in',CAST('$datenow' as datetime), ".$_SESSION['id'].", 'LOGIN','');";
		if ($conn->query($sqll) === TRUE) {} else{echo "Error: " . $sqll . "<br>" . $conn->error;}

	} else {
		header("location: index.php?error");
	}
} else {
	$sqll = "Insert into logs values(null, '".$username." attempted to log in',CAST('$datenow' as datetime), 0, 'ATTEMPT LOGIN','');";
	if ($conn->query($sqll) === TRUE) {}else{echo "Error: " . $sqll . "<br>" . $conn->error;}
	header("location: index.php?invalid=true");
}

?>
