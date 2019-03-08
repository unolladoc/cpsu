<?php
include('conn.php');

session_start();

$id = preg_replace('/\s/', '', $_POST['invalidated_id']);
$pass = mysqli_real_escape_string($conn,$_POST['verifyPassword']);
$url = $_POST['from'];
$username = $_SESSION['username'];

//echo $regid;
//echo $pass;
$sql = "SELECT * FROM user WHERE username = '$username' and password = md5('$pass');";
$result = mysqli_query($conn,$sql);

if($result->num_rows > 0){

//echo "success";
$pre = substr($id, 0, 3);

	if($pre == 'REG'){
		
		$sql2 = "UPDATE registration SET valid=0, invalidity=now() WHERE  id='".$id."';";

			if ($conn->query($sql2) === TRUE){
				//echo $sql2;
				header("location: registration.php?invalidatesuccess=1");
			}else{

				header("location: registration.php?invalidid=1");
			}

	}if($pre == 'DON'){
		$sql2 = "UPDATE donation SET valid=0, invalidity=now() WHERE  id='".$id."';";
		
		if ($conn->query($sql2) === TRUE){
			//echo $sql2;
			header("location: donation.php?invalidatesuccess=1");
		}else{

			header("location: donation.php?invalidid=1");
		}

	}if($pre == 'EXP'){
		$sql2 = "UPDATE expenses SET valid=0, invalidity=now() WHERE  id='".$id."';";
		
		if ($conn->query($sql2) === TRUE){
			//echo $sql2;
			header("location: expenses.php?invalidatesuccess=1");
		}else{

			header("location: expenses.php?invalidid=1");
		}

	}if($pre == 'OTH'){
		$sql2 = "UPDATE otherincome SET valid=0, invalidity=now() WHERE  id='".$id."';";
		
		if ($conn->query($sql2) === TRUE){
			//echo $sql2;
			header("location: otherincome.php?invalidatesuccess=1");
		}else{

			header("location: otherincome.php?invalidid=1");
		}

	}

}
else{
		header("location: ".$url."?invalidpassword=1");
	}
	

//$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

?>