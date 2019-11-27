<?php
/*
* Additional Short codes
*/

add_shortcode('address', 'display_address');
function display_address(){
  echo '<span class="address">' . get_option('company_address') . '</span>';
}
add_shortcode('phone', 'display_phone');
function display_phone(){
  echo '<span class="phone">' . get_option('company_phone') . '</span>';
}
add_shortcode('email', 'display_email');
function display_email(){
  echo '<span class="email">' . get_option('company_email_contact') . '</span>';
}
add_shortcode('product-id', 'display_product_id');
function display_product_id(){
  $slug = 'domestic-move';
  $product_obj = get_page_by_path( $slug, OBJECT, 'product' );
  echo $product_obj->ID;
  echo "Got the code:";
}

/*
* DOMESTIC MOVE PAGE SHORTCODES START
*/

// Domestic Moving Address input form
add_shortcode('home-form', 'home_address_form');
function home_address_form(){
  ?>
  <form>
    <div class="form-row">
      <div class="form-group  mr-2">
        <input type="text" class="form-control" id="pickupAddress" placeholder="Pickup Address">
      </div>
      <div class=" mr-2">
          <label class="sr-only" for="inlineFormInput"><?php _e('Floor','moverates');?></label>
          <input type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Floor #">
      </div>
      <div class="">
            <select class="custom-select mb-2">
                      <option selected="" disabled><?php _e('Elevator','moverates');?>'</option>
                      <option value="1"><?php _e('Yes','moverates');?></option>
                      <option value="2"><?php _e('No','moverates');?></option>
            </select>
        </div>
    </div>
    <div class="form-row">
      <div class="form-group  mr-2">
        <input type="text" class="form-control" id="deliveryAddress" placeholder="Delivery Address">
      </div>
      <div class=" mr-2">
          <label class="sr-only" for="deliveryFloor"><?php _e('Floor','moverates');?></label>
          <input type="text" class="form-control mb-2" id="deliveryFloor" placeholder="Floor #">
      </div>
      <div class="">
            <select class="custom-select mb-2">
                      <option selected="" disabled><?php _e('Elevator','moverates');?></option>
                      <option value="1"><?php _e('Yes','moverates');?></option>
                      <option value="2"><?php _e('No','moverates');?></option>
            </select>
      </div>


    </div>
    <a href="#scrollOffset" class="btn btn-success btn-lg btn-block " id="bannerbutton"  onclick="smoothScroll(document.getElementById('scrollOffset'))">Let's Move</a>
  </form>
  <?php
}

/* Display the crossbar with pickup address, delivery address, estimated volume, total Km, total hr, totl mins*/
add_shortcode('move-details-bar', 'details_cross_bar_display');
function details_cross_bar_display(){
  ?>
    <div class="row" id="movedetailsbar">
      <div class="col-md-2">
        <p class="text-center"><small><?php _e('Est. Volume (Cubic Feet)','moverates');?></small></p>
        <h6 class="text-success text-center display-4" id="estVolumeCuft">--</h6>
      </div>
      <div class="col-md-2">
        <p class="text-center"><small><?php _e('Origin Address','moverates');?>'</small></p>
        <h6 class="text-info text-center" id="origin">--</h6>
      </div>
      <div class="col-md-2">
        <p class="text-center"><small><?php _e('Destination Address','moverates');?></small></p>
        <h6 class="text-info text-center" id="destination">--</h6>
      </div>
      <div class="col-md-2">
        <p class="text-center"><small><?php _e('Total Distance (Km)','moverates');?></small></p>
        <h6 class="text-warning text-center display-4" id="distance">--</h6>
      </div>
      <div class="col-md-2">
        <p class="text-center"><small><?php _e('Drive Time','moverates');?></small></p>
        <h6 class="text-warning text-center display-4"><span id="timeHrs">-</span><small class="text-secondary" style="font-size: 2rem;"> Hrs</small> <span id="timeMins">--</span><small class="text-secondary" style="font-size: 2rem;"> Mins.</small></h6>
      </div>
      <div class="col-md-2 submit-button-container">
          <button type="button" id="submitInventoryButton" class="btn btn-lg btn-success waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal"><?php _e('Submit Inventory','moverates');?></button>
      </div>
    </div>

<?php
}

