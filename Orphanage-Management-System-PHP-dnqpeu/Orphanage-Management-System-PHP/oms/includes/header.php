   <header>
        <div class="header-area ">
            <div class="header-top_area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-md-12 col-lg-8">
                            <div class="short_contact_list">
                                <ul>
                                     <?php

$ret = "select * from tblgenralsettings";
$query = $dbh -> prepare($ret);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{ 
$website=$row->SiteName;
    ?>
                                    <li><a href="#"> <i class="fa fa-phone"></i> +<?php echo $row->PhoneNumber;?></a></li>
                                    <li><a href="#"> <i class="fa fa-envelope"></i><?php echo $row->EmailId;?></a></li><?php }} ?>

                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-lg-4">
                            <div class="social_media_links d-none d-lg-block">
                                 <?php if($_SESSION['usrid']==0):?>
                                <a href="signin.php">
                                    <i class="fa fa-sign-in"> Signin</i>
                                </a>
                                <a href="signup.php">
                                    <i class="fa fa-registered"> Signup</i>
                                </a><?php endif;?>
                                <?php if($_SESSION['usrid']!=0):?>
                                <a href="logout.php">
                                    <i class="fa fa-sign-out"> Logout</i> <?php endif;?> 
                                </a>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-3">
                            <div class="logo">
                                <a href="index.html">
                                    <img src="img/oms.jpg" width="80" height="80" alt="">
                                </a>

                            </div>
                              <?php echo $website;?>
                        </div>
                        <div class="col-xl-9 col-lg-9">
                            <div class="main-menu">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="index.php">home</a></li>
                                        <li><a href="About.php">About</a></li>
                                        <li><a href="admin/index.php">Admin</a></li>
                                        <li><a href="childs.php">Our Childrens</a></li>
                                   <?php if($_SESSION['usrid']!=0):?>
                                        <li><a href="#">My Account <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="profile.php">Profile</a></li>
                                                <li><a href="setting.php">Setting</a></li>
                                                <li><a href="request-history.php">Request History</a></li>
                                                <li><a href="logout.php">Logout</a></li>
                                            </ul>
                                        </li><?php endif;?>
                                        
                                        <li><a href="contact.php">Contact</a></li>
                                    </ul>
                                </nav>
                               
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->