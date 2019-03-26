<!DOCTYPE html>
<html lang="en">

<head>

    <?php 
    include('../conn.php');
    include('../session.php');
    ?>

    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="../image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Home
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-dashboard.css?v=1.2.0" rel="stylesheet" />
    <link href="../assets/css/now-ui-kit.css?v=1.2.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="orange">
            <div class="logo">
                <a href="#" class="simple-text logo-normal">
                    CPSU
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="active">
                        <a href="admin/">
                            <i class="now-ui-icons files_single-copy-04"></i>
                            <p>Document List</p>
                        </a>
                    </li>
                    <li><a href="https://docs.google.com/document/?usp=docs_alc&authuser=0" target="_blank">
                            <i class="now-ui-icons education_paper"></i>
                            <p>Create NEW (Google Doc)</p>
                        </a>
                    </li>
                    <li>
                        <a href="../members">
                            <i class="now-ui-icons users_single-02"></i>
                            <p>Members</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg fixed-top navbar-transparent  bg-primary  navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <button class="btn btn-info btn-round btn-lg" data-toggle="modal" data-target="#addFileModal" data-dismiss="modal">Add File</button>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <form>
                            <div class="input-group no-border">
                                <input type="text" value="" id="myInput" onkeyup="myFunction();" class="form-control" placeholder="Search...">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <i class="now-ui-icons ui-1_zoom-bold"></i>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="now-ui-icons location_world"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Some Actions</span>
                                    </p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="../logout.php">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="panel-header panel-header-sm">
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card card-plain">
                                <div class="card-header" role="tab" id="headingTwo">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="text-decoration: none; color: #000000">
                                        <div class="card-header">
                                            <h4 class="card-title"> Document List</h4>
                                            <!--<i class="now-ui-icons arrows-1_minimal-down"></i>-->
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="myTable">
                                        <?php 
                                        $sql = "SELECT * FROM files ORDER BY datetime DESC";
                                        $result = $conn->query($sql);
                                        $rowi = 1;

                                        if ($result->num_rows > 0) {
                                          // output data of each row

                                          echo '<thead class=" text-primary">
                                        <th onclick="sortTable(0)">
                                          ID
                                        </th>
                                        <th onclick="sortTable(1)">
                                          Name
                                        </th>
                                        <th onclick="sortTable(2)">
                                          File Type
                                        </th>
                                        <th onclick="sortTable(3)">
                                          Revision
                                        </th>
                                        <th onclick="sortTable(4)">
                                          Purpose
                                        </th>
                                        <th onclick="sortTable(5)">
                                          Uploaded
                                        </th>
                                        <th class="text-right" >
                                          Action
                                        </th>
                                      </thead>
                                      <tbody>';


                                          while ($row = $result->fetch_assoc()) {

                                            $actionbuttons = '
                                                <button type="button" onclick="getRowForUptade(' . $rowi . ')" rel="tooltip" class="btn btn-info btn-sm btn-round btn-icon" data-toggle="modal" title="Update" data-target="#updateModal" data-dismiss="modal">
                                                  <i class="now-ui-icons arrows-1_cloud-upload-94"></i>
                                                  </button>
                                                  <button type="button" onclick="getRowID(' . $rowi . ')" rel="tooltip" class="btn btn-danger btn-sm btn-round btn-icon" data-toggle="modal" title="Delete" data-target="#deleteModal" data-dismiss="modal">
                                                      <i class="now-ui-icons ui-1_simple-remove"></i>
                                                  </button>';


                                            echo "<tr>
                                          <td>
                                            " . $row['id'] . "
                                          </td>
                                          <td>
                                            " . $row['file_name'] . "
                                          </td>
                                          <td>
                                            " . $row['file_extension'] . "
                                          </td>
                                          <td>
                                            " . $row['file_rev'] . "
                                          </td>
                                          <td>
                                            " . $row['file_purpose'] . "
                                          </td>
                                          <td>
                                            " . $row['datetime'] . "
                                          </td>
                                          <td class='td-actions text-right'>
                                           		<a href='" . $row['file_path'] . "' download><button type='button' rel='tooltip' class='btn btn-success btn-sm btn-round btn-icon' title='Download' data-dismiss='modal'>
                                           			<i class='now-ui-icons arrows-1_cloud-download-93'></i>
                                                </button></a>
                                           		" . $actionbuttons . "
                                          </td>
                                        </tr>";
                                            $rowi++;
                                          }
                                        } else {
                                          echo "<option>No Results</option>";
                                        }

                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container">
                    <nav>
                        <ul>
                            <li>
                                <a href="#">
                                    CPSU
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright" id="copyright">
                        &copy;
                        <script>
                            document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                        </script>, Designed by
                        <a href="#" target="_blank">Xiari</a>. Coded by
                        <a href="#" target="_blank">Xiari</a>.
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/core/bootstrap-notify.js"></script>
    <script src="../assets/js/core/bootstrap-notify.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/js/angular.min.js"></script>
    <!--  Google Maps Plugin    
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  -->
    <!-- Chart JS -->
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="../assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/now-ui-dashboard.min.js?v=1.2.0" type="text/javascript"></script>
    <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
    <script src="../assets/demo/demo.js"></script>
    <!-- Add for converting number to amount -->
    <script src="../assets/js/js-webshim/minified/polyfiller.js"></script>
    <!--
