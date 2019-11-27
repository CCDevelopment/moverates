<?php
/**
* Plugin Name: Moverates
* Plugin URI: https://expressdev.co
* Version: 1.0.0
* Author: Chris Collins
* Author uri: https://expressdev.co
* Description: International and Domestic Instant Quote & Booking system
* Text Domain: moverates
* Domain Path: /languages
*/

add_shortcode('url', 'display_url');
function display_url(){
  echo '<span>' . site_url() . '</span>';
}
add_action('plugins_loaded', function() {
    load_plugin_textdomain( 'moverates', false,  dirname( plugin_basename(__FILE__) ) . '/languages' );
});

// add_shortcode('print', 'test_display');
// function test_display(){
//     echo dirname( plugin_basename(__FILE__) ) . '/languages';
// }
// Define path and URL to the ACF plugin.
$plugin_dir = ABSPATH . 'wp-content/plugins/moverates';
define( 'MY_ACF_PATH', $plugin_dir . '/assets/acf/' );
define( 'MY_ACF_URL', plugins_url() . '/moverates/assets/acf/' );

add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );
function wpdocs_theme_name_scripts() {
    wp_enqueue_script( 'popper-js', plugins_url() . '/moverates/assets/popper.min.js', array(), '1.0.0', true );
    wp_enqueue_style ( 'bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' );
    wp_enqueue_script( 'bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array(), '1.0.0', true );
    wp_enqueue_style ( 'custom-css', plugins_url() . '/moverates/assets/custom-styles.css' );
    wp_enqueue_style ( 'flaticon-css', plugins_url() . '/moverates/assets/flaticon.css' );
    wp_enqueue_script( 'jquery-cdn', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), '1.0.0', false );
}

// Bring in other required styles
add_action('wp_enqueue_scripts', 'other_styles');
function other_styles() {
  wp_enqueue_style('font-awesome-5', 'https://use.fontawesome.com/releases/v5.8.1/css/all.css');
}

// Update CSS within in Admin
add_action('admin_enqueue_scripts', 'admin_style');
function admin_style() {
  wp_enqueue_style('admin-styles', plugins_url() .'/moverates/assets/admin-styles.css');
  wp_enqueue_style('font-awesome-5', 'https://use.fontawesome.com/releases/v5.8.1/css/all.css');
}

// Bring in the custom files to set things up.
require('adminoptions.php');
require('shortcodes.php');
require('moverates-acf-fields.php');
require('register-cpts.php');
require('register-page-templates.php');
require('register-roles.php');
require('woocommerce-customizations.php');


// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

// (Optional) Hide the ACF admin menu item.
add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) {
    return false;
}

// Add last log in time to the user meta
add_action('wp_login','user_last_login', 0, 2);
function user_last_login($login, $user) {
    $user = get_user_by('login',$login);
    $now = time();
    update_usermeta( $user->ID, 'user_last_login', $now );
}


// Core Rate Engine Functionality here below, all AJAX handlers
// This function updates the inventory from the front end 'edit-inventory' page.
add_action( 'wp_ajax_nopriv_update_inventory_meta', 'update_inventory_meta' );
add_action( 'wp_ajax_update_inventory_meta', 'update_inventory_meta' );
function update_inventory_meta($item) {

  $post_id = $_POST['id'];
  $newinventory = $_POST['items'];
  $testarray = [];
  $counter = 0;
  //print_r($newinventory);
    // get all of the item field names
    $group_key = group_5c8b48a781389;
    $fields = acf_get_fields($group_key);

    // Loop through and update each field with the new quantity.
    foreach($fields as $key => $value){
      foreach($newinventory as $x => $y){
        if($value['label'] === $y[0]){
          $itemdetails = array(
            'item_height'	          => '',
            'item_width_cm'	        => '',
            'item_depth_cm'	        => '',
            'item_location'	        => 'location',
            'item_quantity'       	=>  $y[1], // Volume from the details array
            'item_special_handling'	=> 'handling',
            'item_color'	          => 'blue',
            'item_notes'          	=> 'notes'
          );
          update_row($value['name'], 1, $itemdetails, $post_id);
        }
      }
    }
    echo "inventory updated";
    //Here we need to loop through the post values and update the specified post!


}

