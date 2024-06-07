            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
<a class="navbar-brand" href="dashboard.php" style="color: red;">
OMS | Admin Panel
</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
<li class="divider"></li>
                 
<?php
$sql = "SELECT tbladoption.ID as aid,tbladoption.Requestnumber,tbladoption.RequsetDate from tbladoption  where tbladoption.Status is null";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{ 
    ?>
                        <li>
                            <a href="adoption-request-details.php?apid=<?php echo htmlentities($row->aid);?>">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i>Request No: <?php echo htmlentities($row->Requestnumber);?>
                                    <span class="pull-right text-muted small"><?php echo htmlentities($row->RequsetDate);?></span>
                                </div>
                            </a>
                        </li>
                        <br>
                        <li class="divider"></li>
                   <?php }} ?>
              
                        <li>
                            <a class="text-center" href="new-adoption-request.php">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="admin-profile.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                         <li class="divider"></li>
                        <li><a href="change-password.php"><i class="fa fa-gear fa-fw"></i> Change Password</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>