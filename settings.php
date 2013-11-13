<?php

class SPL_Mailgun_Newsletter_Settings {

	private $options;

	function __construct() {
		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
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

  public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'my_option_name' );
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>My Settings</h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'my_option_group' );   
                do_settings_sections( 'my-setting-admin' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }

} // SPL_Mailgun_Newsletter_Settings

?>