<script src="assets/js/plugins/moment.min.js"></script>-->
    <!--  Plugin for Sweet Alert 
<script src="assets/js/plugins/sweetalert2.min.js"></script>-->
    <!-- Forms Validations Plugin 
<script src="assets/js/plugins/jquery.validate.min.js"></script>-->
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard
<script src="assets/js/plugins/jquery.bootstrap-wizard.js"></script>-->
    <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select 
<script src="assets/js/plugins/bootstrap-selectpicker.js" type="text/javascript"></script>-->
    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="../assets/js/plugins/bootstrap-switch.js"></script>
    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ 
<script src="assets/js/plugins/bootstrap-datetimepicker.js"></script>-->
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/   
<script src="assets/js/plugins/jquery.dataTables.min.js"></script> -->
    <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs 
<script src="assets/js/plugins/bootstrap-tagsinput.js"></script> -->
    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput 
<script src="assets/js/plugins/jasny-bootstrap.min.js"></script>-->
    <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    
<script src="assets/js/plugins/fullcalendar.min.js"></script>-->
    <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ 
<script src="assets/js/plugins/jquery-jvectormap.js"></script>-->
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="../assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
    <!--  Google Maps Plugin 
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
-->
    <!-- Chart JS -->
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="../assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/now-ui-dashboard.js?v=1.1.0" type="text/javascript"></script>
    <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
    <script src="../assets/js/demo.js"></script>
    <script src="../assets/js/now-ui-kit.js?v=1.2.0" type="text/javascript"></script>

</body>


<div class="modal fade bd-example-modal-lg" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="post" enctype="multipart/form-data" action="../update.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <label id="upfilename"></label><br>
                        <label id="upfilerevisionlbl"></label>
                    </div>
                    <!--<button class="btn btn-primary btn-round">Browse File</button>--><br>
                    <label for="exampleFormControlSelect1">File Name</label>
                    <div class="input-group">
                        <input class="form-control" type="file" name="upfilename" id="upfilename" onchange="" required>
                    </div>
                    <input type="hidden" name="upidno" id="upidno">
                    <div class="col-md-4 pull-right">
                        <label for="exampleFormControlSelect1">File Extension</label>
                        <div class="input-group">
                            <input type="text" class="form-control form-control-lg" id="upfileextension" name="upfileextension" required>
                        </div>
                    </div>
                    <div class="col-md-4 pull-right">
                        <label for="exampleFormControlSelect1">File Revision</label>
                        <div class="input-group">
                            <input type="text" class="form-control form-control-lg" id="upfilerevision" name="upfilerevision" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="exampleFormControlSelect1">File Purpose</label>
                        <div class="input-group">
                            <select class="form-control form-control" name="upfilepurpose" id="upfilepurpose" required>
                                <option value="">Select...</option>
                                <option value="Letter">Letter</option>
                                <option value="Form">Form</option>
                                <option value="Memo">Memo</option>
                            </select>
                            <!--<input type="text" class="form-control form-control-lg" id="" name="filepurpose" value="Accreditation" required>-->
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <input type="Submit" class="btn btn-primary" name="Submit" value="Submit">
                </div>
            </div>
        </form>
    </div>