// This function gets the inventory from the front end for the INTERNATIONAL invenotry form.
add_action( 'wp_ajax_nopriv_inventory_submit', 'inventory_submit' );
add_action( 'wp_ajax_inventory_submit', 'inventory_submit' );
function inventory_submit($item) {

  $group_key = group_5c8b48a781389;
  $fields = acf_get_fields($group_key);
  foreach($fields as $key => $value) {
    //echo 'Key:'. $key . 'value: ' . $value['name'];
    foreach($_POST as $item => $detail){
      //echo 'Item: ' . $item . 'detail: ' . $detail;
      foreach($detail as $x => $z){
        if($value['name'] === $z[0]){
          echo "winner chicken dinner";
        }
        //echo 'Inner' . $detail .'x ' . $x . 'as Name: ' . $z[0] . 'and quantity' .$z[1];
      }
    }
  }
}

// This function will create a new 'Saved Rates' CPT,  so users can save an enquiry for reference later on.
add_action( 'wp_ajax_nopriv_save_for_later', 'save_for_later' );
add_action( 'wp_ajax_save_for_later', 'save_for_later' );
function save_for_later($item) {


      $origincity = sanitize_text_field($_POST['origin']);
      $destinationcity = sanitize_text_field($_POST['destination']);
      $volumecbm = sanitize_text_field($_POST['volume']);
      $ratetype = sanitize_text_field($_POST['ratetype']);
      $mode = sanitize_text_field($_POST['mode']);
      $estimatedTrucks = $volumecbm / 200;
      $email = sanitize_text_field($_POST['mail']);

      $originprice = sanitize_text_field($_POST['originprice']);
      $freightprice = sanitize_text_field($_POST['freightprice']);

      $dtchprice = sanitize_text_field($_POST['dthc']);
      $cartonDrop = sanitize_text_field($_POST['cartonDrop']);
      $pictureHanging = sanitize_text_field($_POST['pictureHanging']);
      $longCarry = sanitize_text_field($_POST['longCarry']);
      $stairCarry = sanitize_text_field($_POST['stairCarry']);
      $overTime = sanitize_text_field($_POST['overTime']);
      $grandPiano = sanitize_text_field($_POST['grandPiano']);
      $uprightPiano = sanitize_text_field($_POST['uprightPiano']);
      $noPacking = sanitize_text_field($_POST['noPacking']);
      $noUnpacking = sanitize_text_field($_POST['noUnpacking']);

      $inventory = $_POST['items'];

      $destinationprice = sanitize_text_field($_POST['destinationprice']);
      $doortodoorprice = sanitize_text_field($_POST['finaldoortodoorprice']);


      $userIP = $_SERVER['REMOTE_ADDR'];
      $currentuserid = get_current_user_id();
      $rateid = date('Ymdhisa', time());
      $dateandtime = date('Y/m/d - h:i:s a', time());
      $title = $rateid;
      $categories = 'saved rates';

      // insert the post and set the category
      $post_id = wp_insert_post(array (
          'post_type'       => 'saved_rates',
          'post_title'      => $title,
          'post_author'     => $currentuserid,
          'post_content'    => 'Created by user ID: ' . $currentuserid . ' at IP address: ' . $userIP,
          'post_category'   => $categories,
          'post_status'     => 'publish',
          'comment_status'  => 'closed',   // if you prefer
          'ping_status'     => 'closed',      // if you prefer
      ));

      if ($post_id) {
          // insert post meta
          // echo $post_id;
          update_field('origin_city', $origincity, $post_id);
          update_field('destination_city', $destinationcity, $post_id);
          update_field('volume', $volumecbm, $post_id);
          update_field('rate_type', $ratetype, $post_id);
          update_field('origin_price', $originprice, $post_id);
          update_field('frieght_price', $freightprice, $post_id);
          update_field('dthc_price', $dtchprice, $post_id);
          update_field('destination_price', $destinationprice, $post_id);
          update_field('mode', $mode, $post_id);
          update_field('estimated_total_charge', $doortodoorprice, $post_id);
          update_field('email', $email, $post_id);

          update_field('carton_drop', $cartonDrop, $post_id);
          update_field('picture_hanging', $pictureHanging, $post_id);
          update_field('long_carry', $longCarry, $post_id);
          update_field('stair_carry', $stairCarry, $post_id);
          update_field('holiday_or_weekend', $overTime, $post_id);
          update_field('grand_piano', $grandPiano, $post_id);
          update_field('upright_piano', $uprightPiano, $post_id);
          update_field('no_packing', $noPacking, $post_id);
          update_field('no_unpacking', $noUnpacking, $post_id);

          update_field('estimated_trucks', $estimatedTrucks, $post_id);

          // get all of the item field names
          $group_key = group_5c8b48a781389;
          $fields = acf_get_fields($group_key);

          //Loop through and pull all fields from the 'Items' field group.
          //print_r($inventory);
          foreach($inventory as $item => $detail){
            //echo 'Item: ' . $item . 'detail: ' . $detail[0];
            foreach($fields as $key => $value) {
              //echo 'Key:'. $key . 'value: ' . $value['name'];
              if($detail[0] === $value['name']){
                //echo 'success';
                $itemdetails = array(
                  'item_height'	          => 11,
                  'item_width_cm'	        => 12,
                  'item_depth_cm'	        => 13,
                  'item_image'	          => 'image',
                  'item_icon'	            => 'icon',
                  'item_location'	        => 'location',
                  'item_quantity'       	=>  $detail[1], // Volume from the details array
                  'item_special_handling'	=> 'handling',
                  'item_color'	          => 'blue',
                  'item_notes'          	=> 'notes'
                );
                update_row($value['name'], 1, $itemdetails, $post_id);
              }

            }
          }

          echo $rateid;
      } else {
        echo "Insert Failed";
      }


}

