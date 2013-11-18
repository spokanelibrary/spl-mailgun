<?php

class SPL_Mailgun_Newsletter_Config {

	var $settings;

	var $campaign = 'my-campaign-id';

	function __construct() {
		$this->settings = get_option( 'spl-mailgun-newsletter' );
	}

}

?>