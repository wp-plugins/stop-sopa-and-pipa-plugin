<?php 
/*
Plugin Name: Stop SOPA and PIPA Plugin
Plugin Uri:  http://anseocompany.com.au/
Description: an <a href="http://anseocompany.com.au/">SEO Company</a> developed this plugin which will schedule a temporary redirect for all your incoming Wordpress blog traffic to the official Stop SOPA page, where people can cast their vote- Congress is about to pass internet censorship, even though the vast majority of Americans are opposed. We need to kill the bill - PIPA in the Senate and SOPA in the House - to protect our rights to free speech, privacy, and prosperity.
*/
date_default_timezone_set(get_option('gmt_offset'));
$gmtOffset=get_option('gmt_offset');
define('REDIRECT_URL',WP_PLUGIN_URL.'/StopSOPAandPIPAplugin');

define ('REDIRECT_DIR',WP_PLUGIN_DIR.'/StopSOPAandPIPAplugin');

add_action('init','my_redirect_url');
add_action('admin_menu','add_admin_menu');
add_action( 'admin_print_scripts','my_print_script');
add_action ( 'admin_print_styles','my_print_styles');
include('functions.php'); 
?>