// Here we'll run the domestic pricing engine
add_action( 'wp_ajax_nopriv_domestic_rates_engine', 'domestic_rates_engine' );
add_action( 'wp_ajax_domestic_rates_engine', 'domestic_rates_engine' );
function domestic_rates_engine($item) {

  // Grab the inputs from the font end

  $finaldestinationprice = '';

  $origincity = sanitize_text_field($_POST['origin']);
  $destinationcity = sanitize_text_field($_POST['destination']);
  $volumecuft = sanitize_text_field($_POST['volume']);
  $totalDistance = sanitize_text_field($_POST['distance']);

  //Accessory inputs
  $cartonDrop = sanitize_text_field($_POST['cartonDrop']);
  $pictureHanging = sanitize_text_field($_POST['pictureHanging']);
  $longCarry = sanitize_text_field($_POST['longCarry']);
  $stairCarry = sanitize_text_field($_POST['stairCarry']);
  $overTime = sanitize_text_field($_POST['overTime']);
  $grandPiano = sanitize_text_field($_POST['grandPiano']);
  $uprightPiano = sanitize_text_field($_POST['uprightPiano']);
  $noPacking = sanitize_text_field($_POST['noPacking']);
  $noUnpacking = sanitize_text_field($_POST['noUnpacking']);

  $estimatedTrucks = $volumecuft / 200;

  $mincharge = get_option('min_charge');
  $pertruckcharge = get_option('per_truck_charge');
  $perkmpertruckafter25kmcharge = get_option('per_km_per_truck_after_25km_charge');

  $earlyboxdropoffcharge = get_option('early_box_drop_off_charge');
  $cratingpercuftcharge = get_option('crating_per_cuft_charge');
  $hoistingflatonehourcharge = get_option('hoisting_flat_one_hour_charge');
  $hoistingperadditionalhourcharge = get_option('hoisting_per_additional_hour_charge');
  $picturehanngingfourhourscharge = get_option('picture_hannging_four_hours_charge');
  $longcarrypercuftcharge = get_option('long_carry_per_cuft_charge');
  $staircarrypercuftcharge = get_option('stair_carry_per_cuft_charge');
  $saturdaysundayholidaycharge = get_option('saturday_sunday_holiday_charge');
  $grandpianohandlingcharge = get_option('grand_piano_handling_charge');
  $uprightpianohandlingcharge = get_option('upright_piano_handling_charge');
  $nopackingdiscountpercentage = get_option('no_packing_discount_percentage');
  $nounpackingdiscountpercentage = get_option('no_unpacking_discount_percentage');

  $doortodoorrate = $estimatedTrucks * $pertruckcharge;

  //Get the overmilage rate if any
  if($totalDistance > 25){
    $remainingdistance = $totalDistance - 25;
    $overagechages = $remainingdistance * $perkmpertruckafter25kmcharge;
    $doortodoorrate = $doortodoorrate + ($overagechages * $estimatedTrucks);
  }

  // Add the accessory charges
  if($cartonDrop === 'yes'){ $doortodoorrate = $doortodoorrate + $earlyboxdropoffcharge; }
  if($pictureHanging === 'yes'){ $doortodoorrate = $doortodoorrate + $picturehanngingfourhourscharge; }
  if($longCarry === 'yes'){ $doortodoorrate = $doortodoorrate + ($longcarrypercuftcharge * $volumecuft); }
  if($stairCarry === 'yes'){ $doortodoorrate = $doortodoorrate + ($staircarrypercuftcharge * $volumecuft); }
  if($overTime === 'yes'){ $doortodoorrate = $doortodoorrate + $saturdaysundayholidaycharge; }
  if($grandPiano === 'yes'){ $doortodoorrate = $doortodoorrate + $grandpianohandlingcharge; }
  if($uprightPiano === 'yes'){ $doortodoorrate = $doortodoorrate + $uprightpianohandlingcharge; }
  if($noPacking === 'yes'){ $doortodoorrate = $doortodoorrate - ($doortodoorrate * $nopackingdiscountpercentage); }
  if($noUnpacking === 'yes'){ $doortodoorrate = $doortodoorrate - ($doortodoorrate * $nounpackingdiscountpercentage); }

  $doortodoorrate = ceil($doortodoorrate);

  $domesticcookiearray = [
    'moveorigin'         => $origincity,
    'movedestination'    => $destinationcity,
    'movemode'           => 'Truck',
    'movevolume'         => ceil($volumecuft / 35.314),
    'moveprice'          => $doortodoorrate,
    'inventory'          => $inventory,
    'move_date'          => $movedate,
    'arrival_time'       => $starttime,
    'move_start_day'     => $movedateday,
    'carton_drop'        => $cartonDrop,
    'picture_hanging'    => $pictureHanging,
    'long_carry'         => $longCarry,
    'stair_carry'        => $stairCarry,
    'holiday_or_weekend' => $overTime,
    'grand_piano'        => $grandPiano,
    'upright_piano'      => $uprightPiano,
    'no_packing'         => $noPacking,
    'no_unpacking'       => $noUnpacking,
    'estimated_trucks'   => $estimatedTrucks,
    'volume'             => $volumecuft,
    'special_notes'      => $specialnotes,
    'move_type'          => 'domestic'
  ];
    // Loop through and set the cookies
    foreach($domesticcookiearray as $name=>$value)
      {
        setcookie($name, $value, time() + (86400 * 30), "/");
      }
      // Return the price to the front end for decoding and display.
      $ratesarray = [];
      $ratesarray['finalprice'] = ceil($doortodoorrate);
      $doortodoorrate = ceil($doortodoorrate);
      echo $doortodoorrate;

}

