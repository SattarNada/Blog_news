<?php 
session_start();
error_reporting(0);
include('includes/config.php');
include('includespages/header.php');
 ?>

	<!-- ##### Header Area End ##### -->

	<!-- ##### Breadcrumb Area Start ##### -->
	<div class="mag-breadcrumb py-5">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<nav aria-label="breadcrumb">
						
					</nav>
				</div>
			</div>
		</div>
	</div>
	<!-- ##### Breadcrumb Area End ##### -->
<?php 
if (isset($_GET['id'])) {
	 $idp = $_GET['id'];
	 $info = mysqli_fetch_array(mysqli_query($con, "select * from tblpages where id=".$idp));
?>
	<!-- ##### Post Details Area Start ##### -->
	<section class="post-details-area">
		<div class="container">
			<div class="row justify-content-center">
				<!-- Post Details Content Area -->
				<div class="col-12 col-xl-8">
					<div class="post-details-content bg-white mb-30 p-30 box-shadow">
						<div class="blog-thumb mb-30"><?php
							if(file_exists('assets/img/intro-carousel/'.$info['imagePage'])){ echo '<img src="assets/img/intro-carousel/'.$info['imagePage'].'" alt="">';} ?>
						</div>
						<div class="blog-content">
							<div class="post-meta">
								<a href="#"> <?php 
                                    if (empty($info['UpdationDate'])) 
                                        $dU = date("d M Y", strtotime($info['PostingDate']));
                                    else 
                                        $dU = date("d M Y", strtotime($info['UpdationDate']));
									$d = date("d M Y à H:i", strtotime($info['PostingDate']));
									echo($dU); ?>
								</a>
								<a href="#"><?php echo($info['PageName']) ?></a>
							</div>
							<h4 class="post-title"><?php echo($info['PageTitle']) ?></h4>
							
							<p><?php echo($info['Description']) ?></p>

						   <!-- Post Meta -->
						   <div class="post-meta second-part">
								<p><a href="#" class="post-author">Admin</a> <a href="#" class="post-date"><?php echo($d); ?></a></p>
							</div>
							
							<?php 
							if ($info['PageName'] == 'Contact Us') { ?>
								<form action="" method="POST" class="email-form" style="  box-shadow: 0 0 30px rgba(236, 98, 202, 0.6); padding: 30px;">
									<div class="form-group">
										
										<input type="name" class="form-control" name="username" placeholder="Enter your Name" autocomplete="off" required />
									</div>
									<div class="form-group">
										
										<input type="email" class="form-control" name="email" placeholder="name@example.com" autocomplete="off"  required />
									</div>
									<div class="form-group">
									  <input class="form-control" name="subject"  placeholder="subject" required   />
									  
									</div>
									<div class="form-group">
										<label> Select Symptoms </label> <br>

										<div class="custom-control custom-checkbox custom-control-inline text-capitalize">
											<input type="checkbox" class="custom-control-input" id="customcheckbox1" name="coronasym[]" value="cold">
											<label class="custom-control-label" for="customcheckbox1">Cold</label>
										</div>
										<div class="custom-control custom-checkbox custom-control-inline text-capitalize">
											<input type="checkbox" class="custom-control-input" id="customcheckbox2" name="coronasym[]" value="cough">
											<label class="custom-control-label" for="customcheckbox2">cough</label>
										</div>
										<div class="custom-control custom-checkbox custom-control-inline text-capitalize">
											<input type="checkbox" class="custom-control-input" id="customcheckbox3" name="coronasym[]" value="fever">
											<label class="custom-control-label" for="customcheckbox3">fever</label>
										</div>
										<div class="custom-control custom-checkbox custom-control-inline text-capitalize">
											<input type="checkbox" class="custom-control-input" id="customcheckbox4" name="coronasym[]" value="breath">
											<label class="custom-control-label" for="customcheckbox4">breathing problem</label>
										</div>
										<div class="custom-control custom-checkbox custom-control-inline text-capitalize">
											<input type="checkbox" class="custom-control-input" id="customcheckbox5" name="coronasym[]" value="tird">
											<label class="custom-control-label" for="customcheckbox5">tiredness</label>
										</div>
										<div class="custom-control custom-checkbox custom-control-inline text-capitalize">
											<input type="checkbox" class="custom-control-input" id="customcheckbox6" name="coronasym[]" value="no problem">
											<label class="custom-control-label" for="customcheckbox6">no problem</label>
										</div>
									</div>
									<div class="form-group">
										
										<textarea class="form-control" name="message" rows="3" style=" padding: 10px 14px;border-radius: 0;box-shadow: none;font-size: 15px;" placeholder="message*" required ></textarea>
									</div>
									
									<div class="text-center">
										<button type="submit" name="contact" value="submit" style ="color: #fff;background: purple;text-align: center;" >Send Message</button></div>
								</form>
							 	<?php 
							 } ?>
						</div>
					</div>
				</div>
<?php 
} ?>

				<!-- Sidebar Widget -->
				<!-- Sidebar  -->
			<div class="col-12 col-md-6 col-lg-5 col-xl-4">
					<div class="sidebar-area bg-white mb-30 box-shadow">
					
					<div class="single-sidebar-widget">
					<a href="allnews.php?idc=<?php echo($idH['id']); ?>"><img src="img/ll.jpg" alt=""></a>
						</div>
					<div class="single-sidebar-widget p-30">
					
		<!-- Section Title -->
		<div class="section-heading">
			<h5>NOUVELLES RÉCENTES</h5>
		</div>

		<?php 
		$query=mysqli_query($con,"SELECT p.id, p.PostTitle, p.PostDetails, p.PostImage FROM tblposts AS p left join tblcategory AS c ON p.CategoryId = c.id WHERE c.CategoryName != 'Slider' AND p.Is_Active = 1 ORDER BY p.PostingDate LIMIT 3");
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
					
				</div>
			</div> <?php 
		} ?>
					
						</div>
						
						
						<!-- Sidebar  -->
	<div class="single-sidebar-widget p-30">
		<!-- Section Title -->
		<div class="section-heading">
			<h5>Categories</h5>
		</div>

			<!-- Catagory -->
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

						<!-- Sidebar  -->
						<div class="single-sidebar-widget">
						<?php $query=mysqli_query($con,"SELECT id,CategoryName FROM tblcategory WHERE CategoryName = 'covid-19'");
while($row=mysqli_fetch_array($query))
{
?>
		<a href="allnews.php?idc=<?php echo htmlentities($row['id'])?>"><img src="img/3.jpg" alt=""></a>
		<?php } ?>
	</div>	</div>

						
						</div>
						

						<!-- Sidebar  -->
						<div class="single-sidebar-widget p-30">
							
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</section>
	<!-- ##### Post Details Area End ##### -->

   
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
   
	<!-- Popper js -->
	<script src="js/popper.min.js"></script>
	<!-- Bootstrap js -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Plugins js -->
	<script src="js/plugins.js"></script>
	<!-- Active js -->
	<script src="js/active.js"></script>
	<?php 
	if (isset($_POST['contact'])) {
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
</body>

</html>