add_shortcode('home-maps-inventory-section', 'home_maps_and_inventory_split_section');
function home_maps_and_inventory_split_section(){
  ?>

  <div class="row">
    <div class="col-md-6 pr-0 pl-0" style="max-height: 500px; overflow-x: hidden; overflow-y: scroll;">

      <!-- INVENTORY -->
      <section class="section" id="inventorySection">

            <section id="items">
              <div class="row">
                <div class="col" id="surveyList">
                  <!-- Room by Room Navigation Tabs -->

                  <div id="accordion">
                      <div class="card">
                          <div class="card-header" id="headingOne">
                              <h6 class="m-0">
                                  <a href="#collapseOne" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne">
                                      <?php _e('Living Room','moverates');?>
                                  </a>
                              </h6>
                          </div>

                          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion" style="">
                              <div class="card-body">
                                  <div class="row" id="livingRoomitemsTab">

                                  </div>

                              </div>
                          </div>
                      </div>
                      <div class="card">
                          <div class="card-header" id="headingTwo">
                              <h6 class="m-0">
                                  <a href="#collapseTwo" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo">
                                      <?php _e('Dining Room','moverates');?>
                                  </a>
                              </h6>
                          </div>
                          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion" style="">
                              <div class="card-body">
                                <div class="row" id="diningRoomItemsTab">

                                </div>
                              </div>
                          </div>
                      </div>
                      <div class="card">
                          <div class="card-header" id="headingThree">
                              <h6 class="m-0">
                                  <a href="#collapseThree" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseThree">
                                     <?php _e('Kitchen','moverates');?>
                                  </a>
                              </h6>
                          </div>
                          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion" style="">
                              <div class="card-body">
                                <div class="row" id="kitchenItemsTab">

                                </div>
                              </div>
                          </div>
                      </div>
                      <div class="card">
                          <div class="card-header" id="headingfour">
                              <h6 class="m-0">
                                  <a href="#collapsefour" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapsefour">
                                   <?php _e('Bedroom 1','moverates');?>
                                  </a>
                              </h6>
                          </div>
                          <div id="collapsefour" class="collapse" aria-labelledby="headingfour" data-parent="#accordion" style="">
                              <div class="card-body">
                                <div class="row" id="bedRoomOneItemsTab">

                                </div>
                              </div>
                          </div>
                      </div>
                      <div class="card">
                          <div class="card-header" id="headingfive">
                              <h6 class="m-0">
                                  <a href="#collapsefive" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapsefive">
                                      <?php _e('Bedroom 2', 'moverates');?>
                                  </a>
                              </h6>
                          </div>
                          <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordion" style="">
                              <div class="card-body">
                                <div class="row" id="bedRoomTwoItemsTab">

                                </div>
                              </div>
                          </div>
                      </div>
                      <div class="card">
                          <div class="card-header" id="headingsix">
                              <h6 class="m-0">
                                  <a href="#collapsesix" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapsesix">
                                      <?php _e('Master Bedroom','moverates');?>
                                  </a>
                              </h6>
                          </div>
                          <div id="collapsesix" class="collapse" aria-labelledby="headingsix" data-parent="#accordion" style="">
                              <div class="card-body">
                                <div class="row" id="masterBedRoomItemsTab">

                                </div>
                              </div>
                          </div>
                      </div>
                      <div class="card">
                          <div class="card-header" id="headingseven">
                              <h6 class="m-0">
                                  <a href="#collapseseven" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapsseven">
                                      <?php _e('Study','moverates');?>
                                  </a>
                              </h6>
                          </div>
                          <div id="collapseseven" class="collapse" aria-labelledby="headingseven" data-parent="#accordion" style="">
                              <div class="card-body">
                                <div class="row" id="studyItemsTab">

                                </div>
                              </div>
                          </div>
                      </div>
                      <div class="card">
                          <div class="card-header" id="headingeight">
                              <h6 class="m-0">
                                  <a href="#collapseeight" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseeight">
                                    <?php _e('Bathrooms','moverates');?>
                                  </a>
                              </h6>
                          </div>
                          <div id="collapseeight" class="collapse" aria-labelledby="headingeight" data-parent="#accordion" style="">
                              <div class="card-body">
                                <div class="row" id="bathRoomsItemsTab">

                                </div>
                              </div>
                          </div>
                      </div>
                      <div class="card">
                          <div class="card-header" id="headingnine">
                              <h6 class="m-0">
                                  <a href="#collapsenine" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapsenine">
                                    <?php _e('Other Rooms / Outdoors','moverates');?>
                                  </a>
                              </h6>
                          </div>
                          <div id="collapsenine" class="collapse" aria-labelledby="headingnine" data-parent="#accordion" style="">
                              <div class="card-body">
                                <div class="row" id="otherRoomsItemsTab">

                                </div>
                              </div>
                          </div>
                      </div>
                  </div>

                </div>
             </div>
           </section>

      </section>

    </div>
    <div class="col-md-6 pr-0 pl-0">
      <!-- MAP -->
      <section class="section" id="mapSection">


            <div id="map" style="height: 500px"></div>
            <script>
              function initMap() {
                var directionsService = new google.maps.DirectionsService;
                var directionsDisplay = new google.maps.DirectionsRenderer;
                var map = new google.maps.Map(document.getElementById('map'), {
                  zoom: 10,
                  center: {lat: 25.033, lng: 121.565 },
                });
                directionsDisplay.setMap(map);

                var onChangeHandler = function() {
                  calculateAndDisplayRoute(directionsService, directionsDisplay);
                };
                //document.getElementById('pickupAddress').addEventListener('change', onChangeHandler);
                document.getElementById('deliveryAddress').addEventListener('change', onChangeHandler);
              }

              function calculateAndDisplayRoute(directionsService, directionsDisplay) {
                directionsService.route({
                  origin: document.getElementById('pickupAddress').value,
                  destination: document.getElementById('deliveryAddress').value,
                  travelMode: 'DRIVING'
                }, function(response, status) {
                  if (status === 'OK') {
                    directionsDisplay.setDirections(response);
                  } else {
                    window.alert('Directions request failed due to ' + status);
                  }
                });
              }
            </script>
          <script type="text/javascript" src="<?php echo plugins_url();?>/moverates/assets/domestic-app.js">

          </script>
          <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo esc_attr( get_option('google_maps_api_key'));?>&callback=initMap" type="text/javascript"></script>
          <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
      </section>
      <!-- END MAP -->
    </div>

  </div>

  <!-- FINAL CONFIRMATION SECTION -->
  <div id="con-close-modal" class="modal blur show pt-3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none; padding-right: 15px;">
      <div class="modal-dialog mt-5 pt-3">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title"><?php _e('Final Move Details','moverates');?></h4>
                  <button type="button" class="close closex" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              <div class="modal-body">
                <div class="row">
                          <div class="col-md-3">
                            <h5 class="text-secondary"><?php _e('You Move Price:','moverates');?></h5>
                          </div>
                          <div class="col-md-9">
                            <h5 class="text-success display-4" id="finaldomesticprice"> -- </h5>
                          </div>
                </div>
                  <div class="row">
                      <div class="col-md-6">
                              <h6 class="text-muted"><?php _e('Total Cubic Feet:','moverates');?> <span class="text-info" id="volumeFinal"></h6>
                      </div>
                      <div class="col-md-6">
                              <h6 class="text-muted"><?php _e('Total Estimated Trucks:','moverates');?> <span class="text-info" id="finalTrucks"></h6>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                            <h6><?php _e('Pickup Address:','moverates');?> </h6><span class="text-info" id="originFinal"></span>
                        </div>
                        <div class="col-md-6">
                            <h6><?php _e('Delivery Address:','moverates');?> </h6><span class="text-info" id="destinationFinal"></span>
                        </div>
                  </div>
                  <div class="row">
                      <div class="col-md-4">
                            <h6><?php _e('Total Distance:','moverates');?> <span class="text-warning" id="distanceFinal"></span> </h6>
                      </div>
                      <div class="col-md-4">
                            <h6><?php _e('Hrs:','moverates');?> <span class="text-warning" id="timeFinalHrs"></span></h6>
                      </div>
                      <div class="col-md-4">
                            <h6><?php _e('Mins:','moverates');?> <span class="text-warning" id="timeFinalMins"></span></h6>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-row" id="accessoryServices">
                          <div class="form-row d-none" id="cratingAndHoisting">
                              <div class="form-group col-md-2">
                                <label for="cratingRequired"><?php _e('Crating','moverates');?></label>
                                <input type="number" class="form-control" id="cratingRequired">
                              </div>
                              <div class="form-group col-md-2">
                                <label for="hoistingNeeded"><?php _e('Hoisting','moverates');?>'</label>
                                <input type="number" class="form-control" id="hoistingNeeded">
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="col">
                                <div class="form-check form-check-inline checkbox checkbox-info">
                                    <input class="form-check-input" type="checkbox" id="cartonDrop" onclick="valueFunc(this.id)" value="none">
                                    <label class="form-check-label" for="inlineCheckbox1"><?php _e('Carton Drop','moverates');?></label>
                                </div>
                                <div class="form-check form-check-inline checkbox checkbox-info">
                                      <input class="form-check-input" type="checkbox" id="pictureHanging" onclick="valueFunc(this.id)" value="none">
                                      <label class="form-check-label" for="inlineCheckbox3"><?php _e('Picture Hang','moverates');?></label>
                                </div>
                                <div class="form-check form-check-inline checkbox checkbox-info">
                                    <input class="form-check-input" type="checkbox" id="longCarry" onclick="valueFunc(this.id)" value="none">
                                    <label class="form-check-label" for="inlineCheckbox2"><?php _e('Long Carry','moverates');?></label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check form-check-inline checkbox checkbox-info">
                                  <input class="form-check-input" type="checkbox" id="stairCarry" onclick="valueFunc(this.id)" value="none">
                                  <label class="form-check-label" for="inlineCheckbox3"><?php _e('Stair Carry','moverates');?></label>
                                </div>
                                <div class="form-check form-check-inline checkbox checkbox-info">
                                  <input class="form-check-input" type="checkbox" id="overTime" onclick="valueFunc(this.id)" value="none">
                                  <label class="form-check-label" for="inlineCheckbox3"><?php _e('Holiday','moverates');?></label>
                                </div>
                                <div class="form-check form-check-inline checkbox checkbox-info">
                                  <input class="form-check-input" type="checkbox" id="grandPiano" onclick="valueFunc(this.id)" value="none">
                                  <label class="form-check-label" for="inlineCheckbox3"><?php _e('Grand Piano','moverates');?></label>
                                </div>
                              </div>
                            <div class="col">
                              <div class="form-check form-check-inline checkbox checkbox-info">
                                <input class="form-check-input" type="checkbox" id="uprightPiano" onclick="valueFunc(this.id)" value="none">
                                <label class="form-check-label" for="inlineCheckbox3"><?php _e('Upright Piano','moverates');?></label>
                              </div>
                              <div class="form-check form-check-inline checkbox checkbox-info">
                                <input class="form-check-input" type="checkbox" id="noPacking" onclick="valueFunc(this.id)" value="none">
                                <label class="form-check-label" for="inlineCheckbox3"><?php _e('No Packing','moverates');?></label>
                              </div>
                              <div class="form-check form-check-inline checkbox checkbox-info">
                                <input class="form-check-input" type="checkbox" id="noUnpacking" onclick="valueFunc(this.id)" value="none">
                                <label class="form-check-label" for="inlineCheckbox3"><?php _e('No Unpacking','moverates');?></label>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
             </div>
                  <div class="row pr-5 pl-5">
                      <div class="col-md-12">
                          <div class="form-group no-margin">
                            <h5 class="text-secondary"><?php _e('Inventory','moverates');?></h5>
                            <ul class="list-group list-group-flush" id="inventoryItemsFinalList" style="overflow-y: scroll; max-height: 250px;">

                              <!-- Dynamically populate list items will show here -->

                            </ul>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                    <!--  This is the final form in the pop-up modal that will be sent for processing, it is hidden on the front end -->

                    <div class="hiddenForm d-none">
                      <form class="cart" action="<?php site_url() ;?>/checkout" method="post" enctype="multipart/form-data" id="inventorySubmit">
                        <div class="quantity">
                           <input type="number" id="quantity_5ae8016f9be22" class="hiddenForm input-text qty text" step="0" min="0" max="0" name="quantity" value="0" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric" aria-labelledby="">
                         </div>
                        <input type="number" name="mainCit" id="mainCit" value="">
                        <input type="number" name="volcuft" id="finalVolumeInput" value="">
                        <input type="text" name="oaaddress" id="finalOriginAddressInput" value="">
                        <input type="text" name="oaaddressLAT" id="finalOriginAddressInputLAT" value="">
                        <input type="text" name="oaaddressLONG" id="finalOriginAddressInputLONG" value="">
                        <input type="text" name="daaddress" id="finalDestinationAddressInput" value="">
                        <input type="number" name="totalDistance" id="finalDistanceInput"value="">
                        <input type="number" name="totalTravelhrs" id="finalTravelhrs" value="">
                        <input type="number" name="totalTravelmins" id="finalTravelTimemins" value="">
                        <input type="number" name="crating" id="cratefinal" value="">
                        <input type="number" name="hositing" id="hoistfinal" value="">
                        <input type="text" name="cartondrop" id="cartonfinal" value="none">
                        <input type="text" name="picturehang" id="picturehangfinal" value="none">
                        <input type="text" name="longcarry" id="longcarryfinal" value="none">
                        <input type="text" name="staircarry" id="staircarryfinal" value="none">
                        <input type="text" name="holiday" id="holidayfinal" value="none">
                        <input type="text" name="grandpiano" id="grandpianofinal" value="none">
                        <input type="text" name="uprightpiano" id="uprightpianofinal" value="none">
                        <input type="text" name="nopacking" id="nopackfinal" value="none">
                        <input type="text" name="nounpacking" id="nounpackfinal" value="none">
                        <input type="text" name="inventoryList" id="inventoryList" value="none">
                      </form>
                    </div>
                  </div>
                  <div class="row pr-5 pl-5 pt-2">
                    <button type="submit" id="finalSubmitbtn" class="btn btn-block bg-success bookNow button alt"><?php _e('Get Instant Quote','moverates');?></button>
                  </div>
                  <div class="modal-footer">
                    <div class="col">
                      <button type="submit" class="btn bg-warning btn-block" data-dismiss="modal"><?php _e('Add More Items', 'moverates') ;?></button>
                    </div>
                    <div class="col">
                      <?php
                      $slug = 'domestic-move';
                      $product_obj = get_page_by_path( $slug, OBJECT, 'product' );
                      $product_id = $product_obj->ID; // Domestic Move product ID
                      ?>
                      <button type="submit" class="btn single_add_to_cart_button btn-block" value="<?php echo $product_id;?>" form="inventorySubmit" name="add-to-cart"><?php _e('Book Move!','moverates');?></button>
                    </div>
                  </div>
                  </div>
                  <script>
                  // Send the Ajax call to the server and run rates engine.
                  document.getElementById("finalSubmitbtn").addEventListener("click", function(event){
                    event.preventDefault();

                    var finaldoortodoorprice = document.getElementById('finaldoortodoorrate');
                    document.getElementById('finaldomesticprice').classList.add('pending');
                    document.getElementById('finaldomesticprice').innerHTML = 'Getting Rate...';
                      console.log('domestic rates engine');

                      var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
                      //var form = document.getElementById("inventorySubmit");
                      var origincity = document.getElementById('originFinal').innerHTML;
                      var destinationcity = document.getElementById('destinationFinal').innerHTML;
                      var volumecbm = document.getElementById('volumeFinal').innerHTML;
                      var distance = document.getElementById('distanceFinal').innerHTML;

                      var cartonDrop = document.getElementById('cartonDrop').value;
                      var pictureHanging = document.getElementById('pictureHanging').value;
                      var longCarry = document.getElementById('longCarry').value;
                      var stairCarry = document.getElementById('stairCarry').value;
                      var overTime = document.getElementById('overTime').value;
                      var grandPiano = document.getElementById('grandPiano').value;
                      var uprightPiano = document.getElementById('uprightPiano').value;
                      var noPacking = document.getElementById('noPacking').value;
                      var noUnpacking = document.getElementById('noUnpacking').value;

                        jQuery.ajax({
                          url : ajaxurl,
                          data : {
                              action : 'domestic_rates_engine',
                              origin:  origincity,
                              destination: destinationcity,
                              volume: volumecbm,
                              distance: distance,
                              cartonDrop: cartonDrop,
                              pictureHanging: pictureHanging,
                              longCarry: longCarry,
                              stairCarry: stairCarry,
                              overTime: overTime,
                              grandPiano: grandPiano,
                              uprightPiano: uprightPiano,
                              noPacking: noPacking,
                              noUnpacking: noUnpacking,
                              finaldoortodoorprice: finaldoortodoorprice
                          },
                          dataype: JSON,
                          method : 'POST', //Post method
                          success : function( response ){
                            var results = JSON.parse(response);
                            console.log(response);
                            function numberWithCommas(response) {
                                return response.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }


                            var newStr = response.substring(0, response.length-1)
                            newStr = numberWithCommas(newStr);
                            document.getElementById('finaldomesticprice').innerHTML = newStr;
                            document.getElementById('finaldomesticprice').classList.remove('pending');
                            // Here we need to decode the array into an accessabile object by decoding.

                            //alert(newStr);
                          },
                          error : function(error){ console.log(error) }
                        });
                  });
                  </script>
              </div>
          </div>
      </div>


<?php
}



/*  DOMESTIC MOVE PAGE SHORTCODES END */

