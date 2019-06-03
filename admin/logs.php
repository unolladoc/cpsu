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
                            $sqld = "SELECT * FROM files WHERE NOT EXISTS (Select * FROM logs WHERE logs.file_id = files.id AND logs.author = " . $_SESSION['id'] . ") AND archive = 0;";
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
                    <li><a href="https://docs.google.com/document/?usp=docs_alc&authuser=0" target="_blank">
                            <i class="now-ui-icons education_paper"></i>
                            <p>Create NEW (Google Doc)</p>
                        </a>
                    </li>
                    <li>
                        <a href="members.php">
                            <i class="now-ui-icons users_single-02"></i>
                            <p>Members</p>
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
                                        <h4 class="card-title"> Logs</h4>
                                        <!--<i class="now-ui-icons arrows-1_minimal-down"></i>-->
                                    </div>

                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
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

</html>