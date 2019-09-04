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
        Logs - <?php echo $_SESSION['name']; ?>
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
                    <li>
                        <a href="templates.php">
                            <i class="now-ui-icons education_paper"></i>
                            <p>Templates</p>
                        </a>
                    </li>
                    <!-- <li><a href="https://drive.google.com/drive/folders/1VInlcieE8Tkzwfabrrna8_8yhRbdaG55?usp=sharing" target="_blank">
                            <i class="now-ui-icons education_paper"></i>
                            <p>Create NEW (Google Doc)</p>
                        </a>
                    </li> -->
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
                    <li class="active">
                        <a href="#">
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
                                        <h4 class="card-title"> Logs <button type='button' onclick='printTable();' rel='tooltip' title="Print" class='btn btn-sm btn-round btn-icon pull-right'><img src="data:image/jpeg;base64,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"></button>

                                        </h4>
                                        <!--<i class="now-ui-icons arrows-1_minimal-down"></i>-->
                                    </div>

                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <div id="toPrint">
                                        <div class="justify-content-center" id="headerforprint" style='display:none;text-align:center;'>
                                            <img src="../assets/img/favicon.png" style="height:35px;">
                                            <div class="t m0 x2 h2 y2 ff1 fs0 fc0 sc0 ls0 ws0">CENTRAL PHILIPPINE<span class="_ _0"></span>S ST<span class="_ _0"></span>A<span class="_ _1"></span>TE UNIVERSIT<span class="_ _0"></span>Y<span class="_ _0"></span> </div>
                                            <div class="t m0 x3 h3 y3 ff2 fs0 fc0 sc0 ls0 ws0">Kabankalan Cit<span class="_ _0"></span>y, Negros Occidental<span class="_ _0"></span><span class="ff3 fs1"> </span></div>
                                            <div>
                                                <h3>Logs</h3>
                                            </div>
                                        </div>
                                        <table class="table" id="myTable">
                                            <?php
                                            $sql = "SELECT * FROM logs ORDER BY time DESC;";
                                            $result = $conn->query($sql);
                                            $rowi = 1;

                                            if ($result->num_rows > 0) {
                                                // output data of each row

                                                echo '<thead class=" text-primary">
                                        <th onclick="sortTable(0)">
                                          Log ID
                                        </th>
                                        <th onclick="sortTable(1)">
                                          Date & Time
                                        </th>
                                        <th onclick="sortTable(2)">
                                          Description
                                        </th>
                                      </thead>
                                      <tbody>';


                                                while ($row = $result->fetch_assoc()) {

                                                    $time = strtotime($row['time']);
                                                    $datetime = date("d-M-Y H:i:s", $time);

                                                    echo "<tr>
                                          <td>
                                            " . $row['id'] . "
                                          </td>
                                          <td>
                                            " . $datetime . "
                                          </td>
                                          <td>
                                            " .  $row['description'] . "
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

<script>
    $(document).ready(function() {
        $(".table-responsive").floatingScroll();
    });
</script>

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
                if (td[0].innerHTML.toUpperCase().indexOf(filter) > -1 || td[1].innerHTML.toUpperCase().indexOf(filter) > -1 || td[2].innerHTML.toUpperCase().indexOf(filter) > -1) {
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
    function printTable() {
        var headerforprint = document.getElementById("headerforprint");
        headerforprint.style.display = 'block';
        var divToPrint = document.getElementById("toPrint");
        newWin = window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
        headerforprint.style.display = 'none';
    }
</script>

</html>