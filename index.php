<?php

/**
 * @package SPL_Mailgun
 * @version 0.1
 */

/*
Plugin Name: SPL Mailgun
Plugin URI: http://www.spokanelibrary.org/
Description: Hooks a custom post type to a mailgun campaign.
Author: Sean Girard
Author URI: http://seangirard.com
Version: 0.1
*/

function spl_mailgun_newsletter() {
	$args = array();
	register_post_type( 'newsletter', $args );	
}
add_action( 'init', 'spl_mailgun_newsletter' );



?>