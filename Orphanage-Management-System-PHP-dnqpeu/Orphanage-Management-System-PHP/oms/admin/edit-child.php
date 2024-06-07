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
$childname=$_POST['childname'];
$childgender=$_POST['childgender'];
$cadate=$_POST['cadate'];
$childai=$_POST['childai'];
$childbg=$_POST['childbg'];
$childage=$_POST['childage'];
$status=$_POST['status'];
$oid=intval($_GET['orpid']);
$sql="update tblchild set ChildName=:childname,ChildGender=:childgender,ChildArrivalDate=:cadate,AllergicIssue=:childai,BloodGroup=:childbg,Age=:childage,IsActive=:status where ID=:oid";
$query = $dbh->prepare($sql);
$query->bindParam(':oid',$oid,PDO::PARAM_STR);
$query->bindParam(':childname',$childname,PDO::PARAM_STR);
$query->bindParam(':childgender',$childgender,PDO::PARAM_STR);
$query->bindParam(':cadate',$cadate,PDO::PARAM_STR);
$query->bindParam(':childai',$childai,PDO::PARAM_STR);
$query->bindParam(':childbg',$childbg,PDO::PARAM_STR);
$query->bindParam(':childage',$childage,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);

$query->execute();

echo "<script>alert('Success : Child details updated successfully ');</script>";
echo "<script>window.location.href='manage-child.php'</script>";


}    
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>OMS | Edit Child Details</title>

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
                    <h1 class="page-header"> Edit Child Details</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Edit Child Details
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
<form role="form" method="post" onSubmit="return valid();" name="chngpwd">
<!-- Success / Error Message -->




<?php
$orpid=intval($_GET['orpid']);
$sql = "SELECT * from tblchild where ID=:orpid";
$query = $dbh -> prepare($sql);
$query->bindParam(':orpid',$orpid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{ 
    ?>

<div class="form-group">
<label>Identification Number</label>
<input class="form-control" type="text" name="oname" readonly="true" autofocus value="<?php echo htmlentities($row->IndentificationNumber);?>">
</div>
<div class="form-group">
<label>Child Name</label>
<input class="form-control" type="text" name="childname" autocomplete="off" required="true" value="<?php echo htmlentities($row->ChildName);?>" autofocus>
</div>
<div class="form-group">
<label>Child Gender</label>
<select class="form-control" name="childgender" autocomplete="off" required="true"  autofocus>
    <option value="<?php echo htmlentities($row->ChildGender);?>"><?php echo htmlentities($row->ChildGender);?></option>
    <option value="Male">Male</option>
    <option value="Female">Female</option>
</select>
</div>
<div class="form-group">
<label>Child Photo</label>
<img src="childimages/<?php echo htmlentities($row->ChildPhoto);?>" style="border:solid #000 1px" width="150"><a href="change-child-image.php?childid=<?php echo htmlentities($row->ID);?>"> Change Image</a>
</div>
<!--Event Description -->
<div class="form-group">
<label>Child Arrival Date</label>
<input  class="form-control" type="date" name="cadate" autocomplete="off" value="<?php echo htmlentities($row->ChildArrivalDate);?>" required autofocus />
</div>
<div class="form-group">
<label>Child Allergic Issue</label>
<input class="form-control" type="text" name="childai" autocomplete="off" value="<?php echo htmlentities($row->AllergicIssue);?>" required="true" autofocus>
</div>
<div class="form-group">
<label>Child Blood Group</label>
<input class="form-control" type="text" name="childbg" autocomplete="off" value="<?php echo htmlentities($row->BloodGroup);?>" required="true" autofocus>
</div>

<div class="form-group">
<label>Child Age</label>
<input class="form-control" type="text" name="childage" autocomplete="off" value="<?php echo htmlentities($row->Age);?>" required="true" autofocus>
</div>
<!--status -->
<div class="form-group">
<label>Status</label>
<select class="form-control" name="status" required >
<?php
$status=$row->IsActive;
if($status==1):
?>
<option value="1">Active</option>   
<option value="0">Inactive</option>   
<?php else: ?>
 <option value="0">Inactive</option> 
      <option value="1">Active</option>  
<?php endif; ?>
</select>
</div>

<?php }} ?>

<!--Button -->   
<div class="form-group" align="center">                 
<button type="submit" class="btn btn-primary" name="update">Update</button>
 </div>                                   </form>
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
