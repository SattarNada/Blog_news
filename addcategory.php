<?php
session_start();
include('includes/config.php');
//error_reporting(0);
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{

if(isset($_POST['submit']))
{
    $category=$_POST['category'];

    $status=1;

    $imgfile=$_FILES["catimage"]["name"];
    // get the image extension
    $extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
    // allowed extensions
    $allowed_extensions = array(".jpg","jpeg",".png",".gif");
    // Validation for allowed extensions .in_array() function searches an array for a specific value.
    if(!in_array($extension,$allowed_extensions))
    {
    echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
    }
    else
    {
        //rename the image file
        $imgnewfile=md5($imgfile).$extension;
        // Code for move image into directory
        move_uploaded_file($_FILES["catimage"]["tmp_name"],"catimages/".$imgnewfile);

        $status=1;
        $query=mysqli_query($con,"insert into tblcategory(CategoryName,Is_Active,imageCat) values('$category','$status','$imgnewfile')");
        if($query)
        {
        $msg="Post has been added ";
        }
        else{
        $error="has a problem . Please trying  again.";    
        } 
    }
 
}


?>


<!DOCTYPE html>
<html lang="en">
    <head>

        <title>News| Add Categories</title>

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
                                    <h4 class="page-title" style="color:purple;">Add Categories</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="dashboard.php">Admin</a>
                                        </li>
                                        <li>
                                            <a href="managecategory.php">Categories </a>
                                        </li>
                                        <li class="active">
                                            Add Categories
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
                                    <h4 class="m-t-0 header-title"><b>Add Categorie </b></h4>
                                    <hr />
                        		


<div class="row">
<div class="col-sm-6">  
<!---Success Message--->  
<?php if(isset($msg)){ ?>
<div class="alert alert-success" role="alert">
<strong>successfully!</strong> <?php echo htmlentities($msg);?>
</div>
<?php } ?>

<!---Error Message--->
<?php if(isset($error)){ ?>
<div class="alert alert-danger" role="alert">
<strong>Oh </strong> <?php echo htmlentities($error);?></div>
<?php } ?>


</div>
</div>





                        			<div class="row">
                        				<div class="col-md-6">
                        					<form class="form-horizontal" name="addcat" method="post" enctype="multipart/form-data">
	                                            <div class="form-group">
	                                                <label class="col-md-2 control-label">Categories</label>
	                                                <div class="col-md-10">
	                                                    <input type="text" class="form-control" value="" name="category" required>
	                                                </div>
	                                            </div>
	                                     
	                                            <div class="form-group">
                                                    <label class="col-md-2 control-label">choose Image</label>
                                                    <div class="col-md-10">
                                                        <input type="file" class="form-control" id="catimage" name="catimage"  required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">&nbsp;</label>
                                                    <div class="col-md-10">
                                                  
                                                <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" name="submit">
                                                    Submit
                                                </button>
                                                    </div>
                                                </div>

	                                        </form>
                        				</div>
<!--display categories-->
                                       

                        			


                        			




           
                       


                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                    </div> <!-- container -->

                </div> <!-- content -->



            </div>
        </div>

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

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>
</html>
<?php } ?>