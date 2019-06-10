<?php
include('../conn.php');
session_start();

if (file_exists("../files/")) {
    //echo "The file $filename exists";
    fileUpdload();
} else {
    //echo "The file $filename does not exist";   
    $result = mkdir ("../files/", "0777");
    fileUpdload();
}

function fileUpdload(){

// if($_POST['Submit'])
//     {
        //$filename = $_POST['filename'];
        //$filepath = realpath($_POST['filename']);
        include('../conn.php');

        $id = mt_rand();
        $newid = sprintf("REQ%X",$id);

        $fileextension = $_POST['fileextension'];
        $filepurpose = $_POST['filepurpose'];
        $filerevision = $_POST['filerevision'];
        $filedescription = $_POST['filedesc'];
        $fileuploader = $_SESSION['id'];
        $fileorigin =  $_SESSION['officeid'];

        // if(isset($_POST['allcampus'])){
        //     $customcampus = explode(",","0");
        // }else{
        //     $customcampus = explode(",",$_POST['customcampus']);
        // }
        
        $customcampus = explode(",","1000,1100");
        $filedestination = json_encode($customcampus);

        //$filedestination = "";
        
        $temp_name = basename($_FILES["filename"]["name"],"." . strtolower($fileextension));
        $basename_filename_name = preg_replace('/\s+/', '_', $temp_name);
        //$basename_filename_name = basename($_FILES["filename"]["name"],"." . strtolower($fileextension));
        $newbasename_filename_name = $basename_filename_name . "_INCOMING_" . $filerevision . "." . strtolower($fileextension);

        $target_dir = "../files/";
        $target_path = "files/";
        $target_file = $target_dir . basename($_FILES["filename"]["name"]);
        $target_file_new = $target_dir . $newbasename_filename_name;
        $target_path_new = $target_path  . $newbasename_filename_name;
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        if (file_exists($target_file_new)) 
            {
                //echo "Sorry, file already exists.";
                echo "request.php?error=2";
                // header("location: request.php?error=2");
                $uploadOk = 0;
            }
        else if ($_FILES["filename"]["size"] > 25000000)
            {
                //echo "Sorry, your file is too large.";
                echo "request.php?error=3";
                // header("location: request.php?error=3");
                $uploadOk = 0;
            }
        else if($imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "pdf" && $imageFileType != "jpg" && $imageFileType != "jpeg") 
            {
                //echo "Sorry, only doc, docx, pdf";
                echo "request.php?error=4";
                // header("location: request.php?error=4");
                $uploadOk = 0;
            }
        
        if ($uploadOk == 1) 
            {
                if (move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file_new)) 
                    {
                        
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "INSERT INTO files values('$newid','$target_path_new','$newbasename_filename_name','$filedescription','$fileextension','$filepurpose','$filerevision',$fileuploader,'$fileorigin','$filedestination',1,CAST('$datenow' as datetime),0,0,'');" ;

                        if ($conn->query($sql) === TRUE) {
                            //copy($filepath, $destinationpath);
                            //echo "New record created successfully";
                            echo "request.php?success=1";
                            // header("location: request.php?success=1");
                        } else {
                            echo "request.php?upload=ok&sql=error";
                            //header("location: home.php?error=1");
                        }
                        //echo "The file ". basename( $_FILES["filename"]["name"]). " has been uploaded.<br>";
                        //echo $sql;

                } 
                else 
                    {
                        echo 'index.php?error=0';
                        // echo "Sorry, there was an error uploading your file.";
                    }
            }
        $sqll = "Insert into logs values(null, '".$_SESSION['name']." request a file ".$newbasename_filename_name."',CAST('$datenow' as datetime), ".$_SESSION['id'].", 'REQUEST','$newid');";
        if ($conn->query($sqll) === TRUE) {}else{
            //echo "Error: " . $sqll . "<br>" . $conn->error;
            echo 'index.php?logerror';
        }
    //}
}

$conn->close();
?>