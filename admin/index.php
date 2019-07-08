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
        Administrator - <?php echo $_SESSION['name']; ?>
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/bootstrap-tagsinput.css" />
    <link href="../assets/css/app.css" />
    <link href="../assets/css/now-ui-dashboard.css?v=1.2.0" rel="stylesheet" />
    <link href="../assets/css/now-ui-kit.css?v=1.2.0" rel="stylesheet" />
    <link href="../assets/css/jquery.floatingscroll.css" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />

    <style>
        .scroll {
            height: 200px;
            overflow-y: scroll;
        }

        .label-info {
            background-color: #095006;
        }

        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: white;
        }

        .label {
            display: inline;
            padding: .2em .6em .3em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25em;
        }

        .bootstrap-tagsinput .tag [data-role="remove"] {
            margin-left: 8px;
            cursor: pointer;
        }

        .bootstrap-tagsinput .tag [data-role="remove"]::after {
            content: "x";
            padding: 0px 2px;
        }

        .bootstrap-tagsinput input {
            border: none;
            box-shadow: none;
            outline: none;
            background-color: transparent;
            padding: 0 6px;
            margin: 0;
            width: auto;
            max-width: inherit;
        }

        .bootstrap-tagsinput {
            width: 100%;
        }

        .accordion {
            margin-bottom: -3px;
        }

        .accordion-group {
            border: none;
        }

        .twitter-typeahead .tt-query,
        .twitter-typeahead .tt-hint {
            margin-bottom: 0;
        }

        .twitter-typeahead .tt-hint {
            display: none;
        }

        .tt-menu {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            display: none;
            float: left;
            min-width: 160px;
            padding: 5px 0;
            margin: 2px 0 0;
            list-style: none;
            font-size: 14px;
            background-color: #ffffff;
            border: 1px solid #cccccc;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 4px;
            -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
            background-clip: padding-box;
            cursor: pointer;
        }

        .tt-suggestion {
            display: block;
            padding: 3px 20px;
            clear: both;
            font-weight: normal;
            line-height: 1.428571429;
            color: #333333;
            white-space: nowrap;
        }

        .tt-suggestion:hover,
        .tt-suggestion:focus {
            color: #ffffff;
            text-decoration: none;
            outline: 0;
            background-color: #428bca;
        }
    </style>

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
                    <li class="active">
                        <a href="#">
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
                    <li><a href="https://drive.google.com/drive/folders/1VInlcieE8Tkzwfabrrna8_8yhRbdaG55?usp=sharing" target="_blank">
                            <i class="now-ui-icons education_paper"></i>
                            <p>Create NEW (Google Doc)</p>
                        </a>
                    </li>
                    <li>
                        <a href="members.php">
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
                        <button class="btn btn-info btn-round btn-lg" data-toggle="modal" data-target="#addFileModal" data-dismiss="modal" onclick="">Add File</button>
                        <span style="margin: 20px;"></span>
                        <strong><a class="navbar-brand" href="#" id="no_of_docs"></a></strong>
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
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                            <div class="card card-plain" style="margin-bottom:0px;">
                                <div class="card-header" role="tab" id="headingTwo">

                                    <div class="card-header">
                                        <h4 class="card-title"> Document List</h4>
                                        <!--<i class="now-ui-icons arrows-1_minimal-down"></i>-->
                                    </div>
                                    <div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse">
                                        <div class="card card-plain">
                                            <div class="card-header" role="tab" id="headingOne">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                    Filter

                                                    <i class="now-ui-icons arrows-1_minimal-down"></i>
                                                </a>
                                            </div>

                                            <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                                                <div class="card-body">
                                                    <div class="col-md-3 pull-left">
                                                        <select class="form-control form-control" id="filepurposefilter" onchange="myFunction();">
                                                            <option value="all">All Documents</option>
                                                            <?php
                                                            $sqlt = "Select * from m_typeofdoc;";
                                                            $resultt = $conn->query($sqlt);
                                                            if ($resultt->num_rows > 0) {
                                                                while ($rowt = $resultt->fetch_assoc()) {
                                                                    echo "<option value='" . $rowt['type'] . "'>" . $rowt['type'] . "</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 pull-left">
                                                        <select class="form-control form-control" id="unreadfilter" onchange="myFunction();">
                                                            <option value="all">All Read/Unread</option>
                                                            <option value="unread">Unread Documents</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 pull-left">
                                                        <select class="form-control form-control" id="inoutfilter" onchange="myFunction();">
                                                            <option value="all">Incoming & Outgoing</option>
                                                            <option value="1">Incoming Documents</option>
                                                            <option value="0">Outgoing Documents</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="card-body" style="margin-top:30px;">
                                                    <div class="col-md-2 pull-left">
                                                        <select class="form-control form-control" id="yearfilter" onchange="myFunction();">
                                                            <option value="all">All Year</option>
                                                            <?php
                                                            $sqlt = "SELECT DISTINCT YEAR(datetime) AS year from files where archive = 0 ORDER BY year ASC;";
                                                            $resultt = $conn->query($sqlt);
                                                            if ($resultt->num_rows > 0) {
                                                                while ($rowt = $resultt->fetch_assoc()) {
                                                                    echo "<option value='" . $rowt['year'] . "'>" . $rowt['year'] . "</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 pull-left">
                                                        <select class="form-control form-control" id="monthfilter" onchange="myFunction();">
                                                            <option value="all">All Month</option>
                                                            <?php
                                                            $sqlt = "SELECT DISTINCT Month(datetime) AS mon from files where archive = 0 ORDER BY mon ASC;";
                                                            $resultt = $conn->query($sqlt);
                                                            if ($resultt->num_rows > 0) {
                                                                while ($rowt = $resultt->fetch_assoc()) {
                                                                    $dateObj   = DateTime::createFromFormat('!m', $rowt['mon']);
                                                                    $monthName = $dateObj->format('F');
                                                                    echo "<option value='" . $monthName . "'>" . $monthName . "</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="card-body" style="margin-top:30px;">
                                                    <button class="btn btn-info btn-round btn-sm" onclick="resetFilter();">Reset Filter</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="myTable">
                                        <?php
                                        $sql = "SELECT * FROM files where archive = 0 ORDER BY datetime DESC";
                                        $result = $conn->query($sql);
                                        $rowi = 1;

                                        if ($result->num_rows > 0) {
                                            // output data of each row

                                            echo '<thead class=" text-primary">
                                        <th onclick="sortTable(0)">
                                          Control No.
                                        </th>
                                        <th onclick="sortTable(1)">
                                          Name
                                        </th>
                                        <th onclick="sortTable(2)">
                                          Purpose
                                        </th>
                                        <th onclick="sortTable(3)">
                                          Origin
                                        </th>
                                        <th onclick="sortTable(4)">
                                          Uploader
                                        </th>
                                        <th onclick="sortTable(5)">
                                          Uploaded
                                        </th>
                                        <th class="text-right">
                                          Action
                                        </th>
                                      </thead>
                                      <tbody>';


                                            while ($row = $result->fetch_assoc()) {

                                                // if ($row['file_extension'] == 'DOC' || $row['file_extension'] == 'DOCX') {
                                                //     $filename = "<a href='https://docs.google.com/gview?url=http://" . $servername . "/" . $row['file_path'] . "&embedded=true' target='_blank'>" . $row['file_name'] . "</a>";
                                                // } else {
                                                //     $filename = $row['file_name'];
                                                // }

                                                $dest = json_decode($row['destination']);
                                                $destination = "";
                                                $destvalue = "";
                                                foreach ($dest as $value) {
                                                    $destvalue .= $value;
                                                    if (next($dest)) {
                                                        $destvalue .= ", ";
                                                    }
                                                    $sql1 = "SELECT campus FROM campuses where id = $value";
                                                    $result1 = $conn->query($sql1);
                                                    if ($result1->num_rows > 0) {
                                                        $row1 = $result1->fetch_assoc();
                                                        $destination .= "(" . $row1['campus'] . ")";
                                                    }
                                                    $sql2 = "SELECT offices.office, campuses.campus from offices inner join campuses on offices.campus=campuses.id where offices.id = $value";
                                                    $result2 = $conn->query($sql2);
                                                    if ($result2->num_rows > 0) {
                                                        $row2 = $result2->fetch_assoc();
                                                        $destination .= "(" . $row2['office'] . "(" . $row2['campus'] . "))";
                                                    }
                                                }
                                                if ($destination == "") {
                                                    $destination = "All Campus";
                                                    $destvalue = "all";
                                                }

                                                $sql3 = "SELECT offices.office, campuses.campus from offices inner join campuses on offices.campus=campuses.id where offices.id = " . $row['origin'];
                                                $result3 = $conn->query($sql3);
                                                if ($result3->num_rows > 0) {
                                                    $row3 = $result3->fetch_assoc();
                                                    $origin = $row3['office'] . "(" . $row3['campus'] . ")";
                                                }

                                                $sql4 = "SELECT name from user where id = " . $row['uploader'];
                                                $result4 = $conn->query($sql4);
                                                if ($result4->num_rows > 0) {
                                                    $row4 = $result4->fetch_assoc();
                                                    $uploader = $row4['name'];
                                                }

                                                $filename = "<a href='../" . $row['file_path'] . "' rel='tooltip'  title='Click to Download' onclick = updateDownloads('" . $row['id'] . "'); download>" . $row['file_name'] . "</a>";

                                                if ($row['finout'] == 0) {
                                                    $inout = "Outgoing";
                                                } elseif ($row['finout'] == 1) {
                                                    $inout = "Incoming";
                                                }

                                                $convertdatetime = new DateTime($row['datetime']);
                                                $year = $convertdatetime->format('Y');
                                                $month = $convertdatetime->format('F');

                                                $time = strtotime($row['datetime']);
                                                $datetime = date("d-M-Y h:i A", $time);

                                                if ($row['finout'] == 0) {
                                                    $up_ar_btn = "<button type='button' onclick='getRowForUptade(" . $rowi . ")' rel='tooltip' class='btn btn-info btn-sm btn-round btn-icon' data-toggle='modal' title='Update' data-target='#updateModal' data-dismiss='modal'>
                                                                        <i class='now-ui-icons arrows-1_cloud-upload-94'></i>
                                                                    </button>
                                                                    <button type='button' onclick='getRowForArchive(" . $rowi . ")' rel='tooltip' class='btn btn-warning btn-sm btn-round btn-icon' data-toggle='modal' title='Archive' data-target='#archiveModal' data-dismiss='modal'>
                                                                        <i class='now-ui-icons files_box'></i>
                                                                    </button>";
                                                } else {
                                                    $up_ar_btn = "";
                                                }

                                                echo "<tr class='trcontent'>
                                          <td>
                                            " . $row['id'] . "
                                          </td>
                                          <td>
                                            " . $filename . "
                                          </td>
                                          <td>
                                            " . $inout . " " . $row['file_purpose'] . "
                                          </td>
                                          <td>
                                            " . $origin . "
                                          </td>
                                          <td>
                                            " . $uploader . "
                                          </td>
                                          <td>
                                            " . $datetime . "
                                          </td>
                                          <td style='display:none;'>
                                            " . $row['file_extension'] . "
                                          </td>
                                          <td style='display:none;'>
                                            " . $row['file_rev'] . "
                                          </td>
                                          <td style='display:none;'>
                                            " . $row['archived_by'] . "
                                          </td>
                                          <td style='display:none;'>
                                          " . $row['file_name'] . "
                                          </td>
                                          <td style='display:none;'>
                                          " . $row['file_desc'] . "
                                          </td>
                                          <td style='display:none;'>
                                          " . $destination . "
                                          </td>
                                          <td style='display:none;'>
                                          " . $destvalue . "
                                          </td>
                                          <td style='display:none;'>
                                          " . $row['finout'] . "
                                          </td>
                                          <td style='display:none;'>
                                          " . $row['file_purpose'] . "
                                          </td>
                                          <td style='display:none;'></td>
                                          <td style='display:none;'>
                                          " . $year . "
                                          </td>
                                          <td style='display:none;'>
                                          " . $month . "
                                          </td>
                                          <td class='td-actions text-right'>
                                                " . $up_ar_btn . "
                                                <button type='button' onclick='getRowForDetails(" . $rowi . ")' rel='tooltip' class='btn btn-success btn-sm btn-round btn-icon' title='Details' data-toggle='modal' data-target='#fileDetailsModal' data-dismiss='modal' >
                                           			<i class='now-ui-icons design_bullet-list-67'></i>
                                                </button>
                                                <button type='button' onclick='getRowID(" . $rowi . ")' rel='tooltip' class='btn btn-danger btn-sm btn-round btn-icon' data-toggle='modal' title='Delete' data-target='#deleteModal' data-dismiss='modal'>
                                                    <i class='now-ui-icons ui-1_simple-remove'></i>
                                                </button>
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
    <script src="../assets/js/jquery.form.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/core/bootstrap-notify.js"></script>
    <script src="../assets/js/core/bootstrap-notify.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/js/angular.min.js"></script>
    <script src="../assets/js/jquery.uploadifive.min.js"></script>
    <script src="../assets/js/bootstrap-tagsinput.min.js"></script>
    <script src="../assets/js/bloodhound.min.js"></script>
    <script src="../assets/js/typeahead.bundle.min.js"></script>
    <script src="../assets/js/app.js"></script>
    <script src="../assets/js/jquery.floatingscroll.min.js"></script>
    <!-- <script src="../assets/js/app_bs3.js"></script> -->
    <!--  Google Maps Plugin    
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  -->
    <!-- Chart JS -->
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="../assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <!-- <script src="../assets/js/now-ui-dashboard.min.js?v=1.2.0" type="text/javascript"></script> -->
    <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
    <!-- <script src="../assets/demo/demo.js"></script> -->
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
    <!-- <script src="../assets/js/now-ui-dashboard.js?v=1.1.0" type="text/javascript"></script> -->
    <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
    <!-- <script src="../assets/js/demo.js"></script> -->
    <!-- <script src="../assets/js/now-ui-kit.js?v=1.2.0" type="text/javascript"></script> -->

</body>

<div id="archiveModal" class="modal fade modal-mini modal-warning" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <div class="modal-profile">
                    <i class="now-ui-icons users_circle-08"></i>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" action="toarchive.php">
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">Archive?<h4 id="adocname"></h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="password" class="form-control" id="inputPassword" placeholder="Verify Password" name="password">
                        </div>
                        <div class="col-sm-12">
                            <input type="hidden" class="form-control" id="aidno" name="aidno">
                        </div>
                        <div class="col-sm-12">
                            <input type="hidden" class="form-control" id="archived_idno" name="" value="archived_idno">
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

<div class="modal fade bd-example-modal-lg" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="post" enctype="multipart/form-data" action="update.php" id="updateFileForm">
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
                        <input type="hidden" id="oldfilename" name="oldfilename">
                        <label id="upfiledest"></label><br>
                        <label id="upfilerevisionlbl"></label>
                    </div>
                    <div class="progress-container progress-primary" id="progressBar">
                        <span class="progress-badge" id="uploading"></span>
                        <div class="progress">
                            <div class="progress-bar" id="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                <span class="progress-value" id="ustatus"></span>
                            </div>
                        </div>
                    </div>
                    <!--<button class="btn btn-primary btn-round">Browse File</button>--><br>
                    <label for="exampleFormControlSelect1">Updated Control No.</label>
                    <div class="input-group">
                        <div class="col-md-4">
                            <?php
                            $uid = mt_rand();
                            $newuid = sprintf("CPSU%X", $uid);
                            echo '<input style="font-weight: bold;" class="form-control" type="text" name="upcontrolnumber" id="upcontrolnumber" value="' . $newuid . '" required>';
                            ?>
                        </div>
                        <div class="col-md-8 pull-right"><span style="color:#095006; font-size: 12px;"><i class="now-ui-icons travel_info"></i>NOTE: Add your Document Control Code on the "Control No.", IF NO Control Code available, Please copy the Control No. to the "Control Code" on the footer of the document before uploading.</span></div>
                    </div>
                    <label for="exampleFormControlSelect1">File Name</label>
                    <div class="input-group">
                        <input class="form-control" type="file" name="upfilename" id="uplfilename" onchange="" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">File Description</label>
                        <textarea class="form-control" id="upfiledesc" name="upfiledesc" rows="3" required></textarea>
                    </div>
                    <input type="hidden" name="upidno" id="upidno">
                    <input type="hidden" name="upfiledestval" id="upfiledestval">
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
                        <label for="exampleFormControlSelect1">File Type</label>
                        <div class="input-group">
                            <select class="form-control form-control" name="upfilepurpose" id="upfilepurpose" required>
                                <option value="">Select...</option>
                                <?php
                                $sqlt = "Select * from m_typeofdoc;";
                                $resultt = $conn->query($sqlt);
                                if ($resultt->num_rows > 0) {
                                    while ($rowt = $resultt->fetch_assoc()) {
                                        echo "<option value='" . $rowt['type'] . "'>" . $rowt['type'] . "</option>";
                                    }
                                }
                                ?>
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

<div class="modal fade bd-example-modal-lg" id="fileDetailsModal" tabindex="-1" role="dialog" aria-labelledby="fileDetailsModal" aria-hidden="f">
    <div class="modal-dialog modal-lg" role="document">
        <form></form>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileDetailsModalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group" id="dfilename"></div>
                <div class="input-group" id="dfiledest"></div>
                <div class="input-group" id="downloads"></div>
                <div class="input-group" id="dfiledesc"></div>
                <div class="input-group scroll">
                    <div id="download_log"></div>
                </div>
            </div>
        </div>
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
                <form method="post" action="delete.php">
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
                            <input type="hidden" class="form-control" id="archived_idno" name="" value="archived_idno">
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
        <form method="post" enctype="multipart/form-data" action="upload.php" id="addFileForm" name>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="progress-container progress-primary" id="progressBar">
                        <span class="progress-badge" id="uploading"></span>
                        <div class="progress">
                            <div class="progress-bar" id="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                <span class="progress-value" id="status"></span>
                            </div>
                        </div>
                    </div>
                    <!--<button class="btn btn-primary btn-round">Browse File</button>--><br>
                    <label for="exampleFormControlSelect1">Control No.</label>
                    <div class="input-group">
                        <div class="col-md-4">
                            <?php
                            $id = mt_rand();
                            $newid = sprintf("CPSU%X", $id);
                            echo '<input style="font-weight: bold;" class="form-control" type="text" name="controlnumber" id="controlnumber" value="' . $newid . '" required>';
                            ?>
                        </div>
                        <div class="col-md-8 pull-right"><span style="color:#095006; font-size: 12px;"><i class="now-ui-icons travel_info"></i>NOTE: Add your Document Control Code on the "Control No.", IF NO Control Code available, Please copy the Control No. to the "Control Code" on the footer of the document before uploading.</span></div>
                    </div>
                    <label for="exampleFormControlSelect1">File Name</label>
                    <div class="input-group">
                        <input class="form-control" type="file" name="filename" id="filename" onchange="" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">File Description</label>
                        <textarea class="form-control" id="filedesc" name="filedesc" rows="2" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">File Destination</label>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="allcampus" id="fileDestinationCheckbox" value="all" onclick="unhideFileDesination()" checked> All Campuses
                                <span class="form-check-sign"></span>
                            </label>
                            <div class="col-md-12 form-group" id="customFileDestination" style="display:none; padding:10px;">
                                <div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="alldean" id="alldeanCheckbox" value="1" onclick="unrequirefiledest()" unchecked> All Dean
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="allcampusdirector" id="allcampusdirectorCheckbox" value="1" onclick="unrequirefiledest()" unchecked> All Campus Director
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                </div>
                                <div style="padding-top:10px">
                                    <div class="form-group" id="custominput">
                                        <input type="text" id="fileDest" class="fileDest" name="customcampus" style="display:none;" placeholder="Type Campus/Office">
                                        <input type="hidden" id="fileDestHid" name="">
                                    </div>
                                </div>
                                <script>
                                    var val = new Bloodhound({
                                        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('text'),
                                        queryTokenizer: Bloodhound.tokenizers.whitespace,
                                        remote: {
                                            url: '../loaddata3.php?q=val',
                                            wildcard: 'val'
                                        }
                                    });
                                    val.initialize();
                                    var elt = $('.fileDest');
                                    elt.tagsinput({
                                        itemValue: 'value',
                                        itemText: 'text',
                                        typeaheadjs: {
                                            name: 'cities',
                                            displayKey: 'text',
                                            source: val.ttAdapter(),
                                            limit: 20
                                        }
                                    });
                                </script>

                                <!--<div class="col-md-3">
                                 <button type="button" name="alert tags" onclick="test()">
                                </div>
                                <div class="col-md-5 pull-right">
                                    <select class="form-control form-control" name="office" id="offices"></select>
                                </div>
                                <div class="col-md-4 pull-right">
                                    <select class="form-control form-control" name="campus" id="campuses">
                                        <?php
                                        // $sql = "SELECT * from campuses";
                                        // $result = $conn->query($sql);

                                        // if ($result->num_rows > 0) {

                                        //     echo "<option value=''>Select Campus...</option>";

                                        //     while ($row = $result->fetch_assoc()) {
                                        //         echo "<option value='" . $row['id'] . "' id='" . $row['campus'] . "'>" . $row['campus'] . "</option>";
                                        //     }
                                        // }
                                        ?>
                                    </select>
                                </div> -->
                            </div>
                        </div>
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
                        <label for="exampleFormControlSelect1">File Type</label>
                        <div class="input-group">
                            <select class="form-control form-control" name="filepurpose" required>
                                <option value="">Select...</option>
                                <?php
                                $sqlt = "Select * from m_typeofdoc;";
                                $resultt = $conn->query($sqlt);
                                if ($resultt->num_rows > 0) {
                                    while ($rowt = $resultt->fetch_assoc()) {
                                        echo "<option value='" . $rowt['type'] . "'>" . $rowt['type'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <!--<input type="text" class="form-control form-control-lg" id="" name="filepurpose" value="Accreditation" required>-->
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="modal-footer">
                            <input type="Submit" id="uploadSubmit" class="btn btn-primary" name="Submit" value="Submit" onclick="">
                        </div>
                    </div>
                </div>
        </form>
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
            message: 'File Uploaded Successfully' 
            },{
            
            type: 'success'
            });
          </script> ";
}
if (isset($_GET['mail']) && $_GET['mail'] == 1) {
    echo "<script>
            $.notify({
            
            title: '<strong>Notifications Sent</strong>',
            message: 'Email Notifications Sent Successfully' 
            },{
            
            type: 'success'
            });
          </script> ";
}
if (isset($_GET['success']) && $_GET['success'] == 10) {
    echo "<script>
            $.notify({
            
            title: '<strong>Success</strong>',
            message: 'File Updated Successfully' 
            },{
            
            type: 'info'
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
if (isset($_GET['success']) && $_GET['success'] == 3) {
    echo "<script>
            $.notify({
            
            title: '<strong>File Archived</strong>',
            message: 'File Transferred to Archive' 
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
            message: '<strong>Upload JPEG, JPG, DOC, DOCX, PDF, RAR, ZIP Only</strong>' 
            },{
            
            type: 'danger',
            allow_dismiss: false

            });

          </script> ";
}
if (isset($_GET['error']) && $_GET['error'] == 5) {

    echo "<script>
            $.notify({
            
            title: 'Unable to Verify',
            message: '<strong>File Not Deleted</strong>' 
            },{
            
            type: 'danger',
            allow_dismiss: false

            });

          </script> ";
}
if (isset($_GET['error']) && $_GET['error'] == 0) {

    echo "<script>
            $.notify({
            
            title: '<strong>Upload Error</strong>',
            message: 'There was a problem uploading your file. Please contact the administrator/creator' 
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
        var input, filter, input2, filter2, input3, filter3, input4, filter4, table, tr, td, i, txtValue, no_of_docs;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        no_of_docs = 0;

        input2 = document.getElementById("filepurposefilter");
        if (input2.value.toUpperCase() != "ALL") {
            filter2 = input2.value.toUpperCase();
        } else {
            filter2 = "";
        }

        input3 = document.getElementById("inoutfilter");
        if (input3.value.toUpperCase() != "ALL") {
            filter3 = input3.value.toUpperCase();
        } else {
            filter3 = "";
        }

        input4 = document.getElementById("unreadfilter");
        if (input4.value.toUpperCase() != "ALL") {
            filter4 = input4.value.toUpperCase();
        } else {
            filter4 = "";
        }

        input5 = document.getElementById("yearfilter");
        if (input5.value.toUpperCase() != "ALL") {
            filter5 = input5.value.toUpperCase();
        } else {
            filter5 = "";
        }

        input6 = document.getElementById("monthfilter");
        if (input6.value.toUpperCase() != "ALL") {
            filter6 = input6.value.toUpperCase();
        } else {
            filter6 = "";
        }

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td");
            if (td.length > 0) {
                //txtValue = td.textContent || td.innerText;
                if ((td[0].innerHTML.toUpperCase().indexOf(filter) > -1 || td[1].innerHTML.toUpperCase().indexOf(filter) > -1) && (td[2].innerHTML.toUpperCase().indexOf(filter2) > -1 && td[13].innerHTML.toUpperCase().indexOf(filter3) > -1 && td[15].innerHTML.toUpperCase().indexOf(filter4) > -1 && td[16].innerHTML.toUpperCase().indexOf(filter5) > -1 && td[17].innerHTML.toUpperCase().indexOf(filter6) > -1)) {
                    tr[i].style.display = "";
                    no_of_docs++;
                } else {
                    tr[i].style.display = "none";
                }
            }

        }
        $('#no_of_docs').text("Number of Documents: " + no_of_docs);
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
        var aid = document.getElementById("myTable").rows[r].cells.item(8).innerHTML;
        var doc = document.getElementById("myTable").rows[r].cells.item(9).innerHTML;
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
        $("#archived_idno").val(aid);

    }
</script>

<script>
    function getRowForArchive(r) {
        var id = document.getElementById("myTable").rows[r].cells.item(0).innerHTML;
        var doc = document.getElementById("myTable").rows[r].cells.item(9).innerHTML;
        document.getElementById("adocname").innerHTML = doc;
        $("#aidno").val(id);
    }
</script>

<script>
    function getRowForUptade(r) {
        var fid = document.getElementById("myTable").rows[r].cells.item(0).innerHTML;
        var fname = document.getElementById("myTable").rows[r].cells.item(9).innerHTML;
        var fpor = document.getElementById("myTable").rows[r].cells.item(14).innerHTML;
        //var fxtn = document.getElementById("myTable").rows[r].cells.item(6).innerHTML;
        var frev = document.getElementById("myTable").rows[r].cells.item(7).innerHTML;
        var fdesc = document.getElementById("myTable").rows[r].cells.item(10).innerHTML;
        var fdest = document.getElementById("myTable").rows[r].cells.item(11).innerHTML;
        var fdestval = document.getElementById("myTable").rows[r].cells.item(12).innerHTML;
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
        $("#oldfilename").val(fname.replace(/\s/g, ""));
        $('#upfiledest').text("File Destination: " + fdest);
        $('#upfilerevisionlbl').text("Revision: " + frev.replace(/\s/g, ""));
        $('#upfilerevision').val(parseInt(frev.replace(/\s/g, "")) + 1);
        //$('#upfileextension').val("");
        //$('#upfileextension').val(fxtn.replace(/\s/g, ""));
        $('#upfilepurpose').val(fpor.replace(/\s/g, ""));
        $("#upidno").val(fid.replace(/\s/g, ""));
        $("#upfiledesc").val(fdesc.trim());
        $("#upfiledestval").val(fdestval.trim());
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
<script>
    document.getElementById('uplfilename').onchange = function() {
        var fileextension = this.value.slice(this.value.lastIndexOf(".") + 1).toUpperCase();
        document.getElementById("upfileextension").value = fileextension;
    };
</script>

<script>
    function updateDownloads(myObj) {

        var table = document.getElementById("myTable");
        for (var i = 1; i < table.rows.length; i++) {
            var id = document.getElementById("myTable").rows[i].cells.item(0).innerHTML;
            var newid = id.replace(/\s/g, "");
            if (newid == myObj) {
                //alert(i);
                table.rows[i].style.backgroundColor = "";
                table.rows[i].cells[15].innerHTML = '';
            }
        }

        var obj, dbParam, xmlhttp;
        obj = {
            "fid": myObj
        };
        dbParam = JSON.stringify(obj);
        //alert(dbParam);
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //myObj = JSON.parse(this.responseText);
                //console.log(myObj);
                //console.log(txt);
            }
        };
        xmlhttp.open("POST", "../updatedownloads.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("x=" + dbParam);
    }
</script>

<!-- <script>
    function getRowForDetails(r) {
        var id = document.getElementById("myTable").rows[r].cells.item(0).innerHTML;
        var name = document.getElementById("myTable").rows[r].cells.item(9).innerHTML;
        var desc = document.getElementById("myTable").rows[r].cells.item(10).innerHTML;
        var newname = name.replace(/\s/g, "");
        var newid = id.replace(/\s/g, "");
        document.getElementById("fileDetailsModalTitle").innerHTML = "Control No: " + id;
        $('#dfilename').text("Name: " + name);
        $('#dfiledesc').text("Description: " + desc);
        var obj, dbParam, xmlhttp, myObj, x, txt = "";
        obj = {
            "fid": newid
        };
        dbParam = JSON.stringify(obj);
        //alert(dbParam);
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                myObj = JSON.parse(this.responseText);
                //document.getElementById("downloads").innerHTML = myObj->length;
                $('#downloads').text("Downloaded " + myObj.length + " time/s");
                for (x in myObj) {
                    txt += myObj[x].time + " " + myObj[x].description + " " + "<br>";
                }
                document.getElementById("download_log").innerHTML = txt;
                //console.log(myObj);
            } //else{
            //     alert("error");
            // }
        };
        xmlhttp.open("POST", "loaddownloaddata2.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("x=" + dbParam);
    }
</script> -->

<script>
    function getRowForDetails(r) {
        var id = document.getElementById("myTable").rows[r].cells.item(0).innerHTML;
        var name = document.getElementById("myTable").rows[r].cells.item(9).innerHTML;
        var desc = document.getElementById("myTable").rows[r].cells.item(10).innerHTML;
        var dest = document.getElementById("myTable").rows[r].cells.item(11).innerHTML;
        var newname = name.replace(/\s/g, "");
        var newid = id.replace(/\s/g, "");
        var txt = "";
        document.getElementById("fileDetailsModalTitle").innerHTML = "Control No: " + id;
        $('#dfilename').text("Name: " + name);
        $('#dfiledest').text("Destination: " + dest);
        $('#dfiledesc').text("Description: " + desc);
        $.ajax({
            url: "loaddownloaddata2.php",
            type: "POST",
            data: "fid=" + newid,
            success: function(response) {
                console.log(response);
                $('#downloads').text("Downloaded " + response.length + " time/s");
                $.each(response, function(i, value) {
                    txt += value.time + " " + value.description + " " + "<br>";
                    // $('<option></option>', {
                    //   html: value.office
                    // }).attr('value', value.id).appendTo('#offices');
                });
                document.getElementById("download_log").innerHTML = txt;
            },
            error: function(err) {
                console.log("Error" + err);
            }
        });

    }
</script>

<!-- <script>
    function filterText() {
        document.getElementById('myInput').value = '';
        var rex = new RegExp($('#filepurposefilter').val());
        if (rex == "/all/") {
            clearFilter()
        } else {
            $('.trcontent').hide();
            $('.trcontent').filter(function() {
                return rex.test($(this).text());
            }).show();
        }
    }

    function clearFilter() {
        $('.trcontent').show();
    }
</script> -->

<script>
    function unhideFileDesination() {
        var checkBox = document.getElementById("fileDestinationCheckbox");
        var text = document.getElementById("customFileDestination");
        if (checkBox.checked == false) {
            text.style.display = "block";
            $("#fileDest").attr('required', '');
        } else {
            text.style.display = "none";
            $("#fileDest").removeAttr('required');
        }
    }
</script>

<script>
    function unrequirefiledest() {
        var checkBox1 = document.getElementById("allcampusdirectorCheckbox");
        var checkBox2 = document.getElementById("alldeanCheckbox");
        var text = document.getElementById("customFileDestination");
        if (checkBox1.checked == true || checkBox2.checked == true) {
            $("#fileDest").removeAttr('required');
        } else {
            $("#fileDest").attr('required', '');
        }
    }
</script>

<!-- <script>
    jQuery(document).ready(function($) {
        $("#campuses").change(function() {
            var cid = $("#campuses").val();
            $('#offices').empty();
            $.ajax({
                url: "../loaddata2.php",
                type: "POST",
                data: "campus=" + cid,
                success: function(response) {
                    $('#offices').append('<option value="">All Offices</option>')
                    //console.log(response);
                    //$('#offices').append('<option value=' + myObj[x].id + '>' + myObj[x].office + '</option>');
                    $.each(response, function(i, value) {
                        $('<option></option>', {
                            html: value.office
                        }).attr('value', value.id).appendTo('#offices');
                    });;
                },
                error: function(err) {
                    console.log("Error" + err);
                }
            });
        });
    });
</script> -->

<!-- <script>
    function test() {
        var items = $(".fileDest").tagsinput('items');
        $("#fileDestHid").val(items);
    }
</script> -->

<script>
    function notify(idx) {
        var table = document.getElementById("myTable");

        for (var i = 1; i < table.rows.length; i++) {
            var id = document.getElementById("myTable").rows[i].cells.item(0).innerHTML;
            var newid = id.replace(/\s/g, "");
            if (newid == idx) {
                //alert(i);
                table.rows[i].style.backgroundColor = "lightgreen";
                table.rows[i].cells[15].innerHTML = 'unread';
                //document.getElementById('download_status'+i).innerHTML = "unread";
                //$('#download_status').html('unread');
            } else {
                //$('#download_status').html('read');
                //table.rows[i].cells[15].innerHTML = 'read';
            }
        }
    }
</script>

<?php
$sqld = "SELECT * FROM files WHERE NOT EXISTS (Select * FROM logs WHERE logs.file_id = files.id AND logs.author = " . $_SESSION['id'] . ")AND finout = 1 AND archive = 0 AND uploader !=  " . $_SESSION['id'] . ";";
$resultd = $conn->query($sqld);
$n = 0;
if ($resultd->num_rows > 0) {
    while ($rowd = $resultd->fetch_assoc()) {
        echo "<script> notify('" . $rowd['id'] . "'); </script>";
        $n++;
    }
    if ($n == 0) {
        $noticount = "";
    } else {
        $noticount = "<strong>(" . $n . ")</strong>";
    }
}
?>

<script>
    $(document).ready(function() {
        $('#addFileForm').submit(function(event) {
            if ($('#filename').val) {
                event.preventDefault();
                $('#status').text("Uploading...");
                $('#addFileForm').ajaxSubmit({
                    beforeSubmit: function() {
                        $('.progress-bar').width('0%');
                    },
                    uploadProgress: function(event, position, total, percentageComplete) {
                        $('#status').text('Uploading (' + percentageComplete + '%)...');
                        $('.progress-bar').animate({
                            width: percentageComplete + '%'
                        }, {
                            duration: 1000
                        });
                    },
                    success: function(data) {
                        //console.log(xhr.getAllResponseHeaders());
                        //console.log(xhr.getResponseHeader("location"));
                        $('#status').text("Uploaded!");
                        //console.log(data);
                        window.location = data;
                    }
                });
            }
            return false;
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#updateFileForm').submit(function(event) {
            if ($('#uplfilename').val) {
                event.preventDefault();
                $('#ustatus').text("Uploading...");
                $('#updateFileForm').ajaxSubmit({
                    beforeSubmit: function() {
                        $('.progress-bar').width('0%');
                    },
                    uploadProgress: function(event, position, total, percentageComplete) {
                        $('#ustatus').text('Uploading (' + percentageComplete + '%)...');
                        $('.progress-bar').animate({
                            width: percentageComplete + '%'
                        }, {
                            duration: 1000
                        });
                    },
                    success: function(data) {
                        //console.log(xhr.getAllResponseHeaders());
                        //console.log(xhr.getResponseHeader("location"));
                        $('#ustatus').text("Uploaded!");
                        //console.log(data);
                        window.location = data;
                    }
                });
            }
            return false;
        });
    });
</script>

<script>
    function resetFilter() {
        $("select").each(function() {
            this.selectedIndex = 0;
            myFunction();
        });
    }
</script>

</html>