<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['adminsession'])==0)
{   
header('location:logout.php');
}
else{ 
// Code for remark updation
if(isset($_POST['updatebooking']))
    {
$apid=intval($_GET['apid']);
$adminremark=$_POST['adminremark'];
$status=$_POST['status'];
$childid=$_POST['childid'];
$sql="update tbladoption set Remark=:adminremark,Status=:status where  ID=:apid";
$query = $dbh->prepare($sql);
$query-> bindParam(':apid', $apid, PDO::PARAM_STR);
$query-> bindParam(':adminremark', $adminremark, PDO::PARAM_STR);
$query-> bindParam(':status', $status, PDO::PARAM_STR);
$query->execute();
//////////////////////////////////////////////////////
if($status=='Accepted'):
$query1= $dbh->prepare("update tblchild set isAdopted=1 where  ID=:cid");
$query1-> bindParam(':cid', $childid, PDO::PARAM_STR);
$query1->execute();
endif;
echo "<script>alert('Success: Request details has been updated.');</script>";
echo "<script>window.location.href='all-adoption-request.php'</script>"; 
}
    
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Orphanage Management System | Adoption Request Details</title>

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
                    <h1 class="page-header"> Adoption Request Details</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">

          <?php
     $apid=intval($_GET['apid']);     
$sql = "SELECT tblchild.ID as childid,tbladoption.ID as aid,tbladoption.Userid,tbladoption.Childid,tbladoption.Requestnumber,tbladoption.Address,tbladoption.Occupation,tbladoption.Income,tbladoption.Reasonforadoption,tbladoption.MaritalStatus,tbladoption.SpouseName,tbladoption.SpousePhonenumber,tbladoption.SpouceEmail,tbladoption.SpouseIncome,tbladoption.SpouseOccupation,tbladoption.IsActive,tbladoption.Remark,tblusers.FullName,tblusers.Emailid,tblusers.PhoneNumber,tblusers.UserGender,tblusers.RegDate,tblusers.IsActive,tblchild.ID,tblchild.IndentificationNumber,tblchild.ChildName,tblchild.ChildGender,tblchild.ChildArrivalDate,tblchild.AllergicIssue,tblchild.BloodGroup,tblchild.Age,tblchild.ChildPhoto,tblchild.IsActive,tblchild.RegDate,tbladoption.Status,tbladoption.RequsetDate from tbladoption join tblusers on tblusers.Userid=tbladoption.Userid join tblchild on tblchild.ID=tbladoption.Childid where tbladoption.ID=:apid";
$query = $dbh -> prepare($sql);
$query->bindParam(':apid',$apid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{ 
$chid=$row->childid;
    ?>              
                        <div class="panel-heading">
                          #<?php echo htmlentities($row->Requestnumber);?> Adoption Request Details
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
            
<table width="100%" class="table table-striped table-bordered table-hover" >
<tr>
<th>Request Number</th>    
<td colspan="2"><?php echo htmlentities($row->Requestnumber);?></td>
<th>Adoption Requset Date</th>    
<td colspan="2"><?php echo htmlentities($row->RequsetDate);?></td>

</tr>    
<tr>
    <th colspan="6" style="text-align: center;color: blue;">Requester Details</th>
</tr>
<tr>
<th>Name</th>    
<td colspan="2"><?php echo htmlentities($row->FullName);?></td>
<th>Email</th>    
<td colspan="2"><?php echo htmlentities($row->Emailid);?></td>

</tr> 
<tr>
<th>Phone Number</th>    
<td colspan="2"><?php echo htmlentities($row->PhoneNumber);?></td>
<th>Marital Status</th>    
<td colspan="2"><?php echo htmlentities($row->UserGender);?></td>

</tr> 
<tr>
<th>Address</th>    
<td colspan="2"><?php echo htmlentities($row->Address);?></td>
<th>Occupation</th>    
<td colspan="2"><?php echo htmlentities($row->Occupation);?></td>

</tr> 
<tr>
<th>Income(permonth)</th>    
<td colspan="2"><?php echo htmlentities($row->Income);?></td>
<th>Spouse Name</th>    
<td colspan="2"><?php echo htmlentities($row->SpouseName);?></td>

</tr> 
<tr>
<th>Spouse Phone Number</th>    
<td colspan="2"><?php echo htmlentities($row->SpousePhonenumber);?></td>
<th>Spouce Email</th>    
<td colspan="2"><?php echo htmlentities($row->SpouceEmail);?></td>

</tr> 
<tr>
<th>Spouse Occupation</th>    
<td colspan="2"><?php echo htmlentities($row->SpouseOccupation);?></td>
<th>Spouse Income</th>    
<td colspan="2"><?php echo htmlentities($row->SpouseIncome);?></td>

</tr> 
<tr>
<th>Reason For Adoption</th>    
<td colspan="2"><?php echo htmlentities($row->Reasonforadoption);?></td>
<th>Status</th>    

<td colspan="2"><?php $status=$row->Status;
if($status==""){
echo htmlentities("Not Confirmed yet");    
} else {
echo htmlentities("$status");        
}
?></td>
</tr>

<tr>
    <th colspan="6" style="text-align: center;color: blue;">Child Details</th>
</tr>
<tr>
<th>Child Identifications Number</th>    
<td colspan="2"><?php echo htmlentities($row->IndentificationNumber);?></td>
<th>Child Name</th>    
<td colspan="2"><?php echo htmlentities($row->ChildName);?></td>
</tr> 
<tr>
<th>Child Gender</th>    
<td colspan="2"><?php echo htmlentities($row->ChildGender);?></td>
<th>Child Arrival Date</th>    
<td colspan="2"><?php echo htmlentities($row->ChildArrivalDate);?></td>
</tr>
<tr>
<th>Allergic Issue</th>    
<td colspan="2"><?php echo htmlentities($row->AllergicIssue);?></td>
<th>Blood Group</th>    
<td colspan="2"><?php echo htmlentities($row->BloodGroup);?></td>

</tr>
<tr>
<th>Age</th>    
<td colspan="2"><?php echo htmlentities($row->Age);?></td>
<th>ChildPhoto</th>    
<td colspan="2"><img src="../admin/childimages/<?php echo htmlentities($row->ChildPhoto);?>" width="50" height="50"></td>
</tr>
<?php if($row->Remark!=""){?>
<tr>
<th>Admin Remark</th>    
<td colspan="5"><?php echo htmlentities($row->Remark);?></td>
</tr>
<?php } ?>

<?php if($row->UpdationDate!=""){?>
<tr>
<th>Updation Date</th>    
<td colspan="5"><?php echo htmlentities($row->UpdationDate);?></td>
</tr>
<?php } ?>

</table>

<?php if($status==""){?>
<div class="form-group" align="center">  
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Take Action</button>               
 </div> 
      <?php } ?>                          </div>

                            </div>
                            <!-- /.row (nested) -->
                        </div>
<?php }} ?>


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
<!--Take action model--->
<div id="myModal" class="modal fade" role="dialog" style="margin-top:10%">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Admin take action</h4>
      </div>
      <div class="modal-body">
        <form name="adminremark" method="post">
            <input type="hidden" name="childid" value="<?php echo $chid;?>">
          <p><textarea  placeholder="Admin remark" class="form-control" name="adminremark" required="true"></textarea></p>
         <p><select name="status" required="true" class="form-control">
           <option value="Accepted">Accepted</option>  
           <option value="Rejected">Rejected</option> 
         </select></p> 
          <p><button type="submit" class="btn btn-info btn-lg" name="updatebooking">Submit</button></p>
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>





    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/metisMenu/metisMenu.min.js"></script>
    <script src="dist/js/sb-admin-2.js"></script>
</body>
</html>
<?php } ?>
