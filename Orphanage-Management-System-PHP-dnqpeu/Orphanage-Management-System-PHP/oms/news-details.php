<?php
session_start();
//datbase connection file
include('includes/config.php');
error_reporting(0);
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>Charifit</title>
   <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- <link rel="manifest" href="site.webmanifest"> -->
   <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
   <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/gijgo.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/slicknav.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
   <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->
    <!-- header-start -->
<?php include_once('includes/header.php');?>
  <!-- header-end -->

  <!-- bradcam_area_start  -->
  <div class="bradcam_area breadcam_bg overlay d-flex align-items-center justify-content-center">
      <div class="container">
          <div class="row">
              <div class="col-xl-12">
                  <div class="bradcam_text text-center">
                      <h3>News Details</h3>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- bradcam_area_end  -->

   <!--================Blog Area =================-->
   <section class="blog_area single-post-area section-padding">
      <div class="container">
         <div class="row">
            <?php
$nid=intval($_GET['nid']);

$sql = "SELECT tblnews.*  from tblnews where id = :nid";
$query = $dbh -> prepare($sql);
$query->bindParam(':nid',$nid,PDO::PARAM_STR);

$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{ 
    ?>
            <div class="col-lg-8 posts-list">
               <div class="single-post">
                  <div class="feature-img">
                     <img class="img-fluid" src="admin/newsimages/<?php echo htmlentities($row->NewsImage);?>" width="500" height="300" alt="">
                  </div>
                  <div class="blog_details">
                     <h2><?php echo htmlentities($row->NewsTitle);?>(<?php echo htmlentities($row->PostingDate);?>)
                     </h2>
                    
                     <p>
                        <?php echo htmlentities($row->NewsDetails);?>
                       
                     </p>
                 
                  </div>
               </div>
            
            </div><?php } } ?>
            <div class="col-lg-4">
               <div class="blog_right_sidebar">
                 
                  <aside class="single_sidebar_widget popular_post_widget">
                     <h3 class="widget_title">Recent News</h3>
                     <?php


$sql = "SELECT tblnews.*  from tblnews order by id desc limit 4";
$query = $dbh -> prepare($sql);

$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{ 
    ?>
                     <div class="media post_item">
                        <img src="admin/newsimages/<?php echo htmlentities($row->NewsImage);?>" width="100" height="100" alt="post">
                        <div class="media-body">
                           <a href="news-details.php?nid=<?php echo htmlentities($row->id);?>">
                              <h3><?php echo htmlentities($row->NewsTitle);?></h3>
                           </a>
                           <p><?php echo htmlentities($row->PostingDate);?></p>
                        </div>
                     </div><?php } } ?>
                   
                    
                  
                  </aside>
         
               </div>
            </div>
         </div>
      </div>
   </section>
   <!--================ Blog Area end =================-->

    <!-- footer_start  -->
   <?php include_once('includes/footer.php');?>
  <!-- footer_end  -->

  <!-- JS here -->
  <script src="js/vendor/modernizr-3.5.0.min.js"></script>
  <script src="js/vendor/jquery-1.12.4.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/isotope.pkgd.min.js"></script>
  <script src="js/ajax-form.js"></script>
  <script src="js/waypoints.min.js"></script>
  <script src="js/jquery.counterup.min.js"></script>
  <script src="js/imagesloaded.pkgd.min.js"></script>
  <script src="js/scrollIt.js"></script>
  <script src="js/jquery.scrollUp.min.js"></script>
  <script src="js/wow.min.js"></script>
  <script src="js/nice-select.min.js"></script>
  <script src="js/jquery.slicknav.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/plugins.js"></script>
  <script src="js/gijgo.min.js"></script>
  <!--contact js-->
  <script src="js/contact.js"></script>
  <script src="js/jquery.ajaxchimp.min.js"></script>
  <script src="js/jquery.form.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/mail-script.js"></script>

  <script src="js/main.js"></script>
  <script>
      $('.datepicker').datepicker({
          iconsLibrary: 'fontawesome',
          icons: {
              rightIcon: '<span class="fa fa-calendar"></span>'
          }
      });

      $('.timepicker').timepicker({
          iconsLibrary: 'fontawesome',
          icons: {
              rightIcon: '<span class="fa fa-clock-o"></span>'
          }
      });
  </script>
</body>

</html>