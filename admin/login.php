<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin Login</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body>
  <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="../index.php">Sustainable Portfolio</a>
      <!--<a class="btn btn-primary" href="#">Sign In</a>-->
    </div>
  </nav>
  <style>
  body{
    background: url("../img/bg-masthead.jpg") no-repeat center center;
  }
  .signup{
    background-color:#FF7744;
    border: #FF0000;
  }
  .signup :hover{
    background-color:#FF5511 !important;
  }
  *{
    transition: all 1s;
  }
  </style>
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div id="sign_part" class="col-lg-9" hidden>
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Register!</h1>
                  </div>
                  <form action="" class="user" method="POST">
                    <div class="form-group">
                      <input type="text" name="RegisterName" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <input type="email" name="RegisterMail" class="form-control form-control-user" id="exampleInputPassword" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                      <input type="password" name="RegisterPassword" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <input type="password" name="VerifyPassword" class="form-control form-control-user" id="exampleInputPassword" placeholder="Verify Password">
                    </div>
                    <button type="submit" class="btn btn-block btn-lg btn-primary">Submit!</button>
                  </form>
                </div>
              </div>
              <div class="col-lg-3 d-none d-lg-block bg-login-image"></div>
              <div id="login_part" class="col-lg-9">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <form action="" class="user" method="POST">
                    <div class="form-group">
                      <input type="text" name="username" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <div class="form-group"  style="padding-top:1.6vh !important;">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-lg btn-primary">Login!</button>
                    <a href="#signup" class="btn btn-block btn-lg btn-primary signupbut" style="background-color:#FF5511; border:#FF0000; ">Sign up!</a>
                    <!--<a class="btn btn-primary btn-user btn-block">
                      Login
                    </a>-->
                    <?php
                    include '../config.php';
                    session_start();
                    $count = 0;
                    $connect = mysqli_connect($servername ,$username ,$password ,$db_select);
                    if(isset($_POST['username']) && isset($_POST['password'])){
                      $userid = $_POST['username'];
                      $userpass = $_POST['password'];
                      $action = "SELECT * FROM `admin_list` WHERE `Account` LIKE '$userid' AND `password` LIKE '$userpass' ORDER BY `password` ASC";
                      $result = mysqli_query($connect, $action);
                      $ans = mysqli_fetch_assoc($result);
                      if($ans){
                        $_SESSION['username'] = $ans['Account'];
                        $_SESSION['password'] = $ans['password'];
                        /*echo "<script>alert('success')</script>";*/
                        $url = "index.php";
                        echo "<script type='text/javascript'>";
                        echo "window.location.href='$url'";
                        echo "</script>"; 
                      }else{
                        echo "<script>alert('Wrong username or password!')</script>";
                      }
                    }
                    ?>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