</div>

<div id="deleteModal" class="modal fade modal-mini modal-danger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <div class="modal-profile">
                    <i class="now-ui-icons users_circle-08"></i>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" action="../delete.php">
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">Delete?<h4 id="docname"></h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="password" class="form-control" id="inputPassword" placeholder="Verify Password" name="password">
                        </div>
                        <div class="col-sm-12">
                            <input type="hidden" class="form-control" id="idno" name="idno">
                        </div>
                        <div class="col-sm-12">
                            <input type="hidden" class="form-control" id="" name="" value="">
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-link btn-neutral">Proceed</button>
                <button type="button" class="btn btn-link btn-neutral" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="addFileModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <form method="post" enctype="multipart/form-data" action="../upload.php" id="" name="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--<button class="btn btn-primary btn-round">Browse File</button>--><br>
                    <label for="exampleFormControlSelect1">File Name</label>
                    <div class="input-group">
                        <input class="form-control" type="file" name="filename" id="filename" onchange="" required>
                    </div>

                    <div class="col-md-4 pull-right">
                        <label for="exampleFormControlSelect1">File Extension</label>
                        <div class="input-group">
                            <input type="text" class="form-control form-control-lg" id="fileextension" name="fileextension" required>
                        </div>
                    </div>
                    <div class="col-md-4 pull-right">
                        <label for="exampleFormControlSelect1">File Revision</label>
                        <div class="input-group">
                            <input type="text" class="form-control form-control-lg" id="filerevision" name="filerevision" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="exampleFormControlSelect1">File Purpose</label>
                        <div class="input-group">
                            <select class="form-control form-control" name="filepurpose" required>
                                <option value="">Select...</option>
                                <option value="Letter">Letter</option>
                                <option value="Form">Form</option>
                                <option value="Memo">Memo</option>
                            </select>
                            <!--<input type="text" class="form-control form-control-lg" id="" name="filepurpose" value="Accreditation" required>-->
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="modal-footer">

                            <input type="Submit" class="btn btn-primary" name="Submit" value="Submit">
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>



<script>
    $('.modal').on('hidden.bs.modal', function() {
        $(this).find('form')[0].reset();
    });
</script>

<?php

if (isset($_GET['success']) && $_GET['success'] == 1) {
  echo "<script>
            $.notify({
            
            title: '<strong>Success</strong>',
            message: 'File Uploaded Successfully' 
            },{
            
            type: 'success'
            });
          </script> ";
}
if (isset($_GET['success']) && $_GET['success'] == 2) {
  echo "<script>
            $.notify({
            
            title: '<strong>File Deletion</strong>',
            message: 'File Successfully Deleted' 
            },{
            
            type: 'warning'
            });
          </script> ";
}
if (isset($_GET['error']) && $_GET['error'] == 2) {

  echo "<script>
            $.notify({
            
            title: 'ERROR',
            message: '<strong>File Already Exist</strong>' 
            },{
            
            type: 'danger',
            allow_dismiss: false

            });

          </script> ";
}
if (isset($_GET['error']) && $_GET['error'] == 3) {

  echo "<script>
            $.notify({
            
            title: 'File Too Large',
            message: '<strong>25MB Maximum Size</strong>' 
            },{
            
            type: 'danger',
            allow_dismiss: false

            });

          </script> ";
}
if (isset($_GET['error']) && $_GET['error'] == 4) {

  echo "<script>
            $.notify({
            
            title: 'File Not Supported',
            message: '<strong>Upload JPEG, JPG, DOC, DOCX, PDF Only</strong>' 
            },{
            
            type: 'danger',
            allow_dismiss: false

            });

          </script> ";
}
if (isset($_GET['error']) && $_GET['error'] == 5) {

  echo "<script>
            $.notify({
            
            title: 'Invalid Password',
            message: '<strong>Unable to Verify</strong>' 
            },{
            
            type: 'danger',
            allow_dismiss: false

            });

          </script> ";
}

?>

