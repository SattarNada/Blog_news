<?php 
session_start();

$index = true ; 
include('includes/config.php');
include('includespages/header.php');

?>


  <!-- ======= Intro Section ======= -->
  <section id="intro">
	<div class="intro-container">
	  <div id="introCarousel" class="carousel  slide carousel-fade" data-ride="carousel">

		<ol class="carousel-indicators"></ol>

		<div class="carousel-inner" role="listbox">

		<?php 
		$query = mysqli_query($con, "SELECT p.id, p.PostTitle, p.PostDetails, p.PostImage FROM tblposts AS p left join tblcategory AS c ON p.CategoryId = c.id WHERE c.CategoryName = 'Slider' AND p.Is_Active = 1 ORDER BY p.PostingDate") or die(mysqli_error($con));
		$n = 0;
		while ($row = mysqli_fetch_array($query)) 
		{ 
			if ($n++ == 0) echo '
			<div class="carousel-item active">'; else echo '<div class="carousel-item">'; ?>
		 		<div class="carousel-background">
		 			<img src="postimages/<?php 
		 				if(file_exists('postimages/'.$row['PostImage'])) 
		 					echo htmlentities($row['PostImage']); 
		 				else 
		 					echo('noimage.png'); ?>"
		 			 alt="">
		 		</div>
				<div class="carousel-container">
			  		<div class="carousel-content">
						<h2><?php echo($row['PostTitle']) ?></h2>
						<p><?php echo substr(strip_tags($row['PostDetails']), 0, 150)."..."; ?></p>
						<a href="single-post.php?id=<?php echo $row['id'] ?>" class="btn-get-started scrollto">Lire la suite &rarr;</a>
					</div>
				</div> <?php echo "
			</div>";
        } ?>
		</div>

		<a class="carousel-control-prev" href="#introCarousel" role="button" data-slide="prev">
		  <span class="carousel-control-prev-icon ion-chevron-left" aria-hidden="true"></span>
		  <span class="sr-only">Previous</span>
		</a>

		<a class="carousel-control-next" href="#introCarousel" role="button" data-slide="next">
		  <span class="carousel-control-next-icon ion-chevron-right" aria-hidden="true"></span>
		  <span class="sr-only">Next</span>
		</a>

	  </div>
	</div>
  </section><!-- End Intro Section -->
<!-- Posts Area Start -->
<section class="mag-posts-area d-flex flex-wrap">

<!--Post Left Sidebar Area-->
<div class="post-sidebar-area left-sidebar mt-30 mb-30 bg-white box-shadow">
	<!-- Sidebar Widget -->
	<div class="single-sidebar-widget p-30">
		<!-- Section Title -->
		<div class="section-heading">
			<h5>NOUVELLES RÉCENTES</h5>
		</div>

		<?php 
		$query=mysqli_query($con,"SELECT p.id, p.PostTitle, p.PostDetails, p.PostImage FROM tblposts AS p left join tblcategory AS c ON p.CategoryId = c.id WHERE c.CategoryName != 'Slider' AND p.Is_Active = 1 ORDER BY p.PostingDate LIMIT 6");
		while($row=mysqli_fetch_array($query))
		{ ?>
			<!-- Single Blog Post -->
			<div class="single-blog-post d-flex">
				<div class="post-thumbnail">
					<img src="postimages/<?php 
		 				if(file_exists('postimages/'.$row['PostImage'])) 
		 					echo htmlentities($row['PostImage']); 
		 				else 
		 					echo('noimage.png');
		 			 ?>" alt="">
				</div>
				<div class="post-content">
					<a href="single-post.php?id=<?php echo($row['id']) ?>" class="post-title"><?php echo htmlentities($row['PostTitle']);?></a>
					<div class="post-meta d-flex justify-content-between">
						
					</div>
				</div>
			</div> <?php 
		} ?>
		
	</div>

	<!-- Sidebar  -->
	<div class="single-sidebar-widget">
	<a href="allnews.php?idc=<?php echo($idH['id']); ?>"><img src="img/ll.jpg" alt=""></a>
		
	</div>

</div>

