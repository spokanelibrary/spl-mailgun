<?php

class SPL_Mailgun_Newsletter_Settings {

	private $config;
	private $options;

	function __construct() {
		add_action( 'admin_menu', array( $this, 'addPluginOptionsPage' ) );
    add_action( 'admin_init', array( $this, 'initPluginOptionsPage' ) );
	}
	
	public function addPluginOptionsPage() {
	  add_options_page(
      'SPL Newsletter Settings' 								// page titlebar
      ,'SPL Newsletter'													// menu label
      ,'manage_options'													// capability
      ,'spl-mailgun-newsletter-settings' 				// menu slug
      ,array( $this, 'getPluginOptionsPage' ) 	// callback
	  );
  }

  public function setPluginOptionsConfig() {
  	$config = new stdClass();

  	$headings = array(
											'spl-mailgun-newsletter-api'=>'Mailgun keys are required.'
									);
  	$config->headings = $headings;

  	$this->config = $config;
  }

  public function getPluginOptionsPage() {
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
  
  public function initPluginOptionsPage() {        
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
  }

  public function getSectionHeading($section) {
    print $this->config->headings[$section['id']];
  }

  public function getSettingsFieldText($args) {
 		printf(
          '<input type="text" 
          				id="'.$args['id'].'" 
          				name="'.$args['option'].'['.$args['id'].']" 
          				value="%s" />'
          ,isset( $this->options[$args['id']] ) ? esc_attr( $this->options[$args['id']]) : ''
    );
  }

  public function sanitizeSettingsField( $input ) {
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