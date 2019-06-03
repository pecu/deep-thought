<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <?php

  $name = $_POST[name];
  echo("<title>搜尋結果--");
  echo($name);
  echo("</title>");
  ?>
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/resume.min.css" rel="stylesheet">

</head>
<?php
$servername = "localhost";
$username = "root";
$password = "i-0842ffbbe1c95b180";
$db_select = "suspo";
$connect = mysqli_connect($servername ,$username ,$password ,$db_select);
$action = "SELECT className FROM `Teach_List` WHERE `teacherName` LIKE '$name'";
$result = mysqli_query($connect, $action);

?>
<body id="page-top">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
    <a class="navbar-brand js-scroll-trigger" href="#page-top">
    <span class="d-block d-lg-none"><?php echo($name); ?></span>
      <span class="d-none d-lg-block">
        <img class="iimg-fluid img-profile rounded-circle mx-auto mb-2" src="img/profile.jpg" alt="">
      </span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#about">About</a>
	</li>
<?php
	while($ans = mysqli_fetch_assoc($result))
	{
		echo "<li class='nav-item'>
			<a class='nav-link js-scroll-trigger' href='#";
		echo ($cert_list[$ans['className']]);
		echo "'>";
		echo ($ans['className']);
		echo "</a></li>";
		array_push($personal, $cert_list[$ans['className']]);
	}
	?>
        <!--<li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#education">Education</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#skills">Skills</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#interests">Interests</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#awards">Awards</a>
        </li>-->
      </ul>
    </div>
  </nav>

  <div class="container-fluid p-0">

    <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="about">
      <div class="w-100">
        <h1 class="mb-0" style = "margin: 0 0 2vh 0;">
	<?php echo $name; ?>
	</h1>
	<br>
	<h3>
<?php
	/*
	echo 'Cert: ';
	for($i = 0; $i < sizeof($personal);$i++)
	{
		echo $cert_list[$personal[$i]];
		if($i != sizeof($personal) - 1)
			echo ' ,';
		else
			echo ' ';
	}
	if(!i$personal[0])
		echo 'You have no record yet!';*/
	?>
	</h3>
        <!--<div class="subheading mb-5">3542 Berry Street · Cheyenne Wells, CO 80810 · (317) 585-8468 ·
          <a href="mailto:name@email.com">name@email.com</a>
        </div>-->
        <!--<p class="lead mb-5">I am experienced in leveraging agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition.</p>-->
        <div class="social-icons">
          <a href="#">
            <i class="fab fa-linkedin-in"></i>
          </a>
          <a href="#">
            <i class="fab fa-github"></i>
          </a>
          <a href="#">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#">
            <i class="fab fa-facebook-f"></i>
          </a>
	</div>
      </div>
    </section>

    <hr class="m-0">
    <?php
    /*for($i = 0; $i < sizeof($personal); $i++)
    {
    	if($personal[$i] == "BlockChainCsx")
   	{
    		echo '<section class="resume-section p-3 p-lg-5 d-flex justify-content-center" id="BlockChainCsx">
      			<div class="w-100">
			<h2 class="mb-5">CS+X Blockchain</h2>
			<embed src = "https://ipfs.io/ipfs/';

		echo ($cert_img_list[0]);
		echo '" width="750" height = "630" type="application/pdf"';
     		echo '	</div>
    		</section>';
	}
    }*/
    ?>
    <hr class="m-0">
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/resume.min.js"></script>

</body>

</html>
