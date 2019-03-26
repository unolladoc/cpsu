<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  session_start();
  if(isset($_SESSION['id'])){
      header("Location: home.php");
    }
  ?>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Login
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/now-ui-kit.css?v=1.2.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="login-page sidebar-collapse">
  <!-- Navbar -->
  <!--<nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transparent " color-on-scroll="400">
    <div class="container">
      <div class="dropdown button-dropdown">
        <a href="#pablo" class="dropdown-toggle" id="navbarDropdown" data-toggle="dropdown">
          <span class="button-bar"></span>
          <span class="button-bar"></span>
          <span class="button-bar"></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-header">Dropdown header</a>
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Separated link</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">One more separated link</a>
        </div>
      </div>
      <div class="navbar-translate">
        <a class="navbar-brand" href="https://demos.creative-tim.com/now-ui-kit/index.html" rel="tooltip" title="Designed by Invision. Coded by Creative Tim" data-placement="bottom" target="_blank">
          Now Ui Kit
        </a>
        <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-bar top-bar"></span>
          <span class="navbar-toggler-bar middle-bar"></span>
          <span class="navbar-toggler-bar bottom-bar"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="../assets/img/blurred-image-1.jpg">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="../index.html">Back to Kit</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://github.com/creativetimofficial/now-ui-kit/issues">Have an issue?</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" rel="tooltip" title="Follow us on Twitter" data-placement="bottom" href="https://twitter.com/CreativeTim" target="_blank">
              <i class="fab fa-twitter"></i>
              <p class="d-lg-none d-xl-none">Twitter</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" rel="tooltip" title="Like us on Facebook" data-placement="bottom" href="https://www.facebook.com/CreativeTim" target="_blank">
              <i class="fab fa-facebook-square"></i>
              <p class="d-lg-none d-xl-none">Facebook</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" rel="tooltip" title="Follow us on Instagram" data-placement="bottom" href="https://www.instagram.com/CreativeTimOfficial" target="_blank">
              <i class="fab fa-instagram"></i>
              <p class="d-lg-none d-xl-none">Instagram</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>-->
  <!-- End Navbar -->
  <div class="page-header clear-filter" filter-color="orange">
    <div class="page-header-image" style="background-image:url(/assets/img/login.jpg)"></div>
    <div class="content">
      <div class="container">
        <div class="col-md-4 ml-auto mr-auto">
          <div class="card card-login card-plain">
            <form class="form" method="post" action="login.php">
              <div class="card-header text-center">
                <div class="logo-container">
                  <img src="assets/img/favicon.png" alt="">
                </div>
              </div>
              <div class="card-body">
                  <?php 
                  if(isset($_GET['invalid'])){
                    echo '<div class="alert alert-danger" role="alert">
                            <div class="container">
                              <div class="alert-icon">
                                <i class="now-ui-icons ui-1_bell-53"></i>
                              </div>
                              <strong>Invalid Username or Password</strong>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">
                                  <i class="now-ui-icons ui-1_simple-remove"></i>
                                </span>
                              </button>
                            </div>
                          </div>';
                  }
                  if(isset($_GET['notloggedin'])){
                    echo '<div class="alert alert-danger" role="alert">
                            <div class="container">
                              <div class="alert-icon">
                                <i class="now-ui-icons ui-1_bell-53"></i>
                              </div>
                              You are not logged in.
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">
                                  <i class="now-ui-icons ui-1_simple-remove"></i>
                                </span>
                              </button>
                            </div>
                          </div>';
                  }
                  if(isset($_GET['register']) && $_GET['register'] == 1){
                    echo '<div class="alert alert-info" role="alert">
                            <div class="container">
                              <div class="alert-icon">
                                <i class="now-ui-icons ui-1_bell-53"></i>
                              </div>
                              Registration Successful. Please wait for the Administrator to approve your account.
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">
                                  <i class="now-ui-icons ui-1_simple-remove"></i>
                                </span>
                              </button>
                            </div>
                          </div>';
                  }
                  if(isset($_GET['register']) && $_GET['register'] == 0){
                    echo '<div class="alert alert-danger" role="alert">
                            <div class="container">
                              <div class="alert-icon">
                                <i class="now-ui-icons ui-1_bell-53"></i>
                              </div>
                              Registration unsuccessful.
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">
                                  <i class="now-ui-icons ui-1_simple-remove"></i>
                                </span>
                              </button>
                            </div>
                          </div>';
                  }
                  ?>
                <div class="input-group no-border input-lg">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="now-ui-icons users_circle-08"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" placeholder="Username..." name="username">
                </div>
                <div class="input-group no-border input-lg">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="now-ui-icons objects_key-25"></i>
                    </span>
                  </div>
                  <input type="password" placeholder="Password..." class="form-control" name="password" />
                </div>
                <input type="submit" class="btn btn-primary btn-round btn-lg btn-block" name="" value="Login">
              </div>
              <div class="card-footer text-center">
                
                <div class="pull-center">
                  <h6>
                    <a href="#" class="link" data-toggle="modal" data-target="#createAccountModal">Create Account</a>
                  </h6>
                </div>
                <!--
                <div class="pull-right">
                  <h6>
                    <a href="#pablo" class="link">Need Help?</a>
                  </h6>
                </div>
              -->
            </form>
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
              <a href="">
                CPSU
              </a>
            </li>
            <!--
            <li>
              <a href="http://presentation.creative-tim.com">
                About Us
              </a>
            </li>
            <li>
              <a href="http://blog.creative-tim.com">
                Blog
              </a>
            </li> -->
          </ul>
        </nav>
        <div class="copyright" id="copyright">
          &copy;
          <script>
            document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
          </script>, Designed by
          <a href="" target="_blank">Xiari</a>. Coded by
          <a href="" target="_blank">Xiari</a>.
        </div>
      </div>
    </footer>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <script src="assets/js/plugins/bootstrap-switch.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
  <script src="assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <script src="assets/js/now-ui-kit.js?v=1.2.0" type="text/javascript"></script>
</body>

<div class="modal fade" id="createAccountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" enctype="multipart/form-data" action="register.php">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="form-group">
          <label for="">Name</label>
          <input type="text" class="form-control" name="caName" placeholder="Full Name" required>
        </div>
        <div class="form-group">
          <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="caUsername" placeholder="Username" required>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" id="caPassword" name="caPassword" placeholder="Password" required>
          </div>
          <div class="form-group">
            <label>Verify Password <span id="vperror" style="color: red;"></span></label>
            <input type="password" class="form-control" id="cavPassword" name="cavPassword" placeholder="Verify Password" required>
          </div>
        </div>
       

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="caSubmit">Submit</button>
      </div>

      
    </div>
     </form>
  </div>
</div>

<script>
  $('.modal').on('hidden.bs.modal', function(){
      $(this).find('form')[0].reset();
  });
</script>

<script type="text/javascript">
  
  $("#cavPassword").keyup(function(){
     if($(this).val() == $("#caPassword").val()){
        $("#vperror").text("");
        $("#caSubmit").removeAttr("disabled");
               //alert("values do not match");
               //more processing here
     }else{
         $("#vperror").text("Password does not match");
         $("#caSubmit").attr("disabled", "disabled");
     }
});

$("#caPassword").keyup(function(){
     if($(this).val() == $("#cavPassword").val()){
        $("#vperror").text("");
        $("#caSubmit").removeAttr("disabled");
               //alert("values do not match");
               //more processing here
     }else{
         $("#vperror").text("Password does not match");
         $("#caSubmit").attr("disabled", "disabled");
     }
});

</script>

</html>