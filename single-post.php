<?php 
session_start();
include('includes/config.php');
include('includespages/header.php'); 
if(isset($_POST['reply'])) {
	
			$name = $_POST['name'];
			$email = $_POST['email'];
			$comment = $_POST['comment'];
			$postid = intval($_GET['id']);
			$st1 ='0';
			$query = mysqli_query($con,"insert into tblcomments(postId,name,email,comment,status) values('$postid','$name','$email','$comment','$st1')");
			if($query):
				setcookie('success', 'Comment successfully submit. Comment will be display after admin review.', time() + 3600);
				
			else :
				setcookie('error', 'Something went wrong. Please try again.', time() + 3600);
			endif;

			header("location:single-post.php?id=".$postid);
	
	
}
   ?>
   
	<!-- Breadcrumb Area Start -->
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
	<!-- Breadcrumb Area End -->

	<!-- Post Details Area Start -->
	<section class="post-details-area"> 
		<?php 
		if (isset($_COOKIE['success'])) { ?>
			<div class="alert alert-success" role="alert">
				<strong>Success : </strong> <?php echo htmlentities($_COOKIE['success']);?>
			</div> <?php 
			setcookie("success", "", time() - 3600);
		}
		elseif (isset($_COOKIE['error'])) { ?>
			<div class="alert alert-danger" role="alert">
				<strong>Error : </strong> <?php echo htmlentities($_COOKIE['success']);?>
			</div> <?php 
			setcookie("error", "", time() - 3600);
		} ?>
		<div class="container">
			<div class="row justify-content-center">
				<!-- Post Details Content Area -->
				<?php 
				if (isset($_GET['id'])) {
					 $idp = $_GET['id'];
					 $info = mysqli_fetch_array(mysqli_query($con, "select p.*, c.CategoryName as cName from tblposts as p left join tblcategory as c on p.CategoryId = c.id where p.id = ".$idp)) or die(mysqli_error($con));
				?>
				<div class="col-12 col-xl-8">
					<div class="post-details-content bg-white mb-30 p-30 box-shadow">
						<div class="blog-thumb mb-30 text-center"><?php
							if(file_exists('postimages/'.$info['PostImage'])){ echo '<img src="postimages/'.$info['PostImage'].'" alt="">';} ?>
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
								<a href="#"><?php echo($info['cName']) ?></a>
							</div>
							<h4 class="post-title"><?php echo($info['PostTitle']) ?></h4>
							

							<p><?php echo (html_entity_decode($info['PostDetails'])); ?></p>

						   <!-- Post Meta -->
						   <div class="post-meta second-part">
								<p><a href="#" class="post-author">Admin</a> <a href="#" class="post-date"><?php echo($d); ?></a></p>
							</div>
						</div>
					</div>

				   
					<!-- Comment Area Start -->

					<div class="comment_area clearfix bg-white mb-30 p-30 box-shadow">
						
						<!-- Section Title -->
						<div class="section-heading">
							<h5>COMMENTS</h5>
						</div>

						<ol>
                            <!-- Single Comment Area -->
                            <li class="single_comment_area">
<?php 
 $st1=1;
 $query=mysqli_query($con,"select name,comment,postingDate from  tblcomments where postId='$idp' and status='$st1'");
while ($row=mysqli_fetch_array($query)) {
?>
                                <!-- Comment Content -->
                                <div class="comment-content d-flex">
                                    <!-- Comment Author -->
									<div class="comment-author">
                                        <img src="img/usericon.png" class="d-flex mr-3 rounded-circle"  alt="author">
                                    </div>
                                    <!-- Comment Meta -->
                                    <div class="comment-meta">
										<span style="font-size:11px;">
										<i class="fa fa-calendar" aria-hidden="true"></i>
                                        <?php echo htmlentities($row['postingDate']);?></span>
                                        <h6><?php echo htmlentities($row['name']);?> <br /></h6>
                                        <p><?php echo htmlentities($row['comment']);?>  </p>
                                        
                                    </div>
								</div>
								

                                <?php } ?>
							</li>
						</ol>
					</div>

					<!-- Post A Comment Area -->
					<div class="post-a-comment-area bg-white mb-30 p-30 box-shadow clearfix">
						<!-- Section Title -->
						<div class="section-heading">
							<h5>laisser un commentaire</h5>
						</div>

						<!-- Reply Form -->
						<div class="contact-form-area">
							<form action="single-post.php?id=<?php echo($info['id']) ?>" method="post">
								<div class="row">
									<div class="col-12 col-lg-6">
										<input type="text" class="form-control" name="name" placeholder="Your Name*" required>
									</div>
									<div class="col-12 col-lg-6">
										<input type="email" class="form-control" name="email" placeholder="Your Email*" required>
										</br></div>
									<div class="col-12">
										<textarea class="form-control" name="comment" cols="30" rows="10" placeholder="Message*" required></textarea>
									</div>
									<div class="col-12">
										<button class="btn mag-btn mt-30" type="submit" name="reply">envoyer le Commentaire</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div> <?php 
				} ?>

				<!-- Sidebar  -->
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
	<!--  Post Details Area End  -->

   
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
</body>

</html>