//Retrieve and run the rates engine via AJAX Call with the actions & function below
add_action( 'wp_ajax_nopriv_rates_engine', 'rates_engine' );
add_action( 'wp_ajax_rates_engine', 'rates_engine' );
function rates_engine($item) {

// Debug printing variable, 1 = Print.
$DEBUG = 0;

  //print_r($_POST);

  // Grab the inputs from the font end
  $origincity = sanitize_text_field($_POST['origin']);
  $destinationcity = sanitize_text_field($_POST['destination']);
  $volumecbm = sanitize_text_field($_POST['volume']);
  $mode = sanitize_text_field($_POST['mode']);
  $ratetype = sanitize_text_field($_POST['ratetype']);

  //Accessory inputs
  $cartonDrop = sanitize_text_field($_POST['cartonDrop']);
  $pictureHanging = sanitize_text_field($_POST['pictureHanging']);
  $longCarry = sanitize_text_field($_POST['longCarry']);
  $stairCarry = sanitize_text_field($_POST['stairCarry']);
  $overTime = sanitize_text_field($_POST['overTime']);
  $grandPiano = sanitize_text_field($_POST['grandPiano']);
  $uprightPiano = sanitize_text_field($_POST['uprightPiano']);
  $noPacking = sanitize_text_field($_POST['noPacking']);
  $noUnpacking = sanitize_text_field($_POST['noUnpacking']);

  // Here we can calculate our remaining variables needed
  $volumecuft = $volumecbm * 35.314;
  if($mode === 'air') {
    $volumetricweight = $volumecuft * 10.41;
    $acwkgs = $volumetricweight / 2.2;
  } else {
    $volumetricweight = $volumecuft * 6.5;
    $acwkgs = 0;
  }
  $cwtweight = $volumetricweight / 100;

      if($DEBUG === 1){
        echo " The origin is: " .$origincity;
        echo " The destination is: " .$destinationcity;
        echo " The volume is: " . $volumecbm;
        echo " The mode is: " . $mode;
        echo " Cuft: " . $volumecuft;
        echo " Volumetric Weight: " . $volumetricweight;
        echo "ACW kgs: " . $acwkgs;
        echo "Cwt weight: " . $cwtweight;
      }

// Bring in the appropriate calculations depending on the rate type.
  if($ratetype == 'DTP' || $ratetype == 'DTD'){
    // Require the origin calcuations, this file also INCLUDES Freight calcualtions as their on the same CPT.
    require('includes/origin-and-freight-rate-calculations.php');
  }
  if($ratetype == 'PTD' || $ratetype == 'DTD'){
    // Get the destination rates card and calculate the DA rates
    require('includes/destination-rate-calculations.php');
  }



// Final Door to Door Rate
$finaloriginrate = $finaloriginrate;
$finalfreightprice = $finalfreightprice;
$finaldestinationrate = $finaldestinationrate;
$doortodoorrate = ceil($finaloriginrate + $finalfreightprice + $finaldestinationrate);



//Set the items into an a nice arranged array together
$ratesarray = [];
$ratesarray['origin'] = number_format($finaloriginrate);
$ratesarray['freight'] = number_format($finalfreightprice);
$ratesarray['destination'] = number_format($finaldestinationrate);
$ratesarray['doortodoorrate'] = number_format($doortodoorrate);

  if($DEBUG === 1){
    echo "Final Door to Door Rate is: " . $doortodoorrate;
  }

  // Here we'll set a cookie with the updated price to use in the cart for direct checkout
  $cookiearray = [
    'moveorigin'         => $origincity,
    'movedestination'    => $destinationcity,
    'movemode'           => $mode,
    'movevolume'         => $volumecbm,
    'ratetype'           => $ratetype,
    'moveprice'          => $doortodoorrate,
    'move_date'          => $movedate,
    'arrival_time'       => $starttime,
    'move_start_day'     => $movedateday,
    'carton_drop'        => $cartonDrop,
    'picture_hanging'    => $pictureHanging,
    'long_carry'         => $longCarry,
    'stair_carry'        => $stairCarry,
    'holiday_or_weekend' => $overTime,
    'grand_piano'        => $grandPiano,
    'upright_piano'      => $uprightPiano,
    'no_packing'         => $noPacking,
    'no_unpacking'       => $noUnpacking,
    'estimated_trucks'   => $estimated_trucks,
    'volume'             => $movevolume,
    'special_notes'      => $specialnotes,
    'move_type'          => 'international'
  ];
    // Loop through and set the cookies
    foreach($cookiearray as $name=>$value)
      {
        setcookie($name, $value, time() + (86400 * 30), "/");
      }
    // Here we will set a new cookie for each inventory item.
    $itemlist = $_POST['itemlist'];
    foreach($itemlist as $name => $value)
      {
          //$value[0]; // Item Name
          //$value[1]; // Item Quantity
          setcookie($value[0], $value[1], time() + (86400 * 30), "/");
      }

  // Encode into a JSON format to send back to the front end, so we can use JS to fill in elements with the data.
  // echo wp_json_encode($_COOKIE);
  echo wp_json_encode($ratesarray);

  // Below echo is what is sent back to the font end JQuery function.


  wp_die();
}