/* INTERNATIONAL SHORT CODES BEGIN */
// Shortcode to display the front end form for user input
add_shortcode('input-form', 'display_core_input_form');
function display_core_input_form(){

  $args = array(
      'numberposts' => -1,
      'post_type' => 'service_cities',
    );
      // The Query
      $the_query = new WP_Query( $args );
       ?>

  <form id="ratesform">
    <div class="form-row">
      <div class="col-md">
        <label class="mr-sm-2" for="ratetype"><?php _e('Rate Type', 'moverates');?></label>
        <select class="custom-select mr-sm-2" id="ratetype">
          <option selected disabled>Rate Type</option>
          <option>DTP</option>
          <option>DTD</option>
          <option>PTD</option>
        </select>
      </div>
      <div class="col-md">
        <label class="mr-sm-2" for="origincountry"><?php _e('Origin City', 'moverates');?></label>
        <select class="custom-select mr-sm-2" id="origincity">
          <option selected disabled>Select one...</option>
          <?php  // The Loop
          if ( $the_query->have_posts() ) {

            while ( $the_query->have_posts() ) {
              $the_query->the_post();

              echo '<option value="' . get_field('city') .'">' . get_field('city') .'</option>';

            }
          }
         ?>
        </select>
      </div>
      <div class="col-md">
        <label class="mr-sm-2" for="destinationcity"><?php _e('Destination','moverates');?></label>
        <select class="custom-select mr-sm-2" id="destinationcity">
          <option selected disabled>Select one...</option>
          <?php  // The Loop
          if ( $the_query->have_posts() ) {

            while ( $the_query->have_posts() ) {
              $the_query->the_post();

              echo '<option value="' . get_field('city') .'">' . get_field('city') .'</option>';

            }
          }
          ?>
        </select>
      </div>
      <div class="col-md">
        <label class="mr-sm-2" for="volumecbm">CBM <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Total Cubic Meter volume for your move."></i></label>
        <input type="text" class="form-control" id="volumecbm" placeholder="" onchange="modeOptions()">
      </div>
      <div class="col-md">
        <label class="mr-sm-2" for="mode"><?php _e('Mode','moverates');?></label>
        <select class="custom-select mr-sm-2" id="mode">
        <option selected disabled>Choose...</option>
        <option value="road_20_fcl" id="road_20_fcl"><?php _e('Road 20 FCL','moverates');?></option>
        <option value="road_40_fcl" id="road_40_fcl"><?php _e('Road 40 FCL','moverates');?></option>
        <option value="air" id="air"><?php _e('Air','moverates');?></option>
        <option value="lcl" id="lcl"><?php _e('LCL','moverates');?></option>
        <option value="20_fcl" id="20_fcl"><?php _e('20 FCL','moverates');?></option>
        <option value="40_fcl" id="40_fcl"><?php _e('40 FCL','moverates');?></option>
        <option value="40_high" id="40_high"><?php _e('40 High','moverates');?></option>
        </select>

        <script type="text/javascript">
        // Here we'll dynamically load the MODE options for the user to select based on the volume of the shipment.
          function modeOptions(){
            var volumecheck = document.getElementById('volumecbm').value;
            console.log(volumecheck);
            if( volumecheck >= 0 && volumecheck <= 7 ){
              document.getElementById('road_20_fcl').style.display = 'none';
              document.getElementById('road_40_fcl').style.display = 'none';
              document.getElementById('air').style.display = 'block';
              document.getElementById('lcl').style.display = 'block';
              document.getElementById('20_fcl').style.display = 'none';
              document.getElementById('40_fcl').style.display = 'none';
              document.getElementById('40_high').style.display = 'none';
            }
            if( volumecheck >= 7 && volumecheck <= 12 ){
              document.getElementById('road_20_fcl').style.display = 'none';
              document.getElementById('road_40_fcl').style.display = 'none';
              document.getElementById('air').style.display = 'none';
              document.getElementById('lcl').style.display = 'block';
              document.getElementById('20_fcl').style.display = 'none';
              document.getElementById('40_fcl').style.display = 'none';
              document.getElementById('40_high').style.display = 'none';
            }
            if( volumecheck >= 12 && volumecheck <= 25 ){
              document.getElementById('road_20_fcl').style.display = 'none';
              document.getElementById('road_40_fcl').style.display = 'none';
              document.getElementById('air').style.display = 'none';
              document.getElementById('lcl').style.display = 'block';
              document.getElementById('20_fcl').style.display = 'block';
              document.getElementById('40_fcl').style.display = 'none';
              document.getElementById('40_high').style.display = 'none';
            }
            if( volumecheck >= 25 && volumecheck <= 30 ){
              document.getElementById('road_20_fcl').style.display = 'none';
              document.getElementById('road_40_fcl').style.display = 'none';
              document.getElementById('air').style.display = 'none';
              document.getElementById('lcl').style.display = 'none';
              document.getElementById('20_fcl').style.display = 'block';
              document.getElementById('40_fcl').style.display = 'block';
              document.getElementById('40_high').style.display = 'block';
            }
            if( volumecheck >= 31 && volumecheck <= 75 ){
              document.getElementById('road_20_fcl').style.display = 'none';
              document.getElementById('road_40_fcl').style.display = 'none';
              document.getElementById('air').style.display = 'none';
              document.getElementById('lcl').style.display = 'none';
              document.getElementById('20_fcl').style.display = 'none';
              document.getElementById('40_fcl').style.display = 'block';
              document.getElementById('40_high').style.display = 'block';
            }
            if( volumecheck > 75 ){
              document.getElementById('road_20_fcl').style.display = 'none';
              document.getElementById('road_40_fcl').style.display = 'none';
              document.getElementById('air').style.display = 'none';
              document.getElementById('lcl').style.display = 'none';
              document.getElementById('20_fcl').style.display = 'none';
              document.getElementById('40_fcl').style.display = 'none';
              document.getElementById('40_high').style.display = 'none';
              alert('Please select a volume between 0 - 75 Cubic Meters.');
            }

          }
        </script>
      </div>
      <div class="col-md">
        <button type="submit" id="getrates" class="btn btn-primary"><?php _e('Get Rate', 'moverates');?></button>
      </div>
      <div class="col-md">
          <button type="submit" id="buildinventory" class="btn bg-warning"><?php _e('Inventory', 'moverates');?></button>
      </div>
    </div>


    <!-- Accessory Row on FrontEnd Form -->
    <div class="form-row">
      <div class="col">
        <div class="form-check form-check-inline checkbox checkbox-info">
            <input class="form-check-input" type="checkbox" id="cartonDrop" name="cartonDrop" onclick="valueFunc(this)" value="none">
            <label class="form-check-label" for="inlineCheckbox1"><?php _e('Carton Drop', 'moverates');?></label>
        </div>
      </div>
      <div class="col">
        <div class="form-check form-check-inline checkbox checkbox-info">
              <input class="form-check-input" type="checkbox" id="pictureHanging" onclick="valueFunc(this)" value="none">
              <label class="form-check-label" for="inlineCheckbox3"><?php _e('Picture Hang', 'moverates');?></label>
        </div>
      </div>
      <div class="col">
        <div class="form-check form-check-inline checkbox checkbox-info">
            <input class="form-check-input" type="checkbox" id="longCarry" name="longCarry" onclick="valueFunc(this)" value="none">
            <label class="form-check-label" for="inlineCheckbox2"><?php _e('Long Carry', 'moverates');?></label>
        </div>
      </div>
      <div class="col">
        <div class="form-check form-check-inline checkbox checkbox-info">
          <input class="form-check-input" type="checkbox" id="stairCarry" name="stairCarry" onclick="valueFunc(this)" value="none">
          <label class="form-check-label" for="inlineCheckbox3"><?php _e('Stair Carry', 'moverates');?></label>
        </div>
      </div>
      <div class="col">
        <div class="form-check form-check-inline checkbox checkbox-info">
          <input class="form-check-input" type="checkbox" id="overTime" name="overTime" onclick="valueFunc(this)" value="none">
          <label class="form-check-label" for="inlineCheckbox3"><?php _e('Holiday', 'moverates');?></label>
        </div>
      </div>
      <div class="col">
        <div class="form-check form-check-inline checkbox checkbox-info">
          <input class="form-check-input" type="checkbox" id="grandPiano" name="grandPiano" onclick="valueFunc(this)" value="none">
          <label class="form-check-label" for="inlineCheckbox3"><?php _e('Grand Piano', 'moverates');?></label>
        </div>
      </div>
      <div class="col">
        <div class="form-check form-check-inline checkbox checkbox-info">
          <input class="form-check-input" type="checkbox" id="uprightPiano" name="uprightPiano" onclick="valueFunc(this)" value="none">
          <label class="form-check-label" for="inlineCheckbox3"><?php _e('Upright Piano', 'moverates');?></label>
        </div>
      </div>
      <div class="col">
        <div class="form-check form-check-inline checkbox checkbox-info">
          <input class="form-check-input" type="checkbox" id="noPacking"  name="noPacking" onclick="valueFunc(this)" value="none">
          <label class="form-check-label" for="inlineCheckbox3"><?php _e('No Packing', 'moverates');?></label>
        </div>
      </div>
      <div class="col">
        <div class="form-check form-check-inline checkbox checkbox-info">
          <input class="form-check-input" type="checkbox" id="noUnpacking" name="noUnpacking" onclick="valueFunc(this)" value="none">
          <label class="form-check-label" for="inlineCheckbox3"><?php _e('No Unpacking', 'moverates');?></label>
        </div>
      </div>
    </div>
  </form>
  <script type="text/javascript">
    function valueFunc(checkbox)
    {
        if (checkbox.checked)
        {
            checkbox.value = "yes";
        } else {
          checkbox.value = "none";
        }
    }
  </script>
  <script>
  // Send the Ajax call to the server and run rates engine.
  document.getElementById("getrates").addEventListener("click", function(event){
    event.preventDefault();

    var finaloriginratediv = document.getElementById('finaloriginrate');
    var finalfreightratediv = document.getElementById('finalfreightrate');
    var finaldestinationratediv = document.getElementById('finaldestinationrate');
    var finaldtdratediv = document.getElementById('finaldoortodoorrate');

    var displaydivs =[];
    displaydivs.push(finaloriginratediv,finalfreightratediv, finaldestinationratediv, finaldtdratediv);
    for(counter = 0; counter < displaydivs.length; counter++){
      displaydivs[counter].innerHTML = 'Getting rate...';
      displaydivs[counter].classList.add('pending');
    }

      var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
      var form = document.getElementById("ratesform");
      var origincity = document.getElementById('origincity').value;
      var destinationcity = document.getElementById('destinationcity').value;
      var volumecbm = document.getElementById('volumecbm').value;
      var mode = document.getElementById('mode').value;
      var ratetype = document.getElementById('ratetype').value;

      var cartonDrop = document.getElementById('cartonDrop').value;
      var pictureHanging = document.getElementById('pictureHanging').value;
      var longCarry = document.getElementById('longCarry').value;
      var stairCarry = document.getElementById('stairCarry').value;
      var overTime = document.getElementById('overTime').value;
      var grandPiano = document.getElementById('grandPiano').value;
      var uprightPiano = document.getElementById('uprightPiano').value;
      var noPacking = document.getElementById('noPacking').value;
      var noUnpacking = document.getElementById('noUnpacking').value;

      var inventoryform = document.querySelectorAll("#inventorylist input[type=number]");
      console.log(inventoryform);
      var inventoryformarray =[];
      for (var i = 0, singleitem; singleitem = inventoryform[i++];) {
          var keypair3 = [singleitem.name, singleitem.value];
          inventoryformarray.push(keypair3);
        }

      // Update the small details top row in the results table
      document.getElementById('resulttalbleorigin').innerHTML = origincity;
      document.getElementById('resulttalbledestination').innerHTML = destinationcity;
      document.getElementById('resulttalblevolume').innerHTML = volumecbm;
      document.getElementById('resulttalblemode').innerHTML = mode;

        jQuery.ajax({
          url : ajaxurl,
          data : {
              action : 'rates_engine',
              origin:  origincity,
              destination: destinationcity,
              volume: volumecbm,
              mode: mode,
              ratetype: ratetype,
              cartonDrop: cartonDrop,
              pictureHanging: pictureHanging,
              longCarry: longCarry,
              stairCarry: stairCarry,
              overTime: overTime,
              grandPiano: grandPiano,
              uprightPiano: uprightPiano,
              noPacking: noPacking,
              noUnpacking: noUnpacking,
              itemlist: inventoryformarray
          },
          dataype: JSON,
          method : 'POST', //Post method
          success : function( response ){
            console.log(response);
            // Here we need to decode the array into an accessabile object by decoding.
             var results = JSON.parse(response);
             console.log(results);
            // Here we will update the table <td>'s with the appropriate values for each.
            if(results['freight'] < 0){
              finaloriginratediv.innerHTML = '--';
              document.getElementById('finalfreightrate').innerHTML = '--';
              document.getElementById('finaldestinationrate').innerHTML = '--';
              document.getElementById('finaldoortodoorrate').innerHTML = '--';
              for(counter2 = 0; counter2 < displaydivs.length; counter2++){
                displaydivs[counter2].classList.remove('pending');
              }
              alert('Hi There, we\'re sorry about this but it looks like unfortunaltey there are no '+ mode +' freight rates on file from ' + origincity + ' to '+ destinationcity +'. Please select and try another destination or contact us at Info@bgimoving.com for updated rates.');

            } else if(results['origin'] < 0){
              finaloriginratediv.innerHTML = '--';
              document.getElementById('finalfreightrate').innerHTML = '--';
              document.getElementById('finaldestinationrate').innerHTML = '--';
              document.getElementById('finaldoortodoorrate').innerHTML = '--';
              for(counter2 = 0; counter2 < displaydivs.length; counter2++){
                displaydivs[counter2].classList.remove('pending');
              }
              alert('Hi There, we\'re sorry about this but it looks like unfortunaltey there are no '+ mode +' origin rates on file for ' + origincity + '. Please try another origin or contact us at Info@bgimoving.com for updated rates.');

            } else if(results['destination'] < 0) {
              finaloriginratediv.innerHTML = '--';
              document.getElementById('finalfreightrate').innerHTML = '--';
              document.getElementById('finaldestinationrate').innerHTML = '--';
              document.getElementById('finaldoortodoorrate').innerHTML = '--';
              for(counter2 = 0; counter2 < displaydivs.length; counter2++){
                displaydivs[counter2].classList.remove('pending');
              }
              alert('Hi There, we\'re sorry about this but it looks like unfortunaltey there are no '+ mode +' destination rates on file for ' + destinationcity + '. Please try another origin or contact us at Info@bgimoving.com for updated rates.');

            } else {
              finaloriginratediv.innerHTML = results['origin'];
              document.getElementById('finalfreightrate').innerHTML = results['freight'];
              document.getElementById('finaldestinationrate').innerHTML = results['destination'];
              document.getElementById('finaldoortodoorrate').innerHTML = results['doortodoorrate'];
              for(counter2 = 0; counter2 < displaydivs.length; counter2++){
                displaydivs[counter2].classList.remove('pending');
              }
            }

          },
          error : function(error){
            finaloriginratediv.innerHTML = '--';
            document.getElementById('finalfreightrate').innerHTML = '--';
            document.getElementById('finaldestinationrate').innerHTML = '--';
            document.getElementById('finaldoortodoorrate').innerHTML = '--';
            for(counter2 = 0; counter2 < displaydivs.length; counter2++){
              displaydivs[counter2].classList.remove('pending');
            }
            console.log(error);
            alert("Looks like we/'re having some trouble with that rate. Please try another and if you're still running into trouble contact us at info@bgimoving.com for support.");
          }
        });
  });
  </script>
  <div id="finalrate">

  </div>

<?php
}


