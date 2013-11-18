<?php

class SPL_Mailgun_Newsletter_Settings {

	private $config;
	private $options;

	function __construct() {
		add_action( 'admin_menu', array( $this, 'addPluginOptionsPage' ) );
    add_action( 'admin_init', array( $this, 'initPluginOptionsPage' ) );
	}
	
	function addPluginOptionsPage() {
	  add_options_page(
      'SPL Newsletter Settings' 								// page titlebar
    ,	'SPL Newsletter'													// menu label
    ,	'manage_options'													// capability
    ,	'spl-mailgun-newsletter-settings' 				// menu slug
    ,	array( $this, 'getPluginOptionsPage' ) 		// callback
	  );
  }

  function setPluginOptionsConfig() {
  	$config = new stdClass();

  	$headings = array(
											'spl-mailgun-newsletter-api' => 'Mailgun keys are required.'
										,	'spl-mailgun-newsletter-display' => 'Additional display options:'	
								);
  	$config->headings = $headings;

  	$this->config = $config;
  }

  function getPluginOptionsPage() {
  	$this->setPluginOptionsConfig();

  	$this->options = get_option( 'spl-mailgun-newsletter' );
  	//print_r($this->options);

    echo '<div class="wrap">';
    screen_icon();
    echo '<h2>SPL Newsletter Settings</h2>';        
    echo '<form method="post" action="options.php">';
    // hidden setting fields
    settings_fields( 'spl-mailgun-newsletter-settings-group' );   
    // user settings fields
    do_settings_sections( 'spl-mailgun-newsletter-settings' );
    submit_button();         
    echo '</form>';
    echo '</div>';    
  }
  
  function initPluginOptionsPage() {        
    register_setting(
    	'spl-mailgun-newsletter-settings-group' 	// option group
    , 'spl-mailgun-newsletter' 									// option name
    ,	array( $this, 'sanitizeSettingsField' ) 	// sanitize callback
    );

    add_settings_section(
    	'spl-mailgun-newsletter-api' 							// id
    ,	'Mailgun Api' 														// title
    ,	array( $this, 'getSectionHeading' )		 		// callback
    ,	'spl-mailgun-newsletter-settings' 				// page
    );  

    add_settings_field(
      'mailgun-public-key' 											// id
    ,	'Public Key' 															// title 
    ,	array( $this, 'getSettingsFieldText' ) 		// callback
    ,	'spl-mailgun-newsletter-settings' 				// page
    ,	'spl-mailgun-newsletter-api' 							// section 
    , array('option'=>'spl-mailgun-newsletter'	// callback args
    			,	'id'=>'mailgun-public-key'
    			)          
    );      

    add_settings_field(
    	'mailgun-private-key' 										// id
    ,	'Private Key' 														// title
    ,	array( $this, 'getSettingsFieldText' ) 		// callback
    ,	'spl-mailgun-newsletter-settings' 				// page
    ,	'spl-mailgun-newsletter-api'							// section
    , array('option'=>'spl-mailgun-newsletter'	// callback args
    			,	'id'=>'mailgun-private-key'
    			) 
    );   

    add_settings_field(
    	'mailgun-domain' 													// id
    ,	'Domain' 																	// title
    ,	array( $this, 'getSettingsFieldText' ) 		// callback
    ,	'spl-mailgun-newsletter-settings' 				// page
    ,	'spl-mailgun-newsletter-api'							// section
    , array('option'=>'spl-mailgun-newsletter'	// callback args
    			,	'id'=>'mailgun-domain'
    			) 
    ); 

    add_settings_section(
    	'spl-mailgun-newsletter-display' 					// id
    ,	'Display Options' 												// title
    ,	array( $this, 'getSectionHeading' )		 		// callback
    ,	'spl-mailgun-newsletter-settings' 				// page
    );   

    add_settings_field(
    	'post-category-filter' 										// id
    ,	'Post Category Filter (empty for none)' 	// title
    ,	array( $this, 'getSettingsFieldText' ) 		// callback
    ,	'spl-mailgun-newsletter-settings' 				// page
    ,	'spl-mailgun-newsletter-display'					// section
    , array('option'=>'spl-mailgun-newsletter'	// callback args
    			,	'id'=>'post-category-filter'
    			) 
    );   
  }

  function getSectionHeading($section) {
    print $this->config->headings[$section['id']];
  }

  function getSettingsFieldText($args) {
 		printf(
          '<input type="text" 
          				class="widefat"
          				id="'.$args['id'].'" 
          				name="'.$args['option'].'['.$args['id'].']" 
          				value="%s" />'
        ,	isset( $this->options[$args['id']] ) ? esc_attr( $this->options[$args['id']]) : ''
    );
  }

  function sanitizeSettingsField( $input ) {
    if ( is_array($input) ) {
    	$sanitized = array();
    	foreach ( $input as $k => $v ) {
    		$sanitized[$k] = sanitize_text_field($v);
    	}
    	return $sanitized;
    } else {
    	return $input;
    }
  }

} // SPL_Mailgun_Newsletter_Settings

?>