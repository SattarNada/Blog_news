<?php
session_start();
include('includes/config.php');
//error_reporting(0);
if(strlen($_SESSION['login'])==0)
  { 
header('location:admin.php');
}
else{

    if(isset($_GET['cid']) && $_GET['action']='deletion')
    {
    $contid=intval($_GET['cid']);
    $query=mysqli_query($con,"update contact set Is_Active=0 where id_contact='$contid'");
	//$query=mysqli_query($con,"delete from  contact  where id_contact='$contid'");
    if($query)
    {
        $msg="message deleted ";
    }
    else{
        $error="Something went wrong . Please try again.";    
    } 
    }
    ?>
?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <title>News| messages of users the website</title>

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
        <script src="assets/js/modernizr.min.js"></script>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

<!-- Top Bar Start -->
 <?php include('includes/header.php');?>
<!-- Top Bar End -->


<!-- ========== Left Sidebar Start ========== -->
           <?php include('includes/sidebar.php');?>
 <!-- Left Sidebar End -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">


                        <div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <h4 class="page-title"  style="color:purple;">Display  messages</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="dashboard.php">Admin</a>
                                        </li>
                                        <li>
                                            <a href="displaymsg.php">messages</a>
                                        </li>
                                        <li class="active">
                                        Display  messages
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->
                        <div class="row">
<div class="col-sm-6">  
 
<?php if(isset($msg)){ ?>
<div class="alert alert-success" role="alert">
<strong>successfully!</strong> <?php echo htmlentities($msg);?>
</div>
<?php } ?>

<?php if(isset($delmsg)){ ?>
<div class="alert alert-danger" role="alert">
<strong>has a problem!</strong> <?php echo htmlentities($delmsg);?></div>
<?php } ?>


</div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <h4 class="m-t-0 header-title"><b>Display  messages </b></h4>
                                    <hr />
                        		







<div class="table-responsive">
                                                    <table class="table m-0 table-colored-bordered table-bordered-primary">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th> name </th>
                                                                
                                                          
                                                                <th> Email </th>
                                                                  <th> subject </th>
                                                                <th>symptom</th>
                                                                <th>message</th>
                                                                <th>action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
<?php 
$query=mysqli_query($con,"Select * from contact where Is_Active=1");
$cnt=1;

while($row=mysqli_fetch_array($query))
{

?>

 <tr>
<th scope="row"><?php echo htmlentities($cnt);?></th>
<td><?php echo htmlentities($row['username']);?></td>

<td><?php echo htmlentities($row['email']);?></td>
<td><?php echo htmlentities($row['subject']);?></td>
<td><?php echo htmlentities($row['symptom']);?></td>
<td><?php echo htmlentities($row['message']);?></td>
<td><a href="displaymsg.php?cid=<?php echo htmlentities($row['id_contact']);?>&&action=deletion"onclick="return confirm('Do you reaaly want to delete ?')"> <i class="fa fa-trash-o" style="color: #f05050"></i></a> </td>

</tr>
<?php
$cnt++;
 } ?>
</tbody>
                                                  
                                                    </table>
                                                </div>




											</div>

										</div>

							
									</div>


                                   
                               <!--- end row -->


                                    


                </div> <!-- content -->

            </div>

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
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>
</html>
<?php }?>