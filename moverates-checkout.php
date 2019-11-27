<?php
/*
*  Template Name: Moverates Checkout
*/
?>

<!-- GET OUR DATA FROM THE FRONT END FORM -->

<?php // set all of our required variables
$DEBUG = 0; // 0 = false, 1 = true;

// get the data from http post request and set into variables for processing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if($DEBUG === 1) {
    print_r($_POST);
  }
  $mainCity = $_POST["mainCit"];
  $totalVolume = $_POST["volcuft"];
  $originAddress = $_POST["oaaddress"];
  $destinationAddress = $_POST["daaddress"];
  $totalDistance = $_POST["totalDistance"];

  //$cratingCuftNeed = $_COOKIE["crating"];
  //$hoistingHourNeed = $_COOKIE["hoisting"];

  $cartonDrop = sanitize_text_field($_COOKIE['carton_drop']);
  $pictureHanging = sanitize_text_field($_COOKIE['picture_hanging']);
  $longCarry = sanitize_text_field($_COOKIE['long_carry']);
  $stairCarry = sanitize_text_field($_COOKIE['stair_carry']);
  $overTime = sanitize_text_field($_COOKIE['holiday_or_weekend']);
  $grandPiano = sanitize_text_field($_COOKIE['grand_piano']);
  $uprightPiano = sanitize_text_field($_COOKIE['upright_piano']);
  $noPacking = sanitize_text_field($_COOKIE['no_packing']);
  $noUnpacking = sanitize_text_field($_COOKIE['no_unpacking']);

  $movingCompany = $_POST["movingcompany"];
  $estimatedTrucks = $_POST["estimatedtrucks"];
  $inventoryList = $_POST["inventoryList"];
  $moverid= $_POST["moverid"];
  $price = $_POST["price"];
  $decimalprice = ceil($price);


  $movedate = $_POST["movingdate"];
  $mover = $_POST["movingcompany"];

  $totalTravelTime = $_POST["totalTravelTime"];
  $totalTravelhrs = $_POST["totalTravelhrs"];
  $totalTravelmins = $_POST["totalTravelmins"];

  $inventoryList = $_POST["inventorylist"];

  $totalTruckCount = ceil($totalVolume / 200);

}
?>


<!--  BEGIN CALCULATE PRICE FOR EACH MOVER BASED ON MOVERS PROFILE OPTIONS-->



<!--  END PRICING CALCULATION -->

<?php
if($_COOKIE['move_type'] === 'international') {
  $productimage =  plugins_url() . '/moverates/assets/images/International-shipping450x253.jpg';
} else {
  $productimage = wp_get_attachment_image_src( get_post_thumbnail_id( 583 ), 'single-post-thumbnail' );
}



$movermeta = get_user_meta($moverid);
$companyname = $movermeta['companyname'][0];
$yearstarted =  $movermeta['companystarted'][0];
$trucks =  $movermeta['trucks'][0];
$employees =  $movermeta['employees'][0];
$introduction =  $movermeta['introduction'][0];
$companylogo =  $movermeta['companylogo'][0];

$url = site_url();
$logoPathway = get_option('company_logo');

