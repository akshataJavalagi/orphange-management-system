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
// Posted Values
$identificationno= mt_rand(100000000,999999999);
$childname=$_POST['childname'];
$childgender=$_POST['childgender'];
$cadate=$_POST['cadate'];
$childai=$_POST['childai'];
$childbg=$_POST['childbg'];
$childage=$_POST['childage'];
$childphoto=$_FILES["childimage"]["name"];
$status=1;
// get the image extension
$extension = substr($childphoto,strlen($childphoto)-4,strlen($childphoto));
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
$childimage=md5($childphoto).$extension;
// Code for move image into directory
move_uploaded_file($_FILES["childimage"]["tmp_name"],"childimages/".$childimage);
// Query for insertion data into database
$sql="INSERT INTO  tblchild(IndentificationNumber,ChildName,ChildGender,ChildArrivalDate,AllergicIssue,BloodGroup,Age,ChildPhoto,IsActive) VALUES(:identificationno,:childname,:childgender,:cadate,:childai,:childbg,:childage,:childimage,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':identificationno',$identificationno,PDO::PARAM_STR);
$query->bindParam(':childname',$childname,PDO::PARAM_STR);
$query->bindParam(':childgender',$childgender,PDO::PARAM_STR);
$query->bindParam(':cadate',$cadate,PDO::PARAM_STR);
$query->bindParam(':childai',$childai,PDO::PARAM_STR);
$query->bindParam(':childbg',$childbg,PDO::PARAM_STR);
$query->bindParam(':childage',$childage,PDO::PARAM_STR);
$query->bindParam(':childimage',$childimage,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo '<script>alert("Child details has been added successfully")</script>';
echo "<script>window.location.href='add-child.php</script>";  
}
else 
{
echo '<script>alert("Something went wrong. Please try again")</script>';   
}

}
}    
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>OMS | Add Child</title>

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
                    <h1 class="page-header"> Add Child Details</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Add Child Details
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">

<!-- Success / Error Message -->
 
<form role="form" method="post" enctype="multipart/form-data">


<!--child name -->
<div class="form-group">
<label>Child Name</label>
<input class="form-control" type="text" name="childname" autocomplete="off" required="true" autofocus>
</div>
<div class="form-group">
<label>Child Gender</label>
<select class="form-control" name="childgender" autocomplete="off" required="true" autofocus>
    <option value="">Select Gender</option>
    <option value="Male">Male</option>
    <option value="Female">Female</option>
</select>
</div>
<div class="form-group">
<label>Child Photo</label>
<input  class="form-control" type="file" name="childimage" autocomplete="off" required autofocus />
</div>
<!--Event Description -->
<div class="form-group">
<label>Child Arrival Date</label>
<input  class="form-control" type="date" name="cadate" autocomplete="off" required autofocus />
</div>
<div class="form-group">
<label>Child Allergic Issue</label>
<input class="form-control" type="text" name="childai" autocomplete="off" required="true" autofocus>
</div>
<div class="form-group">
<label>Child Blood Group</label>
<input class="form-control" type="text" name="childbg" autocomplete="off" required="true" autofocus>
</div>

<div class="form-group">
<label>Child Age</label>
<input class="form-control" type="text" name="childage" autocomplete="off" required="true" autofocus>
</div>
<!--Button -->                       
<button type="submit" class="btn btn-default" name="add">Add Child</button>
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
