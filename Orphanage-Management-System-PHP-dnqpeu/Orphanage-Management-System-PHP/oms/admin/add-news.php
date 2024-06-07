<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['adminsession'])==0)
{   
header('location:logout.php');
}
else{ 
if(isset($_POST['add']))
  {
$newstitle=$_POST['newstitle'];
$decrption=$_POST['description'];
$newsphoto=$_FILES["newsimage"]["name"];
$status=1;
// get the image extension
$extension = substr($newsphoto,strlen($newsphoto)-4,strlen($newsphoto));
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
$newsimage=md5($newsphoto).$extension;
// Code for move image into directory
move_uploaded_file($_FILES["newsimage"]["tmp_name"],"newsimages/".$newsimage);
$sql="INSERT INTO  tblnews(NewsTitle,NewsDetails,NewsImage) VALUES(:newstitle,:decrption,:newsimage)";
$query = $dbh->prepare($sql);
$query->bindParam(':newstitle',$newstitle,PDO::PARAM_STR);
$query->bindParam(':decrption',$decrption,PDO::PARAM_STR);
$query->bindParam(':newsimage',$newsimage,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Success : News added successfully ');</script>";
echo "<script>window.location.href='add-news.php'</script>";
}
else 
{
echo "<script>alert('Error : Something went wrong. Please try again. ');</script>"; 
}
}}   
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Orphanage Management System | Add News</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>
<body>
<div id="wrapper">
<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
<!-- / Header -->
<?php include_once('includes/header.php');?>
<!-- / Leftbar -->
<?php include_once('includes/leftbar.php');?>
</nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Add News</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Add News
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
<form role="form" method="post" enctype="multipart/form-data">



<!--Category Name -->
<div class="form-group">
<label>News Title</label>
<input class="form-control" type="text" name="newstitle" autocomplete="off" required autofocus>
</div>
<!--New Pasword -->
<div class="form-group">
<label>Description</label>
<textarea class="form-control" name="description"  required rows="8"></textarea>
</div>

<div class="form-group">
<label>News Image</label>
<input  class="form-control" type="file" name="newsimage" autocomplete="off" required autofocus />
</div>
<!--Button -->  
<div class="form-group" align="center">                     
<button type="submit" class="btn btn-primary" name="add">Add</button>
</div>
                                    </form>
                                </div>

                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/metisMenu/metisMenu.min.js"></script>
    <script src="dist/js/sb-admin-2.js"></script>
</body>
</html>
<?php } ?>
