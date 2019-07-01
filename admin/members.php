<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include('../conn.php');
    include('../session.php');

    if ($_SESSION['type'] != 1) {
        session_destroy();
        header('Location: ../index.php?error');
    }

    ?>

    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="../image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Members - <?php echo $_SESSION['name']; ?>
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-dashboard.css?v=1.2.0" rel="stylesheet" />
    <link href="../assets/css/now-ui-kit.css?v=1.2.0" rel="stylesheet" />
    <link href="../assets/css/jquery.floatingscroll.css" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="green">
            <div class="logo">
                <a href="#" class="simple-text logo-normal">
                    CPSU
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li>
                        <a href="index.php">
                            <i class="now-ui-icons files_single-copy-04"></i>
                            <?php
                            $sqld = "SELECT * FROM files WHERE NOT EXISTS (Select * FROM logs WHERE logs.file_id = files.id AND logs.author = " . $_SESSION['id'] . ")AND finout = 1 AND archive = 0 AND uploader !=  " . $_SESSION['id'] . ";";
                            $resultd = $conn->query($sqld);
                            $n = 0;
                            $noticount = "";
                            if ($resultd->num_rows > 0) {
                                while ($rowd = $resultd->fetch_assoc()) {
                                    $n++;
                                }
                                if ($n == 0) {
                                    $noticount = "";
                                } else {
                                    $noticount = "<strong>(" . $n . ")</strong>";
                                }
                            }
                            ?>
                            <p>Document List <?php echo $noticount ?></p>
                        </a>
                    </li>
                    <li>
                        <a href="archive.php">
                            <i class="now-ui-icons files_box"></i>
                            <p>Archive</p>
                        </a>
                    </li>
                    <li><a href="https://docs.google.com/document/d/18eO2R4hblMhazMgkIquMcJWPfnz6GVJ1/edit" target="_blank">
                            <i class="now-ui-icons education_paper"></i>
                            <p>Create NEW (Google Doc)</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#">
                            <i class="now-ui-icons users_single-02"></i>
                            <?php
                            $sqld = "SELECT COUNT(type) as total_unuser from user where type = 0;";
                            $resultd = $conn->query($sqld);
                            $total_unuser = "";
                            if ($resultd->num_rows > 0) {
                                $rowd = $resultd->fetch_assoc();
                                if ($rowd['total_unuser'] == 0) {
                                    $total_unuser = "";
                                } else {
                                    $total_unuser = "<strong>(" . $rowd['total_unuser'] . ")</strong>";
                                }
                            }
                            ?>
                            <p>Members <?php echo $total_unuser ?></p>
                        </a>
                    </li>
                    <li>
                        <a href="logs.php">
                            <i class="now-ui-icons files_paper"></i>
                            <p>Logs</p>
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

                                    <div class="card-header">
                                        <h4 class="card-title"> Member List</h4>
                                        <!--<i class="now-ui-icons arrows-1_minimal-down"></i>-->
                                    </div>

                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="myTable">
                                        <?php
                                        $sql = "SELECT * FROM user ORDER BY type ASC;";
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
                                          Campus
                                        </th>
                                        <th onclick="sortTable(3)">
                                          Office
                                        </th>
                                        <th onclick="sortTable(4)">
                                          Access
                                        </th>
                                        <th class="text-right" >
                                          Action
                                        </th>
                                      </thead>
                                      <tbody>';


                                            while ($row = $result->fetch_assoc()) {
                                                $style_bg = "";
                                                if ($row['type'] == 0) {
                                                    $access = "UNVERIFIED";
                                                    $actionbuttons = '
                                                  <button type="button" onclick="getRowID(' . $rowi . ')" rel="tooltip" class="btn btn-success btn-sm btn-round btn-icon" data-toggle="modal" title="Approve" data-target="#approveModal" data-dismiss="modal">
                                                      <i class="now-ui-icons ui-1_check"></i>
                                                  </button>
                                                  <button type="button" onclick="getRowID(' . $rowi . ')" rel="tooltip" class="btn btn-danger btn-sm btn-round btn-icon" data-toggle="modal" title="Remove User" data-target="#deleteModal" data-dismiss="modal">
                                                      <i class="now-ui-icons ui-1_simple-remove"></i>
                                                  </button>';
                                                    $style_bg = "style=background-color:lightgreen;";
                                                } else if ($row['type'] == 1) {
                                                    $access = "Admin";
                                                    if ($_SESSION['id'] == $row['id']) {
                                                        $actionbuttons = '-';
                                                    } else {
                                                        $actionbuttons = '<button type="button" onclick="getRowID(' . $rowi . ')" rel="tooltip" class="btn btn-warning btn-sm btn-round btn-icon" data-toggle="modal" title="Remove as Admin" data-target="#revokeadminaccessModal" data-dismiss="modal">
                                                        <i class="now-ui-icons users_single-02"></i>
                                                    </button>';
                                                    }
                                                } else if ($row['type'] == 2) {
                                                    $access = "Guest";
                                                    $actionbuttons = '<button type="button" onclick="getRowID(' . $rowi . ')" rel="tooltip" class="btn btn-info btn-sm btn-round btn-icon" data-toggle="modal" title="Make Admin" data-target="#adminaccessModal" data-dismiss="modal">
                                                    <i class="now-ui-icons users_single-02"></i>
                                                </button>
                                                <button type="button" onclick="getRowID(' . $rowi . ')" rel="tooltip" class="btn btn-warning btn-sm btn-round btn-icon" data-toggle="modal" title="Remove Access" data-target="#revokeaccessModal" data-dismiss="modal">
                                                    <i class="now-ui-icons ui-1_simple-remove"></i>
                                                </button>
                                                    ';
                                                }
                                                if ($row['type'] == 9) {
                                                    $access = "UNVERIFIED";
                                                    $actionbuttons = '
                                                  <button type="button" onclick="getRowID(' . $rowi . ')" rel="tooltip" class="btn btn-success btn-sm btn-round btn-icon" data-toggle="modal" title="Approve" data-target="#approveModal" data-dismiss="modal">
                                                      <i class="now-ui-icons ui-1_check"></i>
                                                  </button>
                                                  <button type="button" onclick="getRowID(' . $rowi . ')" rel="tooltip" class="btn btn-danger btn-sm btn-round btn-icon" data-toggle="modal" title="Remove User" data-target="#deleteModal" data-dismiss="modal">
                                                      <i class="now-ui-icons ui-1_simple-remove"></i>
                                                  </button>';
                                                }

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

                                                echo "<tr ".$style_bg.">
                                          <td>
                                            " . $row['id'] . "
                                          </td>
                                          <td>
                                            " . $row['name'] . "
                                          </td>
                                          <td>
                                            " . $rcampus . "
                                          </td>
                                          <td>
                                            " . $roffice . "
                                          </td>
                                          <td>
                                            " . $access . "
                                          </td>
                                          <td class='td-actions text-right'>
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
    <script src="../assets/js/jquery.floatingscroll.min.js"></script>
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

<div id="deleteModal" class="modal fade modal-mini modal-danger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <div class="modal-profile">
                    <i class="now-ui-icons users_circle-08"></i>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" action="remove.php">
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">Remove User?<h4 id="name"></h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="password" class="form-control" id="inputPassword" placeholder="Verify Password" name="password">
                        </div>
                        <div class="col-sm-12">
                            <input type="hidden" class="form-control" id="idno" name="idno">
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

<div id="approveModal" class="modal fade modal-mini modal-success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <div class="modal-profile">
                    <i class="now-ui-icons users_circle-08"></i>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" action="approve.php">
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">Approve User?<h4 id="name2"></h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="password" class="form-control" id="inputPassword" placeholder="Verify Password" name="password2">
                        </div>
                        <div class="col-sm-12">
                            <input type="hidden" class="form-control" id="idno2" name="idno2">
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

<div id="revokeaccessModal" class="modal fade modal-mini modal-warning" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <div class="modal-profile">
                    <i class="now-ui-icons users_circle-08"></i>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" action="revokeaccess.php">
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">Revoke User Access?<h4 id="name3"></h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="password" class="form-control" id="inputPassword" placeholder="Verify Password" name="password3">
                        </div>
                        <div class="col-sm-12">
                            <input type="hidden" class="form-control" id="idno3" name="idno3">
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

<div id="adminaccessModal" class="modal fade modal-mini modal-info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <div class="modal-profile">
                    <i class="now-ui-icons users_circle-08"></i>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" action="makeadmin.php">
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">Make ADMINISTRATOR?<h4 id="name4"></h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="password" class="form-control" id="inputPassword" placeholder="Verify Password" name="password4">
                        </div>
                        <div class="col-sm-12">
                            <input type="hidden" class="form-control" id="idno4" name="idno4">
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

<div id="revokeadminaccessModal" class="modal fade modal-mini modal-warning" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <div class="modal-profile">
                    <i class="now-ui-icons users_circle-08"></i>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" action="revokeadminaccess.php">
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">Remove as ADMINISTRATOR?<h4 id="name5"></h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="password" class="form-control" id="inputPassword" placeholder="Verify Password" name="password5">
                        </div>
                        <div class="col-sm-12">
                            <input type="hidden" class="form-control" id="idno5" name="idno5">
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

<script>
$(document).ready(function () {
    $(".table-responsive").floatingScroll();
});
</script>

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
            message: 'A user has been approved' 
            },{
            
            type: 'success'
            });
          </script> ";
}
if (isset($_GET['success']) && $_GET['success'] == 2) {
    echo "<script>
            $.notify({
            
            title: '<strong>User Removed</strong>',
            message: 'A user has been removed successfully' 
            },{
            
            type: 'warning'
            });
          </script> ";
}
if (isset($_GET['success']) && $_GET['success'] == 3) {
    echo "<script>
            $.notify({
            
            title: 'Access Revoke',
            message: '<strong>A user has been revoked on all accesss</strong>'  
            },{
            
            type: 'warning'
            });
          </script> ";
}

if (isset($_GET['success']) && $_GET['success'] == 4) {
    echo "<script>
            $.notify({
            
            title: 'Administrative Access',
            message: '<strong>A user has been granted administrative access</strong>'  
            },{
            
            type: 'primary'
            });
          </script> ";
}

if (isset($_GET['success']) && $_GET['success'] == 5) {
    echo "<script>
            $.notify({
            
            title: 'Revoked Administrative Access',
            message: '<strong>A user has been removed as administrator</strong>'  
            },{
            
            type: 'warning'
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
        document.getElementById("name").innerHTML = doc;
        document.getElementById("name2").innerHTML = doc;
        document.getElementById("name3").innerHTML = doc;
        document.getElementById("name4").innerHTML = doc;
        document.getElementById("name5").innerHTML = doc;
        $("#idno").val(id);
        $("#idno2").val(id);
        $("#idno3").val(id);
        $("#idno4").val(id);
        $("#idno5").val(id);
    }
</script>

</html>