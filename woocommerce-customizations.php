<?php

/*
**
** WOOCOMMERCE CUSTOMIZATIONS
**
*/
// This gets rid of the "cannot add another single move to cart" error.
function custom_maybe_empty_cart( $valid, $product_id, $quantity ) {
  if( ! empty ( WC()->cart->get_cart() ) && $valid ){
           WC()->cart->empty_cart();
   }
   return $valid;
  }
add_filter( 'woocommerce_add_to_cart_validation', 'custom_maybe_empty_cart', 10, 3 );


// This is where we update the price of the move on the fly to the exact customers move price. Uses a Session COOKIE, which is set in "checkout.php" during the pricing calculations.
add_action( 'woocommerce_before_calculate_totals', 'woocommerce_pds_update_price', 99 );
function woocommerce_pds_update_price() {

        $custom_price = $_COOKIE["moveprice"];  // This will be your custom price, set in checkout.php

        if( $_COOKIE["move_type"] === 'international'){
          $slug = 'international-move';
          $product_obj = get_page_by_path( $slug, OBJECT, 'product' );
          $product_id = $product_obj->ID; //International move product ID
        } else {
          $slug = 'domestic-move';
          $product_obj = get_page_by_path( $slug, OBJECT, 'product' );
          $product_id = $product_obj->ID; // Domestic Move product ID
        }


        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
          //print_r($cart_item);
            if($cart_item['data']->get_id() == $product_id){
              //print_r($cart_item['data']);
                $cart_item['data']->set_price($custom_price);

            }
        }
        //print_r($cart_item['data']);
    }



    // REMOVE additional unwanted billing Fields from check out form
    add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
    // Our hooked in function - $fields is passed via the filter!
    function custom_override_checkout_fields( $fields ) {
         unset($fields['billing']['billing_company']);
         unset($fields['billing']['billing_email']);
         unset($fields['billing']['billing_phone']);
         unset($fields['billing']['billing_city']);
         unset($fields['billing']['billing_country']);
         unset($fields['billing']['billing_first_name']);
         unset($fields['billing']['billing_last_name']);
         unset($fields['billing']['billing_address_1']);
         unset($fields['billing']['billing_address_2']);
         unset($fields['order']['order_comments']);
         unset($fields['billing']['billing_state']);
         unset($fields['billing']['billing_postcode']);
         return $fields;
    }


    remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );// remove the cupon code prompt.
    add_filter( 'wc_add_to_cart_message_html', '__return_null' ); // remove the "added to cart notice".

    add_filter( 'woocommerce_order_button_text', 'misha_custom_button_text' );
    function misha_custom_button_text( $button_text ) {
       return 'Book My Move!'; // new text is here
    }

    // Update the order ACF fields when the order is placed.
    add_action('woocommerce_new_order', 'custom_process_order', 10, 1);
    function custom_process_order($order_id) {
        $order = new WC_Order( $order_id );
        $myuser_id = (int)$order->user_id;
        $user_info = get_userdata($myuser_id);
        $items = $order->get_items();
        $order_data = $order->get_data();
        $order_billing_first_name = $order_data['billing']['first_name'];
        $order_billing_last_name = $order_data['billing']['last_name'];
        $order_billing_email = $order_data['billing']['email'];
        $order_billing_phone =  get_user_meta( $myuser_id, 'billing_phone', true );


               update_post_meta($order_id, 'origin_city', sanitize_text_field( $_COOKIE['moveorigin'] ));
               update_post_meta($order_id, 'destination_city',  sanitize_text_field( $_COOKIE['movedestination'] ));
               update_post_meta($order_id, 'pickup_address', sanitize_text_field( $_POST['originaddress'] ));
               update_post_meta($order_id, 'delivery_address',  sanitize_text_field( $_POST['destinationaddress'] ));

               update_post_meta($order_id, 'move_reference_number', $order_id);
               update_post_meta($order_id, 'last_name', sanitize_text_field( $_POST['billing_last_name'] ));
               update_post_meta($order_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ));
               update_post_meta($order_id, 'pick_up_contact_phone', $order_billing_phone);
               update_post_meta($order_id, 'delivery_contact_phone', $order_billing_phone);
               update_post_meta($order_id, 'mode', sanitize_text_field( $_COOKIE['movemode'] ));
               update_post_meta($order_id, 'inventory', sanitize_text_field( $_COOKIE['inventory'] ) );
               update_post_meta($order_id, 'move_date', sanitize_text_field( $_POST['movedate'] ));
               update_post_meta($order_id, 'arrival_time', sanitize_text_field( $_POST['starttime'] ));
               update_post_meta($order_id, 'move_start_day', sanitize_text_field( $_COOKIE['movedateday'] ));
               update_post_meta($order_id, 'carton_drop', sanitize_text_field( $_COOKIE['cartondroporder'] ) );
               update_post_meta($order_id, 'picture_hanging', sanitize_text_field( $_COOKIE['picturehangingorder'] ) );
               update_post_meta($order_id, 'long_carry', sanitize_text_field( $_COOKIE['longcarryorder'] ) );
               update_post_meta($order_id, 'stair_carry', sanitize_text_field( $_COOKIE['staircarryorder'] ) );
               update_post_meta($order_id, 'holiday_or_weekend', sanitize_text_field( $_COOKIE['holidayorder'] ) );
               update_post_meta($order_id, 'grand_piano', sanitize_text_field( $_COOKIE['grandpianoorder'] ) );
               update_post_meta($order_id, 'upright_piano', sanitize_text_field( $_COOKIE['uprightpianoorder'] ) );
               update_post_meta($order_id, 'no_packing', sanitize_text_field( $_COOKIE['nopackingorder'] ) );
               update_post_meta($order_id, 'no_unpacking', sanitize_text_field( $_COOKIE['nounpackingorder'] ) );
               update_post_meta($order_id, 'estimated_trucks', sanitize_text_field( $_COOKIE['estimated_trucks'] ));
               update_post_meta($order_id, 'volume', sanitize_text_field( $_COOKIE['movevolume'] ));
               update_post_meta($order_id, 'special_notes', sanitize_text_field( $_POST['specialnotes'] ));
               update_post_meta($order_id, 'email', $order_billing_email );
               update_post_meta($order_id, 'estimated_total_charge', sanitize_text_field( $_COOKIE['moveprice'] ));
               // update_post_meta($order_id, 'actual_final_charge');
               // update_post_meta($order_id, 'actual_volume');
               // update_post_meta($order_id, 'extra_services');
               update_post_meta($order_id, 'contact_phone', $order_billing_phone);
               // update_post_meta($order_id, 'delivery_contact_phone');
               // update_post_meta($order_id, 'extra_notes');
              // update_post_meta($order_id, 'service_rating');

              // get all of the item field names
              $group_key = group_5c8b48a781389;
              $fields = acf_get_fields($group_key);

              //Loop through and pull all fields from the 'Items' field group.
              //print_r($inventory);
              foreach($_COOKIE as $item => $detail){
                //echo 'Item: ' . $item . 'detail: ' . $detail[0];
                foreach($fields as $key => $value) {
                  //echo 'Key:'. $key . 'value: ' . $value['name'];
                    if($item === $value['name']){
                      echo 'success';
                        $itemdetails = array(
                          'item_height'	          => 11,
                          'item_width_cm'	        => 12,
                          'item_depth_cm'	        => 13,
                          'item_image'	          => 'image',
                          'item_icon'	            => 'icon',
                          'item_location'	        => 'location',
                          'item_quantity'       	=>  $detail, // Volume from the details array
                          'item_special_handling'	=> 'handling',
                          'item_color'	          => 'blue',
                          'item_notes'          	=> 'notes'
                        );
                        update_row($value['name'], 1, $itemdetails, $order_id);
                  }
                }
              }


        return $order_id;

    }

    //Redirect to custom thank you page after a new move has been booked.
    add_action( 'template_redirect', 'woo_custom_redirect_after_purchase' );
      function woo_custom_redirect_after_purchase() {
        global $wp;
        if ( is_page('checkout')  && is_checkout() && !empty( $wp->query_vars['order-received'] ) ) {
          wp_redirect( site_url() . '/move-booked-thank-you/' );
          exit;
        }
    }

