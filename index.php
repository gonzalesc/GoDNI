<?php
/*
Plugin Name: Go DNI
Version: 1.0
Author URI: http://www.gopymes.pe/
Plugin URI: http://blog.gopymes.pe/plugins/validar-dni-peruano/
Description: This plugin is a validator of peruvian DNI. NOTE: this one only validates the structure.
Author: Alexander Gonz&aacute;les
*/
?>
<?php
// Insert pluggable.php before calling get_currentuserinfo()
//require (ABSPATH . WPINC . '/pluggable.php');
require_once WP_PLUGIN_DIR.'/GoDNI/godni.class.php';

/*	Class	*/
$godni = new godni();

/*	Active the plugin	*/
add_action('activate_GoDNI/index.php',array(&$godni,'active'));
//add_action('wp_head', array(&$godni,'add_header'));

/*	Can edit at admin panel	*/
if (is_admin()) {
	add_action('admin_menu', array(&$godni,'add_menu'));
	
	$plugin = plugin_basename( __FILE__ );
	add_filter( "plugin_action_links_$plugin", array(&$godni,'add_settings_link' ));
}

/**************************
	FORM REGISTER
***************************/
if(get_option('godni_register')) {
	add_action('register_form',array(&$godni,'set_register_form'), 5);
	add_action('register_post',array(&$godni,'error_register_form'),10,3);
	add_action('user_register', array(&$godni,'save_register_form'));
}

/**************************
	FORM PROFILE
***************************/
if(get_option('godni_profile')) {
	/*	When edit a user profile	*/
	//add_action('show_user_profile', array(&$godni,'set_profile_form'));
	//add_action('edit_user_profile', array(&$godni,'set_profile_form'));
	add_action('profile_personal_options', array(&$godni,'set_profile_form'));
	
	/*	Errors	*/
	add_filter('user_profile_update_errors', array(&$godni,'error_profile_form'),10,3);
	
	/*	When save a user profile	*/
	//add_action('personal_options_update', array(&$godni,'save_profile_form'));
	//add_action('edit_user_profile_update', array(&$godni,'save_profile_form'));
}

/********************************
	COLUMN LIST USER
*********************************/
if(get_option('godni_column')) {
	add_filter('manage_users_columns', array(&$godni,'add_column_listusers'));
	add_action('manage_users_custom_column',  array(&$godni,'add_value_listusers'), 10, 3);
}

?>