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

require('config.php');
require('settings.php');
require('functions.php');

$config = new SPL_Mailgun_Newsletter_Config();
$newsletter = new SPL_Mailgun_Newsletter($config);

if ( is_admin() ) {
	$admin = new SPL_Mailgun_Newsletter_Settings();
}

class SPL_Mailgun_Newsletter {

	var $config;

	function __construct($config=null) {
		if ( !is_null($config) 
					&& isset($config->plugin['mailgun-public-key']) 
					&& isset($config->plugin['mailgun-private-key']) ) {
			$this->config = $config;
			$this->initNewsletter();
		}
	}

	function initNewsletter() {
		$this->registerPostTemplates();

		add_action( 'init', array( $this, 'registerPostType' ) );
		add_action( 'init', array($this, 'initCmbMetaBoxes'), 9999 );

		add_filter( 'template_include', array($this, 'registerPostTemplates'));
		add_filter( 'cmb_meta_boxes', array($this, 'getNewsletterCmbMetaBoxes') );
		
	} // initNewsletter()

	function registerPostTemplates($template) {
		$post_types = array( 'newsletter' );
		/*
    if ( is_post_type_archive( $post_types ) 
    	&& ! file_exists( get_stylesheet_directory() . '/archive-newsletter.php' ) ) {
      $template = plugin_dir_path(__FILE__) . 'templates/archive-newsletter.php';
    }
    */
    if ( is_singular( $post_types )
    	&& ! file_exists( get_stylesheet_directory() . '/single-newsletter.php' ) ) {
      $template = plugin_dir_path(__FILE__) . 'templates/single-newsletter.php';
    }
    
    return $template;
	} // registerPostTemplates()
	
	function registerPostType() {
		$args = array(
			'labels'        => $this->getPostTypeLabels()
		,	'description'   => 'Newsletters'
		,	'public'        => true
		,	'menu_position' => 30
		,	'supports'      => array( 'title'
															, 'editor'
															, 'thumbnail'
															//, 'excerpt'
															//, 'comments' 
															)
		,	'has_archive'   => true
		,	'slug'					=> 'newsletters'
		,	'register_meta_box_cb' => array($this, 'initPublishControls')
		);

		register_post_type( 'newsletter', $args );	
	} // registerPostType()

	function getPostTypeLabels() {
		$labels = array(
			'name'               => _x( 'Newsletters', 'post type general name' )
		,	'singular_name'      => _x( 'Newsletter', 'post type singular name' )
		,	'add_new'            => _x( 'Add New', 'newsletter' )
		,	'add_new_item'       => __( 'Add a New Newsletter' )
		,	'edit_item'          => __( 'Edit Newsletter' )
		,	'new_item'           => __( 'New Newsletter' )
		,	'all_items'          => __( 'All Newsletters' )
		,	'view_item'          => __( 'View Newsletters' )
		,	'search_items'       => __( 'Search Newsletters' )
		,	'not_found'          => __( 'No newsletters found' )
		,	'not_found_in_trash' => __( 'No newsletters found in the Trash' )
		,	'parent_item_colon'  => ''
		,	'menu_name'          => 'Newsletters'
		);

		return $labels;
	} // getPostTypeLabels()

	function initPublishControls() {
		add_meta_box(
			'spl_mailgun_newsletter_publish_controls'	// Unique ID
		,	'Send Newsletter'													// Title
		,	array($this, 'getPublishConrols')					// Callback function
		,	'newsletter'															// Admin page (or post type)
		, 'side'																		// Context
		, 'default'																	// Priority
		);
	} // initPublishControls()

	function getPublishConrols() {
		//print_r( $this->config );
		$params = array('address'=>'sgirard@spokanelibrary.org');
		$domain = 'spokanelibrary.mailgun.org';
		$api = 'https://api.mailgun.net/v2/';
		$auth = array('user'=>'api', 'pass'=>$this->config->plugin['mailgun-public-key']);

		print_r($this->jsonCurl($api.'address/validate', $params, 'get', $auth));

		wp_nonce_field( basename( __FILE__ ), 'spl_mailgun_newsletter_send_nonce' );

		$tmpl = '
		<p>
			<label for="spl-mailgun-newsletter-tempate">Choose a template:</label>
			<br />
			<select class="widefat" name="spl-mailgun-newsletter-template" id="spl-mailgun-newsletter-template">
				<option value="none" selected>Default</option>
				<option value="todo">ToDo: Get these from directory scan</option>
			</select>
		</p>
		';
		echo $tmpl;

		$list = '
		<p>
			<label for="spl-mailgun-newsletter-list">Choose a mailing list:</label>
			<br />
			<select class="widefat" name="spl-mailgun-newsletter-list" id="spl-mailgun-newsletter-list">
				<option value="none" selected>None</option>
				<option value="eva">Just Eva!</option>
				<option value="dev">Dev (sg)</option>
				<option value="test">Test Group</option>
				<option value="all">All Subscribers</option>
				<option value="todo">ToDo: Get these from mailgun</option>
			</select>
		</p>
		';
		echo $list;

		$email = '
		<p>
			<label for="spl-mailgun-newsletter-address">CC this address:</label>
			<br />
			<input class="widefat" type="text" name="spl-mailgun-newsletter-address" id="spl-mailgun-newsletter-address" />
		</p>
		';
		echo $email;

		echo '
		<p>
		<input type="checkbox" name="spl-mailgun-newsletter-confirm" id="spl-mailgun-newsletter-confirm" />
		<label for="spl-mailgun-newsletter-confirm"><strong>Let\'s do this.</strong></label>
		';

		submit_button( __( 'Send Now' )
										, 'primary large'
										, 'spl_mailgun_newsletter_send'
										, false
										,array('style'=>'float:right;')
										//, array( 'tabindex' => '10', 'accesskey' => 's' ) 
										); 
		echo '
		</p>
		<div class="clear"></div>
		';

		$note = '
		<p>
			<strong>Reminder:</strong>
			Save newsletter <em>before</em> sending!
		</p>
		';
		//echo $note;

	} // getPublishConrols()