// Short code to display the route map from country to country.
add_shortcode('route-map', 'create_and_display_route_map');
function create_and_display_route_map(){ ?>
  <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map, #destmap {
        height: 250px;
      }
      #mapsrow .col-md:nth-child(1) {
          padding-right: 0px;
      }
      #mapsrow .col-md:nth-child(2) {
          padding-left: 0px;
      }
      table#mapsrowheadertable {
        margin-bottom: 0rem;
      }
    </style>

    <table class="table" id="mapsrowheadertable">
      <thead class="thead-dark">
        <tr>
          <th class="pl-5" scope="col"><? _e('Origin Location','moverates');?></th>
          <th class="" scope="col"><?php _e('Destination Location','moverates');?></th>
        </tr>
      </thead>
    </table>
    <div class="row" id="mapsrow">
        <div class="col-md">
          <div id="map"></div>
        </div>
        <div class="col-md">
          <div id="destmap"></div>
        </div>
    </div>

    <script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 3,
          center: {lat: 0, lng: -180},
          mapTypeId: 'roadmap'
        });
        var destmap = new google.maps.Map(document.getElementById('destmap'), {
          zoom: 3,
          center: {lat: 0, lng: -180},
          mapTypeId: 'roadmap'
        });
      }

    var origincityinput = document.getElementById("origincity");
    var destinationcityinput = document.getElementById("destinationcity");

    var originCountryLat = '';
    var originCountryLong = '';
    var newlat = '';
    var newlong = '';

    // This will geocode the LAT and LONG coordinates of the origin city and store intp variables.
    origincityinput.onchange = function(){
      var origincityinputvalue = document.getElementById("origincity").value;
      var origingeocoder = new google.maps.Geocoder();
      origingeocoder.geocode({
        'address': origincityinputvalue
      }, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          originCountryLat = results[0].geometry.location.lat();
          originCountryLong = results[0].geometry.location.lng();
          // alert(originCountryLat);
          // alert(originCountryLong);
          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 11,
            center: {lat: originCountryLat, lng: originCountryLong},
            mapTypeId: 'roadmap'
          });
        } else {
          alert("Something got wrong " + status);
        }
      });
    }

    // This will geo code the LAT and LONG of the destination city input, put into variables, and then
    // draw the line between the orign and destination city.
    destinationcityinput.onchange = function(){
      var destinationcityinputvalue = document.getElementById("destinationcity").value;
      var origincityinputvalue = document.getElementById("origincity").value;
      //alert(destinationcityinputvalue);

      var destinationgeocoder = new google.maps.Geocoder();
      destinationgeocoder.geocode({
        'address': destinationcityinputvalue
      }, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          var destinationCountryLat = results[0].geometry.location.lat();
          var destinationCountryLong = results[0].geometry.location.lng();


              // These two variable will center the map on the line after the two cities have been chosen.
              newlat = (originCountryLat + destinationCountryLat)/2;
              newlong = (originCountryLong + destinationCountryLong)/2;

              var destmap = new google.maps.Map(document.getElementById('destmap'), {
                zoom: 11,
                center: {lat: destinationCountryLat, lng: destinationCountryLong},
                mapTypeId: 'roadmap'
              });

              //Here is where we draw the line onto the map <div>
              var flightPlanCoordinates = [
                {lat: originCountryLat, lng: originCountryLong}, // Starting point
                {lat: destinationCountryLat, lng: destinationCountryLong}  // Ending point
              ];
              var flightPath = new google.maps.Polyline({
                path: flightPlanCoordinates,
                geodesic: true,
                strokeColor: '#65bc63', // Here we can set the COLOR of the line
                strokeOpacity: 1.0,
                strokeWeight: 4 // Here we can set the WIDTH of the line
          });

          flightPath.setMap(destmap);

        } else {
          alert("Something got wrong " + status);
        }
      });
    }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7Kjlmln1wlqBwLZiTniXKH7FasKkc_ts&callback=initMap">
    </script>

<?php
}

add_shortcode('results-table', 'display_results_table');
function display_results_table(){
  ?>
      <div class="text-center" id="savingrate">
        <div id="saveforlatermodalcontent">
          <!-- <i class="fa fa-check-circle-o" aria-hidden="true"></i> -->
          <?php if( is_user_logged_in() ) {
            $user = wp_get_current_user();
            $currentuseremail = $user->user_email;
            echo '<h4 class="save-pending">We are saving this rate, just for you...One moment please!</h4>';
            echo '<input type="text" style="display: none;" name="email" id="saverateemail" value="'. $currentuseremail .'"></input>';
          }  else {
            ?>
            <h4 class="save-pending" id="pendingtext"><?php _e('We are saving this rate just for you...One moment please!','moverates');?></h4>
            <p><?php _e('Please enter your e-amil address to confrim the rate.','moverates');?></p>
            <input type="text" name="email" id="saverateemail" value=""></input>
            <button type="button" id="savedemailokay"><?php _e('Save my rate!','moverates');?></button>
          <?php
        };
        ?>


        </div>
      </div>
      <div class="text-center" id="saveforlatermodal">
        <div id="saveforlatermodalcontent">
          <i class="fa fa-check-circle-o" aria-hidden="true"></i>
          <h3 class="text-center"><span class="text-info"><?php _e('Nice work!','moverates');?></span> <?php _e('Your rate has been saved.','moverates');?></h3>
          <p class="text-info display-2" id="savedraterequestid"></p>
          <p><?php _e('Your rate has successfully been saved for later. You\'ll need to log in to the dashboard in order to view the rate and book for later.','moverates');?></p>
          <button type="button" id="savedratemodalclose" class="btn-lg bg-danger text-white"><?php _e('Close','moverates');?></button>
          <a href="<?php echo site_url() .'/contact-us' ;?>"><button type="button" href="" class="btn-lg bg-warning text-white"><?php _e('Get Help','moverates');?></button></a>
          <a href="<?php echo site_url() .'/customer-dashboard'; ?>"><button type="button" href="" class="btn-lg bg-success text-white"><?php _e('Dashboard','moverates');?></button></a>
          <a href="<?php echo wp_login_url(); ?>"><button type="button" href="" class="btn-lg bg-success text-white"><?php _e('Log In','moverates');?></button></a>
        </div>
      </div>

      <div class="row d-none">
        <form class="cart" action="<?php echo site_url() ;?>/checkout" method="post" id="finalratesubmit" enctype="multipart/form-data">
                    <input type="number" name="mainCit" id="mainCit" value="">
                    <input type="number" name="volcuft" id="finalVolumeInput" value="">
                    <input type="text" name="ratetype" id="ratetype" value="">
                    <input type="text" name="oaaddress" id="finalOriginAddressInput" value="">
                    <input type="text" name="oaaddressLAT" id="finalOriginAddressInputLAT" value="">
                    <input type="text" name="oaaddressLONG" id="finalOriginAddressInputLONG" value="">
                    <input type="text" name="daaddress" id="finalDestinationAddressInput" value="">
                    <input type="number" name="totalDistance" id="finalDistanceInput" value="">
                    <input type="number" name="totalTravelhrs" id="finalTravelhrs" value="">
                    <input type="number" name="totalTravelmins" id="finalTravelTimemins" value="">
                    <input type="number" name="crating" id="cratefinal" value="">
                    <input type="number" name="hositing" id="hoistfinal" value="">
                    <input type="text" name="cartondrop" id="cartonfinal" value="none">
                    <input type="text" name="picturehang" id="picturehangfinal" value="none">
                    <input type="text" name="longcarry" id="longcarryfinal" value="none">
                    <input type="text" name="staircarry" id="staircarryfinal" value="none">
                    <input type="text" name="holiday" id="holidayfinal" value="none">
                    <input type="text" name="grandpiano" id="grandpianofinal" value="none">
                    <input type="text" name="uprightpiano" id="uprightpianofinal" value="none">
                    <input type="text" name="nopacking" id="nopackfinal" value="none">
                    <input type="text" name="nounpacking" id="nounpackfinal" value="none">
                    <input type="text" name="inventoryList" id="inventoryList" value="">
        </form>
      </div>

        <table class="table table-hover" id="ratestable">
          <thead class="thead-dark">
            <tr>
              <th class="pl-5" scope="col"><?php _e('Charge','moverates');?></th>
              <th class="" scope="col" colspan=""><?php _e('Price','moverates');?></th>
              <th class="" scope="col" colspan=""><?php _e('CBM','moverates');?></th>
              <th class="" scope="col" colspan=""><?php _e('Mode','moverates');?></th>
              <!-- <th scope="col">Description</th> -->
            </tr>
          </thead>
          <tbody class="">
            <tr>
              <td class="pl-5 text-warning font-weight-bold"><span id="resulttalbleorigin">--</span></td>
              <td class="text-warning font-weight-bold"><span id="resulttalbledestination">--</span></td>
              <td class="text-warning font-weight-bold"><span id="resulttalblevolume">--</span></td>
              <td class="text-warning font-weight-bold"><span id="resulttalblemode">-</span></td>
            </tr>
            <tr>
              <td class="pl-5"><?php _e('Origin','moverates');?> <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Packing, transport, and origin customs clearance service."></i></td>
              <td class="text-left" colspan="3"><span id="finaloriginrate" class="price"></span></td>
              <!-- <td><span id="origindescrition">Cost for origin services</span></td> -->
            </tr>
            <tr>
              <td class="pl-5"><?php _e('Freight','moverates');?> <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Full freight cost, including OTHC"></i></td>
              <td class="text-left" colspan="3"> <span id="finalfreightrate" class="price"></span></td>
              <!-- <td> <span id="freightdescription">cost for freight + DTHC service</span></td> -->
            </tr>
            <tr>
              <td class="pl-5"><?php _e('Destination','moverates');?> <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Customs clearance, DTHC, and delivery to normal residence within 50km of the city center."></i></td>
              <td class="text-left" colspan="3"><span id="finaldestinationrate" class="price"></span></td>
              <!-- <td><span id="destinationdescription">Cost for destination services</span></td> -->
              <tr>
                <td class="pl-5"><?php _e('Door to Door Rate','moverates');?></td>
                <td class="text-left" colspan="3"><span id="finaldoortodoorrate" class="price"></span></td>
                <!-- <td><span id="finaldoortodoordescription">Cost for full door to door service</span></td> -->
              </tr>
            </tr>
              <!-- Hidden form to send data to the checkout page -->
              <td class="pr-5 pl-5" colspan="4">
                <div class="row">
                  <div class="col">
                    <button type="submit" id="saveforlater" class="btn-block bg-danger" value="save" name="save-for-later"><?php _e('Save Rate','moverates');?></button>
                  </div>
                  <div class="col">
                    <?php
                    $slug = 'international-move';
                    $product_obj = get_page_by_path( $slug, OBJECT, 'product' );
                    $product_id = $product_obj->ID; // Domestic Move product ID
                    ?>
                    <button type="submit" class="btn-block single_add_to_cart_button" form="finalratesubmit" value="<?php echo $product_id;?>" name="add-to-cart"><?php _e('Book Move','moverates');?></button>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <script>
        // Enable tooltips
                jQuery(function () {
          jQuery('[data-toggle="tooltip"]').tooltip()
        })
        // Send the Ajax call to the server and run rates engine.

        document.getElementById("saveforlater").addEventListener("click", function(event){
          event.preventDefault();

          var finaloriginratediv = document.getElementById('finaloriginrate');
          var finalfreightratediv = document.getElementById('finalfreightrate');
          var finaldestinationratediv = document.getElementById('finaldestinationrate');
          var finaldtdratediv = document.getElementById('finaldoortodoorrate');
          var savingrate = document.getElementById("savingrate");

          savingrate.style.display = "block";

          console.log('save for later');
          var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
          var form = document.getElementById("ratesform");
          var origincity = document.getElementById('origincity').value;
          var destinationcity = document.getElementById('destinationcity').value;
          var volumecbm = document.getElementById('volumecbm').value;
          var ratetype = document.getElementById('ratetype').value;
          var mode = document.getElementById('mode').value;

          var cartonDrop = document.getElementById('cartonDrop').value;
          var pictureHanging = document.getElementById('pictureHanging').value;
          var longCarry = document.getElementById('longCarry').value;
          var stairCarry = document.getElementById('stairCarry').value;
          var overTime = document.getElementById('overTime').value;
          var grandPiano = document.getElementById('grandPiano').value;
          var uprightPiano = document.getElementById('uprightPiano').value;
          var noPacking = document.getElementById('noPacking').value;
          var noUnpacking = document.getElementById('noUnpacking').value;

          var originprice = document.getElementById('finaloriginrate').innerHTML;
          var freightprice = document.getElementById('finalfreightrate').innerHTML;
          var destinationprice = document.getElementById('finaloriginrate').innerHTML;
          var finaldoortodoorprice = document.getElementById('finaldoortodoorrate').innerHTML;

          var savedmail = document.getElementById('saverateemail').value;

          var inventoryform = document.querySelectorAll("#inventorylist input[type=number]");
          console.log(inventoryform);
          var inventoryformdata =[];
          for (var i = 0, inventoryitem; inventoryitem = inventoryform[i++];) {
              var keypair2 = [inventoryitem.name, inventoryitem.value];
              inventoryformdata.push(keypair2);
            }
            console.log(inventoryformdata);


          <?php if( !is_user_logged_in() ){ ?>
            document.getElementById("savedemailokay").addEventListener("click", function(event){
              event.preventDefault();
              console.log(savedmail);
              console.log(formdata);
              document.getElementById("pendingtext").innerHTML = 'Thanks! We\'re saving away! Just one second...';
            jQuery.ajax({
              url : ajaxurl,
              data : {
                  action : 'save_for_later',
                  origin:  origincity,
                  destination: destinationcity,
                  volume: volumecbm,
                  ratetype: ratetype,
                  mail: savedmail,
                  mode: mode,
                  cartonDrop: cartonDrop,
                  pictureHanging: pictureHanging,
                  longCarry: longCarry,
                  stairCarry: stairCarry,
                  overTime: overTime,
                  grandPiano: grandPiano,
                  uprightPiano: uprightPiano,
                  noPacking: noPacking,
                  noUnpacking: noUnpacking,
                  originprice: originprice,
                  freightprice: freightprice,
                  destinationprice: destinationprice,
                  finaldoortodoorprice: finaldoortodoorprice,
                  items: inventoryformdata
              },
              dataype: JSON,
              method : 'POST', //Post method
              success : function( response ){
                console.log(response);
                var newStr = response.substring(0, response.length-1)
                // Here we need to decode the array into an accessabile object by decoding.
                //var savedresults = JSON.parse(response);
                //alert(newStr);
                var savemodal = document.getElementById("saveforlatermodal");
                var rateidp   = document.getElementById("savedraterequestid");
                var savemodalclose = document.getElementById("savedratemodalclose");

                savemodal.style.display = "block";
                savingrate.style.display = "none";
                rateidp.innerHTML = newStr;
                savemodalclose.addEventListener("click", function(){
                  savemodal.style.display = "none";

                });
              },
              error : function(error){ console.log(error) }
            });
          });

          });
          </script>

        <?php  } else { ?>

          console.log(savedmail);
          jQuery.ajax({
            url : ajaxurl,
            data : {
                action : 'save_for_later',
                origin:  origincity,
                destination: destinationcity,
                volume: volumecbm,
                ratetype: ratetype,
                mode: mode,
                mail: savedmail,
                cartonDrop: cartonDrop,
                pictureHanging: pictureHanging,
                longCarry: longCarry,
                stairCarry: stairCarry,
                overTime: overTime,
                grandPiano: grandPiano,
                uprightPiano: uprightPiano,
                noPacking: noPacking,
                noUnpacking: noUnpacking,
                originprice: originprice,
                freightprice: freightprice,
                destinationprice: destinationprice,
                finaldoortodoorprice: finaldoortodoorprice,
                items: inventoryformdata
            },
            dataype: JSON,
            method : 'POST', //Post method
            success : function( response ){
              console.log(response);
              var newStr = response.substring(0, response.length-1)
              // Here we need to decode the array into an accessabile object by decoding.
              //var savedresults = JSON.parse(response);
              //alert(newStr);
              var savemodal = document.getElementById("saveforlatermodal");
              var rateidp   = document.getElementById("savedraterequestid");
              var savemodalclose = document.getElementById("savedratemodalclose");

              savemodal.style.display = "block";
              savingrate.style.display = "none";
              rateidp.innerHTML = newStr;
              savemodalclose.addEventListener("click", function(){
                savemodal.style.display = "none";

              });
            },
            error : function(error){ console.log(error) }
          });
        });
        </script>

        <?php  };
      }
