<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sustainable portfolio</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="css/landing-page.min.css" rel="stylesheet">
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">Sustainable Portfolio</a>
      <!--<a class="btn btn-primary" href="#">Sign In</a>-->
    </div>
  </nav>

  <!-- Masthead -->
  <header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h1 class="mb-5">Applying Blockchain to Trace Your Sustainable Portfolio!</h1>
        </div>
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto" style = "margin: 5px 20px 5px 20px">
          <form action="#result" method="POST"> <!--action="" method = "POST"-->
            <div class="form-row">
              <div class="col-12 col-md-9 mb-2 mb-md-0">
		<input type="text" name="studentName" class="form-control form-control-lg" placeholder="Enter student's name...">
              </div>
              <div class="col-12 col-md-3">
                <button type="text" class="btn btn-block btn-lg btn-primary" data-toggle = "collapse" href="#collapsedev">Go</button>
              </div>
            </div>
          </form>
	</div>
	
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto" style = "margin: 5px 20px 5px 20px">
          <form action="#result" method="POST">
            <div class="form-row">
              <div class="col-12 col-md-9 mb-2 mb-md-0">
		<input type="text" name="teacherName" class="form-control form-control-lg" placeholder="Enter teacher's name...">
              </div>
              <div class="col-12 col-md-3">
                <button type="text" class="btn btn-block btn-lg btn-primary" data-toggle = "collapse" href="#collapsedev">Go</button>
              </div>
            </div>
          </form>
        </div>

        

        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto" style = "margin: 5px 20px 5px 20px">
          <form action="#result" method="POST"> <!--action="" method = "POST"-->
            <div class="form-row">
              <div class="col-12 col-md-9 mb-2 mb-md-0">
		<input type="text" name="assistantName" class="form-control form-control-lg" placeholder="Enter assistant's name...">
              </div>
              <div class="col-12 col-md-3">
                <button type="text" class="btn btn-block btn-lg btn-primary" data-toggle = "collapse" href="#collapsedev">Go</button>
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>
  </header>

  <section>
<?php

$servername = "localhost";
$username = "root";
$password = "i-0842ffbbe1c95b180";
$db_select = "suspo";
$connect = mysqli_connect($servername ,$username ,$password ,$db_select);
$action = "";

$haveResult = 0;

if( isset($_POST['studentName']) ){
  $name = $_POST['studentName'];
  $haveResult = 1;
  $action = "SELECT * FROM `Pass_List` WHERE `studentName` LIKE '$name'";
}
else if( isset($_POST['teacherName'])){
  $name = $_POST['teacherName'];
  $haveResult = 1;
  $action = "SELECT className FROM `Teach_List` WHERE `teacherName` LIKE '$name'";
}
else if( isset($_POST['assistantName'])){
  $name = $_POST['assistantName'];
  $haveResult = 1;
  $action = "SELECT className FROM `Assist_List` WHERE `assistantName` LIKE '$name'";
}

$result = mysqli_query($connect, $action);
?>

<?php
if($haveResult == 1):
  ?>

	<script>
	setTimeout(function(){
	window.scrollTo({ 
		top: 1000, 
		behavior: "smooth" 
	});},2);
  </script>

  <?php
endif;
?>


<div class="container" href="result" style="margin-top:5vh;margin-bottom:5vh;">
  <div class="row">

    <div class="col-2"> </div>

    <div class="col-3 mx-auto">
      <img src= <?php echo "./img/kTMKzGyMc.jpg" ?> class= "rounded-circle" height="150px" width="150px">
    </div>

    <div class="col-4 text-center" style=" text-align:center; line-height:150px;">
      <p style="font-size:8vh; font-weight:bolder;">
        <?php echo "$name"; ?>
      </p>
    </div>

    <div class="col-2"> </div>

  </div>
</div>

<div class="container">
  <hr>

  <div class="row">

    <div class="col-1"> </div>

    <div class="col-5 mx-auto text-center" style="background-color:rgba(0,0,0,0.1);">
      CERTS
    </div>

    <div class="col-2 mx-auto text-center"style="background-color:rgba(0,0,0,0.1);">
      證書內容
    </div>

    <div class="col-2"> </div>

  </div>

  <?php
    while($ans = mysqli_fetch_assoc($result)):
  ?>

  <div class="row">
      
    <div class="col-1"> </div>

    <div class="col-5 mx-auto">
      <h5 style="margin:2vh;margin-left:0; color:#007bff;">

        <?php
          // print class name
          if(isset($ans['className'])) {
            $className = $ans['className'];
            echo "$className";
          }
          else{
            echo "unknown class";
          }
        ?>

      </h5>
    </div>

    <div class="col-2 mx-auto" style="margin-left:0;">
      <button type="text" class="btn btn-block btn-primary center" style="margin-top:8%;" onclick=
        <?php 
          echo "\"location.href='";
          // print href

          if(isset($ans['ipfsIndex'])) {
            $ipfsIndex = $ans['ipfsIndex'];
            echo "https://ipfs.io/ipfs/"."$ipfsIndex";
          }
          else{
            echo "#"; // unknown ipfs link
          }

          echo "'\"";
        ?>
      >
        檢視
      </button>
    </div>

    <div class="col-2"> </div>

  </div>
    

  <?php
    endwhile;
  ?>

