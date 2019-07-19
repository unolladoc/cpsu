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

    //    if ($_POST['Submit']) {
    //$filename = $_POST['filename'];
    //$filepath = realpath($_POST['filename']);
    include('../conn.php');

    // $id = mt_rand();
    // $newid = sprintf("CPSU%X", $id);

    $fileextension = $_POST['fileextension'];
    $filepurpose = $_POST['filepurpose'];
    $filerevision = $_POST['filerevision'];
    $filedescription = $_POST['filedesc'];
    $fileuploader = $_SESSION['id'];
    $fileorigin = $_SESSION['officeid'];
    $newid = $_POST['controlnumber'];

    //$dean = "1011,1012,1013,1014,1015,1016,1017,1018,1019";
    //$campusdirectors = "2000,3000,4000,5000,6000,7000,8000,9000,10000";
    //$customcampus = 0;

    if (isset($_POST['allcampus'])) {
        if (count($_POST['allcampus']) == 10) {
            $customcampus = explode(",", 0);
            $tomail = 0;
        }else{
            $customcampus = explode(",", implode(",",$_POST['allcampus']));
            $tomail = 0;
        }
    } else {
        $tmpcustomcampus = $_POST['customcampus'];
        //vp
        if (isset($_POST['vp'])) {
            if ($tmpcustomcampus != "") {
                $tmpcustomcampus .= "," . implode(",", $_POST['vp']);
            } else {
                $tmpcustomcampus .= implode(",", $_POST['vp']);
            }
        }
        //director
        if (isset($_POST['director'])) {
            if ($tmpcustomcampus != "") {
                $tmpcustomcampus .= "," . implode(",", $_POST['director']);
            } else {
                $tmpcustomcampus .= implode(",", $_POST['director']);
            }
        }//registrar
        if (isset($_POST['registrar'])) {
            if ($tmpcustomcampus != "") {
                $tmpcustomcampus .= "," . implode(",", $_POST['registrar']);
            } else {
                $tmpcustomcampus .= implode(",", $_POST['registrar']);
            }
        }
        //accounting
        if (isset($_POST['accounting'])) {
            if ($tmpcustomcampus != "") {
                $tmpcustomcampus .= "," . implode(",", $_POST['accounting']);
            } else {
                $tmpcustomcampus .= implode(",", $_POST['accounting']);
            }
        }
        //cashier
        if (isset($_POST['cashier'])) {
            if ($tmpcustomcampus != "") {
                $tmpcustomcampus .= "," . implode(",", $_POST['cashier']);
            } else {
                $tmpcustomcampus .= implode(",", $_POST['cashier']);
            }
        }
        //library
        if (isset($_POST['library'])) {
            if ($tmpcustomcampus != "") {
                $tmpcustomcampus .= "," . implode(",", $_POST['library']);
            } else {
                $tmpcustomcampus .= implode(",", $_POST['library']);
            }
        }
        //deans
        if (isset($_POST['deans'])) {
            if ($tmpcustomcampus != "") {
                $tmpcustomcampus .= "," . implode(",", $_POST['deans']);
            } else {
                $tmpcustomcampus .= implode(",", $_POST['deans']);
            }
        }
        //campusdirectors
        if (isset($_POST['campusdirectors'])) {
            if ($tmpcustomcampus != "") {
                $tmpcustomcampus .= "," . implode(",", $_POST['campusdirectors']);
            } else {
                $tmpcustomcampus .= implode(",", $_POST['campusdirectors']);
            }
        }
        $tmpcustomcampus_expl = explode(",",$tmpcustomcampus);
        $tmpcustomcampus_unq = array_unique($tmpcustomcampus_expl);
        $customcampus = explode(",", implode(",",$tmpcustomcampus_unq));
        $tomail = implode(",",$tmpcustomcampus_unq);
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
        echo "index.php?error=2";
        //header("location: index.php?error=2");
        $uploadOk = 0;
    } else if ($_FILES["filename"]["size"] > 25000000) {
        //echo "Sorry, your file is too large.";
        echo "index.php?error=3";
        //header("location: index.php?error=3");
        $uploadOk = 0;
    } else if ($imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "pdf" && $imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "rar" && $imageFileType != "zip") {
        //echo "Sorry, only doc, docx, pdf";
        echo "index.php?error=4";
        //header("location: index.php?error=4");
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file_new)) {

            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "INSERT INTO files values('$newid','$target_path_new','$newbasename_filename_name','$filedescription','$fileextension','$filepurpose','$filerevision',$fileuploader,'$fileorigin','$filedestination',0,CAST('$datenow' as datetime),0,0,'');";

            $mailnotif = "";
            if ($tomail != 0) {
                $sqlm = "SELECT username, office, campus from user where office IN (" . $tomail . ") OR campus IN (" . $tomail . ") AND type != 0;";
                $resultm = $conn->query($sqlm);
                if ($resultm->num_rows > 0) {
                    while ($rowm = $resultm->fetch_assoc()) {
                        $to = $rowm['username'];
                        $subject = "NEW " . $filepurpose;
                        $txt = "New File Uploaded: " . $newbasename_filename_name . "<br><br>Description: " . $filedescription . "<br><br>To download please LOGIN at cpsu.cf";
                        $headers = "From: " . $email . "\r\n";
                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        //mail($to, $subject, $txt, $headers);
                        // echo $to . "<br><br>" .
                        // $subject . "<br><br>" .
                        // $txt . "<br><br>" .
                        // $headers . "<br><br>" 
                        // ;
                        $retval = mail($to, $subject, $txt, $headers);
                        if ($retval == true) {
                            //echo 'Sucess';
                            $mailnotif = "&mail=1";
                        } else {
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
                        $subject = "NEW " . $filepurpose;
                        $txt = "New File Uploaded: " . $newbasename_filename_name . "<br><br>Description: " . $filedescription . "<br><br>To download please LOGIN at cpsu.cf";
                        $headers = "From: " . $email . " \r\n";
                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        //($to, $subject, $txt, $headers);
                        $retval = mail($to, $subject, $txt, $headers);
                        if ($retval == true) {
                            //echo 'Sucess';
                            $mailnotif = "&mail=1";
                        } else {
                            //echo 'Error';
                            $mailnotif = "&mail=0";
                        }
                    }
                }
            }
            if ($conn->query($sql) === TRUE) {
                //copy($filepath, $destinationpath);
                //echo "New record created successfully";
                //header("location: index.php?success=1" . $mailnotif);
                $sqll = "Insert into logs values(null, '" . $_SESSION['name'] . " uploaded " . $newbasename_filename_name . "',CAST('$datenow' as datetime), " . $_SESSION['id'] . ", 'UPLOAD','$newid');";
                if ($conn->query($sqll) === TRUE) { } else {
                    //echo "Error: " . $sqll . "<br>" . $conn->error;
                    echo 'index.php?logerror';
                }
                echo 'index.php?success=1' . $mailnotif;
                //echo '<script>window.location.href="index.php?success=1'.$mailnotif.'";</script>';
            } else {
                echo 'index.php?upload=ok&sql=error';
                //echo "Error: " . $sql . "<br>" . $conn->error;
                //header("location: home.php?error=1");
            }
            //echo "The file ". basename( $_FILES["filename"]["name"]). " has been uploaded.<br>";
            //echo $sql;
            //echo $tomail;

        } else {
            echo 'index.php?error=0';
            //echo "Sorry, there was an error uploading your file.";
        }
    }

    //    }
}

$conn->close();