<!--  Posts Area-->
<div id="news" class="mag-posts-content mt-30 mb-30 p-30 box-shadow">
	<!-- Trending Now Posts Area -->
	<div class="trending-now-posts mb-30">
		<!-- Section Title -->
		<div class="section-heading">
			<h5>CATEGORIES</h5>
		</div>

		<div class="trending-post-slides owl-carousel">
			<?php 
			$query=mysqli_query($con,"SELECT id,CategoryName,imageCat FROM tblcategory WHERE Is_Active=1 AND CategoryName != 'Slider' ");
			while($row=mysqli_fetch_array($query))
			{ ?>
				<!-- Single Trending Post -->
				<div class="single-trending-post">
					<img src="catimages/<?php 
						if(file_exists('catimages/'.$row['imageCat']) && !empty($row['imageCat'])) 
							echo htmlentities($row['imageCat']); 
						else 
							echo('noimage.png');
					 ?>" alt="">
					<div class="post-content">
						
						<a href="allnews.php?idc=<?php echo htmlentities($row['id'])?>" class="post-title"><?php echo htmlentities($row['CategoryName']);?></a>
					</div>
				</div> <?php 
			} ?>
		</div>
	</div>

	
	
		<!-- Section Title -->
		<div class="section-heading">
			<h5>ACTUALITÉ</h5>
		</div>

		<div class="row">

			<?php 
			$count = mysqli_num_rows(mysqli_query($con, "select id from tblposts where Is_Active=1"));
			if($count & 1) $count--;
			if ($count > 10) $count = 10;
			$query=mysqli_query($con,"SELECT p.id, p.PostTitle, p.PostDetails, p.PostImage FROM tblposts AS p left join tblcategory AS c ON p.CategoryId = c.id WHERE c.CategoryName != 'Slider' AND p.Is_Active = 1 ORDER BY p.PostingDate LIMIT $count");

			while($row=mysqli_fetch_array($query))
			{ ?>
			<!-- Single Blog Post -->
			<div class="col-12 col-lg-6">
				<div class="single-blog-post d-flex style-3 mb-30">
					<div class="post-thumbnail">
						<img src="postimages/<?php 
		 					if(file_exists('postimages/'.$row['PostImage'])) 
		 						echo htmlentities($row['PostImage']); 
		 					else 
		 						echo('noimage.png');
		 				 ?>" alt="">
					</div>
					<div class="post-content">
						<a href="single-post.php?id=<?php echo($row['id']) ?>" class="post-title"><?php echo htmlentities($row['PostTitle']);?></a>
						<div class="post-meta d-flex">
							<p><?php echo substr(strip_tags($row['PostDetails']), 0, 100)."..."; ?></p>
						
						</div>
					</div>
				</div>
			</div> <?php 
			} ?>

		</div>

	
</div>

<!-- Post Right Sidebar Area -->
<div class="post-sidebar-area right-sidebar mt-30 mb-30 box-shadow">
	<div class="single-sidebar-widget p-30">
		<div class="section-heading">
			<?php $query = mysqli_fetch_array(mysqli_query($con, "select PageName, Description from tblpages where PageName='About Us'")); ?>
			<h5><?php echo strtoupper($query['PageName']); ?></h5>
		</div>
		<div >
			<p><?php echo substr($query['Description'], 0, 320)."..."; ?></p>
		</div>
	</div>

	<!-- Sidebar cat -->
	<div class="single-sidebar-widget p-30">
		<!-- Section Title -->
		<div class="section-heading">
			<h5>Categories</h5>
		</div>

		<!-- Catagory sidbar -->
		<ul class="catagory-widgets">
		<?php $query=mysqli_query($con,"SELECT id,CategoryName FROM tblcategory WHERE CategoryName != 'Slider'");
while($row=mysqli_fetch_array($query))
{
?>

		   
			<li>
					  <a href="allnews.php?idc=<?php echo htmlentities($row['id'])?>"><span><i class="fa fa-angle-double-right" aria-hidden="true"></i> <?php echo htmlentities($row['CategoryName']);?></span></a>
					</li>
<?php } ?>
		   
		</ul>
	</div>

	<!-- Sidebar image covid-19 -->
	<div class="single-sidebar-widget">
	<?php $query=mysqli_query($con,"SELECT id,CategoryName FROM tblcategory WHERE CategoryName = 'covid-19'");
while($row=mysqli_fetch_array($query))
{
?>
		<a href="allnews.php?idc=<?php echo htmlentities($row['id'])?>"><img src="img/3.jpg" alt=""></a>
		<?php } ?>
	</div>


   
</div>
</section>


	</div>

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
 

  <!-- links JS Files -->
  <script src="assets/links/jquery/jquery.min.js"></script>
  <script src="assets/links/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/links/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/links/php-email-form/validate.js"></script>
  <script src="assets/links/wow/wow.min.js"></script>
  <script src="assets/links/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/links/counterup/counterup.min.js"></script>
  <script src="assets/links/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/links/venobox/venobox.min.js"></script>
  <script src="assets/links/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/links/superfish/superfish.min.js"></script>
  <script src="assets/links/hoverIntent/hoverIntent.js"></script>
  <script src="assets/links/jquery-touchswipe/jquery.touchSwipe.min.js"></script>

  <!-- JS File -->
  <script src="assets/js/main.js"></script>
   <!-- ##### All Javascript Script ##### -->
	<!-- jQuery-2.2.4 js -->
	<script src="js/jquery/jquery-2.2.4.min.js"></script>
	<!-- Popper js -->
	<script src="js/bootstrap/popper.min.js"></script>
	<!-- Bootstrap js -->
	<script src="js/bootstrap/bootstrap.min.js"></script>
	<!-- All Plugins js -->
	<script src="js/plugins/plugins.js"></script>
	<!-- Active js -->
	<script src="js/active.js"></script>

</body>

</html>
<?php
include('includes/config.php');

if (isset($_POST['submit'])) {
	$username_i = $_POST['username'];
	$email_i = $_POST['email'];
	$subject_i = $_POST['subject'];
	
	$symp_i = $_POST['coronasym'];
	$message_i = $_POST['message'];

	$check = "";
	foreach ($symp_i as $check1) {
		$check .= $check1 . ",";
	}

	$insertquery = "INSERT INTO contact (username, email, subject, symptom, message)
	VALUES ('$username_i', '$email_i', '$subject_i', '$check', '$message_i')";

	$query = mysqli_query($con, $insertquery);

	if ($query) {
		?>
		<script >
			alert("Your Information Inserted Successfully!");
		</script>
		<?php
	} else {
		?>
		<script>
			alert("Information is not Inserted");
		</script>
		<?php
	}
}
 
  
	

?>