?>
<?php get_header();?>

    <div class="content-page">
          <!-- Start content -->
          <div class="content mt-5">
              <div class="container">

                  <!-- Page-Title -->
                  <div class="row">
                    <h3 class="display-3 text-secondary font-weight-bold">Great, Let's Book Your Move.</h3>
                  </div>

                  <div class="row">
                      <div class="col-12">
                          <div class="card-box product-detail-box">
                              <div class="row">
                                  <div class="col-sm-4">
                                    <div class="sp-wrap sp-non-touch" style="display: inline-block;">
                                      <div class="sp-large"><a href="#" class=".sp-current-big"><img class="card-img-top img-fluid img-resultscard" src="<?php echo $productimage ;?>" alt=""></a></div>
                                    </div>
                                  </div>

                                  <div class="col-sm-8">
                                      <div class="product-right-info">
                                          <h4 id="moversname"><?php echo $movingCompany ?></h4>
                                          <div class="rating">
                                              <ul class="list-inline">
                                                  <li class="list-inline-item text-warning"><a class="fa fa-star" href=""></a></li>
                                                  <li class="list-inline-item text-warning"><a class="fa fa-star" href=""></a></li>
                                                  <li class="list-inline-item text-warning"><a class="fa fa-star" href=""></a></li>
                                                  <li class="list-inline-item text-warning"><a class="fa fa-star" href=""></a></li>
                                                  <li class="list-inline-item text-warning"><a class="fa fa-star-o" href=""></a></li>
                                              </ul>
                                          </div>

                                          <h2>Your Guaranteed Price: <span id="checkoutprice" class="text-success display-3"><?php echo number_format($_COOKIE["moveprice"]);?></span><small class="text-muted m-l-10"></small></h2>
                                          <!-- Dynamically place move details bar here -->
                                          <div class="row" id="movedetailsbar">
                                            <div class="col-md-2">
                                              <p class="text-center"><small>Est. Vol (CBM)</small></p>
                                              <h6 class="text-warning text-center display-4" id="estVolumeCuft"><?php echo $_COOKIE["movevolume"] ;?></h6>
                                            </div>
                                            <div class="col-md-3">
                                              <p class="text-center"><small>Origin Address</small></p>
                                              <h6 class="text-info text-center" id="origin"><?php echo $_COOKIE["moveorigin"] ;?></h6>
                                            </div>
                                            <div class="col-md-3">
                                              <p class="text-center"><small>Destination Address</small></p>
                                              <h6 class="text-info text-center" id="destination"><?php echo $_COOKIE["movedestination"] ;?></h6>
                                            </div>
                                            <div class="col-md-4">
                                              <p class="text-center"><small>Mode</small></p>
                                              <h6 class="text-warning text-center display-4"><?php echo $_COOKIE["movemode"] ;?></h6>
                                            </div>
                                          </div>

                                            <h5 class="m-t-20"><b>Addtional Services Included:</b></h5>
                                            <h5 class="d-flex flex-wrap" id="accservices">
                                               <?php
                                               //if($hoistingHourNeed === 'yes'){ echo '<span class="label services-label" style="background-color: #007bff;">Long Carry</span>';} else { echo '';}
                                               if($cartonDrop === 'yes'){ echo '<span class="label services-label" style="background-color: #6610f2;">Carton Drop</span>';} else { echo '';}
                                               if($pictureHanging === 'yes'){ echo '<span class="label services-label" style="background-color: #e83e8c;">Picture Hanging</span>';} else { echo '';}
                                               if($cartonDrop === 'yes'){ echo '<span class="label services-label" style="background-color: #dc3545;">Long Carry</span>';} else { echo '';}
                                               if($stairCarry === 'yes'){ echo '<span class="label services-label" style="background-color: #ffc107;">Stair Carry</span>';} else { echo '';}
                                               if($overTime === 'yes'){ echo '<span class="label services-label" style="background-color: #28a745;">Sat/Sun</span>';} else { echo '';}
                                               if($grandPiano === 'yes'){ echo '<span class="label services-label" style="background-color: #20c997;">Grand Piano</span>';} else { echo '';}
                                               if($uprightPiano === 'yes'){ echo '<span class="label services-label" style="background-color: #7d7d7d;">Upright Piano</span>';} else { echo '';}
                                               if($noPacking === 'yes'){ echo '<span class="label services-label" style="background-color: #17a2b8;">No Packing</span>';} else { echo '';}
                                               if($noUnpacking === 'yes'){ echo '<span class="label services-label" style="background-color: #246aaf;">No Unpacking</span>';} else { echo '';}
                                              ;?>
                                            </h5>
                                          <hr>

                                          <h5 class="font-600">Trust <?php echo get_option('company_name');?> with your move.</h5>

                                          <p class="text-muted"><?php echo get_option('company_introduction');?></p>

                                      </div>

                                  </div>
                              </div>
                              <!-- end row -->

                              <div class="row m-t-30">
                                  <div class="col-12">
                                      <div class="card-box">
                                          <h4 class="m-t-0 m-b-30 header-title">Move Details</h4>

                                          <?php // This runs the Woocommerce Checkout functions. To change, see the woocommerce -> checkout - > Form-billing.php file
                                            if ( have_posts() ) : while ( have_posts() ) : the_post();
                                            the_content();
                                            endwhile; else: ?>
                                            <p>Sorry, no posts matched your criteria.</p>
                                          <?php endif; ?>

                                      </div>
                                  </div>
                              </div>
                          </div> <!-- end card-box/Product detai box -->
                      </div> <!-- end col -->
                  </div> <!-- end row -->

              </div> <!-- container -->

          </div> <!-- content -->

          <footer class="footer text-right">
              <script type="text/javascript">
                var movedate = "<?php echo $movedate ?>";
                var totalvolume = "<?php echo $totalVolume ?>";
                var pickup = "<?php echo $originAddress ?>";
                var destination = "<?php echo $destinationAddress?>";
                var movingcompany = "<?php echo $mover?>";
                var estPrice = "<?php echo $roundedprice?>";
                var trucks = "<?php echo $truckEstimate?>";
                var distance = "<?php echo $totalDistance ?>";
                var traveltimehrs = "<?php echo $totalTravelhrs?>";
                var traveltimemins = "<?php echo $totalTravelmins?>";
                var cratingCuftNeed = "<?php echo $cratingCuftNeed ?>";
                var hoistingHourNeed = "<?php echo $hoistingHourNeed ?>";
                var CartonDropNeed = "<?php echo $CartonDropNeed ?>";
                var pictureHangingFlatNeed = "<?php echo $pictureHangingFlatNeed ?>";
                var longCarryCuft = "<?php echo $longCarryCuftNeed ?>";
                var stairCarryCuft = "<?php echo $stairCarryCuftNeed ?>";
                var weekendOvertimeFLATNeed = "<?php echo $weekendOvertimeFLATNeed ?>";
                var grandPianoNeed = "<?php echo $grandPianoNeed ?>";
                var uprightPianoNeed = "<?php echo $uprightPianoNeed ?>";
                var noPackingNeed = "<?php echo $noPackingNeed ?>";
                var noUnpackingNeed = "<?php echo $noUnpackingNeed ?>";
                var inventory = "<?php echo $inventoryList?>";

                console.log('Movedate:'+movedate);
                console.log('Volume:'+totalvolume);
                console.log('Pickup:'+pickup);
                console.log('Destination:'+destination);
                console.log('Price:')+(estPrice);
                console.log('Mover:'+movingcompany);
                console.log('Trucks:'+trucks);
                console.log('Distance:'+distance);
                console.log('Travel time hr:'+traveltimehrs);
                console.log('Travel time Mins:'+traveltimemins);
                console.log('Crating:'+cratingCuftNeed);
                console.log('Hoisting:'+hoistingHourNeed);
                console.log('Carton drop:'+CartonDropNeed);
                console.log('Picture Hanging:'+pictureHangingFlatNeed);
                console.log('Long Carry:'+longCarryCuft);
                console.log('Stair Carry:'+stairCarryCuft);
                console.log('Weekend:'+weekendOvertimeFLATNeed);
                console.log('Grand Piano:'+grandPianoNeed);
                console.log('Upright Piano:'+uprightPianoNeed);
                console.log('No Packing:'+noPackingNeed);
                console.log('No Unpacking:'+noUnpackingNeed);
                console.log('Inventory:'+inventory);
              </script>
          </footer>

      </div>


<?php get_footer();?>
