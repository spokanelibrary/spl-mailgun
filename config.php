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

    // ToDo: slug? ...
    
    $settings->post_type = 'newsletter';

    $sidebar = new stdClass();
    $sidebar->img_width = '180px';

    $settings->sidebar = $sidebar;

    $inliner = new stdClass();
    $inliner->api = 'http://skate.zurb.com/api/v1/';

    $settings->inliner = $inliner;

    $mailgun = new stdClass();
    $mailgun->api = 'https://api.mailgun.net/v2/';
    $mailgun->user = 'api';

    $settings->mailgun = $mailgun;

    return $settings;
  }

}

?>