/* INTERNATIONAL SHORCODES END */

/*
* CUSTOMER DASHBOARD SHORTCODE START
*/

add_shortcode('customer-dashboard', 'display_customer_dashboard');
function display_customer_dashboard(){

  if( is_user_logged_in() ) {
    $user = wp_get_current_user();
    $currentuseremail = $user->user_email;
    $currentusename = $user->display_name;

    // Get 10 most recent order ids in date descending order.
      $query = new WC_Order_Query( array(
          'limit'   => 9999,
          'orderby' => 'date',
          'order'   => 'DESC',
          'return'  => 'ids'
      ) );
      $orders = $query->get_orders();?>

      <div class="section">
        <div class="container">


      <h2 class="display-3 mt-5"><span class="text-info">Hi <?php echo $currentusename ;?>,</span><?php _e('view your booked moves here below.','moverates');?></h2>
      <?php
      echo '<table><thead>';
      echo '<th></th>';
      echo '<th></th>';
      echo '<th>Type</th>';
      echo '<th>First Name</th>';
      echo '<th>Last Name</th>';
      echo '<th>Email</th>';
      echo '<th>Move Charge</th>';
      foreach ($orders as $key => $value) {
        $order_meta = wc_get_order($value);
        $order_data = $order_meta->get_data();

        $post_meta = get_post_meta($order_data['id']);

        if($order_data['billing']['email'] === $currentuseremail || current_user_can('administrator') ){

          echo '<tr>';
          echo '<td><a href="'.site_url().'/move-details/?order='.$order_data['id'].'">View Details</a>';
          echo '<td><a href="'.site_url().'/edit-inventory/?rate='.$order_data['id'].'">Edit Inventory</a>';
          echo '<td> Booked Move </td>';
          echo '<td>'.  $post_meta['first_name'][0]           .'</td>';
          echo '<td>'.  $post_meta['last_name'][0]            .'</td>';
          echo '<td>'.  $order_data['billing']['email']       .'</td>';
          echo '<td>$'. $order_data['total']                  .'</td>';
          echo '</tr>';
        }
      }
      echo '</thead></table>';

      $args = array(
          'numberposts' => -1,
          'post_type'   => 'saved_rates',
          'meta'        => 'email',
          'meta_value'  => $currentuseremail
        );
        ?>
        <h2 class="display-3"><?php _e('Saved rates','moverates');?></h2>
        <?php
          // The Query
          $the_query = new WP_Query( $args );

           echo '<table><thead>';
           echo '<th>Rate ID</th>';
           echo '<th></th>';
           echo '<th>Type</th>';
           echo '<th>Origin</th>';
           echo '<th>Destination</th>';
           echo '<th>Volume</th>';
           echo '<th>Mode</th>';
           echo '<th>Est. Total Charge</th>';
            // The Loop
          if ( $the_query->have_posts() ) {

            while ( $the_query->have_posts() ) {
              $the_query->the_post();
              $post_id = get_the_ID();
              $post_meta = get_post_meta($post_id);
              $title = get_the_title();
              // echo "<pre>";
              // print_r($post_meta);
              echo '<tr>';
              echo '<td><a href="'.site_url().'/saved-rate/?rate='.$post_id.'">'. $title .'</a></td>';
              echo '<td><a href="'.site_url().'/edit-inventory/?rate='.$post_id.'">Edit Inventory</a></td>';
              echo '<td> Saved Rate </td>';
              echo '<td>'.  $post_meta['origin_city'][0]  .'</td>';
              echo '<td>'.  $post_meta['destination_city'][0]   .'</td>';
              echo '<td>'.  $post_meta['volume'][0]       .'</td>';
              echo '<td>'.  $post_meta['mode'][0]       .'</td>';
              echo '<td>$'. $post_meta['estimated_total_charge'][0] .'</td>';
              echo '</tr>';
            }
          }
          echo '</thead></table>';?>

        </div> <!-- end container -->
      </section> <!-- end section -->

    <?php
    } else {
    ?>
    <section> <!-- end container -->
      <div class="container"> <!-- end section -->

    <h3><?php _e('Hi there, please log in first to view your orders.','moverates');?></h3>
    <?php
    wp_login_form();?>

      </div> <!-- end container -->
    </section> <!-- end section -->

  <?php }

}
/* END CUSOMTER DASHBOARD */

/* Inventory table*/

// This shortcode will give us a front end form to fill in an inventory and submit.
add_shortcode('inventory-modal', 'display_inventory_modal');
function display_inventory_modal(){;?>
  <style media="screen">
  </style>
  <div id="inventorymodal">
    <div class="inventorymodalcontent">
      <?php // do_shortcode('[inventory-repeater]');?>
      <?php
      $group_key = group_5c8b48a781389;
      $fields = acf_get_fields($group_key);?>
      <h3><?php _e('Build & Submit Your Inventory','moverates');?></h3>
      <form id="inventorylist">
      <table>
        <thead class="bg-dark">
          <th class="pl-2"><?php _e('Picture','moverates');?></th>
          <th class="pl-2"><?php _e('Label','moverates');?></th>
          <th><?php _e('Description','moverates');?></th>
          <th><?php _e('Volume Per Item (cuft)','moverates');?></th>
          <th><?php _e('Quantity','moverates');?></th>
        </thead>
        <tbody>

      <?php

      //Loop through and pull all fields from the 'Items' field group. Print a row for each field.
      foreach ($fields as $key => $value) {;?>

        <tr>
          <td><div class="icon <?php echo $value['sub_fields'][6]['default_value']  ;?>"></div></td> <!--Icon  -->
          <td class="pl-2 text-info"><?php echo $value['label'];?></td>  <!--Label  -->
          <td><?php echo $value['sub_fields'][0]['default_value'];?></td> <!--Description  -->
          <td><?php echo $value['sub_fields'][1]['default_value'];?></td> <!--Volume  -->
          <td class="text-center"><?php echo $value['sub_fields'][8]['value'];?><!--Quantity  -->
            <input type="number" data-volume="<?php echo $value['sub_fields'][1]['default_value'];;?>"name="<?php echo $value['name'];?>" id="<?php echo $value['name'];?>" value="<?php echo $value['sub_fields'][8]['value']; ?>">
          </td>
        </tr>

  <?php  } ;?>

      </tbody>
    </table>
    <!-- <button type="submit" form="inventorylist" class="btn-lg btn-block" name="updateinventory" id="updateinventory">Update Inventory</button> -->
    <button type="submit" form="" class="btn-lg bg-warning btn-block" name="" id="closeinventorymodal"><?php _e('Update','moverates');?></button>
    </form>
    <div ="results">

    </div>

    <script>
    // Send the Ajax call to the server and run rates engine.
    var formdata = [];
    document.getElementById("buildinventory").addEventListener("click", function(event){
      event.preventDefault();

      document.getElementById('inventorymodal').style.display = 'block';
      document.getElementById("closeinventorymodal").addEventListener("click", function(event){
        document.getElementById('inventorymodal').style.display = 'none';
      });
      // This grabs all of the input elements from the inventory form.
      var elements = document.querySelectorAll("#inventorylist input[type=number]");
      console.log(elements);


      // Here we need to get all of the form input elements and send them to the server in the AJAX data pass below.
      // We'll grab all of the inputs from the form, and push them into a key => value data paired array.
      // Then, well send the whole data array with the ajax function.
        for (var i = 0, element; element = elements[i++];) {
            var keypair = [element.name, element.value];
            formdata.push(keypair);
          }
        console.log('clicked');
        var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';

          jQuery.ajax({
            url : ajaxurl,
            data : {
                action : 'inventory_submit',
                item: formdata, // Here we send the data array created above!
            },
            dataype: JSON,
            method : 'POST', //Post method
            success : function( response ){
              console.log(response);
              // Here we need to decode the array into an accessabile object by decoding.
              //var results = JSON.parse(response);
              //console.log(results);
              // Here we will update the table <td>'s with the appropriate values for each.

            },
            error : function(error){ console.log(error) }
          });
    });
    </script>
    <?php
      //print_r($fields);
      ?>
    </div>

  </div>
<?php
}
add_shortcode('edit-inventory', 'display_edit_inventory_section');
function display_edit_inventory_section(){

  // Here we need to $_GET and set the post ID we want to update.
   $post_id = sanitize_text_field($_GET['rate']);

   display_inventory_field($post_id);
   ?>
   <script type="text/javascript">
  var inventoryform = document.querySelectorAll("#inventorylist input[type=number]");
  var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
     var inventoryformdata =[];
     var id = <?php echo $post_id ;?>;


       document.getElementById("updateinventory").addEventListener("click", function(event){
         event.preventDefault();
         document.getElementById('updatesuccessful').style.display = 'block';
         inventoryformdata =[]
         inventoryform = document.querySelectorAll("#inventorylist input[type=number]");
         for (var i = 0, inventoryitem; inventoryitem = inventoryform[i++];) {
             var keypair2 = [inventoryitem.name, inventoryitem.value];
             inventoryformdata.push(keypair2);
           }
         console.log('clicked');
         console.log(inventoryformdata);
         console.log(id);
       jQuery.ajax({
         url : ajaxurl,
         data : {
             action : 'update_inventory_meta',
             id: id,
             items: inventoryformdata
         },
         dataype: JSON,
         method : 'POST', //Post method
         success : function( response ){
           console.log(response);
           inventoryform = [];
           document.getElementById("backtoinventory").addEventListener("click", function(event){
             event.preventDefault();
             document.getElementById('updatesuccessful').style.display = 'none';
           });
         },
         error : function(error){ console.log(error) }
       });
     });
   </script>

   <?php
}




