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

if($_POST['Submit'])
    {
        //$filename = $_POST['filename'];
        //$filepath = realpath($_POST['filename']);
        include('../conn.php');

        $fileid = $_POST['upidno'];
        $fileextension = $_POST['upfileextension'];
        $filepurpose = $_POST['upfilepurpose'];
        $filerevision = $_POST['upfilerevision'];
        $filedescription = $_POST['upfiledesc'];
        $fileuploader = $_SESSION['name'];
        $fileorigin = $_SESSION['campus'] . " Campus (" . $_SESSION['office'] . ")";

        if($_POST['upfiledestval'] !=0 ){
            $customcampus = explode(",",$_POST['upfiledestval']); 
        }else{
            $customcampus = explode(",","0");
        }
        $filedestination = json_encode($customcampus);

        //$filedestination = "";

        $temp_name = basename($_FILES["upfilename"]["name"],"." . strtolower($fileextension));
        $basename_filename_name = preg_replace('/\s+/', '_', $temp_name);
        //$basename_filename_name = basename($_FILES["upfilename"]["name"],"." . strtolower($fileextension));
        $newbasename_filename_name = $basename_filename_name . "_REVISION_" . $filerevision . "." . strtolower($fileextension);

        $target_dir = "../files/";
        $target_path = "files/";
        $target_file = $target_dir . basename($_FILES["upfilename"]["name"]);
        $target_file_new = $target_dir . $newbasename_filename_name;
        $target_path_new = $target_path  . $newbasename_filename_name;
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        if (file_exists($target_file_new)) 
            {
                //echo "Sorry, file already exists.";
                header("location: index.php?error=2");
                $uploadOk = 0;
            }
        else if ($_FILES["upfilename"]["size"] > 25000000)
            {
                //echo "Sorry, your file is too large.";
                header("location: index.php?error=3");
                $uploadOk = 0;
            }
        else if($imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "pdf" && $imageFileType != "jpg" && $imageFileType != "jpeg") 
            {
                //echo "Sorry, only doc, docx, pdf";
                header("location: index.php?error=4");
                $uploadOk = 0;
            }
        
        if ($uploadOk == 1) 
            {
                if (move_uploaded_file($_FILES["upfilename"]["tmp_name"], $target_file_new)) 
                    {
                        
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $id = mt_rand();
                        $newid = sprintf("CPSU%X",$id);

                        $sql = "INSERT INTO files values('$newid','$target_path_new','$newbasename_filename_name','$filedescription','$fileextension','$filepurpose','$filerevision','$fileuploader','$fileorigin','$filedestination',CAST('$datenow' as datetime),0,0,'$fileid');" ;

                        if ($conn->query($sql) === TRUE) {
                            //copy($filepath, $destinationpath);
                            //echo "New record created successfully";
                            $sql2 = "UPDATE files SET archive = '1' WHERE id='$fileid'";
                            if ($conn->query($sql2) === TRUE) {
                                header("location: index.php?success=10");
                            }else {
                                echo "Error: " . $sql2 . "<br>" . $conn->error;
                            }
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                            //header("location: admin/index.php?error=1");
                        }
                        //echo "The file ". basename( $_FILES["filename"]["name"]). " has been uploaded.<br>";
                        //echo $sql;

                } 
                else 
                    {
                        echo "Sorry, there was an error uploading your file.";
                    }
            }
        $sqll = "Insert into logs values(null, '".$_SESSION['name']." uploaded ".$newbasename_filename_name."',CAST('$datenow' as datetime));";
        if ($conn->query($sqll) === TRUE) {}else{echo "Error: " . $sqll . "<br>" . $conn->error;}
    }
}

$conn->close();
?>