// Add the custom move related fields to the checkout page form
add_action('woocommerce_before_checkout_billing_form', 'display_new_move_fields');
function display_new_move_fields(){ ?>

<?php $user = wp_get_current_user();
$currentuseremail = $user->user_email;?>

  <div class="woocommerce-billing-fields__field-wrapper">
    <div class="form-group">
        <label for="originaddress">Pickup Address</label>
        <input type="text" class="form-control" name="originaddress" id="originaddress" aria-describedby="originaddress" placeholder="" value="<?php echo $originAddress ;?>" required>
    </div>
    <div class="form-group">
        <label for="destinationaddress">Delivery Address</label>
        <input type="text" class="form-control" name="destinationaddress" id="destinationaddress" aria-describedby="destinationaddress" placeholder="" value="<?php echo $destinationAddress ;?>" required>
    </div>
    <div class="form-group d-none">
        <label for="volume">Volume (Cuft):</label>
        <input type="text" class="form-control" name="volume" id="volume" aria-describedby="volume" placeholder="" value="<?php echo $totalVolume ;?>" required>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
          <label for="movedate">Move Date</label>
          <input type="date" class="form-control" name="movedate" id="movedate" aria-describedby="movedate" placeholder="" value="" required>
      </div>
      <div class="form-group col-md-6">
          <label for="starttime">Start Time</label>
          <input type="time" class="form-control" name="starttime" id="starttime" aria-describedby="starttime" placeholder="" value="" required>
      </div>
    </div>
    <div class="form-group d-none">
        <label for="totaldistance">Move Distance (km):</label>
        <input type-"text" class="form-control" rows="5" name="totaldistance" id="totaldistance" placeholder="" value="<?php echo $totalDistance ;?>" required></textarea>
    </div>
    <div class="form-group d-none">
      <label for="inventory">Inventory</label>
      <input type="text" class="form-control" id="inventory" name="inventory" aria-describedby="inventory" placeholder="" value="<?php echo $inventoryList ;?>" required>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
          <label for="billing_first_name">First Name</label>
          <input type="text" class="form-control validate-required" aria-describedby="firstname" name="billing_first_name" id="billing_first_name" placeholder="" value="" autocomplete="given-name" data-priority="10" required>
      </div>
      <div class="form-group col-md-6">
          <label for="billing_last_name">Last Name</label>
          <input type="text" class="form-control validate-required" aria-describedby="lastname" name="billing_last_name" id="billing_last_name" placeholder="" value="" autocomplete="family-name" data-priority="20" required>
      </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="billing_email" class="col-form-label">Email</label>
            <input type="email" class="form-control validate-required" value="<?php echo $currentuseremail ;?>" name="billing_email" id="billing_email" placeholder="Email" autocomplete="email username" readonly="readonly">
        </div>
        <div class="form-group col-md-6">
            <label for="billing_phone" class="col-form-label">Phone</label>
            <input type="tel" class="form-control validate-required" name="billing_phone" id="billing_phone" placeholder="Tel" autocomplete="tel">
        </div>
    </div>
    <div class="form-group">
        <label for="billing_address_1" class="col-form-label">Billing Address</label>
        <input type="text" class="form-control validate-required" name="billing_address_1" id="billing_address_1" placeholder="1234 Main St">
    </div>
    <div class="form-group">
        <label for="billing_address_2" class="col-form-label">Billing Address 2</label>
        <input type="text" class="form-control validate-required" anme="billing_address_2" id="billing_address_2" placeholder="Apartment, studio, or floor">
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="billing_city" class="col-form-label">City</label>
            <input type="text" name="billing_city" class="form-control validate-required" id="billing_city" data-priority="40">
        </div>
        <div class="form-group col-md-4">
            <label for="billing_country" class="col-form-label">Country</label>
            <select name="billing_country" id="billing_country" class="form-control validate-required" autocomplete="country" tabindex="-1" aria-hidden="true">
              <option value="" selected="selected">Select a country…</option>
              <option value="AX">Åland Islands</option>
              <option value="AF">Afghanistan</option>
              <option value="AL">Albania</option>
              <option value="DZ">Algeria</option>
              <option value="AS">American Samoa</option>
              <option value="AD">Andorra</option>
              <option value="AO">Angola</option>
              <option value="AI">Anguilla</option>
              <option value="AQ">Antarctica</option>
              <option value="AG">Antigua and Barbuda</option>
              <option value="AR">Argentina</option>
              <option value="AM">Armenia</option>
              <option value="AW">Aruba</option>
              <option value="AU">Australia</option>
              <option value="AT">Austria</option>
              <option value="AZ">Azerbaijan</option>
              <option value="BS">Bahamas</option>
              <option value="BH">Bahrain</option>
              <option value="BD">Bangladesh</option>
              <option value="BB">Barbados</option>
              <option value="BY">Belarus</option>
              <option value="PW">Belau</option>
              <option value="BE">Belgium</option>
              <option value="BZ">Belize</option>
              <option value="BJ">Benin</option>
              <option value="BM">Bermuda</option>
              <option value="BT">Bhutan</option>
              <option value="BO">Bolivia</option>
              <option value="BQ">Bonaire, Saint Eustatius and Saba</option>
              <option value="BA">Bosnia and Herzegovina</option>
              <option value="BW">Botswana</option>
              <option value="BV">Bouvet Island</option>
              <option value="BR">Brazil</option>
              <option value="IO">British Indian Ocean Territory</option>
              <option value="VG">British Virgin Islands</option>
              <option value="BN">Brunei</option>
              <option value="BG">Bulgaria</option>
              <option value="BF">Burkina Faso</option>
              <option value="BI">Burundi</option>
              <option value="KH">Cambodia</option>
              <option value="CM">Cameroon</option>
              <option value="CA">Canada</option>
              <option value="CV">Cape Verde</option>
              <option value="KY">Cayman Islands</option>
              <option value="CF">Central African Republic</option>
              <option value="TD">Chad</option>
              <option value="CL">Chile</option>
              <option value="CN">China</option>
              <option value="CX">Christmas Island</option>
              <option value="CC">Cocos (Keeling) Islands</option>
              <option value="CO">Colombia</option>
              <option value="KM">Comoros</option>
              <option value="CG">Congo (Brazzaville)</option>
              <option value="CD">Congo (Kinshasa)</option>
              <option value="CK">Cook Islands</option>
              <option value="CR">Costa Rica</option>
              <option value="HR">Croatia</option>
              <option value="CU">Cuba</option>
              <option value="CW">Curaçao</option>
              <option value="CY">Cyprus</option>
              <option value="CZ">Czech Republic</option>
              <option value="DK">Denmark</option>
              <option value="DJ">Djibouti</option>
              <option value="DM">Dominica</option>
              <option value="DO">Dominican Republic</option>
              <option value="EC">Ecuador</option>
              <option value="EG">Egypt</option>
              <option value="SV">El Salvador</option>
              <option value="GQ">Equatorial Guinea</option>
              <option value="ER">Eritrea</option>
              <option value="EE">Estonia</option>
              <option value="ET">Ethiopia</option>
              <option value="FK">Falkland Islands</option>
              <option value="FO">Faroe Islands</option>
              <option value="FJ">Fiji</option>
              <option value="FI">Finland</option>
              <option value="FR">France</option>
              <option value="GF">French Guiana</option>
              <option value="PF">French Polynesia</option>
              <option value="TF">French Southern Territories</option>
              <option value="GA">Gabon</option>
              <option value="GM">Gambia</option>
              <option value="GE">Georgia</option>
              <option value="DE">Germany</option>
              <option value="GH">Ghana</option>
              <option value="GI">Gibraltar</option>
              <option value="GR">Greece</option>
              <option value="GL">Greenland</option>
              <option value="GD">Grenada</option>
              <option value="GP">Guadeloupe</option>
              <option value="GU">Guam</option>
              <option value="GT">Guatemala</option>
              <option value="GG">Guernsey</option>
              <option value="GN">Guinea</option>
              <option value="GW">Guinea-Bissau</option>
              <option value="GY">Guyana</option>
              <option value="HT">Haiti</option>
              <option value="HM">Heard Island and McDonald Islands</option>
              <option value="HN">Honduras</option>
              <option value="HK">Hong Kong</option>
              <option value="HU">Hungary</option>
              <option value="IS">Iceland</option>
              <option value="IN">India</option>
              <option value="ID">Indonesia</option>
              <option value="IR">Iran</option>
              <option value="IQ">Iraq</option>
              <option value="IE">Ireland</option>
              <option value="IM">Isle of Man</option>
              <option value="IL">Israel</option>
              <option value="IT">Italy</option>
              <option value="CI">Ivory Coast</option>
              <option value="JM">Jamaica</option>
              <option value="JP">Japan</option>
              <option value="JE">Jersey</option>
              <option value="JO">Jordan</option>
              <option value="KZ">Kazakhstan</option>
              <option value="KE">Kenya</option>
              <option value="KI">Kiribati</option>
              <option value="KW">Kuwait</option>
              <option value="KG">Kyrgyzstan</option>
              <option value="LA">Laos</option>
              <option value="LV">Latvia</option>
              <option value="LB">Lebanon</option>
              <option value="LS">Lesotho</option>
              <option value="LR">Liberia</option>
              <option value="LY">Libya</option>
              <option value="LI">Liechtenstein</option>
              <option value="LT">Lithuania</option>
              <option value="LU">Luxembourg</option>
              <option value="MO">Macao S.A.R., China</option>
              <option value="MK">Macedonia</option>
              <option value="MG">Madagascar</option>
              <option value="MW">Malawi</option>
              <option value="MY">Malaysia</option>
              <option value="MV">Maldives</option>
              <option value="ML">Mali</option>
              <option value="MT">Malta</option>
              <option value="MH">Marshall Islands</option>
              <option value="MQ">Martinique</option>
              <option value="MR">Mauritania</option>
              <option value="MU">Mauritius</option>
              <option value="YT">Mayotte</option>
              <option value="MX">Mexico</option>
              <option value="FM">Micronesia</option>
              <option value="MD">Moldova</option>
              <option value="MC">Monaco</option>
              <option value="MN">Mongolia</option>
              <option value="ME">Montenegro</option>
              <option value="MS">Montserrat</option>
              <option value="MA">Morocco</option>
              <option value="MZ">Mozambique</option>
              <option value="MM">Myanmar</option>
              <option value="NA">Namibia</option>
              <option value="NR">Nauru</option>
              <option value="NP">Nepal</option>
              <option value="NL">Netherlands</option>
              <option value="NC">New Caledonia</option>
              <option value="NZ">New Zealand</option>
              <option value="NI">Nicaragua</option>
              <option value="NE">Niger</option>
              <option value="NG">Nigeria</option>
              <option value="NU">Niue</option>
              <option value="NF">Norfolk Island</option>
              <option value="KP">North Korea</option>
              <option value="MP">Northern Mariana Islands</option>
              <option value="NO">Norway</option>
              <option value="OM">Oman</option>
              <option value="PK">Pakistan</option>
              <option value="PS">Palestinian Territory</option>
              <option value="PA">Panama</option>
              <option value="PG">Papua New Guinea</option>
              <option value="PY">Paraguay</option>
              <option value="PE">Peru</option>
              <option value="PH">Philippines</option>
              <option value="PN">Pitcairn</option>
              <option value="PL">Poland</option>
              <option value="PT">Portugal</option>
              <option value="PR">Puerto Rico</option>
              <option value="QA">Qatar</option>
              <option value="RE">Reunion</option>
              <option value="RO">Romania</option>
              <option value="RU">Russia</option>
              <option value="RW">Rwanda</option>
              <option value="ST">São Tomé and Príncipe</option>
              <option value="BL">Saint Barthélemy</option>
              <option value="SH">Saint Helena</option>
              <option value="KN">Saint Kitts and Nevis</option>
              <option value="LC">Saint Lucia</option>
              <option value="SX">Saint Martin (Dutch part)</option>
              <option value="MF">Saint Martin (French part)</option>
              <option value="PM">Saint Pierre and Miquelon</option>
              <option value="VC">Saint Vincent and the Grenadines</option>
              <option value="WS">Samoa</option>
              <option value="SM">San Marino</option>
              <option value="SA">Saudi Arabia</option>
              <option value="SN">Senegal</option>
              <option value="RS">Serbia</option>
              <option value="SC">Seychelles</option>
              <option value="SL">Sierra Leone</option>
              <option value="SG">Singapore</option>
              <option value="SK">Slovakia</option>
              <option value="SI">Slovenia</option>
              <option value="SB">Solomon Islands</option>
              <option value="SO">Somalia</option>
              <option value="ZA">South Africa</option>
              <option value="GS">South Georgia/Sandwich Islands</option>
              <option value="KR">South Korea</option>
              <option value="SS">South Sudan</option>
              <option value="ES">Spain</option>
              <option value="LK">Sri Lanka</option>
              <option value="SD">Sudan</option>
              <option value="SR">Suriname</option>
              <option value="SJ">Svalbard and Jan Mayen</option>
              <option value="SZ">Swaziland</option>
              <option value="SE">Sweden</option>
              <option value="CH">Switzerland</option>
              <option value="SY">Syria</option>
              <option value="TW">Taiwan</option>
              <option value="TJ">Tajikistan</option>
              <option value="TZ">Tanzania</option>
              <option value="TH">Thailand</option>
              <option value="TL">Timor-Leste</option>
              <option value="TG">Togo</option>
              <option value="TK">Tokelau</option>
              <option value="TO">Tonga</option>
              <option value="TT">Trinidad and Tobago</option>
              <option value="TN">Tunisia</option>
              <option value="TR">Turkey</option>
              <option value="TM">Turkmenistan</option>
              <option value="TC">Turks and Caicos Islands</option>
              <option value="TV">Tuvalu</option>
              <option value="UG">Uganda</option>
              <option value="UA">Ukraine</option>
              <option value="AE">United Arab Emirates</option>
              <option value="GB">United Kingdom (UK)</option>
              <option value="US">United States (US)</option>
              <option value="UM">United States (US) Minor Outlying Islands</option>
              <option value="VI">United States (US) Virgin Islands</option>
              <option value="UY">Uruguay</option>
              <option value="UZ">Uzbekistan</option>
              <option value="VU">Vanuatu</option>
              <option value="VA">Vatican</option>
              <option value="VE">Venezuela</option>
              <option value="VN">Vietnam</option>
              <option value="WF">Wallis and Futuna</option>
              <option value="EH">Western Sahara</option>
              <option value="YE">Yemen</option>
              <option value="ZM">Zambia</option>
              <option value="ZW">Zimbabwe</option>
            </select>
        </div>
    </div>
    <div class="form-group">
      <label for="specialnotes">Special Notes</label>
      <textarea class="form-control" id="specialnotes" name="specialnotes" aria-describedby="specialnotes" placeholder="" value="<?php echo $inventoryList ;?>" required></textarea>
    </div>
    <div class="form-group d-none">
        <label for="moving_company_name">Moving Company</label>
        <input type="text" class="form-control validate-required" aria-describedby="moving_company_name" name="moving_company_name" id="moving_company_name" value="" data-priority="80" required>
    </div>
    <div class="form-group d-none">
        <label for="estimated_trucks">Estimated Trucks</label>
        <input type="text" class="form-control validate-required" aria-describedby="estimated_trucks" name="estimated_trucks" id="estimated_trucks" value="" data-priority="80" required>
    </div>
		<div class="form-group d-none">
        <label for="traveltime">Travel Time</label>
        <input type="text" class="form-control" id="traveltime" name="traveltime" aria-describedby="traveltime" placeholder="" value="<?php echo $totalTravelTime ;?>" required>
    </div>
		<div class="form-group d-none">
				<label for="travelTimeHrs">travel time Hrs</label>
				<input type="text" class="form-control" name="travelTimeHrs" id="travelTimeHrs" aria-describedby="travelTimeHrs" placeholder="" value="<?php echo $totalVolume ;?>" required>
		</div>
		<div class="form-group d-none">
				<label for="travelTimeMins">travel time mins</label>
				<input type="text" class="form-control" name="travelTimeMins" id="travelTimeMins" aria-describedby="travelTimeMins" placeholder="" value="" required>
		</div>
		<div class="form-group d-none">
				<label for="longcarryorder">long carry</label>
				<input type="text" class="form-control" name="longcarryorder" id="longcarryorder" aria-describedby="longcarryorder" placeholder="" value="" required>
		</div>
		<div class="form-group d-none">
				<label for="staircarryorder">stair carry</label>
				<input type="text" class="form-control" name="staircarryorder" id="staircarryorder" aria-describedby="staircarryorder" placeholder="" value="" required>
		</div>
		<div class="form-group d-none">
				<label for="cartondroporder">carton drop order</label>
				<input type="text" class="form-control" name="cartondroporder" id="cartondroporder" aria-describedby="cartondroporder" placeholder="" value="" required>
		</div>
		<div class="form-group d-none">
				<label for="picturehangingorder">Picture Haning</label>
				<input type="text" class="form-control" name="picturehangingorder" id="picturehangingorder" aria-describedby="picturehangingorder" placeholder="" value="" required>
		</div>
		<div class="form-group d-none">
				<label for="holidayorder">Holiday</label>
				<input type="text" class="form-control" name="holidayorder" id="holidayorder" aria-describedby="holidayorder" placeholder="" value="" required>
		</div>
		<div class="form-group d-none">
				<label for="grandpianoorder">Grand Piano</label>
				<input type="text" class="form-control" name="grandpianoorder" id="grandpianoorder" aria-describedby="grandpianoorder" placeholder="" value="" required>
		</div>
		<div class="form-group d-none">
				<label for="uprightpianoorder">Upright Piano</label>
				<input type="text" class="form-control" name="uprightpianoorder" id="uprightpianoorder" aria-describedby="uprightpianoorder" placeholder="" value="" required>
		</div>
		<div class="form-group d-none">
				<label for="nopackingorder">No Packing</label>
				<input type="text" class="form-control" name="nopackingorder" id="nopackingorder" aria-describedby="nopackingorder" placeholder="" value="" required>
		</div>
		<div class="form-group d-none">
				<label for="nounpackingorder">No unpacking</label>
				<input type="text" class="form-control" name="nounpackingorder" id="nounpackingorder" aria-describedby="nounpackingorder" placeholder="" value="" required>
		</div>
		<div class="form-group d-none">
				<label for="priceorder">price</label>
				<input type="text" class="form-control" name="priceorder" id="priceorder" aria-describedby="priceorder" placeholder="" value="" required>
		</div>
	</div>

<?php
}