//Shortcode for printing the inventory custom fields with pre-populated values for updating an inventory list.
add_shortcode('inventory-repeater','display_inventory_field');
function display_inventory_field($post_id){

  $args = array(
      'numberposts' => -1,
      'post_type' => array('saved_rates', 'shop_order'),
      'p'         => $post_id
    );
      // The Query
      $the_query = new WP_Query( $args ); ?>
      <div id="updatesuccessful">
        <div id="updatedsuccessfulcontent" class="text-center bg-white">
          <h3 class="display-2"><span class="text-info"> <?php _e('Inventory Updated.','moverates');?></span></h3>
          <p><?php _e('Nice work. Your inventory has been updated.','moverates');?></p>
          <div class="row">
            <div class="col">
              <button type="button" class="bg-warning text-white font-weight-bold p-3" id="backtoinventory" name="backtoinventory"><?php _e('Back to Inventory','moverates');?></button>
            </div>
            <div class="col">
              <?php $posttype = get_post_type($post_id);
                  if($posttype === 'shop_order'){
                     echo '<a href="'.site_url().'/move-details/?order='.$post_id.'"><button type="button" class="bg-danger text-white font-weight-bold p-3" id="viewratedetails" name="viewratedetails">View Order Details</button></a>';
                  } else {
                     echo '<a href="'.site_url().'/saved-rate/?rate='.$post_id.'"><button type="button" class="bg-danger text-white font-weight-bold p-3" id="viewratedetails" name="viewratedetails">View Rate Details</button></a>';
                  };?>
            </div>
            <div class="col">
              <a href="<?php site_url();?>"><button type="button" class="bg-info text-white font-weight-bold p-3" id="headhome" name="headhome"><?php _e('Head Home','moverates');?></button></a>
            </div>
          </div>
        </div>
      </div>
      <h3><?php _e('Build & Submit Your Inventory','moverates');?></h3>
      <form id="inventorylist" method="post">

      <table id="">
        <thead class="bg-dark">
          <th class="pl-2"><?php _e('Item','moverates');?></th>
          <th><?php _e('Desc.','moverates');?></th>
          <th><?php _e('Quantity','moverates');?></th>
          <th><?php _e('Special Notes','moverates');?></th>
        </thead>
        <tbody>

      <?php
          // The Loop
          if ( $the_query->have_posts() ) {

          	while ( $the_query->have_posts() ) {
          		$the_query->the_post();

              $group_key = group_5c8b48a781389;
              $fields = acf_get_fields($group_key);

              foreach($fields as $key => $value){

                  if( have_rows($value['name']) ): ?>

                     <?php while( have_rows($value['name']) ): the_row(); ?>
                      <tr>
                         <td><?php echo $value['label']; ?> </td>
                         <td><?php the_sub_field('item_description'); ?> </td>
                         <td> <input type="number" name="<?php echo $value['label'];?>" value="<?php the_sub_field('item_quantity'); ?>"></td>
                      </tr>

                     <?php endwhile; ?>
                 <?php endif;
              }
           }
         } else {

           $query = new WC_Order_Query( array(
               'limit'   => 1,
               'orderby' => 'date',
               'order'   => 'DESC',
               'return'  => 'ids',
               'p'       => $post_id
           ) );
           $orders = $query->get_orders();

           foreach ($orders as $key => $value) {
             $order_meta = wc_get_order($value);
             $order_data = $order_meta->get_data();

             $group_key = group_5c8b48a781389;
             $fields = acf_get_fields($group_key);

             foreach($fields as $key => $value){

                 if( have_rows($value['name'], $post_id) ): ?>

                    <?php while( have_rows($value['name'], $post_id) ): the_row(); ?>
                     <tr>
                        <td><?php echo $value['label']; ?> </td>
                        <td><?php the_sub_field('item_description'); ?> </td>
                        <td> <input type="number" name="<?php echo $value['label'];?>" value="<?php the_sub_field('item_quantity'); ?>"></td>
                     </tr>

                    <?php endwhile; ?>
                <?php endif;
             }
           }

         }?>
     </tbody>
   </table>
   <button type="submit" class="btn-lg btn-block" id="updateinventory" form="inventorylist" name="updateinventory"><?php _e('Update Inventory','moverates');?></button>
   </form>
<?php
}


// Shortcode for printing and checking prices on the front end
add_shortcode('display-repeater','display_repeater_field');
function display_repeater_field(){

  $orgin = 'Paris, France';
  $destination = 'vancouver';
  $volume = 100;


  $args = array(
      'numberposts' => -1,
      'post_type' => 'service_cities',
      'meta_query' => array(
          'relation' => 'OR',
          array(
              'key' => 'city',
              'meta_value' => $origin
          ),
          array(
              'key' => 'city',
              'meta_value' => $destination
          )
      )
    );

      // The Query
      $the_query = new WP_Query( $args );

      // The Loop
      if ( $the_query->have_posts() ) {
      	echo '<ul>';
      	while ( $the_query->have_posts() ) {
      		$the_query->the_post();
          echo '<li><a href="' . get_permalink($post->ID) . '">' . get_the_title($post->ID) . '</a></li>';

          if( have_rows('air') ): ?>
            <h3>AIR rates</h3>

             <?php while( have_rows('air') ): the_row(); ?>
              <ul>
                 <li>Origin / Destination = <?php the_sub_field('origin_or_destination'); ?> </li>
                 <li>AIR Minimum = <?php the_sub_field('air_minimum'); ?> </li>
                 <li>0 - 500 lbs = <?php the_sub_field('0_-_500_lbs'); ?> </li>
                 <li>500 - 1000 lbs = <?php the_sub_field('500_-_1000_lbs'); ?> </li>
                 <li>1000 - 1250 lbs = <?php the_sub_field('1000_-_1250_lbs'); ?> </li>
                 <li>1250 - 1500 lbs = <?php the_sub_field('1250_-_1500_lbs'); ?> </li>
                 <li>1500 - 1750 lbs = <?php the_sub_field('1500_-_1750_lbs'); ?> </li>
                 <li>1750 - 2000 lbs = <?php the_sub_field('1750_-_2000_lbs'); ?> </li>
                 <li>2000 lbs + = <?php the_sub_field('2000_lbs_+'); ?> </li>
              </ul>
                 <?php
                 //set a field intoa variable
                // $sub_field_3 = get_sub_field('lcl_minimum');
                 ?>

             <?php endwhile; ?>

         <?php endif;

         if( have_rows('lcl') ): ?>
           <h3>LCL rates</h3>

            <?php while( have_rows('lcl') ): the_row(); ?>
              <ul>
                <li>Origin / Destination = <?php the_sub_field('origin_or_destination'); ?> </li>
                <li>LCL Minimum = <?php the_sub_field('lcl_minimum'); ?> </li>
                <li>0 - 500 lbs = <?php the_sub_field('0_-_500_lbs'); ?> </li>
                <li>500 - 1000 lbs = <?php the_sub_field('500_-_1000_lbs'); ?> </li>
                <li>1000 - 2000 lbs = <?php the_sub_field('1000_-_2000_lbs'); ?> </li>
                <li>2000 - 3000 lbs = <?php the_sub_field('2000_-_3000_lbs'); ?> </li>
                <li>3000 - 4000 lbs = <?php the_sub_field('3000_-_4000_lbs'); ?> </li>
                <li>4000 - 5000 lbs = <?php the_sub_field('4000_-_5000_lbs'); ?> </li>
             </ul>
                <?php
                //set a field intoa variable
               // $sub_field_3 = get_sub_field('lcl_minimum');
                ?>

            <?php endwhile; ?>

        <?php endif;

        if( have_rows('20_fcl') ): ?>
          <h3>20 FCL rates</h3>

           <?php while( have_rows('20_fcl') ): the_row(); ?>
             <ul>
               <li>Origin / Destination = <?php the_sub_field('origin_or_destination'); ?> </li>
               <li>20 FCL Minimum = <?php the_sub_field('20_fcl_minimum'); ?> </li>
               <li>1000 - 2000 lbs = <?php the_sub_field('1000_-_2000_lbs'); ?> </li>
               <li>2000 - 3000 lbs = <?php the_sub_field('2000_-_3000_lbs'); ?> </li>
               <li>3000 - 4000 lbs = <?php the_sub_field('3000_-_4000_lbs'); ?> </li>
               <li>4000 - 5000 lbs = <?php the_sub_field('4000_-_5000_lbs'); ?> </li>
               <li>5000 - 6000 lbs = <?php the_sub_field('5000_-_6000_lbs'); ?> </li>
               <li>6000 - 7000 lbs = <?php the_sub_field('6000_-_7000_lbs'); ?> </li>
            </ul>
               <?php
               //set a field intoa variable
              // $sub_field_3 = get_sub_field('lcl_minimum');
               ?>

           <?php endwhile; ?>

       <?php endif;

       if( have_rows('40_fcl') ): ?>
         <h3>40 FCL rates</h3>

          <?php while( have_rows('40_fcl') ): the_row(); ?>
            <ul>
              <li>Origin / Destination = <?php the_sub_field('origin_or_destination'); ?> </li>
              <li>20 FCL Minimum = <?php the_sub_field('40_fcl_minimum'); ?> </li>
              <li>0 - 500 lbs = <?php the_sub_field('6000_-_7000_lbs'); ?> </li>
              <li>7000 - 8000 lbs = <?php the_sub_field('7000_-_8000_lbs'); ?> </li>
              <li>8000 - 9000 lbs = <?php the_sub_field('8000_-_9000_lbs'); ?> </li>
              <li>9000 - 10000 lbs = <?php the_sub_field('9000_-_10000_lbs'); ?> </li>
              <li>10000 - 11000 lbs = <?php the_sub_field('10000_-_11000_lbs'); ?> </li>
              <li>11000 - 12000 lbs = <?php the_sub_field('11000_-_12000_lbs'); ?> </li>
              <li>12000 - 13000 lbs = <?php the_sub_field('12000_-_13000_lbs'); ?> </li>
              <li>13000 - 14000 lbs = <?php the_sub_field('13000_-_14000_lbs'); ?> </li>
              <li>14000 - 15000 lbs = <?php the_sub_field('14000_-_15000_lbs'); ?> </li>
              <li>15000 - 16000 lbs = <?php the_sub_field('15000_-_16000_lbs'); ?> </li>
              <li>16000 - 17000 lbs = <?php the_sub_field('16000_-_17000_lbs'); ?> </li>
              <li>17000 + lbs = <?php the_sub_field('17000_lbs_up'); ?> </li>
           </ul>
              <?php
              //set a field intoa variable
             // $sub_field_3 = get_sub_field('lcl_minimum');
              ?>

          <?php endwhile; ?>

      <?php endif;

      if( have_rows('freight_rates') ): ?>
        <h3>Freight rates</h3>

         <?php while( have_rows('freight_rates') ): the_row(); ?>
           <ul>
             <li>Mode = <?php the_sub_field('freight_mode'); ?> </li>
             <li>Destination POE / APOE = <?php the_sub_field('destination_apoe__poe'); ?> </li>
             <li>Price = <?php the_sub_field('freight_price'); ?> </li>
             <li>DTCH = <?php the_sub_field('dthc'); ?> </li>
          </ul>
             <?php
             //set a field intoa variable
            // $sub_field_3 = get_sub_field('lcl_minimum');
             ?>

         <?php endwhile; ?>

     <?php endif;

     if( have_rows('outbound_freight_rates') ): ?>
       <h3>Outbound Freight rates</h3>

        <?php while( have_rows('outbound_freight_rates') ): the_row(); ?>

          <?php
          if($destinationcity === get_sub_field('destination_city')){
            $mode = '40_high';
            switch ($mode) {
            case "local_truck_200":
                  $freightprice = the_sub_field('local_truck_200');
                break;
            case "road_20_fcl":
                  $freightprice = the_sub_field('road_20_fcl');
                break;
            case "road_40_fcl":
                  $freightprice = the_sub_field('road_40_fcl');
                break;
            case "air":
                  $freightprice = the_sub_field('air');
                break;
            case "lcl":
                  $freightprice = the_sub_field('lcl');
                break;
            case "20_fcl":
                  $freightprice = the_sub_field('20_fcl');
                break;
            case "40_fcl":
                  $freightprice = the_sub_field('40_fcl');
                break;
            case "40_high":
                  $freightprice = the_sub_field('40_high');
                break;
            default:
                $freightprice = 0;
          }
        };
        ?>
          <?php echo 'Freight Price:' . $freighprice;?>
          <ul>
            <li>Mode = <?php the_sub_field('freight_mode'); ?> </li>
            <li>Destination = <?php the_sub_field('destination_city'); ?> </li>
            <li>Local truck = <?php the_sub_field('local_truck_200'); ?> </li>
            <li>Road 20 = <?php the_sub_field('road_20_fcl'); ?> </li>
            <li>Road 40 = <?php the_sub_field('road_40_fcl'); ?> </li>
            <li>Air = <?php the_sub_field('air'); ?> </li>
            <li>lcl = <?php the_sub_field('lcl'); ?> </li>
            <li>20 FCL = <?php the_sub_field('20_fcl'); ?> </li>
            <li>40 FCL = <?php the_sub_field('40_fcl'); ?> </li>
            <li>40 High = <?php the_sub_field('40_high'); ?> </li>
         </ul>
            <?php
            //set a field intoa variable
           // $sub_field_3 = get_sub_field('lcl_minimum');
            ?>

        <?php endwhile; ?>

    <?php endif;


     if( have_rows('accessory_charges') ): ?>
       <h3>Accessory Charges</h3>

        <?php while( have_rows('accessory_charges') ): the_row(); ?>
          <ul>
            <li>Charge: <?php the_sub_field('charge_name'); ?> </li>
            <li>Origin or Destination: <?php the_sub_field('origin_or_destination'); ?> </li>
            <li>Per 100 lbs or FLAT: <?php the_sub_field('per_100_lbs_or_flat'); ?> </li>
            <li>Price: <?php the_sub_field('price'); ?> </li>
         </ul>
            <?php
            //set a field intoa variable
           // $sub_field_3 = get_sub_field('lcl_minimum');
            ?>

        <?php endwhile; ?>

    <?php endif;

      	}
      	echo '</ul>';
      	/* Restore original Post Data */
      	wp_reset_postdata();
      } else {
      	// no posts found
      }

}

