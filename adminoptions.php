<?php

/**
* BEGIN ADMIN SCREEN SETTINGS
*/

    /* Register the custom menu page on admin screen.*/

    function pds_moving_theme_admin_menu() {
      $page_title = 'Moving Leads';
      $menu_title = 'Moving Leads';
      $capability = 'manage_options';
      $menu_slug =  'moving-leads';
      $function =   'admin_output';
      add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);

      //call register settings function
	    add_action( 'admin_init', 'pds_register_moving_lead_settings' );
    }
    add_action( 'admin_menu', 'pds_moving_theme_admin_menu' );
    /* Register the fields we'll need for admin input */
    function pds_register_moving_lead_settings(){
      //register our settings
        // Company Information Fields
    	register_setting( 'pds-moving-leads-options', 'company_name');
      register_setting( 'pds-moving-leads-options', 'company_founded_date');
      register_setting( 'pds-moving-leads-options', 'company_email_contact');
      register_setting( 'pds-moving-leads-options', 'no_of_employees');
      register_setting( 'pds-moving-leads-options', 'no_of_trucks');
      register_setting( 'pds-moving-leads-options', 'company_introduction');
      register_setting( 'pds-moving-leads-options', 'company_address');
      register_setting( 'pds-moving-leads-options', 'company_phone');
      register_setting( 'pds-moving-leads-options', 'company_logo');
      register_setting( 'pds-moving-leads-options', 'company_logo_file');
      register_setting( 'pds-moving-leads-options', 'company_logo_file_attachment_id');
      register_setting( 'pds-moving-leads-options', 'google_maps_api_key');

        // Pricing fields
      register_setting( 'pds-moving-leads-options', 'min_charge');
      register_setting( 'pds-moving-leads-options', 'per_truck_charge');
      register_setting( 'pds-moving-leads-options', 'per_km_per_truck_after_25km_charge');
      register_setting( 'pds-moving-leads-options', 'early_box_drop_off_charge');
      register_setting( 'pds-moving-leads-options', 'crating_per_cuft_charge');
      register_setting( 'pds-moving-leads-options', 'hoisting_flat_one_hour_charge');
      register_setting( 'pds-moving-leads-options', 'hoisting_per_additional_hour_charge');
      register_setting( 'pds-moving-leads-options', 'picture_hannging_four_hours_charge');
      register_setting( 'pds-moving-leads-options', 'long_carry_per_cuft_charge');
      register_setting( 'pds-moving-leads-options', 'stair_carry_per_cuft_charge');
      register_setting( 'pds-moving-leads-options', 'saturday_sunday_holiday_charge');
      register_setting( 'pds-moving-leads-options', 'grand_piano_handling_charge');
      register_setting( 'pds-moving-leads-options', 'upright_piano_handling_charge');
      register_setting( 'pds-moving-leads-options', 'no_packing_discount_percentage');
      register_setting( 'pds-moving-leads-options', 'no_unpacking_discount_percentage');
    }

    /* Form Output for user input on the admin screen. This will handle input, updating, and sanatizing of all fields automatically!... Options -> Moving Leads */
    function admin_output(){
      ?>
      <div class="wrap">
        <h1>Moving Company Details</h1>
        <p style="padding: 20px; background-color: white; border: 2px solid #00ca67;"><span style="font-weight: 700;">Welcome to the moving leads system settings. </span><br>Use this page to update your company profile information, pricing, and details. All of these settings will begin to be used instantly when you save, so please be sure to pay extra attention when inputting to ensure there are no errors to prevent any mis-quoting to occur to your customers.</p>
        <form method="post" action="options.php" enctype="multipart/form-data">

          <?php settings_fields( 'pds-moving-leads-options' );
                do_settings_sections( 'pds-moving-leads-options' );
          ?>

          <table class="form-table">
            <tr>
              <h3>Company Information</h3>
              <p>Please use the fields here below to input some of the key information about your company. This will be displayed in various places across the site to help build potential visitors trust in your business.</p>
            </tr>
              <tr valign="top">
                <th scope="row">Company Name</th>
                <td><input type="text" name="company_name" value="<?php echo esc_attr( get_option('company_name') ); ?>" /></td>
              </tr>
              <tr valign="top">
                <th scope="row">Company Founded</th>
                <td><input type="date" name="company_founded_date" value="<?php echo esc_attr( get_option('company_founded_date') ); ?>" /></td>
              </tr>
              <tr valign="top">
                <th scope="row">Company E-mail</th>
                <td><input type="email" name="company_email_contact" value="<?php echo esc_attr( get_option('company_email_contact') ); ?>" /></td>
              </tr>
              <tr valign="top">
                <th scope="row">Number of Employees</th>
                <td><input type="number" name="no_of_employees" value="<?php echo esc_attr( get_option('no_of_employees') ); ?>" /></td>
              </tr>
              <tr valign="top">
                <th scope="row">Number of Trucks</th>
                <td><input type="number" name="no_of_trucks" value="<?php echo esc_attr( get_option('no_of_trucks') ); ?>" /></td>
              </tr>
              <tr valign="top">
                <th scope="row">Company Introduction</th>
                <td><input type="textarea" name="company_introduction" value="<?php echo esc_attr( get_option('company_introduction') ); ?>" /></td>
              </tr>
              <tr valign="top">
                <th scope="row">Company Address</th>
                <td><input type="text" name="company_address" value="<?php echo esc_attr( get_option('company_address') ); ?>" /></td>
              </tr>
              <tr valign="top">
                <th scope="row">Company Phone</th>
                <td><input type="phone" name="company_phone" value="<?php echo esc_attr( get_option('company_phone') ); ?>" /></td>
              </tr>
              <tr valign="top">
                <th scope="row">Company Logo URL path (e.g. /wp-content/uploads/2000/01/picture.jpg)</th>
                <td><input type="text" name="company_logo" value="<?php echo esc_attr( get_option('company_logo') ); ?>" /></td>
              </tr>
              <tr valign="top">
                <th scope="row">Company Logo file</th>
                <td><input type="file" name="company_logo_file" value="<?php echo esc_attr( get_option('company_logo_file') ); ?>" /></td>
              </tr>
              <tr valign="top">
                <th scope="row">Company Logo file Attachment ID</th>
                <td><input type="text" name="company_logo_file_attachment_id" value="<?php echo esc_attr( get_option('company_logo_file_attachment_id') ); ?>" /></td>
              </tr>
              <tr valign="top">
                <th scope="row">Google Maps API Key</th>
                <td><input type="text" name="google_maps_api_key" value="<?php echo esc_attr( get_option('google_maps_api_key') ); ?>" /></td>
              </tr>
          </table>

          <table class="form-table">
            <tr>
              <h3>Domestic Pricing Table</h3>
              <p>Please use the inputs below for your DOMESTIC MOVE pricing only. Remember, all quote calcuations will be based on the rates you put into these fields, and will be effective immediatley when saving.</p>
            </tr>
            <tr valign="top">
              <th scope="row">Minimum Charge</th>
              <td><input type="number" name="min_charge" value="<?php echo esc_attr( get_option('min_charge') ); ?>" /></td>
            </tr>
            <tr valign="top">
              <th scope="row">Per Truck Charge (200 cuft / truck)</th>
              <td><input type="number" name="per_truck_charge" value="<?php echo esc_attr( get_option('per_truck_charge') ); ?>" /></td>
            </tr>
            <tr valign="top">
              <th scope="row">Charge per KM, per Truck, after first 25km</th>
              <td><input type="number" name="per_km_per_truck_after_25km_charge" value="<?php echo esc_attr( get_option('per_km_per_truck_after_25km_charge') ); ?>" /></td>
            </tr>
            <tr valign="top">
              <th scope="row">Early Box Drop Off Charge</th>
              <td><input type="number" name="early_box_drop_off_charge" value="<?php echo esc_attr( get_option('early_box_drop_off_charge') ); ?>" /></td>
            </tr>
            <tr valign="top">
              <th scope="row">Crating Charge (per cubic foot)</th>
              <td><input type="number" name="crating_per_cuft_charge" value="<?php echo esc_attr( get_option('crating_per_cuft_charge') ); ?>" /></td>
            </tr>
            <tr valign="top">
              <th scope="row">Hoisting Charge (First 1 Hour)</th>
              <td><input type="number" name="hoisting_flat_one_hour_charge" value="<?php echo esc_attr( get_option('hoisting_flat_one_hour_charge') ); ?>" /></td>
            </tr>
            <tr valign="top">
              <th scope="row">Hoisting Charge Per Additional Hour)</th>
              <td><input type="number" name="hoisting_per_additional_hour_charge" value="<?php echo esc_attr( get_option('hoisting_per_additional_hour_charge') ); ?>" /></td>
            </tr>
            <tr valign="top">
              <th scope="row">Picture Hanging (4 Hours)</th>
              <td><input type="number" name="picture_hannging_four_hours_charge" value="<?php echo esc_attr( get_option('picture_hannging_four_hours_charge') ); ?>" /></td>
            </tr>
            <tr valign="top">
              <th scope="row">Long Carry Charge (per cubic foot)</th>
              <td><input type="number" name="long_carry_per_cuft_charge" value="<?php echo esc_attr( get_option('long_carry_per_cuft_charge') ); ?>" /></td>
            </tr>
            <tr valign="top">
              <th scope="row">Stair Carry Charge (per cubic foot)</th>
              <td><input type="number" name="stair_carry_per_cuft_charge" value="<?php echo esc_attr( get_option('stair_carry_per_cuft_charge') ); ?>" /></td>
            </tr>
            <tr valign="top">
              <th scope="row">Saturday, Sunday, & Holiday Flat Charge</th>
              <td><input type="number" name="saturday_sunday_holiday_charge" value="<?php echo esc_attr( get_option('saturday_sunday_holiday_charge') ); ?>" /></td>
            </tr>
            <tr valign="top">
              <th scope="row">Grand Piano Handling Charge</th>
              <td><input type="number" name="grand_piano_handling_charge" value="<?php echo esc_attr( get_option('grand_piano_handling_charge') ); ?>" /></td>
            </tr>
            <tr valign="top">
              <th scope="row">Upright Piano Handling Charge</th>
              <td><input type="number" name="upright_piano_handling_charge" value="<?php echo esc_attr( get_option('upright_piano_handling_charge') ); ?>" /></td>
            </tr>
            <tr valign="top">
              <th scope="row">No Packing Service Discount (Enter a % discount of total price if no packing service is needed)</th>
              <td><input type="number" name="no_packing_discount_percentage" value="<?php echo esc_attr( get_option('no_packing_discount_percentage') ); ?>" /></td>
            </tr>
            <tr valign="top">
              <th scope="row">No Un-packing Service Discount (Enter a % discount of total price if no Un-packing service is needed)</th>
              <td><input type="number" name="no_unpacking_discount_percentage" value="<?php echo esc_attr( get_option('no_unpacking_discount_percentage') ); ?>" /></td>
            </tr>

          </table>

          <?php submit_button(); ?>

        </form>
      </div>
