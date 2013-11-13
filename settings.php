<?php

class SPL_Mailgun_Newsletter_Settings {

	public $options;

	function __construct() {
		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
    //add_action( 'admin_init', array( $this, 'page_init' ) );
	}
	
	public function add_plugin_page() {
	  add_options_page(
	      'SPL Newsletter Settings', 
	      'SPL Newsletter', 
	      'manage_options', 
	      'spl-mailgun-newsletter-settings', 
	      array( $this, 'create_admin_page' )
	  );
  }

  public function create_admin_page() {
  	$this->options = get_option( 'my_option_name' );
    echo '<div class="wrap">';
    screen_icon();
    echo '<h2>My Settings</h2>';        
    echo '<form method="post" action="options.php">';
    // hidden setting fields
    settings_fields( 'my_option_group' );   
    do_settings_sections( 'my-setting-admin' );
    submit_button();         
    echo '</form>';
    echo '</div>';    
  }
  
} // SPL_Mailgun_Newsletter_Settings

?>