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
    
    $settings->post_type = 'newsletter'; // used?

    $sidebar = new stdClass();
    $sidebar->img_width = '178px'; // this is barely used

    $settings->sidebar = $sidebar;

    $inliner = new stdClass();
    $inliner->api = 'http://skate.zurb.com/api/v1/';

    $settings->inliner = $inliner;

    $mailgun = new stdClass();
    $mailgun->api = 'https://api.mailgun.net/v2/';
    $mailgun->user = 'api';

    $settings->mailgun = $mailgun;

    $widgets = new stdClass();
    // load jquery.validate.js?
    $widgets->validateJS = true;
    // widget slugs
    $widgets->subscribe = 'subscribe';
    $widgets->unsubscribe = 'unsubscribe';

    $settings->widgets = $widgets;

    return $settings;
  }

}

?>