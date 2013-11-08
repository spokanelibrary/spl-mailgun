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

add_action( 'load-post.php', 'spl_mailgun_newsletter_meta_boxes_setup' );
add_action( 'load-post-new.php', 'spl_mailgun_newsletter_meta_boxes_setup' );

function spl_mailgun_newsletter_meta_boxes_setup() {
	add_meta_box(
		'spl_mailgun_newsletter_list',			// Unique ID
		esc_html__( 'Newsletter List', 'list' ),		// Title
		'spl_mailgun_newsletter_list_meta_box',		// Callback function
		'newsletter',					// Admin page (or post type)
		'side',					// Context
		'default'					// Priority
	);
}

function spl_mailgun_newsletter_list_meta_box($object, $box) {

	echo 'this is a test';

}

/*
function spl_mailgun_newsletter_box() {
    add_meta_box( 
        'spl_mailgun_newsletter_box',
        __( 'Newsletter Info', 'spl_mailgun_newsletter_box_display' ),
        'spl_mailgun_newsletter_box_box_content',
        'newsletter',
        'side',
        'high'
    );
}
add_action( 'add_meta_boxes', 'spl_mailgun_newsletter_box' );
*/

?>