<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['adminsession'])==0)
{   
header('location:logout.php');
}
else{    

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Orphanage Management System | Between Dates Report of Adoption Request</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
     <!-- DataTables CSS -->
    <link href="vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
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
                    <h1 class="page-header"> Between Dates Report of Adoption Request</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row" style="margin-top:1%">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Between Dates Report of Adoption Request

                        </div>



                        <div class="panel-body">

                            <div class="row">
                                

                                <div class="col-lg-12">
<form role="form" method="post" enctype="multipart/form-data">
<div class="form-group">
<label>From Date</label>
<input type="date"  name="fromdate" class="form-control" required>
</div>
<div class="form-group">
<label>To Date</label>
<input type="date"  name="todate" class="form-control" required>
</div>
<!--Button -->                       
<button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </form>

                                    <hr>
                                    <?php if (isset($_POST['submit'])) { 
$fdate=$_POST['fromdate'];
$tdate=$_POST['todate'];
?>
 <h4 align="center" style="color:blue">Orders Report Form <?php echo $fdate;?> To <?php echo $tdate;?></h4>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Request Number</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile Number</th>
                                        <th>Status</th>
                                        <th>Requset Date</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
$sql = "SELECT tbladoption.ID as aid,tbladoption.Userid,tbladoption.Childid,tbladoption.Requestnumber,tblusers.FullName,tblusers.Emailid,tblusers.PhoneNumber,tbladoption.Status,tbladoption.RequsetDate from tbladoption left  join tblusers on tblusers.Userid=tbladoption.Userid where tbladoption.RequsetDate between '$fdate' and '$tdate'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{ 
    ?>

<tr >
<td><?php echo htmlentities($cnt);?></td>
<td><?php echo htmlentities($row->Requestnumber);?></td>
<td><?php echo htmlentities($row->FullName);?></td>
<td><?php echo htmlentities($row->Emailid);?></td>
<td><?php echo htmlentities($row->PhoneNumber);?></td>


<td><?php $status=$row->Status;
if($status==""){
echo htmlentities("Not Updated yet");    
} else {
echo htmlentities("$status");        
}
?></td>
<td><?php echo htmlentities($row->RequsetDate);?></td>
<td>
<a href="adoption-request-details.php?apid=<?php echo htmlentities($row->aid);?>">
<i class="fa fa-file-text"></i>
</a>
                            </button>    
                            </a></td>
</tr>
        <?php $cnt++;
    }} ?>                         

                                </tbody>
                            </table><?php } ?>
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
      <!-- DataTables JavaScript -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="vendor/datatables-responsive/dataTables.responsive.js"></script>
        <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
</body>
</html>
<?php } ?>
