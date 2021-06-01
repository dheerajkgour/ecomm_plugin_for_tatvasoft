<?php 
/*
Plugin Name: TS Ecommerce
Plugin URI: https://google.com
Description: Ecommerce Plugin
Version: 1.0
Author: Dheeraj Gour
Author URI: http://google.com
*/

define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require_once( PLUGIN_PATH.'classes/admin.php' );
require_once( PLUGIN_PATH.'classes/frontend.php' );


new Admin_class();
new Frontend_class();



?>