<script>
    function myFunction() {
        // Declare variables 
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td");

            if (td.length > 0) {
                //txtValue = td.textContent || td.innerText;
                if (td[0].innerHTML.toUpperCase().indexOf(filter) > -1 || td[1].innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

<script>
    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("myTable");
        switching = true;
        // Set the sorting direction to ascending:
        dir = "asc";
        /* Make a loop that will continue until
        no switching has been done: */
        while (switching) {
            // Start by saying: no switching is done:
            switching = false;
            rows = table.rows;
            /* Loop through all table rows (except the
            first, which contains table headers): */
            for (i = 1; i < (rows.length - 1); i++) {
                // Start by saying there should be no switching:
                shouldSwitch = false;
                /* Get the two elements you want to compare,
                one from current row and one from the next: */
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                /* Check if the two rows should switch place,
                based on the direction, asc or desc: */
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                /* If a switch has been marked, make the switch
                and mark that a switch has been done: */
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                // Each time a switch is done, increase this count by 1:
                switchcount++;
            } else {
                /* If no switching has been done AND the direction is "asc",
                set the direction to "desc" and run the while loop again. */
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
</script>

<script>
    function getRowID(r) {
        var id = document.getElementById("myTable").rows[r].cells.item(0).innerHTML;
        var doc = document.getElementById("myTable").rows[r].cells.item(1).innerHTML;
        /*var bch = document.getElementById("myTable").rows[r].cells.item(2).innerHTML;
        var amt = document.getElementById("myTable").rows[r].cells.item(3).innerHTML;
        document.getElementById("display_validate_no").innerHTML = "Invalidate "+reg+"?";
        document.getElementById("print_validate_no").innerHTML = "Control Number: "+reg;
        document.getElementById("print_donor").innerHTML = "Donor: "+dnr;
        document.getElementById("print_batch_no").innerHTML = "Batch: "+bch;
        document.getElementById("print_amount").innerHTML = "Amount "+amt;
        $("#display_validate_no_txt").val(reg);*/
        document.getElementById("docname").innerHTML = doc;
        $("#idno").val(id);

    }
</script>

<script>
    function getRowForUptade(r) {
        var fid = document.getElementById("myTable").rows[r].cells.item(0).innerHTML;
        var fname = document.getElementById("myTable").rows[r].cells.item(1).innerHTML;
        var fxtn = document.getElementById("myTable").rows[r].cells.item(2).innerHTML;
        var frev = document.getElementById("myTable").rows[r].cells.item(3).innerHTML;
        var fpor = document.getElementById("myTable").rows[r].cells.item(4).innerHTML;
        /*var bch = document.getElementById("myTable").rows[r].cells.item(2).innerHTML;
        var amt = document.getElementById("myTable").rows[r].cells.item(3).innerHTML;
        document.getElementById("display_validate_no").innerHTML = "Invalidate "+reg+"?";
        document.getElementById("print_validate_no").innerHTML = "Control Number: "+reg;
        document.getElementById("print_donor").innerHTML = "Donor: "+dnr;
        document.getElementById("print_batch_no").innerHTML = "Batch: "+bch;
        document.getElementById("print_amount").innerHTML = "Amount "+amt;
        $("#display_validate_no_txt").val(reg);*/
        //document.getElementById("docname").innerHTML = doc;
        $('#upfilename').text("File Name: " + fname);
        $("#upidno").val(fid);
        $('#upfilerevisionlbl').text("Revision: " + frev.replace(/\s/g, ""));
        $('#upfilerevision').val(parseInt(frev.replace(/\s/g, "")) + 1);
        $('#upfileextension').val(fxtn.replace(/\s/g, ""));
        $('#upfilepurpose').val(fpor.replace(/\s/g, ""));


    }
</script>

<script>
    document.getElementById('filename').onchange = function() {

        //var last = this.value.lastIndexOf(".");
        //var filepath = this.value;
        var fileextension = this.value.slice(this.value.lastIndexOf(".") + 1).toUpperCase();
        //alert('Selected file extension: ' + fileextension);
        document.getElementById("fileextension").value = fileextension;
        //document.getElementById("filepath").value = filepath;
        document.getElementById("filerevision").value = "1";
        //document.getElementById("filerevision").disabled = true;
        //document.getElementById("fileextension").disabled = true;

    };
</script>



</html> 