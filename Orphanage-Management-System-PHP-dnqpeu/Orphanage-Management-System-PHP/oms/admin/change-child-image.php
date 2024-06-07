<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['adminsession'])==0)
{   
header('location:logout.php');
}
else{ 
if(isset($_POST['update']))
{

$childid=intval($_GET['childid']);    
// Posted Values
$childimage=$_FILES["childimage"]["name"];
// get the image extension
$extension = substr($childimage,strlen($childimage)-4,strlen($childimage));
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
$imgnewfile=md5($childimage).$extension;
// Code for move image into directory
move_uploaded_file($_FILES["childimage"]["tmp_name"],"childimages/".$imgnewfile);
// Query for insertion data into database
$oldimage="eventimages/".$_SESSION['entimg'];
unlink($oldimage);
// Query for Updation data into database
$sql="update tblchild set ChildPhoto=:imgnewfile where ID=:childid";
$query = $dbh->prepare($sql);
$query->bindParam(':childid',$childid,PDO::PARAM_STR);
$query->bindParam(':imgnewfile',$imgnewfile,PDO::PARAM_STR);
$query->execute();

echo "<script>alert('Success :mage updated successfully');</script>";
echo "<script>window.location.href='manage-child.php'</script>";
}  
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>OMS | Edit Child Image</title>
    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
 <style>
    .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
</style>
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
                    <h1 class="page-header"> Edit Child Image</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Edit Child Image
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">



<form role="form" method="post" enctype="multipart/form-data">
<?php
$cid=intval($_GET['childid']);
$sql = "SELECT ID,ChildName,ChildPhoto,RegDate from tblchild where ID=:cid";
$query = $dbh -> prepare($sql);
$query->bindParam(':cid',$cid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{ 
    ?>

<!--Sponser Logo -->
<div class="form-group">
<label>Child Photo :</label>
<img src="childimages/<?php echo htmlentities($row->ChildPhoto);?>" width="300" height="200" />
</div>


<!--Sponser logo -->
<div class="form-group">
<label>New Child Photo</label>
<input type="file" name="childimage"  required autofocus /></td>
</div>
<?php  }}?>

<!--Button -->  
<div class="form-group" align="center">                     
<button type="submit" class="btn btn-primary" name="update">Update</button>
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