</div>
   
  </section>

  <!-- Image Showcases -->
  <!--<section class="showcase" id="collapsedev">
    <div class="container-fluid p-0">
      <div class="row no-gutters">

        <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('img/bg-showcase-1.jpg');"></div>
        <div class="col-lg-6 order-lg-1 my-auto showcase-text">
          <h2>Fully Responsive Design</h2>
          <p class="lead mb-0">When you use a theme created by Start Bootstrap, you know that the theme will look great on any device, whether it's a phone, tablet, or desktop the page will behave responsively!</p>
        </div>
      </div>
      <div class="row no-gutters">
        <div class="col-lg-6 text-white showcase-img" style="background-image: url('img/bg-showcase-2.jpg');"></div>
        <div class="col-lg-6 my-auto showcase-text">
          <h2>Updated For Bootstrap 4</h2>
          <p class="lead mb-0">Newly improved, and full of great utility classes, Bootstrap 4 is leading the way in mobile responsive web development! All of the themes on Start Bootstrap are now using Bootstrap 4!</p>
        </div>
      </div>
      <div class="row no-gutters">
        <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('img/bg-showcase-3.jpg');"></div>
        <div class="col-lg-6 order-lg-1 my-auto showcase-text">
          <h2>Easy to Use &amp; Customize</h2>
          <p class="lead mb-0">Landing Page is just HTML and CSS with a splash of SCSS for users who demand some deeper customization options. Out of the box, just add your content and images, and your new landing page will be ready to go!</p>
        </div>
      </div>
    </div>
  </section>-->

  <!-- Testimonials -->
  <!--<section class="testimonials text-center bg-light">
    <div class="container">
      <h2 class="mb-5">What people are saying...</h2>
      <div class="row">
        <div class="col-lg-4">
          <div class="testimonial-item mx-auto mb-5 mb-lg-0">
            <img class="img-fluid rounded-circle mb-3" src="img/testimonials-1.jpg" alt="">
            <h5>Margaret E.</h5>
            <p class="font-weight-light mb-0">"This is fantastic! Thanks so much guys!"</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="testimonial-item mx-auto mb-5 mb-lg-0">
            <img class="img-fluid rounded-circle mb-3" src="img/testimonials-2.jpg" alt="">
            <h5>Fred S.</h5>
            <p class="font-weight-light mb-0">"Bootstrap is amazing. I've been using it to create lots of super nice landing pages."</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="testimonial-item mx-auto mb-5 mb-lg-0">
            <img class="img-fluid rounded-circle mb-3" src="img/testimonials-3.jpg" alt="">
            <h5>Sarah W.</h5>
            <p class="font-weight-light mb-0">"Thanks so much for making these free resources available to us!"</p>
          </div>
        </div>
      </div>
    </div>
  </section>-->

  <!-- Call to Action -->
  <!--<section class="call-to-action text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h2 class="mb-4">Ready to get started? Sign up now!</h2>
        </div>
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
          <form>
            <div class="form-row">
              <div class="col-12 col-md-9 mb-2 mb-md-0">
                <input type="email" class="form-control form-control-lg" placeholder="Enter your email...">
              </div>
              <div class="col-12 col-md-3">
                <button type="submit" class="btn btn-block btn-lg btn-primary">Sign up!</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>-->

  <!-- Footer -->
  <footer class="footer bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
          <ul class="list-inline mb-2">
            <li class="list-inline-item">
	      <a href="./aboutus.php">關於我們</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Contact</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Terms of Use</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Privacy Policy</a>
            </li>
          </ul>
          <p class="text-muted small mb-4 mb-lg-0">&copy; Your Website 2019. All Rights Reserved.</p>
        </div>
        <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
          <ul class="list-inline mb-0">
            <li class="list-inline-item mr-3">
              <a href="#">
                <i class="fab fa-facebook fa-2x fa-fw"></i>
              </a>
            </li>
            <li class="list-inline-item mr-3">
              <a href="#">
                <i class="fab fa-twitter-square fa-2x fa-fw"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-instagram fa-2x fa-fw"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <!--<script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>-->
  
</body>

</html>