	function getNewsletterCmbMetaBoxes( $meta_boxes ) {
	  $prefix = '_spl_mailgun_newsletter_'; // Prefix for all fields

	  $meta_boxes[] = array('id' => $prefix . 'sidebar_headline_id'
	                      , 'title' => 'Sidebar Headline'
	                      , 'pages' => array('newsletter') // post type
	                      //, 'show_on' => array()
	                      , 'context' => 'normal'
	                      , 'priority' => 'high'
	                      , 'show_names' => false
	                      , 'fields' => array(
	                                          array('name' => 'Headline'
	                                              , 'desc' => 'optional'
	                                              , 'id' => $prefix . 'sidebar_headline'
	                                              , 'type' => 'text'
	                                          )
	                                    )
	                  );

	  $meta_boxes[] = array('id' => $prefix . 'sidebar_content_id'
	                      , 'title' => 'Sidebar Content'
	                      , 'pages' => array('newsletter') // post type
	                      //, 'show_on' => array()
	                      , 'context' => 'normal'
	                      , 'priority' => 'high'
	                      , 'show_names' => false
	                      , 'fields' => array(
	                                          array(
																									'name' => 'Sidebar',
																									'desc' => 'optional',
																									'id' => $prefix . 'sidebar_content',
																									'type' => 'wysiwyg',
																									'options' => array()
																								)
	                                    )
	                  );

	  $fields = array();
	  $fields[] = array(
												//'name' => 'Select Posts',
												'desc' => 'Posts are added to the newsletter in the order shown below.',
												'type' => 'title',
												'id' => $prefix . 'post_select_title'
											);
	  for ( $i=1; $i<=9; $i++ ) {
	  	$fields[] = array('name' => 'Post # ' . $i . ':'
                      , 'desc' => ''
                      , 'id' => $prefix . 'post_select_'.$i
                      , 'type' => 'post_select'
                      , 'limit' => 20 // limit number of options (posts)
                      , 'post_type' => 'post' // post_type to query for
                  		, 'category' => 5
	                    );
	  	$fields[] = array('name' => '',
												'desc' => 'Excerpt Only?',
												'id' => $prefix . 'post_select_excerpt_'.$i,
												'type' => 'checkbox',
											);
	  }

	  $meta_boxes[] = array('id' => $prefix . 'post_select_id'
	                      , 'title' => 'Add Posts to Newsletter'
	                      , 'pages' => array('newsletter') // post type
	                      //, 'show_on' => array()
	                      , 'context' => 'normal'
	                      , 'priority' => 'high'
	                      , 'show_names' => true  
	                      
	                      , 'fields' => $fields
	                      
	                  );

	  return $meta_boxes;
	} // getNewsletterCmbMetaBoxes()

	function initCmbMetaBoxes() {
		//https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
		if ( !class_exists( 'cmb_Meta_Box' ) ) {
	    require_once( plugin_basename('/lib/metabox/init.php') );
	  }
	  // https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress/wiki/Adding-your-own-field-types
	  add_action( 'cmb_render_post_select', array($this, 'renderPostSelect'), 10, 2 );
	  add_filter( 'cmb_validate_post_select', array($this, 'validatePostSelect') );
	} // initCmbMetaBoxes()

	function renderPostSelect( $field, $meta ) {
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
	} // renderPostSelect()
	
	function validatePostSelect( $new ) {
	  // stub
	  return $new;
	} // validatePostSelect()

	function jsonCurl($url, $params, $method='post', $auth=null) {
		//return $this->curlProxy($url, $params, $method, $auth);
    return json_decode($this->curlProxy($url, $params, $method, $auth), true);
  }

  function curlProxy($url, $params, $method='post', $auth=null) {
    // create a new cURL resource
    $ch = curl_init();
 		
 		if ( 'post' == $method ) {
 			// setup for an http post
    	curl_setopt($ch, CURLOPT_POST, 1);
    	// 'cause cURL doesn't like multi-dimensional arrays
  	  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
 		} elseif ( 'get' == $method ) {
    	$url .= '?' . http_build_query($params);
  	}

    // set URL and other appropriate options
    curl_setopt($ch, CURLOPT_URL, $url);
    //curl_setopt($ch, CURLOPT_HEADER, false);

    // follow redirects
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    // set auth params
    if ( is_array($auth) ) {
    	//curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);  
    	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    	curl_setopt($ch, CURLOPT_USERPWD, $auth['user'] . ':' . $auth['pass']);
    }

    // set returntransfer to true to prevent browser echo
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
    $ua = $_SERVER['HTTP_USER_AGENT']; // optional
    if (isset($ua)) {
        curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    }
 
    // grab URL
    $result = curl_exec($ch);
 
    // close cURL resource, and free up system resources
    curl_close($ch);
    
    return $result;
  }

} // SPL_Mailgun_Newsletter

?>