<?php }


// Below action and tied function will create a widget on the admin dash to show Woocmmerce orders for easy viewing.
add_action( 'wp_dashboard_setup', 'admin_dashboard_order_list_widget' );
function admin_dashboard_order_list_widget() {
	wp_add_dashboard_widget(
		'admin_dash_orders_widget',
		'Booked Moves',
		'admin_dash_orders_widget_display'
	);
}
// Show the "Booked Moves" widget on the dashboard
function admin_dash_orders_widget_display() {
  ?>
  <p>View your move order details here below.</p>

  <?php
      $args = array(
       'limit' => 9999,
       'return' => 'ids',
      );
      $query = new WC_Order_Query( $args );
      echo "<table><tbody>";
      $orders = $query->get_orders();
      foreach( $orders as $order_id ) {
        echo '<tr>';
        echo '<td><a href="'. site_url() . '/move-details/?order='. $order_id .'"</a>View Order #'.$order_id.'</td>';
        echo '</tr>';
      }
      echo '</tbody></table>';
  ?>

<?php
}

// DASHBOARD FOR SAVED RATES
add_action( 'wp_dashboard_setup', 'admin_dashboard_saved_rates_list_widget' );
function admin_dashboard_saved_rates_list_widget() {
	wp_add_dashboard_widget(
		'admin_dash_saved_rates_widget',
		'Saved for Later Rates',
		'admin_dash_saved_rates_widget_display'
	);
}
// Show the "Saved Rates" widget on the dashboard
function admin_dash_saved_rates_widget_display() {
  ?>
  <p>View your Save Rates & details here below.</p>
<?php
          $args = array(
              'numberposts' => -1,
              'post_type' => 'saved_rates',
            );
              // The Query
              $the_query = new WP_Query( $args );
               ?>

                  <?php  // The Loop
                  if ( $the_query->have_posts() ) {
                    echo "<table><tbody>";
                    while ( $the_query->have_posts() ) {
                      $the_query->the_post();
                      $post_id = get_the_ID();
                      $title = get_the_title();
                      echo '<tr>';
                      echo '<td><a target="_blank" href="'. site_url() . '/saved-rate/?rate='. $post_id .'"</a>'.$title.'</td>';
                      echo '</tr>';
                    }
                    echo '</tbody></table>';
                  } else {
                    echo '<p> Currently no saved rates. </p>';
                  }

}
