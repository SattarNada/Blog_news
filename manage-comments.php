<?php 
session_start();
include('includes/config.php');
//error_reporting(0);
if(strlen($_SESSION['login'])==0)
{ 
	header('location:admin.php');
}
else{
	if (isset($_GET['action'])) {
		switch ($_GET['action']) {
		case 'del':
			$commentId=intval($_GET['cid']);
			$query=mysqli_query($con,"delete from tblcomments where id = '$commentId'");
			if($query)
				$msg="comment has been deleted.";
			else
				$error="has a problem . Please trying  again.";  
			break;
		
		case 'refuse':
			$commentId=intval($_GET['cid']);
			$query=mysqli_query($con,"update tblcomments set status=0 where id = '$commentId'");
			if($query)
				$msg="Comment has been refused.";
			else
				$error="has a problem . Please trying  again.";
		}
	}

	?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
		<meta name="author" content="Coderthemes">

		<!-- App favicon -->
		<link rel="shortcut icon" href="assets/images/favicon.ico">
		<!-- App title -->
		<title>News | Manage comments</title>

		<!--Morris Chart CSS -->
		<link rel="stylesheet" href="plugins/morris/morris.css">

		<!-- jvectormap -->
		<link href="plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />

		<!-- App css -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/core.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/components.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="plugins/switchery/switchery.min.css">

		
		<script src="assets/js/modernizr.min.js"></script>

	</head>


	<body class="fixed-left">

		<!-- Begin page -->
		<div id="wrapper">

			<!-- Top Bar Start -->
		   <?php include('includes/header.php');?>

			<!-- ========== Left Sidebar Start ========== -->
		   <?php include('includes/sidebar.php');?>


			<!-- ============================================================== -->
			<!-- Start right Content here -->
			<!-- ============================================================== -->
			<div class="content-page">
				<!-- Start content -->
				<div class="content">
					<div class="container">


						<div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
									<h4 class="page-title"  style="color:purple;">Manage Posts </h4>
									<ol class="breadcrumb p-0 m-0">
										<li>
											<a href="dashboard.php">Admin</a>
										</li>
										<li>
											<a href="manage-comments.php">comments</a>
										</li>
										<li class="active">
											Manage comments 
										</li>
									</ol>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<!-- end row -->




						<div class="row">
							<div class="col-sm-12">
								<div class="card-box">
						 
<!---Success Message--->  
<?php if(isset($msg)){ ?>
<div class="alert alert-warning" role="alert">
<strong>successfully</strong> <?php echo htmlentities($msg);?>
</div>
<?php } ?>

<!---Error Message--->
<?php if(isset($error)){ ?>
<div class="alert alert-danger" role="alert">
<strong>Oh</strong> <?php echo htmlentities($error);?></div>
<?php } ?>

									<div class="table-responsive">
<table class="table table-colored table-centered table-inverse m-0">
<thead>
<tr>
										   
<th>Nom</th>
<th>Email</th>

<th>Comment</th>
<th>Post Title</th>
<th>Action</th>
</tr>
</thead>
<tbody>

<?php
$query=mysqli_query($con,"select c.*, p.PostTitle as post from tblcomments as c left join tblposts as p on c.postId = p.id where c.status = 1 order by postingDate Desc");
$rowcount=mysqli_num_rows($query);
if($rowcount==0)
{
?>
<tr>

<td colspan="4" aligne="center"><h3 style="color:red">No record found</h3></td>
<tr>
<?php 
} else {
while($row=mysqli_fetch_array($query))
{
?>
 <tr>
<td><b><?php echo htmlentities($row['name']);?></b></td>
<td><?php echo htmlentities($row['email'])?></td>
<td><?php echo htmlentities($row['comment'])?></td>
<td><?php echo htmlentities($row['post'])?></td>


<td>
	<a href="?cid=<?php echo htmlentities($row['id']);?>&&action=refuse">
		<i class="fa fa-times" style="color: #b629f6;"></i>
	</a> 
	&emsp;
	<a href="?cid=<?php echo htmlentities($row['id']);?>&&action=del" onclick="return confirm('Do you really want to delete ?')">
		<i class="fa fa-trash-o" style="color: #f05050"></i>
	</a>
</td>
 </tr>
<?php } }?>
											   
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>



					</div> <!-- container -->

				</div> <!-- content -->

	   

			</div>


			<!-- ============================================================== -->
			<!-- End Right content here -->
			<!-- ============================================================== -->


		</div>
		<!-- END wrapper -->



		<script>
			var resizefunc = [];
		</script>

		<!-- jQuery  -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/detect.js"></script>
		<script src="assets/js/fastclick.js"></script>
		<script src="assets/js/jquery.blockUI.js"></script>
		<script src="assets/js/waves.js"></script>
		<script src="assets/js/jquery.slimscroll.js"></script>
		<script src="assets/js/jquery.scrollTo.min.js"></script>
		<script src="plugins/switchery/switchery.min.js"></script>

		<!-- CounterUp  -->
		<script src="plugins/waypoints/jquery.waypoints.min.js"></script>
		<script src="plugins/counterup/jquery.counterup.min.js"></script>

		<!--Morris Chart-->
		<script src="plugins/morris/morris.min.js"></script>
		<script src="plugins/raphael/raphael-min.js"></script>

		<!-- Load page level scripts-->
		<script src="plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
		<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
		<script src="plugins/jvectormap/gdp-data.js"></script>
		<script src="plugins/jvectormap/jquery-jvectormap-us-aea-en.js"></script>


		<!-- Dashboard Init js -->
		<script src="assets/pages/jquery.blog-dashboard.js"></script>

		<!-- App js -->
		<script src="assets/js/jquery.core.js"></script>
		<script src="assets/js/jquery.app.js"></script>

	</body>
</html>
<?php } ?>