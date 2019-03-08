<!DOCTYPE html>
<html lang="en">

<head>

  <script type="text/javascript">
        function hideinvalidated() {
            //alert('ok');
            var checked = $(this).is(':checked');
            $("#myTable #validity0").each(function() {
            if (checked)
              $(this).show(); //Show if checkbox is checked
            else
              $(this).hide(); //Hide if checkbox is not checked
            });
            //document.getElementById('validity0').hide();
        }
        window.onload = hideinvalidated;
        </script>

  <?php 
  include('conn.php');
  include('session.php');
  ?>

  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Expenses
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/now-ui-dashboard.css?v=1.2.0" rel="stylesheet" />
  <link href="assets/css/now-ui-kit.css?v=1.2.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      <div class="logo">
        <a href="#" class="simple-text logo-mini">
          ICHS
        </a>
        <a href="#" class="simple-text logo-normal">
          Alumni 2018
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class=>
            <a href="dashboard.php">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li>
            <a href="registration.php">
              <i class="now-ui-icons business_badge"></i>
              <p>Registration</p>
            </a>
          </li>
          <li>
            <a href="donation.php">
              <i class="now-ui-icons business_money-coins"></i>
              <p>Donation</p>
            </a>
          </li>
          <li class="active ">
            <a href="expenses.php">
              <i class="now-ui-icons shopping_credit-card"></i>
              <p>Expenses</p>
            </a>
          </li>
          <li>
            <a href="otherincome.php">
              <i class="now-ui-icons shopping_cart-simple"></i>
              <p>Other Income</p>
            </a>
          </li>
          <li>
            <a href="batchlist.php">
              <i class="now-ui-icons files_single-copy-04"></i>
              <p>Batch List</p>
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
            <button class="btn btn-info btn-round btn-lg" data-toggle="modal" data-target="#registerModal" data-dismiss="modal">Add Expenses</button>
            <span style="margin: 20px;"></span>

            <?php
              $sql1 = "SELECT count(amount) as regbatch FROM expenses WHERE valid=1;";
              $result1 = $conn->query($sql1);

              $sql2 = "SELECT SUM(amount) as totalreg FROM expenses WHERE valid=1;";
              $result2 = $conn->query($sql2);

              if($result1->num_rows > 0){
                $row1 = $result1->fetch_assoc();
              }
              if($result2->num_rows > 0){
                $row2 = $result2->fetch_assoc();
              }

              $totalregformat = number_format($row2['totalreg'],2,".",",");
                  
            ?>
            <a class="navbar-brand" href="#">Number of Expenses: <strong><?php echo $row1['regbatch']; ?></strong></a>
            <span style="margin: 20px;"></span>
            <a class="navbar-brand" href="#">Total Amount: <strong>&#8369; <?php echo $totalregformat; ?></strong></a>
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
                  <a class="dropdown-item" href="logout.php">Logout</a>
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
                        <h4 class="card-title"> Expenses List</h4>
                        <!--<i class="now-ui-icons arrows-1_minimal-down"></i>-->
                      </div>
                </a>
                </div>
                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                  <div class="card-body">
                    <div class="form-check form-check-inline">
                      
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" id="validityCheckbox1" value="invalid1">Show Invalid Amounts
                          <span class="form-check-sign"></span>
                        </label>
                      </div>
                  </div>
                </div>
              </div>
              
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="myTable">
                    <thead class=" text-primary">
                      <th onclick="sortTable(0)">
                        Control Number
                      </th>
                      <th onclick="sortTable(1)">
                        Description
                      </th>
                      <th onclick="sortTable(2)">
                        Amount
                      </th>
                      <th onclick="sortTable(3)">
                        Encoded
                      </th>
                      <th class="text-right" >
                        Action
                      </th>
                    </thead>
                    <tbody>
                      <?php 
                          $sql = "SELECT * FROM expenses ORDER BY datetime DESC";
                          $result = $conn->query($sql);
                          $rowi = 1;

                          if ($result->num_rows > 0) {
                              // output data of each row
                              while($row = $result->fetch_assoc()) {
                                  
                                  $moneyformat = number_format($row['amount'],2,".",",");
                                  

                                  if ($row['description'] == '') {
                                    $dname = "-";
                                  }else{
                                    $dname = $row['description'];
                                  }


                                  if($row['valid'] == 0){
                                    $moneystrike = '<del>&#8369; '.$moneyformat.'</del?';
                                    $validity = 'id="validity0"';
                                    $validitycontrol = "Invalidated (".$row['invalidity'].")" ;
                                  }else{
                                    $moneystrike = "&#8369; ".$moneyformat;
                                    $validity = '';
                                    $validitycontrol = '<button type="button" onclick="getRowID('.$rowi.')" rel="tooltip" class="btn          btn-success btn-sm btn-round btn-icon" data-toggle="modal" title="Print" data-target="#printModal" data-dismiss="modal">
                                                              <i class="now-ui-icons education_paper"></i>
                                                          </button>
                                                          <button type="button" onclick="getRowID('.$rowi.')" rel="tooltip" class="btn btn-danger btn-sm btn-round btn-icon" data-toggle="modal" title="Invalidate Data" data-target="#verifyModal1" data-dismiss="modal">
                                                              <i class="now-ui-icons ui-1_simple-remove"></i>
                                                          </button>';
                                  }
                                  
                                  echo "<tr ".$validity.">
                                          <td>
                                            ".$row['id']."
                                          </td>
                                          <td>
                                            ".$dname."
                                          </td>
                                          <td id='invalidmoney'>
                                            ".$moneystrike."
                                          </td>
                                          <td>
                                            ".$row['datetime']."
                                          </td>
                                          <td class='td-actions text-right'>
                                            ".$validitycontrol."
                                          </td>
                                        </tr>";
                              $rowi++;}
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
                  ICHS
                </a>
              </li>
              <li>
                <a href="#">
                  Alumni
                </a>
              </li>
              <li>
                <a href="#">
                  2018
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright" id="copyright">
            &copy;
            <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>, Designed by
            <a href="#" target="_blank">uno</a>. Coded by
            <a href="#" target="_blank">uno</a>.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/core/bootstrap-notify.js"></script>
  <script src="assets/js/core/bootstrap-notify.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="assets/js/angular.min.js"></script>
  <!--  Google Maps Plugin    
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  -->
  <!-- Chart JS -->
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/now-ui-dashboard.min.js?v=1.2.0" type="text/javascript"></script>
  <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
  <!-- Add for converting number to amount -->
  <script src="assets/js/js-webshim/minified/polyfiller.js"></script>
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
<script src="assets/js/plugins/bootstrap-switch.js"></script>
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
<script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--  Google Maps Plugin 
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
-->
<!-- Chart JS -->
<script src="assets/js/plugins/chartjs.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="assets/js/now-ui-dashboard.js?v=1.1.0" type="text/javascript"></script>
<!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>
<script src="assets/js/now-ui-kit.js?v=1.2.0" type="text/javascript"></script>









</body>

<div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Print</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card" id="divToPrint">
          <div class="card-body">
            <blockquote class="blockquote blockquote-primary mb-0">
              <p>ICHS Alumni 2018</p>
              <p id="print_validate_no"></p>
              <p>-----EXPENSES-----</p>
              <p id="print_donor"></p>
              
              <p id="print_amount"></p>
              <footer class="blockquote-footer">Printed <?php date_default_timezone_set("Asia/Singapore"); echo date('Y/d/m h:i:sa');?></footer>
            </blockquote>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="PrintDiv();">Print</button>
      </div>
    </div>
  </div>
</div>

<div id="verifyModal1" class="modal fade modal-mini modal-danger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header justify-content-center">
            <div class="modal-profile">
              <i class="now-ui-icons users_circle-08"></i>
            </div>
          </div>
          <div class="modal-body">
            <form method="post" action="verify.php">
              <div class="form-group row">
                <div class="col-sm-12 text-center"><h4 id="display_validate_no"></h4></div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12">
                  <input type="password" class="form-control" id="inputPassword" placeholder="Verify Password" name="verifyPassword">
                </div>
                <div class="col-sm-12">
                  <input type="hidden" class="form-control" id="display_validate_no_txt" name="invalidated_id">
                </div>
                <div class="col-sm-12">
                  <input type="hidden" class="form-control" id="" name="from" value="expenses.php">
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

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="registerModal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" >
    <form method="post" action="spend.php" id="registerBatchForm" name="registration_form">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Expenses</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Description</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="descripton"></textarea>
        </div>       
        <label for="exampleFormControlSelect1">Amount</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text"><i>&#8369;</i></div>
          </div>
            <input type="number" name="amount" class="form-control form-control-lg" required="required">
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <input type="Submit"  class="btn btn-primary" value="Submit">
      </div>
    </div>
    </form>
  </div>
</div>

<script>
  //webshim.setOptions('basePath', '/js-webshim/minified/shims/');

  //request the features you need:
  webshim.polyfill('es5 mediaelement forms');
  
  $(function(){
    // use all implemented API-features on DOM-ready
    webshims.setOptions('forms-ext', {
    replaceUI: 'auto',
    types: 'number'
    });
    webshims.polyfill('forms forms-ext');
  });
</script>

<script>
  $('.modal').on('hidden.bs.modal', function(){
      $(this).find('form')[0].reset();
  });
</script>

<?php

if(isset($_GET['sucess'])){
    $moneyformat2 = number_format($_GET['a'],2,".",",");
    echo "<script>
            $.notify({
            
            title: 'Data Successfully Saved',
            message: 'Donor <strong>".$_GET['d']." ".$_GET['b']."</strong> Amount: <strong>&#8369;".$moneyformat2."</strong>' 
            },{
            
            type: 'success'
            });
          </script> ";
  }
  if(isset($_GET['invalidpassword'])){

    echo "<script>
            $.notify({
            
            title: '<strong>Error</strong>',
            message: '<strong>Invalid Password</strong>' 
            },{
            
            type: 'danger',
            allow_dismiss: false

            });

          </script> ";
        }
  if(isset($_GET['batch_error'])){

    echo "<script>
            $.notify({
            
            title: '<strong>Error</strong>',
            message: 'Invalid Batch Year: <strong>".$_GET['b']."</strong>' 
            },{
            
            type: 'danger',
            allow_dismiss: false

            });

          </script> ";

  }
  if(isset($_GET['invalidatesuccess'])){

    echo "<script>
            $.notify({
            
            title: '<strong>Invalidated</strong>',
            message: 'Control Number was invalidated' 
            },{
            
            type: 'warning',
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
      switchcount ++; 
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
  
   $(function() {
      $('#validityCheckbox1').click(function() {
        //var user_type = $(this).data("id1");
        var checked = $(this).is(':checked');
        //tr = table.getElementsByTagName("tr");

        //for (i = 0; i < tr.length; i++) {

          $("#myTable #validity0").each(function() {
            if (checked)
              $(this).show(); //Show if checkbox is checked
            else
              $(this).hide(); //Hide if checkbox is not checked
          });

        //}

        //$('.test').html(user_type);
      });
    });

</script>

<script>
  
function getRowID(r) {
  var reg = document.getElementById("myTable").rows[r].cells.item(0).innerHTML;
  var dsc = document.getElementById("myTable").rows[r].cells.item(1).innerHTML;
  //var bch = document.getElementById("myTable").rows[r].cells.item(2).innerHTML;
  var amt = document.getElementById("myTable").rows[r].cells.item(2).innerHTML;
  document.getElementById("display_validate_no").innerHTML = "Invalidate "+reg+"?";
  document.getElementById("print_validate_no").innerHTML = "Control Number: "+reg;
  document.getElementById("print_donor").innerHTML = "Description: "+dsc;
  //document.getElementById("print_batch_no").innerHTML = "Batch: "+bch;
  document.getElementById("print_amount").innerHTML = "Amount "+amt;
  $("#display_validate_no_txt").val(reg);
}

</script>

<script type="text/javascript">     
        function PrintDiv() {    
           var divToPrint = document.getElementById('divToPrint');
           var popupWin = window.open('', '_blank', 'width=800,height=600');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
           popupWin.document.close();
                }
     </script>

</html>