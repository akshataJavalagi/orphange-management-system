<hr />
<footer class="footer">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-md-6 col-lg-4 ">
                        <div class="footer_widget">
                            <div class="footer_logo">
                                <a href="index.php">
                                   Orphanage Management System
                                </a>
                            </div>
                             <?php
 $ptype="aboutus";
$ret = "select  PageDetails from tblpages where PageType=:ptype";
$query = $dbh -> prepare($ret);
$query -> bindParam(':ptype',$ptype, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{ ?>
                            <p class="address_text"><?php echo $row->PageDetails;?>
                            </p> <?php }} ?>
                       

                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-4">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Quick Links
                            </h3>
                            <ul class="links">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="childs.php">Our Children</a></li>
                                <li><a href="About.php">About</a></li>
                                <li><a href="contact.php">Contact</a></li>
                                <li><a href="admin/index.php">Admin</a></li>
                               
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-4">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Contacts
                            </h3>
                            <div class="contacts">
                                 <?php

$ret = "select * from tblgenralsettings";
$query = $dbh -> prepare($ret);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{ ?>
                                <p>+<?php echo $row->PhoneNumber;?> <br>
                                    <?php echo $row->EmailId;?> <br>
                                   <?php echo $row->address;?>
                                </p> <?php }} ?>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
        <div class="copy-right_text">
            <div class="container">
                <div class="row">
                    <div class="bordered_1px "></div>
                    <div class="col-xl-12">
                        <p class="copy_right text-center" style="color: blue;font-weight: bold;font-size: 20px;">
                           Orphanage Management System
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>