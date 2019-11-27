<?php




function remove_admin_bar() {
  if (!current_user_can('administrator') && !is_admin()) {
    show_admin_bar(false);
  }

  //Begin a session each time word press is initialized
  add_action('init', 'session_manager');
  function session_manager() {
  	if (!session_id()) {
  		session_start();
  	}
  }
  //destroy session each time a log-out occurs
  add_action('wp_logout', 'session_logout');
  function session_logout() {
    session_unset();
  	session_destroy();
  }
  //Capture user meta and save into variable upon log in
  add_filter('authenticate', 'check_login', 10, 3);
  function check_login($user, $username, $password) {
       $user = get_user_by('login', $username);
       $_SESSION['userdata'] = $user;
       return $user;
  }

    // Add the moving company role to the Administrator
    $user_id = 1;
    $user = get_userdata( $user_id );
    if( $user && $user->exists() ) {
      $user->add_role( 'moving_company' );
    }

  // keep users logged in for longer in wordpress
  function wcs_users_logged_in_longer( $expirein ) {
      // 1 week in seconds
      return 604800;
  }
  add_filter( 'auth_cookie_expiration', 'wcs_users_logged_in_longer' );


}
add_action( 'after_setup_theme', 'remove_admin_bar' );


?>



  <?php
}
