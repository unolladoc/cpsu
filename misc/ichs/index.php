<!DOCTYPE html>
<html>
<head>
<?php
include('conn.php');
session_start();
?>

	<title>ICHS</title>

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

<script>
setInterval(function() {
    //('#totalincome').fadeOut("fast").load('totalincomerefresh.php').fadeIn("fast");
    $('#grossincome').fadeOut("fast").load('grossincomerefresh.php').fadeIn("fast");
    $('#netincome').fadeOut("fast").load('netincomerefresh.php').fadeIn("fast");
    $('#totalreg').fadeOut("fast").load('totalregrefresh.php').fadeIn("fast");
    $('#totaldon').fadeOut("fast").load('totaldonrefresh.php').fadeIn("fast");
    $('#totalexp').fadeOut("fast").load('totalexprefresh.php').fadeIn("fast");
    $('#totaloth').fadeOut("fast").load('totalothrefresh.php').fadeIn("fast");
}, 10000);
</script>

</head>
<body>

<ul class="nav justify-content-end">
  <li class="nav-item">
    <form method="post" action="summary.php" id="batchsummaryform">
    <select class="form-control form-control-md" id="exampleFormControlSelect1" name="batch_no">
      <?php 
                $sql = "SELECT * FROM batch";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<option>".$row["batch_no"]."</option>";
                    }
                } else {
                    echo "<option>No Results</option>";
                }
                
      ?>
    </select>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="#" id="submitId">Summary</a>
    </form>
  </li>
  <li class="nav-item">
    <?php 
    if(isset($_SESSION['id'])){
      echo '<a class="nav-link" href="dashboard.php" id="">Dashboard</a>';
    }else{
      echo '<a class="nav-link" href="#" id="loginId">Login</a>';
    }
    ?>
  </li>
</ul>

<div>
  <h1 style="margin-bottom:0px;" class="text-center">ICHS ALUMNI 2018</h1>
</div>
<div>
  <h2 style="margin-bottom:0px;" class="text-center"><strong>DONORS</strong></h2>
</div>

<div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner btn-warning" role="listbox" id="carouselExampleItem">
    <div class="carousel-item active">
      <div class="content">
        <div class="row text-center">
          <div class="col-md-12">
              <h2 style="margin:auto; padding: 30px;"><i class="now-ui-icons loader_refresh spin"></i></h2>
          </div>
        </div>
      </div>
    </div>
    <?php 
      $sql = "SELECT * FROM donation where valid=1 ORDER BY datetime DESC";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
      
      $moneyformat = number_format($row['amount'],2,".",",");
      
      if ($row['batch_no'] == 0000) {
            $batch = "";
          }else{
            $batch = $row['batch_no'];
          }

          if ($row['name'] == '') {
            $dname = "";
          }else{
            $dname = $row['name'];
          }                                 
            echo '
                  <div class="carousel-item">
                    <div class="content">
                      <div class="row text-center">
                        <div class="col-md-12">
                            <h2 style="margin:auto; padding: 10px;">'.$batch.' '.$dname.'<br><strong>&#8369; '.$moneyformat.'</strong></h2>
                        </div>
                      </div>
                    </div>
                  </div>
            '


            ;
        }
    } else {
        echo "<option>No Results</option>";
    }
    
?>

    
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
    <i class="now-ui-icons arrows-1_minimal-left"></i>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
    <i class="now-ui-icons arrows-1_minimal-right"></i>
  </a>
</div>

<div>
  <h4 style="margin-bottom:0px;" class="text-center">Click to View Summary</h4>
