<?php
include('../conn.php');
session_start();

if (file_exists("../files/")) {
    //echo "The file $filename exists";
    fileUpdload();
} else {
    //echo "The file $filename does not exist";   
    $result = mkdir("../files/", "0777");
    fileUpdload();
}

function fileUpdload()
{

    if ($_POST['Submit']) {
        //$filename = $_POST['filename'];
        //$filepath = realpath($_POST['filename']);
        include('../conn.php');

        $fileextension = $_POST['fileextension'];
        $filepurpose = $_POST['filepurpose'];
        $filerevision = $_POST['filerevision'];
        $filedescription = $_POST['filedesc'];
        $fileuploader = $_SESSION['id'];
        $fileorigin = $_SESSION['officeid'];

        if (isset($_POST['allcampus'])) {
            $customcampus = explode(",", "0");
            $tomail = 0;
        } else {
            $customcampus = explode(",", $_POST['customcampus']);
            $tomail = $_POST['customcampus'];
        }
        $filedestination = json_encode($customcampus);

        //$filedestination = "";

        $temp_name = basename($_FILES["filename"]["name"], "." . strtolower($fileextension));
        $basename_filename_name = preg_replace('/\s+/', '_', $temp_name);
        //$basename_filename_name = basename($_FILES["filename"]["name"],"." . strtolower($fileextension));
        $newbasename_filename_name = $basename_filename_name . "_REVISION_" . $filerevision . "." . strtolower($fileextension);

        $target_dir = "../files/";
        $target_path = "files/";
        $target_file = $target_dir . basename($_FILES["filename"]["name"]);
        $target_file_new = $target_dir . $newbasename_filename_name;
        $target_path_new = $target_path  . $newbasename_filename_name;
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        if (file_exists($target_file_new)) {
            //echo "Sorry, file already exists.";
            header("location: index.php?error=2");
            $uploadOk = 0;
        } else if ($_FILES["filename"]["size"] > 25000000) {
            //echo "Sorry, your file is too large.";
            header("location: index.php?error=3");
            $uploadOk = 0;
        } else if ($imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "pdf" && $imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "rar" && $imageFileType != "zip") {
            //echo "Sorry, only doc, docx, pdf";
            header("location: index.php?error=4");
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file_new)) {

                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $id = mt_rand();
                $newid = sprintf("CPSU%X", $id);

                $sql = "INSERT INTO files values('$newid','$target_path_new','$newbasename_filename_name','$filedescription','$fileextension','$filepurpose','$filerevision',$fileuploader,'$fileorigin','$filedestination',0,CAST('$datenow' as datetime),0,0,'');";

                $mailnotif = "";
                if ($tomail != 0) {
                    $sqlm = "SELECT username, office, campus from user where office IN (" . $tomail . ") OR campus IN (" . $tomail . ") AND type != 0;";
                    $resultm = $conn->query($sqlm);
                    if ($resultm->num_rows > 0) {
                        while ($rowm = $resultm->fetch_assoc()) {
                            $to = $rowm['username'];
                            $subject = "NEW ".$filepurpose;
                            $txt = "New File Uploaded: ". $newbasename_filename_name ."<br><br>Description: ". $filedescription ."<br><br>To download please LOGIN at cpsu.cf";
                            $headers = "From: " . $email . "\r\n";
                            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                            //mail($to, $subject, $txt, $headers);
                            // echo $to . "<br><br>" .
                            // $subject . "<br><br>" .
                            // $txt . "<br><br>" .
                            // $headers . "<br><br>" 
                            // ;
                            $retval = mail($to,$subject,$txt,$headers);     
                                    if( $retval == true ) {
                                        //echo 'Sucess';
                                        $mailnotif = "&mail=1";
                                    }else {
                                        //echo 'Error';
                                        $mailnotif = "&mail=0";
                                    }
                        }
                    }
                } else {
                    $sqlm = "SELECT username, office, campus from user where type != 0;";
                    $resultm = $conn->query($sqlm);
                    if ($resultm->num_rows > 0) {
                        while ($rowm = $resultm->fetch_assoc()) {
                            $to = $rowm['username'];
                            $subject = "NEW ".$filepurpose;
                            $txt = "New File Uploaded: ". $newbasename_filename_name ."<br><br>Description: ". $filedescription ."<br><br>To download please LOGIN at cpsu.cf";
                            $headers = "From: " . $email . " \r\n";
                            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                            //($to, $subject, $txt, $headers);
                            $retval = mail($to,$subject,$txt,$headers);     
                                    if( $retval == true ) {
                                        //echo 'Sucess';
                                        $mailnotif = "&mail=1";
                                    }else {
                                        //echo 'Error';
                                        $mailnotif = "&mail=0";
                                    }
                        }
                    }
                }
                if ($conn->query($sql) === TRUE) {
                    //copy($filepath, $destinationpath);
                    //echo "New record created successfully";
                    header("location: index.php?success=1" . $mailnotif);
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    //header("location: home.php?error=1");
                }
                //echo "The file ". basename( $_FILES["filename"]["name"]). " has been uploaded.<br>";
                //echo $sql;

            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        $sqll = "Insert into logs values(null, '" . $_SESSION['name'] . " uploaded " . $newbasename_filename_name . "',CAST('$datenow' as datetime), " . $_SESSION['id'] . ", 'UPLOAD','$newid');";
        if ($conn->query($sqll) === TRUE) { } else {
            echo "Error: " . $sqll . "<br>" . $conn->error;
        }
    }
}

$conn->close();
