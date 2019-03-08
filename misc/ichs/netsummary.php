<!DOCTYPE html>
<html>
<head>
<?php
  include('conn.php');

  $sql = "SELECT SUM(amount) as totalreg FROM registration WHERE valid=1;";
  $result = $conn->query($sql);

  if($result->num_rows > 0){
      $row = $result->fetch_assoc();
      $reg = $row['totalreg'];
  }

  $sql1 = "SELECT SUM(amount) as totalreg FROM donation WHERE valid=1;";
  $result1 = $conn->query($sql1);

  if($result1->num_rows > 0){
      $row1 = $result1->fetch_assoc();
      $don = $row1['totalreg'];
  }

  $sql2 = "SELECT SUM(amount) as totalreg FROM otherincome WHERE valid=1;";
  $result2 = $conn->query($sql2);

  if($result2->num_rows > 0){
      $row2 = $result2->fetch_assoc();
      $oth = $row2['totalreg'];
  }

  $sql3 = "SELECT SUM(amount) as totalreg FROM expenses WHERE valid=1;";
  $result3 = $conn->query($sql3);

  if($result3->num_rows > 0){
      $row3 = $result3->fetch_assoc();
      $exp = $row3['totalreg'];
  }

  $totalinc = ($reg + $don + $oth) - $exp;

  $totalreg = number_format($reg,2,".",",");
  $totaldon = number_format($don,2,".",",");
  $totaloth = number_format($oth,2,".",",");
  $totalexp = number_format($exp,2,".",",");

  $totalformat = number_format($totalinc,2,".",",");

?>

	<title>Net Income Summary</title>

	 <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
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
<body>
  <div class="wrapper ">
    <div class="container">
      <div class="content">
        
        <div class="col-md-12">
            <div class="card card-plain">
              <div class="card-header">
                <h4 class="card-title"> Summary of Net Income</h4>
                <p class="category"> Gross Income = Total Registration + Total Donation + Other Income(Total) <span style="color: red;">(LESS Total Expenses)</span></p>  
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                      <thead class=" text-primary">
                        <th>
                          List
                        </th>
                        <th class="text-right">
                          Amount
                        </th>
                      </thead>
                        <tbody>
                          <tr>
                            <td>
                            Total Registration 
                            </td>
                            <td class="text-right">
                            &#8369; <?php echo $totalreg; ?>
                            </td>  
                          </tr>
                          <tr>
                            <td>
                            Total Donation 
                            </td>
                            <td class="text-right">
                            &#8369; <?php echo $totaldon; ?>
                            </td>  
                          </tr>
                          <tr>
                            <td>
                            Other Income (Total) 
                            </td>
                            <td class="text-right">
                            &#8369; <?php echo $totaloth; ?>
                            </td>  
                          </tr>
                          <tr>
                            <td>
                            -----LESS-----
                            </td>
                            <td>
                            <td class="text-right">
                            </td>  
                          </tr>
                          <tr>
                            <td>
                            Total Expenses 
                            </td>
                            <td class="text-right" style="color: red">
                            &#8369; <?php echo $totalexp; ?>
                            </td>  
                          </tr>
                          <tr>                            
                            <td  class="text-right">
                            <strong>Net Income (Total)</strong> 
                            </td>
                            <td class="text-right">
                            <strong>&#8369; <?php echo $totalformat; ?></strong>
                            </td>  
                          </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

      </div>
    </div>
  </div>



</body>

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


<script>
    $(document).ready(function() {
      // the body of this function is in assets/js/now-ui-kit.js
      nowuiKit.initSliders();
    });

    function scrollToDownload() {

      if ($('.section-download').length != 0) {
        $("html, body").animate({
          scrollTop: $('.section-download').offset().top
        }, 1000);
      }
    }
  </script>

</html>