</div>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0"class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <div class="content">
        <div class="row" style="padding: 40px;">
          <div class="col-md-12">
            <div class="card text-center btn-primary" id="grossincome" style="margin: auto;">
              <h2>GROSS INCOME<br><i class="now-ui-icons loader_refresh spin"></i></h2>
            </div>
          </div>
          <!--<div class="col-md-6">
            <div class="card text-center btn-info" id="grossincomeold" style="margin: auto;">
              <h2>GROSS INCOME<br><i class="now-ui-icons loader_refresh spin"></i></h2>
            </div>
          </div>-->
          <div class="col-md-12">
            <div class="card text-center btn-success" id="netincome" style="margin: auto;">
              <h2>NET INCOME<br><i class="now-ui-icons loader_refresh spin"></i></h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <div class="content">
        <div class="row" style="padding: 40px;">
          <div class="col-md-6">
            <div class="card text-center btn-primary" id="totalreg" style="margin: auto;">
              <h2>Total Registration<br><i class="now-ui-icons loader_refresh spin"></i></h2>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card text-center btn-success" id="totaldon" style="margin: auto;">
              <h2>Total Donation<br><i class="now-ui-icons loader_refresh spin"></i></h2>
            </div>
          </div> 
          <div class="col-md-6">
            <div class="card text-center btn-info" id="totaloth" style="margin: auto;">
              <h2>Other Income<br><i class="now-ui-icons loader_refresh spin"></i></h2>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card text-center btn-danger" id="totalexp" style="margin: auto;">
              <h2>Total Expenses<br><i class="now-ui-icons loader_refresh spin"></i></h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <i class="now-ui-icons arrows-1_minimal-left"></i>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <i class="now-ui-icons arrows-1_minimal-right"></i>
  </a>
</div>

</body>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="summaryModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      ...
    </div>
  </div>
</div>

<div id="loginModal" class="modal fade modal-mini modal-danger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header justify-content-center">
            <div class="modal-profile">
              <i class="now-ui-icons users_circle-08"></i>
            </div>
          </div>
          <div class="modal-body">
            <form method="post" action="login.php">
              <div class="form-group row">
                <div class="col-sm-12 text-center"><h4 id="">LOGIN</h4></div>
                <div class="col-sm-12">
                  <input type="password" class="form-control" id="inputUsername" placeholder="Username" name="verifyUsername">
                </div>
              </div>
              <div class="form-group row">
                
                <div class="col-sm-12">
                  <input type="password" class="form-control" id="inputPassword" placeholder="Verify Password" name="verifyPassword">
                </div>
                <div class="col-sm-12">
                  <input type="hidden" class="form-control" id="" name="">
                </div>
                <div class="col-sm-12">
                  <input type="hidden" class="form-control" id="" name="" value="">
                </div>
              </div>
           
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-link btn-neutral">Login</button>
            <button type="button" class="btn btn-link btn-neutral" data-dismiss="modal">Close</button>
            </form>
          </div>
        </div>
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

<script>
  document.getElementById("submitId").onclick = function() {
  document.getElementById("batchsummaryform").submit();
}
</script>

<script>
$(document).ready(function(){
  $("#loginId").click(function(){
    $("#loginModal").modal();
  });
});
</script>

<script> 
$('#grossincome').click(function () {
  window.location = 'grosssummary.php';
});
$('#netincome').click(function () {
  window.location = 'netsummary.php';
});
$('#totalreg').click(function () {
  window.location = 'registrationlist.php';
});
$('#totaldon').click(function () {
  window.location = 'donationlist.php';
});
$('#carouselExampleItem').click(function () {
  window.location = 'donationlist.php';
});
$('#totaloth').click(function () {
  window.location = 'otherincomelist.php';
});
$('#totalexp').click(function () {
  window.location = 'expenseslist.php';
});
</script>

<?php
 if(isset($_GET['invalid'])){

    echo "<script>
            $.notify({
            
            title: '<strong>Error</strong>',
            message: 'Invalid <strong>Username</strong> or <strong>Password</strong>' 
            },{
            
            type: 'danger',
            allow_dismiss: false

            });

          </script> ";

  }
  if(isset($_GET['notloggedin'])){

    echo "<script>
            $.notify({
            
            title: '<strong>Warning</strong>',
            message: 'You are not logged in' 
            },{
            
            type: 'warning',
            allow_dismiss: false

            });

          </script> ";

  }
?>

</html>