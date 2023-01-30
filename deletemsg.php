<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  { 
header('location:admin.php');
}else{



if(!empty($_GET['cid']))
{
$cid=intval($_GET['cid']);
try{
	if($_GET['action']=='restore'){
		$query=mysqli_query($con,"update contact set Is_Active=1 where id_contact='$cid'");
		($query)?$msg="message restored successfully ":$error="Something went wrong . Please try again.";
	}elseif($_GET['action']=='delete'){ 
		$query=mysqli_query($con,"delete from  contact  where id_contact='$cid'");
		//$delmsg="Post deleted forever";
		($query)?$delmsg="message deleted forever":$error="Something went wrong . Please try again.";
		}
 } catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
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
        <title>News| Manage message</title>

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="plugins/morris/morris.css">
<!-- Favicons -->
<link href="assets/img/intro-carousel/333.png" rel="icon">

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
                                    <h4 class="page-title" style="color:purple;">Trashed messages </h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="dashboard.php">Admin</a>
                                        </li>
                                        <li>
                                            <a href="manageposts.php">Posts</a>
                                        </li>
                                        <li class="active">
                                          Trashed messages
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->

<div class="row">


<div class="col-sm-6">  
 


<?php if($delmsg){ ?>
<div class="alert alert-danger" role="alert">

<strong>Oh has a problem!</strong> <?php echo htmlentities($delmsg);?></div>
<?php }?>
<?php if($msg){ ?>
<div class="alert alert-success" role="alert">

<strong>successfully </strong> <?php echo htmlentities($msg);?></div>
<?php }?>


</div>




</div>


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                         

                                    <div class="table-responsive">
<table class="table table-colored table-centered table-inverse m-0">
<thead>
<tr>
                                                              
                                                                <th> name </th>

                                                                <th> Email </th>
                                                                  <th> subject </th>
                                                                <th>symptom</th>
                                                                <th>message</th>
                                                              <th>Action</th>
</tr>
</thead>
<tbody>

<?php
$query=mysqli_query($con,"select * from contact where Is_Active=0 ");
$rowcount=mysqli_num_rows($query);
if($rowcount==0)
{
?>
<tr>

<td colspan="7" aligne="center"><h3 style="color:red">No record found</h3></td>
<tr>
<?php 
} else {
while($row=mysqli_fetch_array($query))
{
?>
 <tr>
 <td><?php echo htmlentities($row['username']);?></td>

<td><?php echo htmlentities($row['email']);?></td>
<td><?php echo htmlentities($row['subject']);?></td>
<td><?php echo htmlentities($row['symptom']);?></td>
<td><?php echo htmlentities($row['message']);?></td>

<td>
<a href="deletemsg.php?cid=<?php echo htmlentities($row['id_contact']);?>&action=restore" onclick="return confirm('Do you really want to restore ?')"> <i class="ion-arrow-return-right" style="color: purple" title="Restore this Post"></i></a>
    &nbsp;
    <a href="deletemsg.php?cid=<?php echo htmlentities($row['id_contact']);?>&action=delete" onclick="return confirm('Do you really want to delete ?')"><i class="fa fa-trash-o" style="color: #f05050" title="Permanently delete this post"></i></a> 
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
 
<?php }?>