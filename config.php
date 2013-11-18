<?php

class SPL_Mailgun_Newsletter_Config {

	var $custom;
	var $plugin;

	function __construct() {
		$this->custom = $this->getCustomSettings();
		// get settings defined in admin interface
		$this->plugin = get_option( 'spl-mailgun-newsletter' );
	}

	function getCustomSettings() {
		$settings = new stdClass();

		$settings->campaign = 'my-campaign-id';

		return $settings;
	}

}

?>