// Show saved rates template page
add_shortcode('saved-rates', 'show_single_saved_rate');
function show_single_saved_rate(){
  if ( is_user_logged_in() )  { ?>

  <?php
  $rate_id = $_GET['rate'];

  $userinfo = wp_get_current_user();

  // echo "<pre>" ;
  // print_r($userinfo);
  $saved_rate = get_post($rateid);
  $title = get_the_title($saved_rate);
  $saved_rate_meta = get_post_meta($rate_id);
  $slug = 'international-move';
  $product_obj = get_page_by_path( $slug, OBJECT, 'product' );

  // Cookies are set using JS on the front end to avoid headers being sent to late on "Book now" button.

  $args = array(
      'numberposts' => -1,
      'post_type'  => 'saved_rates',
      'p'           => $rate_id
    );
      // The Query
      $the_query = new WP_Query( $args );
       ?>
          <?php  // The Loop
          if ( $the_query->have_posts() ) {

            while ( $the_query->have_posts() ) {
              $the_query->the_post();
              $title = get_the_title();



                  // We stil need to set the inventory items into a cookie to book directy from this page...
                 //  $group_key = 986;
                 //  $fields = acf_get_fields($group_key);
                 //  foreach($fields as $key => $value) {
                 //    if( have_rows($value['name']) ):
                 //        while( have_rows($value['name']) ): the_row();
                 //         $qty = get_sub_field('item_quantity');
                 //              setcookie($value['label'], $qty , time() + (86400 * 30), "/")
                 //        endwhile;
                 //   endif;
                 // }
            }
          }


?>

<section>

  <div class="container">

    <div class="row pt-5">
      <div data-id="62de70eb" class="elementor-element elementor-element-62de70eb elementor-widget elementor-widget-heading" data-element_type="heading.default">
        <div class="elementor-widget-container">
             <h1 class="elementor-heading-title elementor-size-xl">Hi <?php echo $userinfo->display_name ;?>, <span class="text-secondary display-4"> you're saved rate details are below:</span></h1>
        </div>
      </div>
    </div>
      <!-- Page-Title -->
      <div class="row pt-5 pb-5">
        <div class="col-4">
          <h4 class="page-title pt-4 text-secondary"><?php echo $title; ?></h4>
        </div>
        <div class="col-8 pt-3">
          <button type="submit" class="btn-lrg single_add_to_cart_button" form="finalratesubmit" id="savetobookbtn" value="<?php echo $product_obj->ID;?>" name="add-to-cart">Book this move!</button>
        </div>
        <script>
        // This function will set the saved rates meta into the cookie for direct booking with with "Book now" button!
        function setCookies(){
          var cname = 'testcookie';
          var cvalue = 'test';
          var exdays = 1;
          console.log('clicked');
          var d = new Date();
          d.setTime(d.getTime() + (exdays*24*60*60*1000));
          var expires = "expires="+ d.toUTCString();
          <?php $origin = str_replace(",", "",$saved_rate_meta['origin_city'][0]);
                $origin = str_replace(" ", "",$origin);
                $destination = str_replace(",", "",$saved_rate_meta['destination_city'][0]);
                $destination = str_replace(" ", "",$destination);
          ;?>
          var cookiearray = {
            moveorigin         : '<?php echo $origin ;?>',
            movedestination    : '<?php echo $destination ;?>',
            movemode           : '<?php echo $saved_rate_meta['mode'][0] ;?>',
            movevolume         : <?php echo $saved_rate_meta['volume'][0] ;?>,
            ratetype           : ''
            moveprice          : <?php echo str_replace(",", "",$saved_rate_meta['estimated_total_charge'][0]) ;?>,
            move_date          : '',
            arrival_time       : '',
            move_start_day     : '',
            carton_drop        : '<?php echo $saved_rate_meta['carton_drop'][0] ;?>',
            picture_hanging    : '<?php echo $saved_rate_meta['picture_hanging'][0] ;?>',
            long_carry         : '<?php echo $saved_rate_meta['long_carry'][0] ;?>',
            stair_carry        : '<?php echo $saved_rate_meta['stair_carry'][0] ;?>',
            holiday_or_weekend : '<?php echo $saved_rate_meta['holiday_or_weekend'][0] ;?>',
            grand_piano        : '<?php echo $saved_rate_meta['grand_piano'][0] ;?>',
            upright_piano      : '<?php echo $saved_rate_meta['upright_piano'][0] ;?>',
            no_packing         : '<?php echo $saved_rate_meta['no_packing'][0] ;?>',
            no_unpacking       : '<?php echo $saved_rate_meta['no_unpacking'][0] ;?>',
            estimated_trucks   : <?php echo $saved_rate_meta['estimated_trucks'][0] ;?>,
            volume             : <?php echo $saved_rate_meta['volume'][0] ;?>,
            special_notes      : <?php echo $saved_rate_meta['volume'][0] ;?>,
            move_type          : 'international'
          };
          console.log(cookiearray);
          for (var key in cookiearray){
            cname = key;
            cvalue = cookiearray[key];
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
          }
        }
        setCookies();
        </script>
        <div class="d-none">
          <form class="cart" action="<?php echo site_url();?>/checkout" method="post" id="finalratesubmit" enctype="multipart/form-data">
          </form>
        </div>
      </div>
        <hr>
      <div class="row pt-3">
          <div class="col-12">
              <div class="card-box product-detail-box">
                  <div class="row" id="single-order-details-row">
                                <div class="col-md-4">
                                  <h5 class="text-muted">Your guaranteed price:</h5>
                                  <h5><span class="text-success display-3"><b><?php echo $saved_rate_meta['estimated_total_charge'][0];?></span></b><small class="text-muted m-l-10"> TWD</small></h5>
                                </div>
                                <div class="col-md-8">
                                  <h5 class="text-muted m-l-10"><b>Addtional Services:</b></h5>
                                  <h5 class="d-flex flex-wrap">
                                     <?php
                                     if($saved_rate_meta['carton_drop'][0] === 'yes'){ echo '<span class="label m-l-5  m-t-10" style="background-color: #6610f2;">Carton Drop</span>';}
                                     if($saved_rate_meta['picture_hanging'][0] === 'yes'){ echo '<span class="label m-l-5  m-t-10" style="background-color: #e83e8c;">Picture Hanging</span>';}
                                     if($saved_rate_meta['long_carry'][0] === 'yes'){ echo '<span class="label m-l-5  m-t-10" style="background-color: #dc3545;">Long Carry</span>';}
                                     if($saved_rate_meta['stair_carry'][0] === 'yes'){ echo '<span class="label m-l-5  m-t-10" style="background-color: #ffc107;">Stair Carry</span>';}
                                     if($saved_rate_meta['holiday_or_weekend'][0]  === 'yes'){ echo '<span class="label m-l-5  m-t-10" style="background-color: #28a745;">Sat/Sun</span>';}
                                     if($saved_rate_meta['grand_piano'][0] === 'yes'){ echo '<span class="label m-l-5  m-t-10" style="background-color: #20c997;">Grand Piano</span>';}
                                     if($saved_rate_meta['upright_piano'][0] === 'yes'){ echo '<span class="label m-l-5  m-t-10" style="background-color: #7d7d7d;">Upright Piano</span>';}
                                     if($saved_rate_meta['no_packing'][0]  === 'yes'){ echo '<span class="label m-l-5  m-t-10" style="background-color: #17a2b8;">No Packing</span>';}
                                     if($saved_rate_meta['no_unpacking'][0]  === 'yes'){ echo '<span class="label m-l-5  m-t-10" style="background-color: #246aaf;">No Unpacking</span>';}

                                    ;?> </h5>

                                </div>

                  </div>
                  <!-- end row -->

                  <div class="row m-t-30">
                            <div class="col-12">
                                <h4 class="font-18"><b>Move Details:</b></h4>
                                <div class="table-responsive m-t-20">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td width="400">Pickup Address</td>
                                            <td>
                                                <?php echo $saved_rate_meta['origin_city'][0]; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Delivery Address</td>
                                            <td>
                                                <?php echo $saved_rate_meta['destination_city'][0]; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Date</td>
                                            <td>
                                                <?php echo 'TBC'; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Start Time</td>
                                            <td>
                                                <?php echo 'TBC'; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Volume(cuft)</td>
                                            <td>
                                                <?php echo $saved_rate_meta['volume'][0]; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Contact Person & Phone</td>
                                            <td>
                                                <?php echo 'TBC'; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total Charge (TWD)</td>
                                            <td>
                                                <?php echo $saved_rate_meta['estimated_total_charge'][0]; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>
                                                <?php echo 'TBC'; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Inventory</td>
                                            <td>
                                                    <table>
                                                        <thead class="bg-dark text-white">
                                                          <th class="pl-2">Item</th>
                                                          <th>Description</th>
                                                          <th class="pr-2">Quantity</th>
                                                        </thead>
                                                        <tbody>
                                                    <?php
                                                    $group_key = group_5c8b48a781389;
                                                    $fields = acf_get_fields($group_key);
                                                    foreach($fields as $key => $value) {
                                                      if( have_rows($value['name']) ): ?>

                                                         <?php while( have_rows($value['name']) ): the_row(); ?>
                                                          <tr>
                                                             <td><?php echo $value['label']; ?> </td>
                                                             <td><?php the_sub_field('item_description'); ?> </td>
                                                             <td><?php the_sub_field('item_quantity'); ?> </td>
                                                          </tr>

                                                         <?php endwhile; ?>

                                                     <?php endif;
                                                    } ; ?>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Special Notes</td>
                                            <td>
                                              <?php echo 'TBC'; ?>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
              </div> <!-- end card-box/Product detai box -->
          </div> <!-- end col -->
      </div> <!-- end row -->

  </div> <!-- End container -->
</section>





<?php

  } else {
    $home = site_url();
    wp_redirect($home);
  }
}

