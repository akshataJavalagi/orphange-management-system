<?php
session_start();
include('includes/config.php');
if(isset($_POST['submit']))
  {
    $email=$_POST['email'];
$username=$_POST['username'];
$newpassword=md5($_POST['newpassword']);
  $sql ="SELECT AdminEmail FROM admin WHERE AdminEmail=:email and UserName=:username";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update admin set Password=:newpassword where AdminEmail=:email and UserName=:username";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
$chngpwd1-> bindParam(':username', $username, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
echo "<script>alert('Your Password succesfully changed');</script>";
}
else {
echo "<script>alert('Email id or Mobile no is invalid');</script>"; 
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Orphanage Management System | Forgot Password </title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>
</head>
<body>

    <div class="container">
<div class="row"> 
<div class="col-md-12" align="center">
<h3>OMS  | Forgot Password</h3>
</div>


    </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Recover Your Password</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                           
                            <fieldset>
<!--Username -->
<div class="form-group"> 
<input class="form-control" placeholder="Email Address" name="email" type="text" autofocus required="true">
</div>

<!--Password -->
<div class="form-group">
<input class="form-control" placeholder="User Name" name="username" type="text" required="true" autofocus>
</div>

<div class="form-group">
 <input class="form-control" type="password" name="newpassword" placeholder="New Password" required="true"/>
</div>
<div class="form-group">
<input class="form-control" type="password" placeholder="Confirm Password" name="confirmpassword" required="true"/>
</div>

<!--Submit Button -->                           
<input type="submit" name="submit"  class="btn btn-lg btn-success btn-block"  value="submit">                            </fieldset>
                        </form>
                        <hr />
                        <a class="link-effect text-muted mr-10 mb-5 d-inline-block" href="index.php">
                                                 <i class="fa fa-user text-muted mr-5"></i> Sign In
                                            </a>
                        <div align="center">
<a href="../index.php" class="btn btn-primary">Back to Home Page</a>
</div>

                    </div>
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
