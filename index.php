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

/*
We're using this metabox toolkit
https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
*/

// make sure the metabox class exists
function spl_mailgun_init_cmb_meta_boxes() {
  if ( !class_exists( 'cmb_Meta_Box' ) ) {
    require_once( plugin_basename('/metabox/init.php') );
  }
}
add_action( 'init', 'spl_mailgun_init_cmb_meta_boxes', 9999 );

// register custom postype (newsletter)
function spl_mailgun_init_newsletter() {
	$labels = array(
		'name'               => _x( 'Newsletters', 'post type general name' ),
		'singular_name'      => _x( 'Newsletter', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'newsletter' ),
		'add_new_item'       => __( 'Add a New Newsletter' ),
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
		'menu_position' => 30,
		'supports'      => array( 'title'
														, 'editor'
														, 'thumbnail'
														//, 'excerpt'
														//, 'comments' 
														),
		'has_archive'   => true,
		'slug'					=> 'newsletters'
	);

	register_post_type( 'newsletter', $args );	
}
add_action( 'init', 'spl_mailgun_init_newsletter' );


function spl_mailgun_newsletter_init_publish() {
	add_meta_box(
		'spl_mailgun_newsletter_list',			// Unique ID
		'Send Newsletter',		// Title
		'spl_mailgun_newsletter_publish_control',		// Callback function
		'newsletter',					// Admin page (or post type)
		'side',					// Context
		'high'					// Priority
	);
}
add_action( 'load-post.php', 'spl_mailgun_newsletter_init_publish' );
add_action( 'load-post-new.php', 'spl_mailgun_newsletter_init_publish' );


function spl_mailgun_newsletter_publish_control($object, $box) {

	wp_nonce_field( basename( __FILE__ ), 'spl_mailgun_newsletter_list_nonce' );

	$list = '
	<p>
		<label for="spl-mailgun-newsletter-list">Choose a mailing list:</label>
		<br />
		<select class="widefat" type="text" name="spl-mailgun-newsletter-list" id="spl-mailgun-newsletter-list">
			<option value="none">None (do not send)</option>
			<option value="dev">Development</option>
			<option value="test">Test Message</option>
			<option value="all">All Subscribers</option>
			<option value="todo">ToDo: Get these from mailgun</option>
		</select>
	</p>
	';
	echo $list;

		submit_button( __( 'Send Now' )
										, 'primary large'
										, 'spl_mailgun_newsletter_send'
										, false
										//, array( 'tabindex' => '5', 'accesskey' => 'p' ) 
										); 
}

function spl_newsletter_metaboxes( $meta_boxes ) {
  $prefix = '_cmb_'; // Prefix for all fields

  $meta_boxes[] = array('id' => 'spl_sidebar_intro'
                      , 'title' => 'Sidebar Intro'
                      , 'pages' => array('newsletter') // post type
                      //, 'show_on' => array( 'key' => 'page-template', 'value' => 'template-newsletter.php' )
                      , 'context' => 'normal'
                      , 'priority' => 'high'
                      , 'show_names' => true // Show field names on the left
                      , 'fields' => array(
                                          array('name' => 'Headline'
                                              , 'desc' => ''
                                              , 'id' => $prefix . 'sidebar_headline'
                                              , 'type' => 'text'
                                          )
                                    )
                  );

  $meta_boxes[] = array('id' => 'spl_sidebar_content'
                      , 'title' => 'Sidebar'
                      , 'pages' => array('newsletter') // post type
                      //, 'show_on' => array( 'key' => 'page-template', 'value' => 'template-newsletter.php' )
                      , 'context' => 'normal'
                      , 'priority' => 'high'
                      , 'show_names' => false // Show field names on the left
                      , 'fields' => array(
                                          array(
																								'name' => 'Test wysiwyg',
																								'desc' => 'field description (optional)',
																								'id' => $prefix . 'test_wysiwyg',
																								'type' => 'wysiwyg',
																								'options' => array(),
																							)
                                    )
                  );

  $fields = array();
  $fields[] = array(
											//'name' => 'Select Posts',
											'desc' => 'Posts are added to the newsletter in the order shown below',
											'type' => 'title',
											'id' => $prefix . 'test_title'
										);
  for ( $i=1; $i<=9; $i++ ) {
  	$fields[] = array('name' => 'Post # ' . $i . ':'
                                              , 'desc' => ''
                                              , 'id' => $prefix . 'newsletter_post_'.$i
                                              , 'type' => 'post_select'
                                              , 'limit' => 20 // limit number of options
                                              , 'post_type' => 'post' // post_type to query for
                                          		, 'category' => 2
                                          );
  }

  $meta_boxes[] = array('id' => 'spl_post_select'
                      , 'title' => 'Add Posts to Newsletter'
                      , 'pages' => array('newsletter') // post type
                      //, 'show_on' => array( 'key' => 'page-template', 'value' => 'template-newsletter.php' )
                      , 'context' => 'normal'
                      , 'priority' => 'high'
                      , 'show_names' => true // Show field names on the left
                      
                      , 'fields' => $fields
                      
                  );

  return $meta_boxes;
}

add_filter( 'cmb_meta_boxes', 'spl_newsletter_metaboxes' );

// render post select
add_action( 'cmb_render_post_select', 'sm_cmb_render_post_select', 10, 2 );

function sm_cmb_render_post_select( $field, $meta ) {
	$post_type = ($field['post_type'] ? $field['post_type'] : 'post');
	$limit = ($field['limit'] ? $field['limit'] : '-1');
	$category = ($field['category'] ? $field['category'] : '');
	echo '<select name="', $field['id'], '" id="', $field['id'], '">';
	// get_posts orders by post_date desc?
	$posts = get_posts('post_type='.$post_type.'&category='.$category.'&numberposts='.$limit.'&posts_per_page='.$limit);
	
	echo '<option value="">None</option>';
	foreach ( $posts as $art ) {
		if ($art->ID == $meta ) {
			echo '<option value="' . $art->ID . '" selected>' . get_the_title($art->ID) . '</option>';
		} else {
			echo '<option value="' . $art->ID . '  ">' . get_the_title($art->ID) . '</option>';
		}
	}
	echo '</select>';
	echo '<p class="cmb_metabox_description">', $field['desc'], '</p>';
}

// the field doesnt really need any validation, but just in case
add_filter( 'cmb_validate_post_select', 'rrh_cmb_validate_post_select' );
function rrh_cmb_validate_post_select( $new ) {
    return $new;
}

?>
