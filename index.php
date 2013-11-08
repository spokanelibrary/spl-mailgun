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
	$labels = array(
		'name'               => _x( 'Newsletters', 'post type general name' ),
		'singular_name'      => _x( 'Newsletter', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'newsletter' ),
		'add_new_item'       => __( 'Add New Newsletter' ),
		'edit_item'          => __( 'Edit Newsletter' ),
		'new_item'           => __( 'New Newsletter' ),
		'all_items'          => __( 'All Newsletters' ),
		'view_item'          => __( 'View Newsletters' ),
		'search_items'       => __( 'Search Newsletters' ),
		'not_found'          => __( 'No newsletters found' ),
		'not_found_in_trash' => __( 'No newsletters found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Newsletters'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Newsletters',
		'public'        => true,
		'menu_position' => 7,
		'supports'      => array( 'title'
														, 'editor'
														, 'thumbnail'
														//, 'excerpt'
														//, 'comments' 
														),
		'has_archive'   => true,
	);

	register_post_type( 'newsletter', $args );	
}
add_action( 'init', 'spl_mailgun_newsletter' );



?>