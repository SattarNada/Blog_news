
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>prevention against covid-19</title>
	<meta content="" name="descriptison">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="assets/img/intro-carousel/333.png" rel="icon">


	<!--  Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

	<!-- links CSS Files -->
	<link href="assets/links/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/links/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="assets/links/ionicons/css/ionicons.min.css" rel="stylesheet">
	<link href="assets/links/animate.css/animate.min.css" rel="stylesheet">
	<link href="assets/links/venobox/venobox.css" rel="stylesheet">
	<link href="assets/links/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">

	<!-- CSS File -->
	<link href="assets/css/styleproject.css" rel="stylesheet">

	
</head>

<body>

	<!-- ======= Header ======= -->
	<header id="header"style='background:purple;'>
		<div class="container-fluid">

			<div id="logo" class="pull-left">
				<h1><a href="index.php" class="scrollto" >news</a></h1>
				
			</div>

			<nav id="nav-menu-container">
				<ul class="nav-menu">
					<?php 
						$idH = mysqli_fetch_array(mysqli_query($con, "SELECT id FROM tblcategory WHERE CategoryName = 'Histoire'"));
						$idP = mysqli_fetch_array(mysqli_query($con, "SELECT id FROM tblcategory WHERE CategoryName = 'Prévention'"));
						$idA = mysqli_fetch_array(mysqli_query($con, "SELECT id FROM tblpages WHERE PageName = 'About Us'"));
						$idC = mysqli_fetch_array(mysqli_query($con, "SELECT id FROM tblpages WHERE PageName = 'Contact Us'"));
					 ?>
					<li><a href="<?php if(isset($index)) echo "#news"; else echo "index.php#news"; ?>">Actualité</a></li>
					<li><a href="allnews.php?idc=<?php echo($idH['id']); ?>">Histoire</a></li>
					<li><a href="statistics.php">Statistique</a></li>
					<li><a href="allnews.php?idc=<?php echo($idP['id']); ?>">Prévention</a></li>
					<li><a href="<?php echo "page.php?id=".$idA['id']; ?>">About Us</a></li>
					<li><a href="<?php echo "page.php?id=".$idC['id']; ?>">Contact</a></li>
					<li> 
						<a href="admin.php"><i class="fa fa-user" aria-hidden="true"></i></a>
					</li>
		<div id="search-wrapper">
			<form action="search.php" id="searchF" method="get">
					<input type="text" id="search" name="searchT" placeholder="Searching something...">
					<div id="close-icon"></div>
					<input class="d-none" type="submit" value="">
			</form>
	</div>
				</ul>
			</nav><!-- #nav-menu-container -->
		</div>
	</header><!-- End Header -->

	<script type="text/javascript">
		var form = document.getElementById("searchF");

		document.getElementById("searchB").addEventListener("click", function () {
			form.submit();
		});
	</script>
