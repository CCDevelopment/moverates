<?php
add_action('init', 'register_roles');
function register_roles(){
  //create the new custom moving company role
  add_role(
      'moving_company',
      __( 'Moving Company' ),
      array(
          'read'         => true,
          'edit_posts'   => true,
      )
  );

  //create the new custom moving customer role
  add_role(
      'moving_customer',
      __( 'Moving Customer' ),
      array(
          'read'         => true,
          'edit_posts'   => true,
      )
  );
  // create the new company employee role
  add_role(
      'moving_company_employee',
      __( 'Moving Company Employee' ),
      array(
          'read'          => true,
          'edit_posts'    => true,
          'publish_posts' => true,
      )
  );
}

// Hide the adminbar from all users except administrators
function my_function_admin_bar($content) {
	return ( current_user_can( 'administrator' ) ) ? $content : false;
}
add_filter( 'show_admin_bar' , 'my_function_admin_bar');

// Redirect to proper dashboard on log-in, hide the admin bar as required.
add_filter('login_redirect','login_redirect_base_on_role');
function login_redirect_base_on_role() {

    global $user;
    $userroles = $user->roles;
    if( in_array('moving_company_employee', $userroles) || in_array('administrator', $userroles)  ){
      return site_url() . '/wp-admin';
    } else {
      return site_url() . '/customer-dashboard';
    }

}
