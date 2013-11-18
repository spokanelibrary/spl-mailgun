<?php

class SPL_Mailgun_Newsletter_Settings {

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
      ,array( $this, 'buildPluginOptionsPage' ) // callback
	  );
  }

  public function buildPluginOptionsPage() {
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
    	'spl-mailgun-newsletter-settings-group' 	// Option group
    , 'spl-mailgun-newsletter' 									// Option name
    ,	array( $this, 'sanitize' ) 								// Sanitize
    );

    add_settings_section(
    	'spl-mailgun-newsletter-api' 							// ID
    ,	'Mailgun Api' 														// Title
    ,	array( $this, 'mailgun_api_section' ) 		// Callback
    ,	'spl-mailgun-newsletter-settings' 				// Page
    );  

    add_settings_field(
      'mailgun-public-key' 											// ID
    ,	'Public Key' 															// Title 
    ,	array( $this, 'settings_field_text' ) 		// Callback
    ,	'spl-mailgun-newsletter-settings' 				// Page
    ,	'spl-mailgun-newsletter-api' 							// Section 
    , array('option'=>'spl-mailgun-newsletter'	// Callback Args
    			,	'id'=>'mailgun-public-key'
    			)          
    );      

    add_settings_field(
    	'mailgun-private-key' 										// ID
    ,	'Private Key' 														// Title
    ,	array( $this, 'settings_field_text' ) 		// Callback
    ,	'spl-mailgun-newsletter-settings' 				// Page
    ,	'spl-mailgun-newsletter-api'							// Section
    , array('option'=>'spl-mailgun-newsletter'	// Callback Args
    			,	'id'=>'mailgun-private-key'
    			) 
    );      
  }

  /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
      /*
        $new_input = array();
        if( isset( $input['id_number'] ) )
            $new_input['id_number'] = absint( $input['id_number'] );

        if( isset( $input['title'] ) )
            $new_input['title'] = sanitize_text_field( $input['title'] );

        return $new_input;
      */
      return $input;
    }

    /** 
     * Print the Section text
     */
    public function mailgun_api_section()
    {
        //print 'Enter your settings below:';
    }

    protected function settings_field_text($args) {
     		printf(
            '<input type="text" id="'.$args['id'].'" name="'.$args['option'].'['.$args['id'].']" value="%s" />',
            isset( $this->options[$args['id']] ) ? esc_attr( $this->options[$args['id']]) : ''
        );
    }



} // SPL_Mailgun_Newsletter_Settings

?>