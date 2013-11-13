<?php

class SPL_Mailgun_Newsletter_Settings {

	private $options;

	function __construct() {
		//add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
    //add_action( 'admin_init', array( $this, 'page_init' ) );
	}

	public function add_plugin_page() {
	  add_options_page(
	      'Settings Admin', 
	      'My Settings', 
	      'manage_options', 
	      'spl-mailgun-newsletter-settings', 
	      array( $this, 'create_admin_page' )
	  );
  }

  public function create_admin_page() {
      
  }

} // SPL_Mailgun_Newsletter_Settings

?>