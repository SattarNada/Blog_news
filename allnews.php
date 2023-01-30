<?php 
session_start();
include('includes/config.php');
include('includespages/header.php');
 ?>

	<!--  Breadcrumb Area Start -->
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
	<!--  Breadcrumb Area End -->


<body>
	<!-- Preloader -->
	<div class="preloader d-flex align-items-center justify-content-center">
		<div class="spinner">
			<div class="double-bounce1"></div>
			<div class="double-bounce2"></div>
		</div>
	</div>

	<!--  Post Area Start  -->
<?php
$sql = "SELECT p.id FROM tblposts AS p LEFT JOIN tblcategory AS c ON p.CategoryId = c.id WHERE c.CategoryName != 'Slider' AND p.Is_Active = 1";
if (isset($_GET['idc'])) $sql .= " AND p.CategoryId = " . $_GET['idc'];
$count = mysqli_num_rows(mysqli_query($con, $sql));
$nPosts = 3;
$PdPg = $count / $nPosts;
$intPdPg = intval($count / $nPosts);
$nPages = ($PdPg > $intPdPg) ? intval($PdPg) + 1 : intval($PdPg) ;
$nPages = intval($PdPg) + 1;

if (isset($_GET['pg'])) {
	$pg = intval($_GET['pg']);
	$pb = ($pg - 1) * $nPosts;
}
else {
	$pg = 1;
	$pb = 0;
}
$sql = "SELECT p.*, c.CategoryName FROM tblposts AS p LEFT JOIN tblcategory AS c ON p.CategoryId = c.id WHERE c.CategoryName != 'Slider' AND p.Is_Active = 1 ORDER BY p.PostingDate LIMIT $pb,$nPosts";
$pos = strpos($sql, "WHERE ") + 6;
if (isset($_GET['idc'])) $sql = substr_replace($sql, "p.CategoryId = " . $_GET['idc'] . " AND ", $pos, 0);

$query=mysqli_query($con, $sql); ?>

<!--   Post Area Start -->

<div class="archive-post-area">

		<div class="container">
	   
			<div class="row justify-content-center">
		   
				<div class="col-12 col-xl-8">
				<div class="archive-posts-area bg-white p-30 mb-30 box-shadow"> <?php 
					if ($count === 0) {
						echo "<h2>Nothing to show!</h2>";
					}
					while ($row=mysqli_fetch_array($query)) {
					?>
						<!-- Single Catagory Post -->
						<div class="single-catagory-post d-flex flex-wrap">
						
							<div class="post-thumbnail bg-img">
								<img class="card-img-top" src="postimages/<?php 
									if(file_exists('postimages/'.$row['PostImage'])) 
										echo htmlentities($row['PostImage']); 
									else 
										echo('noimage.png'); 
								?>" alt="<?php echo htmlentities($row['PostTitle']);?>">
							</div>

							<!-- Post Contetnt -->
							<div class="post-content">
								<div>
									<span>
										<i class="fa fa-tags" aria-hidden="true"></i>
										<a href="allnews?idc=<?php echo($row['CategoryId']) ?>"><?php echo $row['CategoryName']; ?></a>
									</span>
									<span>
										<i class="fa fa-user" aria-hidden="true"></i>
										Admin
									</span>
									<span>
										<i class="fa fa-calendar" aria-hidden="true"></i> <?php 
										if (is_null($row['UpdationDate'])) 
											$d = date("d-m-Y à H:i", strtotime($row['PostingDate']));
										else 
											$d = date("d-m-Y à H:i", strtotime($row['UpdationDate']));
										echo($d);?>
									</span>
								</div>
								<a href="single-post.php?id=<?php echo($row['id']) ?>" class="post-title"><?php echo htmlentities($row['PostTitle']);?></a>
							   
								<p> <?php
									echo substr(strip_tags($row['PostDetails']), 0, 300)."..."; ?>
								</p>
			 
								<a href="single-post.php?id=<?php echo $row['id'] ?>" class="btn-get-started scrollto">Lire la suite &rarr;</a>
							
						   
							</div>
						</div> <?php
						} 

						if ($PdPg > 1) { 
							$pLink = (isset($_GET['idc'])) ? "?idc=".$_GET['idc']."&pg=" : "?pg=" ; ?>
							<!-- Pagination -->
							<nav>
								<ul class="pagination"> <?php 
									for ($i=1; $i <= $nPages; $i++) { 
										switch ($pg) {
											case $i:
												echo '<li class="page-item active"><a class="page-link" href="'.$pLink.$i.'">'.$i.'</a></li>';
												break;
											
											default:
												echo '<li class="page-item"><a class="page-link" href="'.$pLink.$i.'">'.$i.'</a></li>';
												break;
										}
									} 
									if ($pg !== $nPages) {
										$pg++;
										echo '<li class="page-item">
											<a class="page-link" href="'.$pLink.$pg.'">
												<i class="fa fa-angle-right"></i>
											</a>
										  </li>';
									} ?>
								</ul>
							</nav> <?php 
						} ?>
				</div>
			</div>
		</div>
	</div>
</div>

	


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
								
							 </div>
							 </div>