// Show single order template page
add_shortcode('single-order', 'show_single_order_details');
function show_single_order_details(){
   if ( is_user_logged_in() )  { ?>

    <?php
    $user = wp_get_current_user();

      $order_id = $_GET['order'];
    ?>
    <?php
    // Get an instance of the WC_Order object
    $order = wc_get_order( $order_id );

    // The Order data
    $order_data = $order->get_data();

    ## CUSTOM FIELDS AND META INFORMATION:
    $postMeta = get_post_meta($order_id);

    //echo "<pre>" . print_r($postMeta) . "</pre>";
    $movRefNo = $postMeta['move_reference_number'][0];
    $move_start_month = $postMeta['move_start_month'][0];
    $move_end = $postMeta['move_end'][0];
    $pickup_address = $postMeta['pickup_address'][0];
    $delivery_address = $postMeta['delivery_address'][0];
    $estimated_volume  = $postMeta['volume'][0];
    $first_name = $postMeta['first_name'][0];
    $last_name = $postMeta['last_name'][0];
    $pick_up_contact_phone = $postMeta['pick_up_contact_phone'][0];
    $delivery_contact_phone = $postMeta['delivery_contact_phone'][0];
    $moving_company_name = $postMeta['moving_company_name'][0];
    $estimated_trucks = $postMeta['estimated_trucks'][0];
    $travel_distance = $postMeta['travel_distance'][0];
    $total_travel_hrs = $postMeta['total_travel_hrs'][0];
    $total_travel_mins= $postMeta['total_travel_mins'][0];
    $extra_services = $postMeta['extra_services'][0];
    $crating = $postMeta['crating'][0];
    $hoisting = $postMeta['hoisting'][0];
    $move_route = $postMeta['move_route'][0];
    $inventory = $postMeta['inventory'][0];
    $actual_volume = $postMeta['actual_volume'][0];
    $loaded_truck_pictures = $postMeta['loaded_truck_pictures'][0];
    $estimated_total_charge = $postMeta['estimated_total_charge'][0];
    $actual_final_charge = $postMeta['actual_final_charge'][0];
    $service_rating = $postMeta['service_rating'][0];
    $move_start_time = $postMeta['move_start_time'][0];
    $move_start_day= $postMeta['move_start_day'][0];
    $carton_drop = $postMeta['carton_drop'][0];
    $picture_hanging = $postMeta['picture_hanging'][0];
    $long_carry = $postMeta['long_carry'][0];
    $stair_carry = $postMeta['stair_carry'][0];
    $overtime = $postMeta['overtime'][0];
    $grand_piano = $postMeta['grand_piano'][0];
    $upright_piano = $postMeta['upright_piano'][0];
    $no_unpacking = $postMeta['no_unpacking'][0];
    $no_packing = $postMeta['no_packing'][0];
    $contact_phone = $postMeta['contact_phone'][0];
    $moving_date = $postMeta['move_date'][0];
    $arrival_time = $postMeta['arrival_time'][0];
    $special_notes = $postMeta['special_notes'][0];
    $on_site_picture_1 = $postMeta['on_site_picture_#1'][0];
    $on_site_picture_2 = $postMeta['on_site_picture_#2'][0];
    $on_site_picture_3 = $postMeta['on_site_picture_#3'][0];
    $on_site_picture_4 = $postMeta['on_site_picture_#4'][0];
    $on_site_picture_5 = $postMeta['on_site_picture_#5'][0];
    $price = $postMeta['_order_total'][0];
    $price = ceil($price);

    ## BASE ORDER INFORMATION:
    $order_id = $order_data['id'];
    $order_parent_id = $order_data['parent_id'];
    $order_status = $order_data['status'];
    $order_currency = $order_data['currency'];
    $order_version = $order_data['version'];
    $order_payment_method = $order_data['payment_method'];
    $order_payment_method_title = $order_data['payment_method_title'];
    $order_payment_method = $order_data['payment_method'];
    $order_payment_method = $order_data['payment_method'];


    ## Creation and modified WC_DateTime Object date string ##

        // Using a formated date ( with php date() function as method)
        $order_date_created = $order_data['date_created']->date('Y-m-d H:i:s');
        $order_date_modified = $order_data['date_modified']->date('Y-m-d H:i:s');

        // Using a timestamp ( with php getTimestamp() function as method)
        $order_timestamp_created = $order_data['date_created']->getTimestamp();
        $order_timestamp_modified = $order_data['date_modified']->getTimestamp();

    ## TOTALS INFORMATION:
    $order_discount_total = $order_data['discount_total'];
    $order_discount_tax = $order_data['discount_tax'];
    $order_shipping_total = $order_data['shipping_total'];
    $order_shipping_tax = $order_data['shipping_tax'];
    $order_total = $order_data['cart_tax'];
    $order_total_tax = $order_data['total_tax'];
    $order_customer_id = $order_data['customer_id']; // ... and so on

    ## BILLING INFORMATION:

    $order_billing_first_name = $order_data['billing']['first_name'];
    $order_billing_last_name = $order_data['billing']['last_name'];
    $order_billing_company = $order_data['billing']['company'];
    $order_billing_address_1 = $order_data['billing']['address_1'];
    $order_billing_address_2 = $order_data['billing']['address_2'];
    $order_billing_city = $order_data['billing']['city'];
    $order_billing_state = $order_data['billing']['state'];
    $order_billing_postcode = $order_data['billing']['postcode'];
    $order_billing_country = $order_data['billing']['country'];
    $order_billing_email = $order_data['billing']['email'];
    $order_billing_phone = $order_data['billing']['phone'];

    ## SHIPPING INFORMATION:

    $order_shipping_first_name = $order_data['shipping']['first_name'];
    $order_shipping_last_name = $order_data['shipping']['last_name'];
    $order_shipping_company = $order_data['shipping']['company'];
    $order_shipping_address_1 = $order_data['shipping']['address_1'];
    $order_shipping_address_2 = $order_data['shipping']['address_2'];
    $order_shipping_city = $order_data['shipping']['city'];
    $order_shipping_state = $order_data['shipping']['state'];
    $order_shipping_postcode = $order_data['shipping']['postcode'];
    $order_shipping_country = $order_data['shipping']['country'];

    //Get moving company meta
    $moveruser = get_users(array(
        'meta_key'     => 'companyname',
        'meta_value'   => $moving_company_name,
        'meta_compare' => '=',
    ));
    $movermeta = get_user_meta($moveruser[0]->ID);
    $moverlogo = $movermeta['companylogo'][0];
    $moverintro = $movermeta['introduction'][0];
    ?>

    <section>
      <div class="container">

        <div class="row">
          <div data-id="62de70eb" class="elementor-element elementor-element-62de70eb elementor-widget elementor-widget-heading" data-element_type="heading.default">
            <div class="elementor-widget-container">
                 <h1 class="elementor-heading-title elementor-size-xl"><span class="text-info display-4"> Hi  <?php echo $user->first_name ;?></span>, <span class="text-secondary display-4"> you're move details are here below:</span></h1>
            </div>
          </div>

        </div>

          <!-- Page-Title -->

          <div class="row">
              <div class="col-12">
                  <div class="card-box product-detail-box">
                      <div class="row" id="single-order-details-row">


                              <div class="product-right-info">
                                  <h4 class="page-title display-4 text-info">Booked Move # <?php echo $order_id ?></h4>

                                  <div class="row">
                                    <div class="col-md-4">
                                      <h5 class="text-muted">Your guaranteed price:</h5>
                                      <h2 class="text-success display-3"> <b><?php echo number_format($price);?></b><small class="text-muted m-l-10"> TWD</small></h2>
                                    </div>
                                    <div class="col-md-8">
                                      <h5 class="text-muted m-l-10"><b>Addtional Services:</b></h5>
                                      <h5 class="d-flex flex-wrap">
                                         <?php if($hoistingHourNeed === 'yes'){ echo '<span class="label label-default m-l-5 m-t-10" style="background-color: darkgoldenrod;">Long Carry</span>';} else { echo ''; }
                                         if($carton_drop === 'yes'){ echo '<span class="label m-l-5  m-t-10" style="background-color: #6610f2;">Carton Drop</span>';} else { echo ''; }
                                         if($picture_hanging === 'yes'){ echo '<span class="label m-l-5  m-t-10" style="background-color: #e83e8c;">Picture Hanging</span>';} else { echo ''; }
                                         if($long_carry === 'yes'){ echo '<span class="label m-l-5  m-t-10" style="background-color: #dc3545;">Long Carry</span>';} else { echo ''; }
                                         if($stair_carry === 'yes'){ echo '<span class="label m-l-5  m-t-10" style="background-color: #ffc107;">Stair Carry</span>';} else { echo ''; }
                                         if($overtime === 'yes'){ echo '<span class="label m-l-5  m-t-10" style="background-color: #28a745;">Sat/Sun</span>';} else { echo ''; }
                                         if($grand_piano === 'yes'){ echo '<span class="label m-l-5  m-t-10" style="background-color: #20c997;">Grand Piano</span>';} else { echo ''; }
                                         if($upright_piano === 'yes'){ echo '<span class="label m-l-5  m-t-10" style="background-color: #7d7d7d;">Upright Piano</span>';} else { echo ''; }
                                         if($no_unpacking === 'yes'){ echo '<span class="label m-l-5  m-t-10" style="background-color: #17a2b8;">No Packing</span>';} else { echo ''; }
                                         if($no_packing === 'yes'){ echo '<span class="label m-l-5  m-t-10" style="background-color: #246aaf;">No Unpacking</span>';} else { echo ''; }
                                        ;?> </h5>
                                    <hr>
                                    </div>
                                  </div>

                              </div>


                      </div>
                      <!-- end row -->

                      <div class="row m-t-30">
                                <div class="col-12">
                                    <h4 class="font-18"><b>Move Details:</b></h4>
                                    <div class="table-responsive m-t-20">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td width="400">Pickup Address</td>
                                                <td>
                                                    <?php echo $pickup_address; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Delivery Address</td>
                                                <td>
                                                    <?php echo $delivery_address; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Date</td>
                                                <td>
                                                    <?php echo $moving_date; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Start Time</td>
                                                <td>
                                                    <?php echo $arrival_time; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Volume(cuft)</td>
                                                <td>
                                                    <?php echo $estimated_volume; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Contact Person & Phone</td>
                                                <td>
                                                    <?php echo $last_name . ", " . $first_name . " - " . $pick_up_contact_phone; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total Charge (TWD)</td>
                                                <td>
                                                    <?php echo number_format($price); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>
                                                    <?php echo $order_status; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Inventory</td>
                                                <td>
                                                  <table>
                                                      <thead class="bg-dark text-white">
                                                        <th class="pl-2">Item</th>
                                                        <th>Description</th>
                                                        <th class="pr-2">Quantity</th>
                                                      </thead>
                                                      <tbody>
                                                  <?php
                                                  $group_key = group_5c8b48a781389;
                                                  $fields = acf_get_fields($group_key);
                                                  foreach($fields as $key => $value) {
                                                    if( have_rows($value['name'], $order_id) ): ?>

                                                       <?php while( have_rows($value['name'], $order_id) ): the_row(); ?>
                                                        <tr>
                                                           <td><?php echo $value['label']; ?> </td>
                                                           <td><?php the_sub_field('item_description'); ?> </td>
                                                           <td><?php the_sub_field('item_quantity'); ?> </td>
                                                        </tr>

                                                       <?php endwhile; ?>

                                                   <?php endif;
                                                  } ; ?>
                                                  </tbody>
                                              </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Special Notes</td>
                                                <td>
                                                  <?php echo $special_notes; ?>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                  </div> <!-- end card-box/Product detai box -->
              </div> <!-- end col -->
          </div> <!-- end row -->

      </div> <!-- End container -->

    </section>


          <?php } else {

            wp_redirect(do_shortcode('[url]'));

           }
}
