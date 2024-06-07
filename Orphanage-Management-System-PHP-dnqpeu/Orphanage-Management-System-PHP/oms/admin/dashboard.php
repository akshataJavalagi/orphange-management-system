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

    <title>OMS | Dashboard</title>

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
                    <h1 class="page-header"> Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                   <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file fa-5x"></i>
                                </div>

<?php 
$sql ="SELECT ID from tblchild ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$totchild=$query->rowCount();
?>



                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo htmlentities($totchild);?></div>
                                    <div>Total Child</div>
                                </div>
                            </div>
                        </div>
                        <a href="manage-child.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                                

<!------------Subjects------------>

             <div class="col-lg-4 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
<?php 
$sql1 ="SELECT Userid from tblusers ";
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$totuser=$query1->rowCount();
?>

                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo htmlentities($totuser);?></div>
                                    <div>Total Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="manage-users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Detail</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

<!---- Students----->
       <div class="col-lg-4 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-files-o fa-fw fa-5x"></i>
                                </div>

<?php 
$sql2 ="SELECT id from tblnews ";
$query2 = $dbh -> prepare($sql1);
$query2->execute();
$results2=$query2->fetchAll(PDO::FETCH_OBJ);
$totnews=$query2->rowCount();
?>


                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo htmlentities($totnews);?></div>
                                    <div>Total News</div>
                                </div>
                            </div>
                        </div>
                        <a href="manage-news.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                  
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                   <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file fa-5x"></i>
                                </div>

<?php 
$sql1 ="SELECT ID from tbladoption where Status is null";
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$newreq=$query1->rowCount();
?>



                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo htmlentities($newreq);?></div>
                                    <div>New Adoption Request</div>
                                </div>
                            </div>
                        </div>
                        <a href="manage-child.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                                

<!------------Subjects------------>

             <div class="col-lg-4 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-files-o fa-5x"></i>
                                </div>
<?php 
$sql1 ="SELECT ID from tbladoption where Status='Accepted'";
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$accreq=$query1->rowCount();
?>

                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo htmlentities($accreq);?></div>
                                    <div>Accepted Adoption Request</div>
                                </div>
                            </div>
                        </div>
                        <a href="new-adoption-request.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Detail</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

<!---- Students----->
       <div class="col-lg-4 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-files-o fa-fw fa-5x"></i>
                                </div>

<?php 
$sql1 ="SELECT ID from tbladoption where Status='Rejected'";
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$rejreq=$query1->rowCount();
?>


                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo htmlentities($rejreq);?></div>
                                    <div>Rejected Adoption Request</div>
                                </div>
                            </div>
                        </div>
                        <a href="rejected-adoption-request.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                  
                </div>
                <!-- /.col-lg-12 -->
            </div>
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
