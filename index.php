<?php

/**
 * @package SPL_Mailgun
 * @version 0.1
 */

/*
Plugin Name: SPL Mailgun
Plugin URI: http://www.spokanelibrary.org/
Description: Hooks a custom post type to a mailgun campaign.
Author: Sean Girard
Author URI: http://seangirard.com
Version: 0.1
*/

require('config.php');
require('settings.php');
//require('functions.php');

$config = new SPL_Mailgun_Newsletter_Config();
$newsletter = new SPL_Mailgun_Newsletter($config);

if ( is_admin() ) {
  $admin = new SPL_Mailgun_Newsletter_Settings();
}

class SPL_Mailgun_Newsletter {

  var $config;

  function __construct($config=null) {
    
    // can't get this working.
    // for now just hit permalinks page
    //register_activation_hook( __FILE__, array( 'SPL_Mailgun_Newsletter', 'activateNewsletter' ) );

    if ( !is_null($config) 
          && isset($config->plugin['mailgun-public-key']) 
          && isset($config->plugin['mailgun-private-key']) ) {
      $this->config = $config;
      $this->initNewsletter();
    }

    add_shortcode('spl_mailgun_subscribe', array($this, 'widgetSubscribe'));
    add_shortcode('spl_mailgun_unsubscribe', array($this, 'widgetUnsubscribe'));
    add_shortcode('spl_mailgun_current', array($this, 'widgetCurrentLink'));
  }

  function loadWidgetJS() {
    // note: jquery.validate.js included by default
    // see switch in config.php to disable
    if ( $this->config->custom->widgets->validateJS ) {
      wp_enqueue_script( 'jquery-validate', plugins_url( 'js/jquery.validate.js', __FILE__ ), false, null );
    }
    wp_enqueue_script( 'spl-mailgun', plugins_url( 'js/spl-mailgun.js', __FILE__ ), false, null );    
  }

  function throwWidgetError($error) {
    $html = null;
    $html .= '<div class="alert alert-danger">';
    $html .= '<strong>Whoops:</strong>';
    $html .= '<br>';
    $html .= $error;
    $html .= '</div>';

    return $html;
  }

  function getWidgetSlugs($params) {
    // see config.php for slug defs (default: /subscribe + /unsubscribe)
    $slug = new stdClass();
    $slug->subscribe = home_url('/');
    $slug->unsubscribe = home_url('/');
    if ( isset($params['slug']) ) {
      $slug->subscribe = home_url('/'.$params['slug'].'/');
      $slug->unsubscribe = home_url('/'.$params['slug'].'/');
    }
    $slug->subscribe .= $this->config->custom->widgets->subscribe.'/';
    $slug->unsubscribe .= $this->config->custom->widgets->unsubscribe.'/';

    return $slug;
  }

  function loadWidgetFile($file, $vars=null) {
    $slug = $this->getWidgetSlugs($vars->params);

    $widget = null;
    $template = plugin_dir_path(__FILE__).'widgets/'.$file;
    if ( file_exists($template) ) {
      ob_start();
      include($template);
      $widget = ob_get_contents();
      ob_end_clean();
    }
    //$widget .= '<pre>'.print_r($vars, true).'</pre>';
    return $widget;
  }

  function widgetCurrentLink( $params ) {

    //$this->loadWidgetJS();

    $html = null;
    $q = new WP_Query( 'post_type=newsletter&post_status=publish&posts_per_page=1' );
    //return '<pre>'.print_r($q->post, true).'</pre>';
    
    if ( isset($params['title']) && !empty($params['title']) ) {
      $title = $params['title'];
    } else{
      $title = $q->post->post_title;
    }

    $link = '<a class="'.$params['class'].'" href="'.get_permalink($q->post->ID).'" title="'.$title.'">'.$title.'</a>';
    
    $posts = array();
    for ( $i=1; $i<= 12; $i++ ) {
      $select = SPL_Mailgun_Newsletter::getPostSelect($q->post->ID, $i);
      if ( !empty($select) ) {
        $posts[$i] = $select;
      }
    }

    switch ( $params['format'] ) {
      case 'subtitle':
        $subtitle = get_post_meta($q->post->ID
                  ,'_spl_mailgun_newsletter_subtitle'
                  ,true 
                  );
        if ( empty($subtitle) ) {
          $subtitle = $params['default_subtitle'];
        }
        return $subtitle;
        break;
      case 'toc':
        //$html .= '<span class="text-muted">';
        //$html .= mysql2date( 'F, Y', $q->post->post_date );
        //$html .= '</span>';

        if ( in_array('subtitle', $params) ) {
          $subtitle = get_post_meta($q->post->ID
                  ,'_spl_mailgun_newsletter_subtitle'
                  ,true 
                  );
          if ( !empty($subtitle) ) {
            $html .= '<h5 class="text-muted text-right" style="padding:0;">';
            $html .= $subtitle;
            $html .= '</h5>';
          }
        }
        
        $html .= '<h2>';
        $html .= $link;
        $html .= '</h2>';

        if ( in_array('excerpt', $params) ) {
          //setup_postdata( $q->post );
          if ($q->post->post_excerpt) {
              // excerpt set, return it
              $excerpt = apply_filters('the_excerpt', $q->post->post_excerpt);

          } else {
              setup_postdata( $q->post );
              $excerpt = get_the_excerpt();
              wp_reset_postdata();
          }

          //if ( has_post_thumbnail() ) { 
            $img = wp_get_attachment_image_src(get_post_thumbnail_id($q->post->ID), 'medium');
            $img_src = $img[0];
          //}
          //wp_reset_postdata();

          if ( $img_src ) {
            $html .= '<div class="row">';
            $html .= '<div class="col-sm-4">';
            $html .= '<a href="'.get_permalink($q->post->ID).'" title="'.$title.'">';
            $html .= '<img class="img-responsive img-rounded" style="max-height:200px;" src="'.$img_src.'">';
            $html .= '</a>';
            $html .= '</div>';
            $html .= '<div class="col-sm-8">';
            $html .= '<p>';
            $html .= $excerpt;
            $html .= '</p>';
            $html .= '</div>';
            $html .= '</div>';
          } else {
            $html .= '<p>';
            $html .= $excerpt;
            $html .= '</p>';
          }


          
        }

        if ( !empty($posts) ) {
          $html .= '<div class="row">';
          $html .= '<div class="col col-sm-11 col-sm-offset-1">';
          $html .= '<h3 class="normal">';
          $html .= 'also in this issue:';
          $html .= '</h3>';

          if ( isset($params['link_posts']) ) {
            $html .= '<ul class="">';
            foreach ( $posts as $post ) {
              $html .= '<li><b><a href="'.$post->link.'">'.$post->title.'</a></b></li>';
            }
            $html .= '</ul>';
          } else {
            $html .= '<ul class="">';
            foreach ( $posts as $post ) {
              $html .= '<li>';
              $html .= '<b>'.$post->title.'</b>';
              $html .= '</li>';
            }
            $html .= '</ul>';
          }
          if ( isset($params['link_button']) ) {
            $html .= '<a class="btn btn-large btn-success" href="'.get_the_permalink().'">Read this issue of Library News &rarr;</a>';
          }
          $html .= '</div>';
          $html .= '</div>';
        }
        break;
      default:
        $html = $link;
        break;
    }
    
    return $html;
  }

  function widgetSubscribe($params) {
    // allow request to override widget default list
    $list = $params['list'];
    if ( isset($_REQUEST['list']) && !empty($_REQUEST['list']) ) {
      $list = $_REQUEST['list'];
    }
    if ( isset($_REQUEST['spl-subscribe']['list']) && !empty($_REQUEST['spl-subscribe']['list']) ) {
      $list = $_REQUEST['spl-subscribe']['list'];
    }
    // without a list this widget is pretty pointless
    if ( !isset($list) ) {
      return $this->throwWidgetError('No list specified.  ');
    }

    
    $this->loadWidgetJS();
    
    $vars = new stdClass();
    $vars->params = $params;
    $tmpl = 'subscribe.php';
    if ( !empty($_REQUEST['spl-subscribe']) ) {
      $tmpl = 'subscribe-response.php';
      $name = trim($_REQUEST['spl-subscribe']['name']['first'].' '.$_REQUEST['spl-subscribe']['name']['last']);
      $vars->result = $this->subscribeEmailAddress($_REQUEST['spl-subscribe']['email'], $list, $name, $_REQUEST['spl-subscribe']['vars']);
    }
    $subscribe = $this->loadWidgetFile($tmpl, $vars);
    
    return $subscribe;
  }

  function widgetUnsubscribe($params) {
    // allow request to override widget default list
    $list = $params['list'];
    if ( isset($_REQUEST['list']) && !empty($_REQUEST['list']) ) {
      $list = $_REQUEST['list'];
    }
    if ( isset($_REQUEST['spl-unsubscribe']['list']) && !empty($_REQUEST['spl-unsubscribe']['list']) ) {
      $list = $_REQUEST['spl-unsubscribe']['list'];
    }
    // without a list this widget is pretty pointless
    if ( !isset($list) ) {
      return $this->throwWidgetError('No list specified.  ');
    }

    $this->loadWidgetJS();

    $vars = new stdClass();
    $vars->params = $params;
    $vars->request = $_REQUEST;
    $tmpl = 'unsubscribe.php';
    if ( !empty($_REQUEST['spl-unsubscribe']) ) {
      $tmpl = 'unsubscribe-response.php';
      if ( $_REQUEST['spl-unsubscribe']['delete'] ) {
        $vars->result = $this->deleteEmailAddress($_REQUEST['spl-unsubscribe']['email'], $list);
      } else {
        if ( stristr(urldecode($list), '@') ) {
          // unsubscribe from list
          $vars->result =  $this->unsubscribeEmailAddress($_REQUEST['spl-unsubscribe']['email'], $list);
        } else {
          // unsubscribe from domain
          $vars->result =  $this->unsubscribeEmailAddressGlobal($_REQUEST['spl-unsubscribe']['email'], $list);
        }
      }
    }
    $subscribe = $this->loadWidgetFile($tmpl, $vars);
    
    return $subscribe;
  }

  function subscribeEmailAddress($address, $list, $name=null, $vars=null) {
    
    $subscribe = $this->addAddressToMailingList($address, $list, true, $name, $vars);
    if ( 200 == $subscribe->result->httpcode ) {
      return $subscribe;
    } else {
      // try to resubscribe an unsubscribed user
      return $this->updateEmailAddress($address, $list, true, $name, $vars);
    }
  }

  function updateEmailAddress($address, $list, $subscribed=true, $name=null, $vars=null) {
    return $this->updateAddressOnMailingList($address, $list, $subscribed, $name, $vars);
  }

  function unsubscribeEmailAddress($address, $list) {
    return $this->updateAddressOnMailingList($address, $list, false);
  }

  function unsubscribeEmailAddressGlobal($address, $domain) {
    return $this->unsubscribeAddressFromDomain($address, $domain);
  }

  function deleteEmailAddress($address, $list) {
    return $this->removeAddressFromMailingList($address, $list);
  }

  // WARNING: this doesn't actually work, yet!
  static function activateNewsletter() {
    // false does not attempt to overwrite .htaccess
    flush_rewrite_rules(false);
  }


  static function getPostSelectFormattedSidebar($select) {
    
    $html = '';
    if ( !empty($select) ) {
      $html .= '<aside class="aside">';
      //$html .= '<p class="lead text-primary">';
      $html .= '<h3>';
      if ( $select->excerpt ) {
        $html .= '<a href="'.$select->link.'">';
      }
      $html .= $select->title;
      if ( $select->excerpt ) {
        $html .= '</a>';
      }
      $html .= '</h3>';
      //$html .= '</p>';

      if ( $select->excerpt && isset($select->thumbnail) ) {
        $html .= $select->thumbnail;
      }
      // clearfix since we might have a floated featured image
      $html .= '<div class="clearfix" style="margin-bottom:0px;">';
      $html .= $select->content;
      $html .= '</div>';
      
      if ( $select->excerpt ) {
        $html .= '<p>
                    <a href="'.$select->link.'"
                      class="btn btn-block btn-default">
                      <span class="text-primary">More &rarr;</span>
                    </a>
                  </p>
                  <!-- <hr> -->';
      } else {
        $html .= '';
      }

      /*
      $html .= '<p class="lead text-center text-muted">
                  &hellip;
                  <i class="glyphicon glyphicon-leaf" style="padding: 0 8px 0 12px;"></i>
                  &hellip;
                </p>';
      */
      $html .= '</aside>';
      
    }

    return $html;
  } 

  static function getPostSelectFormatted($select) {
    
    $html = '';
    if ( !empty($select) ) {
      //$html .= '<p class="lead texf-primary">';
      $html .= '<h3 class="">';
      if ( $select->excerpt ) {
        $html .= '<a href="'.$select->link.'">';
      }
      $html .= $select->title;
      if ( $select->excerpt ) {
        $html .= '</a>';
      }
      $html .= '</h3>';
      //$html .= '</p>';

      if ( $select->excerpt && isset($select->thumbnail) ) {
        $html .= $select->thumbnail;
      }
      // clearfix since we might have a floated featured image
      $html .= '<div class="clearfix" style="margin-bottom:6px;">';
      $html .= $select->content;
      $html .= '</div>';
      
      if ( $select->excerpt ) {
        $html .= '<p>
                    <a href="'.$select->link.'"
                      class="btn btn-block btn-default">
                      <span class="text-primary">Continue Reading &rarr;</span>
                    </a>
                  </p>
                  <!-- <hr> -->';
      } else {
        $html .= '';
      }

      /*
      $html .= '<p class="lead text-center text-muted">
                  &hellip;
                  <i class="glyphicon glyphicon-leaf" style="padding: 0 8px 0 12px;"></i>
                  &hellip;
                </p>';
      */

      
    }

    return $html;
  }

  static function getNewsletterMetadata($post) {
    $meta = false;

    if ( isset($post->ID) ) {
      $meta = new stdClass();
      $meta->id = $post->ID;

      $sidebar = array();
      $headline = get_post_meta($post->ID
                  ,'_spl_mailgun_newsletter_sidebar_headline'
                  ,true 
                  );
      if ( !empty($headline) ) {
        $sidebar['headline'] = $headline;
      }
      $content = apply_filters('the_content', get_post_meta($post->ID
                ,'_spl_mailgun_newsletter_sidebar_content'
                ,true 
                ));
      if ( !empty($content) ) {
        $sidebar['content'] = $content;
      }

      $posts = array();
      for ( $i=1; $i<= 12; $i++ ) {
        $select = SPL_Mailgun_Newsletter::getPostSelect($post->ID, $i, true);
        if ( !empty($select) ) {
          $posts[$i] = $select;
        }
      }
      if ( !empty($posts) ) {
        $sidebar['posts'] = $posts;
      }

      if ( !empty($sidebar) ) {
        $meta->sidebar = $sidebar;
      }


      $subtitle = get_post_meta($post->ID
                  ,'_spl_mailgun_newsletter_subtitle'
                  ,true 
                  );
      //if ( !empty($subtitle) ) {
        $meta->subtitle = $subtitle;
      //}








      $callout = array();
      $content = apply_filters('the_content', get_post_meta($post->ID
                ,'_spl_mailgun_newsletter_sidebar_callout'
                ,true 
                ));
      if ( !empty($content) ) {
        $callout['content'] = $content;
      }
      
      $attrib = get_post_meta($post->ID
                ,'_spl_mailgun_newsletter_sidebar_attribution'
                ,true 
                );
      
      if ( !empty($attrib) ) {
        $callout['attrib'] = $attrib;
      }
      if ( !empty($callout) ) {
        $meta->callout = $callout;
      }


      $posts = array();
      for ( $i=1; $i<= 12; $i++ ) {
        $select = SPL_Mailgun_Newsletter::getPostSelect($post->ID, $i);
        if ( !empty($select) ) {
          $posts[$i] = $select;
        }
      }
      if ( !empty($posts) ) {
        $meta->posts = $posts;
      }

    }

    return $meta;
  }

  function initNewsletter() {
    //$this->registerPostTemplates();
    
    add_action( 'init', array( $this, 'registerPostType' ) );
    add_action( 'init', array($this, 'initCmbMetaBoxes'), 9999 );

    add_action( 'save_post', array( $this, 'registerSaveHandler' ) );

    add_filter( 'template_include', array($this, 'registerPostTemplates'));
    add_filter( 'cmb_meta_boxes', array($this, 'getNewsletterCmbMetaBoxes') );
    

  } // initNewsletter()

  function registerPostTemplates($template) {
    
    $post_types = array( 'newsletter' );
    /*
    if ( is_post_type_archive( $post_types ) 
      && ! file_exists( get_stylesheet_directory() . '/archive-newsletter.php' ) ) {
      $template = plugin_dir_path(__FILE__) . 'templates/archive-newsletter.php';
    }
    */
    //if ( 'newsletter' == get_post_type( get_the_ID() ) ) {
    
    if ( is_singular( $post_types )
      && ! file_exists( get_stylesheet_directory() . '/single-newsletter.php' ) ) {
      $template = plugin_dir_path(__FILE__) . 'templates/single-newsletter.php';
    }
    
    //print_r( get_post_type( get_the_ID() ) );
    //$template = plugin_dir_path(__FILE__) . 'templates/single-newsletter.php';
    return $template;
  } // registerPostTemplates()

  function registerSaveHandler($id) {
    if ( is_admin() 
      && ( $this->config->custom->post_type == $_POST['post_type'])
      && !empty($_POST['spl-mailgun-newsletter-confirm']) ) {

      $this->processNewsletter($id, $_POST['spl-mailgun-newsletter-subject'], $_POST['spl-mailgun-newsletter-list'], $_POST['spl-mailgun-newsletter-address'], $_POST['spl-mailgun-newsletter-template'], $_POST['spl-mailgun-newsletter-campaign']);
    }
  } // registerSaveHandler()

  function registerPostType() {
    $args = array(
      'labels'        => $this->getPostTypeLabels()
    , 'description'   => 'Newsletters'
    , 'public'        => true
    , 'menu_position' => 30
    , 'supports'      => array( 'title'
                              , 'editor'
                              , 'thumbnail'
                              , 'author'
                              , 'excerpt'
                              //, 'comments' 
                              )
    , 'has_archive'   => true
    , 'rewrite'       => array('slug'=>'newsletter', 'with_front'=>false)
    //, 'slug'          => 'newsletter'
    , 'register_meta_box_cb' => array($this, 'initPublishControls')
    );

    register_post_type( 'newsletter', $args );  
  
  } // registerPostType()

  function getPostTypeLabels() {
    $labels = array(
      'name'               => _x( 'Newsletters', 'post type general name' )
    , 'singular_name'      => _x( 'Newsletter', 'post type singular name' )
    , 'add_new'            => _x( 'Add New', 'newsletter' )
    , 'add_new_item'       => __( 'Add a New Newsletter' )
    , 'edit_item'          => __( 'Edit Newsletter' )
    , 'new_item'           => __( 'New Newsletter' )
    , 'all_items'          => __( 'All Newsletters' )
    , 'view_item'          => __( 'View Newsletters' )
    , 'search_items'       => __( 'Search Newsletters' )
    , 'not_found'          => __( 'No newsletters found' )
    , 'not_found_in_trash' => __( 'No newsletters found in the Trash' )
    , 'parent_item_colon'  => ''
    , 'menu_name'          => 'Newsletters'
    , 'archive_title'      => 'These are the archives'
    );

    return $labels;
  } // getPostTypeLabels()

  function initPublishControls() {
    add_meta_box(
      'spl_mailgun_newsletter_publish_controls' // Unique ID
    , 'Send Newsletter'                         // Title
    , array($this, 'getPublishConrols')         // Callback function
    , 'newsletter'                              // Admin page (or post type)
    , 'side'                                    // Context
    , 'default'                                 // Priority
    );
  } // initPublishControls()

  function getPublishConrols() {
    //print_r( $this->config );
    
    wp_nonce_field( basename( __FILE__ ), 'spl_mailgun_newsletter_send_nonce' );

    echo 'Reminder: Max image width for primary column is 370px. For the sidebar, 160px.';

    $subject = '
    <p>
      <label for="spl-mailgun-newsletter-subject">Enter a subject line:</label>
      <br />
      <input value="'.$this->getNewsletterDefaultSubject().'" class="widefat" type="text" name="spl-mailgun-newsletter-subject" id="spl-mailgun-newsletter-subject" />
    </p>
    ';
    echo $subject;

    $templates = scandir(plugin_dir_path(__FILE__).'emails');
    $tmpl = '
    <p>
      <label for="spl-mailgun-newsletter-tempate">Choose a template:</label>
      <br />
      <select class="widefat" name="spl-mailgun-newsletter-template" id="spl-mailgun-newsletter-template">
      ';

    if ( is_array($templates) ) {
      foreach( $templates as $template ) {
        if ( !is_dir(plugin_dir_path(__FILE__).'emails/'.$template) ) {
          $tmpl .= '<option value="'.$template.'">';
          $tmpl .= str_replace(array('.php', '_'), array('',' '), $template);
          $tmpl .='</option>';
        }
      }
    }
    //print_r($templates);

    $tmpl .= '
      </select>
    </p>
    ';
    echo $tmpl;
    
    $mailgun = $this->getMailgunMailingLists();
    //print_r($mailgun);
    $lists = '
    <p>
      <label for="spl-mailgun-newsletter-list">Send to this mailing list:</label>
      <br />
      <select class="widefat" name="spl-mailgun-newsletter-list" id="spl-mailgun-newsletter-list">
        <option value="" selected>None</option>
    ';

    $exclude = array('undeliverable@'.$this->getMailgunDomain());
    foreach ($mailgun->items as $list) {
      if ( !in_array($list->address, $exclude) ) {
        $lists .= '<option value="'.$list->address.'">'.$list->description.' ('.$list->members_count.')'.'</option>';
      }
    }
    $lists .= '
      </select>
    </p>
    ';
    echo $lists;

    echo '
    <p>
      <label for="spl-mailgun-newsletter-address">Send to this address:</label>
      <br />
      <input value="'.$this->getNewsletterDefaultRecipient().'" class="widefat" type="text" name="spl-mailgun-newsletter-address" id="spl-mailgun-newsletter-address" />
    </p>
    ';

    $campaign = '
    <p>
      <label for="spl-mailgun-newsletter-campaign">Enter a Campaign ID (optional):</label>
      <br />
      <input value="'.$this->getNewsletterDefaultCampaign().'" class="widefat" type="text" name="spl-mailgun-newsletter-campaign" id="spl-mailgun-newsletter-campaign" />
    </p>
    ';
    echo $campaign;

    $prepend = '
    <p>
      <label for="spl-mailgun-newsletter-prepend">Add a note (prepended):</label>
      <br />
      <textarea class="widefat" rows="3" name="spl-mailgun-newsletter-prepend" id="spl-mailgun-newsletter-prepend"></textarea>
    </p>
    ';
    echo $prepend;

    echo '<hr />';

    echo '
    <p>
    <input type="checkbox" name="spl-mailgun-newsletter-confirm" id="spl-mailgun-newsletter-confirm" />
    <label for="spl-mailgun-newsletter-confirm"><strong>Let\'s do this thing!</strong></label>
    ';


    submit_button( __( 'Send Now' )
                    , 'primary large'
                    , 'spl_mailgun_newsletter_send'
                    , false
                    ,array('style'=>'float:right;')
                    //, array( 'tabindex' => '10', 'accesskey' => 's' ) 
                    ); 
    echo '
    </p>
    <div class="clear"></div>
    ';

    $note = '
    <p>
      Check the box to make the magic happen.
    </p>
    <hr>
    <p>
      <strong>Defaults:</strong> Settings &rarr; SPL Newsletter
    </p>
    ';
    echo $note;

  } // getPublishConrols()

  function getNewsletterCmbMetaBoxes( $meta_boxes ) {
    $prefix = '_spl_mailgun_newsletter_'; // Prefix for all fields

    // SUBTITLE
    $meta_boxes[] = array('id' => $prefix . 'subtitle_id'
                        , 'title' => 'Article Issue'
                        , 'pages' => array('newsletter') // post type
                        //, 'show_on' => array()
                        , 'context' => 'normal'
                        , 'priority' => 'high'
                        , 'show_names' => false
                        , 'fields' => array(
                                            array('name' => 'Subtitle'
                                                , 'desc' => 'date, etc.'
                                                , 'id' => $prefix . 'subtitle'
                                                , 'type' => 'text'
                                                //, 'type' => 'text'
                                                //, 'type' => 'wysiwyg'
                                                , 'options' => array()
                                            )
                                      )
                    );

    // CONTENT
    $fields = array();
    $fields[] = array(
                        //'name' => 'Select Posts',
                        /*
                        'desc' => 'Posts 1-4 are displayed 1 across in the primary column, below the main article.
                                  <br>
                                  Posts 4-6 are displayed below the primary column and sidebar, width depends on screen size.
                                  <br>
                                  Posts 7-12 are displayed in 3 rows of 2 columns, across the entire page.',
                        */
                        /*
                        'desc' => 'Posts 1-2 are displayed 1 across in the primary column, below the main article.
                                  <br>
                                  Posts 3-6 are displayed below the primary column and sidebar, width depends on screen size.
                                  <br>
                                  Posts 7-12 are displayed in 3 rows of 2 columns, across the entire page.',
                        */
                        'desc' => 'Posts 1-6 are displayed 1 across in the primary column, below the main article.
                        <br>
                        Posts 7-12 are displayed in 3 rows of 2 columns, across the entire page.',
                                  
                        'type' => 'title',
                        'id' => $prefix . 'post_select_title'
                      );
    for ( $i=1; $i<=12; $i++ ) {
      $fields[] = array('name' => 'Post # ' . $i . ':'
                      , 'desc' => ''
                      , 'id' => $prefix . 'post_select_'.$i
                      , 'type' => 'post_select'
                      , 'limit' => $this->config->plugin['post-quantity-filter'] // limit number of options (posts)
                      , 'post_type' => 'post' // post_type to query for
                      , 'category' => $this->config->plugin['post-category-filter']
                      );
      $fields[] = array('name' => '',
                        'desc' => 'Excerpt Only?',
                        'id' => $prefix . 'post_select_excerpt_'.$i,
                        'type' => 'checkbox',
                      );
    }

    $meta_boxes[] = array('id' => $prefix . 'post_select_id'
                        , 'title' => 'Add Posts to Newsletter'
                        , 'pages' => array('newsletter') // post type
                        //, 'show_on' => array()
                        , 'context' => 'normal'
                        , 'priority' => 'high'
                        , 'show_names' => true  
                        
                        , 'fields' => $fields
                        
                    );

    // SIDEBAR

    $meta_boxes[] = array('id' => $prefix . 'sidebar_callout_id'
                        , 'title' => 'Sidebar Callout'
                        , 'pages' => array('newsletter') // post type
                        //, 'show_on' => array()
                        , 'context' => 'normal'
                        , 'priority' => 'high'
                        , 'show_names' => false
                        , 'fields' => array(
                                            array('name' => 'Callout'
                                                , 'desc' => 'optional callout box'
                                                , 'id' => $prefix . 'sidebar_callout'
                                                //, 'type' => 'textarea_small'
                                                , 'type' => 'wysiwyg'
                                                , 'options' => array()
                                            )
                                          , array('name' => 'Attribution'
                                                , 'desc' => 'optional callout attribution'
                                                , 'id' => $prefix . 'sidebar_attribution'
                                                //, 'type' => 'text'
                                                , 'type' => 'wysiwyg'
                                                , 'options' => array()
                                            )
                                      )
                    );
    
    $meta_boxes[] = array('id' => $prefix . 'sidebar_headline_id'
                        , 'title' => 'Sidebar Headline'
                        , 'pages' => array('newsletter') // post type
                        //, 'show_on' => array()
                        , 'context' => 'normal'
                        , 'priority' => 'high'
                        , 'show_names' => false
                        , 'fields' => array(
                                            array('name' => 'Headline'
                                                , 'desc' => 'optional'
                                                , 'id' => $prefix . 'sidebar_headline'
                                                //, 'type' => 'text'
                                                , 'type' => 'wysiwyg'
                                                , 'options' => array()
                                            )
                                      )
                    );

    $meta_boxes[] = array('id' => $prefix . 'sidebar_content_id'
                        , 'title' => 'Sidebar Content'
                        , 'pages' => array('newsletter') // post type
                        //, 'show_on' => array()
                        , 'context' => 'normal'
                        , 'priority' => 'high'
                        , 'show_names' => false
                        , 'fields' => array(
                                            array(
                                                  'name' => 'Sidebar',
                                                  'desc' => 'optional',
                                                  'id' => $prefix . 'sidebar_content',
                                                  'type' => 'wysiwyg',
                                                  'options' => array()
                                                )
                                      )
                    );

    $fields = array();
    $fields[] = array(
                        //'name' => 'Select Posts',
                        'desc' => 'Sidebar posts are displayed in a single column.',
                        'type' => 'title',
                        'id' => $prefix . 'sidebar_post_select_title'
                      );
    for ( $i=1; $i<=12; $i++ ) {
      $fields[] = array('name' => 'Sidebar # ' . $i . ':'
                      , 'desc' => ''
                      , 'id' => $prefix . 'sidebar_post_select_'.$i
                      , 'type' => 'post_select'
                      , 'limit' => $this->config->plugin['post-quantity-filter'] // limit number of options (posts)
                      , 'post_type' => 'post' // post_type to query for
                      , 'category' => $this->config->plugin['post-category-filter']
                      );
      $fields[] = array('name' => '',
                        'desc' => 'Excerpt Only?',
                        'id' => $prefix . 'sidebar_post_select_excerpt_'.$i,
                        'type' => 'checkbox',
                      );
    }

    $meta_boxes[] = array('id' => $prefix . 'sidebar_post_select_id'
                        , 'title' => 'Add Posts to Sidebar'
                        , 'pages' => array('newsletter') // post type
                        //, 'show_on' => array()
                        , 'context' => 'normal'
                        , 'priority' => 'high'
                        , 'show_names' => true  
                        
                        , 'fields' => $fields
                        
                    );

    return $meta_boxes;
  } // getNewsletterCmbMetaBoxes()

  function initCmbMetaBoxes() {
    //https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
    if ( !class_exists( 'cmb_Meta_Box' ) ) {
      require_once( plugin_basename('/lib/metabox/init.php') );
    }
    // https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress/wiki/Adding-your-own-field-types
    add_action( 'cmb_render_post_select', array($this, 'renderPostSelect'), 10, 2 );
    add_filter( 'cmb_validate_post_select', array($this, 'validatePostSelect') );
  } // initCmbMetaBoxes()

  function renderPostSelect( $field, $meta ) {
    $post_type = ($field['post_type'] ? $field['post_type'] : 'post');
    $limit = ($field['limit'] ? $field['limit'] : '-1');
    $category = ($field['category'] ? $field['category'] : '');
    echo '<select name="', $field['id'], '" id="', $field['id'], '">';
    // get_posts orders by post_date desc?
    $posts = get_posts('post_type='.$post_type.'&category='.$category.'&numberposts='.$limit.'&posts_per_page='.$limit);
    
    echo '<option value="">None</option>';
    foreach ( $posts as $art ) {
      if ($art->ID == $meta ) {
        echo '<option value="' . $art->ID . '" selected>' . get_the_title($art->ID) . '</option>';
      } else {
        echo '<option value="' . $art->ID . '  ">' . get_the_title($art->ID) . '</option>';
      }
    }
    echo '</select>';
    echo '<p class="cmb_metabox_description">', $field['desc'], '</p>';
  } // renderPostSelect()
  
  function validatePostSelect( $new ) {
    // stub
    return $new;
  } // validatePostSelect()



  // MAILGUN INTEGRATION

  function filterNewsletterImages( $html, $sidebar=false ){
    //return $html;
    $classes = 'img-responsive img-rounded'; // separated by spaces, e.g. 'img image-link'
    if ( true == $sidebar ) {
      $classes = $classes . ' center';
    }

    if ( !$sidebar ) {
      $html = str_ireplace('<img', '<img hspace="6"', $html);
    }

    // check if there are already classes assigned to the anchor
    if ( preg_match('/<img.*? class="/', $html) ) {
      $html = preg_replace('/(<img.*? class=".*?)(".*?\/>)/', '$1 ' . $classes . ' $2', $html);
    } else {
      $html = preg_replace('/(<img.*?)(\/>)/', '$1 class="' . $classes . '" $2', $html);
    }

    

    // remove dimensions from images
    //$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    // give fixed width to images
    if ( !empty($sidebar) ) {
      //$html = preg_replace( '/(width|height)=\"\d*\"\s/', ' width="'.$this->config->custom->sidebar->img_width.'" style="width:'.$this->config->custom->sidebar->img_width.';" ', $html );
      //$html = preg_replace( '/(width|height)=\"\d*\"\s/', ' width="" style="max-width:'.$this->config->custom->sidebar->img_width.'; height: auto;" ', $html );
    }

    return $html;
  }

  function filterNewsletterSidebarImages($html) {
    return $this->filterNewsletterImages($html, true);
  } 


  static function formatPostSelectSidebar($post, $class=null) {
    $html = '';

    if ( !is_null($post) ) {
      $post->content = str_replace(array('<figure','</figure>','<figcaption','</figcaption>')
                          ,array('<div', '</div>', '<div', '</div>')
                          ,apply_filters('the_content', $post->content));

      $html .= '<h3>';      
      if ( $post->excerpt ) {
        $html .= '<a href="'.$post->link.'">';
      }
      $html .= $post->title;
      if ( $post->excerpt ) {
        $html .= '</a>';
      }
      $html .= '</h3>';
      
      if ( $post->thumbnail ) {
        $html .= $post->thumbnail;
      }

      $html .= $post->content;


  
      if ( $post->excerpt ) {
        $html .= '<p class="center">';
        $html .= '<center>';
        $html .= '<a href="'.$post->link.'">';
        $html .= 'Continue Reading →';
        $html .= '</a>';
        $html .= '</center>';
        $html .= '</p>';
      }

    }
    //$html .= print_r($post, true);

    return $html;      
  }

  static function formatPostSelect($post, $class=null) {
    $html = '';
    if ( !is_null($post) ) {
      
      $post->content = str_replace(array('<figure','</figure>','<figcaption','</figcaption>')
                          ,array('<div', '</div>', '<div', '</div>')
                          ,apply_filters('the_content', $post->content));
      

      $html .= '<table class="post '.$class.'">';
      $html .= '<tr>';
      $html .= '<td>';
      $html .= '<h4 class="subtitle">';
      if ( $post->excerpt ) {
        $html .= '<a href="'.$post->link.'">';
      }
      $html .= '<span class="">';
      $html .= $post->title;
      if ( $post->excerpt ) {
        $html .= '</a>';
      }
      $html .= '</span>';
      $html .= '</h4>';
      $html .= '</td>';
      $html .= '<td class="expander"></td>';
      $html .= '<tr>';
      $html .= '<td>';
      if ( $post->thumbnail ) {
        $html .= $post->thumbnail;
      }
      $html .= $post->content;
      
      if ( !$post->excerpt ) {
        $html .= '<h4 class="center"><center>...</center></h4>';
      }
      
      $html .= '</td>';
      $html .= '<td class="expander"></td>';
      $html .= '</tr>';
      
      if ( $post->excerpt ) {
        $html .= '<tr>';
        $html .= '<td>';
        $html .= '<table class="button">';
        $html .= '<tr>';
        $html .= '<td>';
        $html .= '<a href="'.$post->link.'">';
        $html .= 'Continue Reading →';
        $html .= '</a>';
        $html .= '</td>';
        $html .= '</tr>';
        $html .= '</table>';
        $html .= '</td>';
        $html .= '<td class="expander"></td>';
        $html .= '</tr>';
      }
      
      $html .= '</table>';
      
    }

    if ( $post->excerpt ) {
      $html = str_ireplace('<img', '<img hspace="6"', $html);
    }

    //$html .= print_r($post, true);

    return $html;
  }

  static function getPostSelect($pid, $order, $sidebar=false, $trim=60) {
    $post = null;

    if ( $sidebar ) {
      $prefix = 'sidebar_';
    }

    $select = get_post_meta($pid
                            ,'_spl_mailgun_newsletter_'.$prefix.'post_select_'.$order
                            ,true 
                          );
    $excerpt = get_post_meta($pid
                            ,'_spl_mailgun_newsletter_'.$prefix.'post_select_excerpt_'.$order
                            ,true 
                            ); 

    if ( !empty($select) ) {
      $post = new stdClass();

      $attach = get_post($select);

      $post->link = get_permalink($select);
      $post->title = $attach->post_title;

      // featured img
      //$post->thumbnail = $attach->ID;

      $thumbnail_classes = 'img-responsive img-rounded ';
      if ( $sidebar ) {
        $thumbnail_classes .= 'aligncenter';
      } else {
        $thumbnail_classes .= 'alignleft';
      }
      $post->thumbnail = get_the_post_thumbnail($attach->ID, 'thumbnail', array('class'=>$thumbnail_classes));

      if ( !empty($excerpt) ) {
        $post->excerpt = true;
        if (!empty($attach->post_excerpt)) { 
          $post->content .= wpautop($attach->post_excerpt);
        } else {
          $post->content .=  wpautop(wp_trim_words(apply_filters('the_content', $attach->post_content), 60));
          //$post->content .= wpautop(wp_trim_words($attach->post_content, $trim));
        }
      } else {
        //$post->content .= wpautop($attach->post_content);
        $post->content .= apply_filters('the_content', $attach->post_content);
      }
      /*
      // A regular expression of what to look for.
      $pattern = '/(<img([^>]*)>)/i';
      // What to replace it with. $1 refers to the content in the first 'capture group', in parentheses above
      $replacement = '<p class="alignleft">$1</p>';
      // run preg_replace() on the $content
      $post->content = preg_replace( $pattern, $replacement, $post->content );
      */
    }
    
    return $post;
  }

  function getNewsletterHTMLEmail($id, $template, $list=null) {
    //return 'This is newsletter # '.$id;
    if ( !empty($_POST['spl-mailgun-newsletter-subject']) ) {
      $prepend = wpautop(stripslashes($_POST['spl-mailgun-newsletter-prepend']));
    }

    remove_filter( 'the_content','bootstrap_responsive_images',10 );
    remove_filter( 'post_thumbnail_html', 'bootstrap_responsive_images', 10 );

    add_filter( 'the_content', array($this,'filterNewsletterImages'),10 );
    //add_filter( 'post_thumbnail_html', array($this, 'filterNewsletterImages'), 10 );

    $post = get_post($id);
    //$trace = print_r($post, true);

    $link = get_permalink($id);

    $date = mysql2date( 'F Y', $post->post_date );

    $title = $post->post_title;
    
    $content = str_replace(array('<figure','</figure>','<figcaption','</figcaption>')
                          ,array('<div', '</div>', '<div', '</div>')
                          ,apply_filters('the_content', $post->post_content));

    $subtitle = get_post_meta($id
                          , '_spl_mailgun_newsletter_sidebar_headline'
                          , true 
                          );
    
    $callout = nl2br(get_post_meta($id
                          , '_spl_mailgun_newsletter_sidebar_callout'
                          , true 
                          ));
 
    $attribute = get_post_meta($id
                          , '_spl_mailgun_newsletter_sidebar_attribution'
                          , true 
                          );
    
    // attached posts
    $posts = array();
    for ( $i=1; $i<= 12; $i++ ) {
      $posts[$i] = $this->getPostSelect($id, $i);
    }

    add_filter( 'the_content', array($this,'filterNewsletterSidebarImages'),10 );
    add_filter( 'post_thumbnail_html', array($this, 'filterNewsletterSidebarImages'), 10 );
    
    $sidebar = get_post_meta($id
                          , '_spl_mailgun_newsletter_sidebar_content'
                          , true 
                          );
    $sidebar = str_replace(array('<figure','</figure>','<figcaption','</figcaption>')
                          ,array('<div', '</div>', '<div', '</div>')
                          ,apply_filters('the_content', $sidebar));
    
    $sb_posts = array();
    for ( $i=1; $i<= 12; $i++ ) {
      $sb_posts[$i] = $this->getPostSelect($id, $i, true);
    }

    
    // these really need to be removed after being run
    remove_filter( 'the_content', array($this,'filterNewsletterSidebarImages'));
    remove_filter( 'post_thumbnail_html', array($this, 'filterNewsletterSidebarImages'));
    

    //return print_r($_POST, true);
    $template = plugin_dir_path(__FILE__).'emails/'.$template;
    if ( file_exists($template) ) {
      ob_start();
      include($template);
      $template = ob_get_contents();
      ob_end_clean();
    }

    $inliner = $this->config->custom->inliner->api.'raw';
    $inlined = $this->curlJSON($inliner, array('source'=>$template));
    $template = $inlined->html;

    return $template;
  }

  function getNewsletterDefaultSubject() {
    return $this->config->plugin['default-subject'];
  }

  function getNewsletterDefaultCampaign() {
    return $this->config->plugin['default-campaign'];
  }

  function getNewsletterDefaultRecipient() {
    return $this->config->plugin['default-recipient'];
  }

  function getNewsletterSendReceiptTo() {
    return $this->config->plugin['config-receipt-to'];
  }

  function processNewsletter($id, $subject, $list, $address, $template, $campaign=null) {

    $from = $this->getMailgunFrom();
    $html = $this->getNewsletterHTMLEmail($id, $template, $list);

    if ( !empty($address) ) {
      $response = $this->sendMailgunMessage($from, $address, $subject, $html, null, $campaign);
      $this->notifyMailgunResponse($response, $address, null);
    }

    if ( !empty($list) ) {
      $response = $this->sendMailgunMessage($from, $list, $subject, $html, null, $campaign);
      $this->notifyMailgunResponse($response, null, $list);
    }
    
  } // processNewsletter()

  function notifyMailgunResponse($response, $address=null, $list=null) {
    $recipient = $this->getNewsletterSendReceiptTo();

    if ( !empty($recipient) ) {

      //$response = 'You just sent out a newsletter.'.PHP_EOL.'You are a very special snowflake.'.PHP_EOL.$response;
      
      $response = 'Newsletter Sent.'.PHP_EOL;

      if ( !is_null($address) ) {
        $response .= PHP_EOL.$this->getMailgunAddressValidation($address);
      }
      
      if ( !is_null($list) ) {
        $count = $this->getMailgunMailingListCount($list);
        $detail = $this->getMailgunMailingList($list);

        $response .= PHP_EOL.'Active Subscribers: '.$count.PHP_EOL;
        $response .= PHP_EOL.'List Detail: '.PHP_EOL.$detail;
      }
    
      wp_mail( $this->getNewsletterSendReceiptTo(), 'Newsletter: Mailgun API Response', $response );
    }
  }
  
  function sendMailgunMessage($from, $to, $subject, $html=null, $text=null, $campaign=null) {
    $api = $this->getMailgunApi().$this->getMailgunDomain().'/'.'messages';
    $auth = $this->getMailgunPrivateAuth();
    $params = array('from'=>$from
                  , 'to'=>$to
                  , 'subject'=>$subject
                  , 'o:tag'=>$subject
                  //, 'v:my-data' => '{"my_message_id":123}'
                    );
    if ( !empty($html) ) {
      $params['html'] = $html;
    }
    if ( !empty($text) ) {
      $params['text'] = $text;
    }
    if ( !empty($campaign) ) {
      $params['o:campaign'] = $campaign;
    }
    //return $auth;
    $curl = $this->curlProxy($api, $params, 'post', $auth);
    return $curl->response;
    //return $this->curlProxy($api, $params, 'post', $auth);
  } // sendMailgunMessage()

  function addAddressToMailingList($address, $list, $subscribed=true, $name=null, $vars=null) {
    $result = false;
    if ( !empty($vars) ) {
      $vars = json_encode($vars);
    }
    if ( $address && $list ) {
      $api = $this->getMailgunApi().'lists'.'/'.$list.'/'.'members';
      $auth = $this->getMailgunPrivateAuth();
      $params = array('subscribed'=>$subscribed
                    , 'address'=>$address
                    , 'name'=>$name
                    , 'vars'=>$vars
                      );

      return $this->curlJSON($api, $params, 'post', $auth);
    }
    return $result;
  }

  function unsubscribeAddressFromDomain($address, $domain) {
    if ( $address ) {
      $api = $this->getMailgunApi().$domain.'/'.'unsubscribes';
      $auth = $this->getMailgunPrivateAuth();
      $params = array('address'=>$address
                    , 'tag'=>'*');
      
      return $this->curlJSON($api, $params, 'post', $auth);
    }
    return $result;
  }

  function updateAddressOnMailingList($address, $list, $subscribed=true, $name=null, $vars=null) {
    $result = false;
    if ( !empty($vars) ) {
      $vars = json_encode($vars);
    }
    if ( $address && $list ) {
      $api = $this->getMailgunApi().'lists'.'/'.$list.'/members/'.$address;
      $auth = $this->getMailgunPrivateAuth();
      $params = array('subscribed'=>$subscribed
                    , 'name'=>$name
                    , 'vars'=>$vars
                      );

      return $this->curlJSON($api, $params, 'put', $auth);
    }
    return $result;
  }

  function removeAddressFromMailingList($address, $list) {
    $result = false;
    if ( $address && $list ) {
      $api = $this->getMailgunApi().'lists'.'/'.$list.'/members/'.$address;
      $auth = $this->getMailgunPrivateAuth();
      return $this->curlJSON($api, null, 'delete', $auth);
    }
    return $result;
  }
  

  function getMailgunAddressValidation($address) {
    $api = $this->getMailgunApi().'address/validate';
    $auth = $this->getMailgunPublicAuth();
    $params = array('address'=>$address);

    $curl = $this->curlProxy($api, $params, 'get', $auth);
    return $curl->response;
    //return $this->curlProxy($api, $params, 'get', $auth);
  } // getMailgunAddressValidation()

  function getMailgunMailingListCount($address) {
    $api = $this->getMailgunApi().'lists'.'/'.$address.'/members';
    $auth = $this->getMailgunPrivateAuth();
    
    $params = array('subscribed'=>'yes'
                  , 'limit'=>1
                  );
    
    //$params = array();

    $curl = $this->curlProxy($api, $params, 'get', $auth);
    $response = json_decode($curl->response);

    return print_r($response->total_count, true);
  } // getMailgunMailingListCount()

  function getMailgunMailingList($address) {
    $api = $this->getMailgunApi().'lists'.'/'.$address;
    $auth = $this->getMailgunPrivateAuth();
    
    $params = array();

    $curl = $this->curlProxy($api, $params, 'get', $auth);
    return $curl->response;
    //return $this->curlProxy($api, $params, 'get', $auth);
  } // getMailgunMailingList()



  function getMailgunMailingLists() {
    $api = $this->getMailgunApi().'lists';
    $auth = $this->getMailgunPrivateAuth();
    //$params = array('subscribed'=>'yes');
    $params = array();

    return $this->curlJSON($api, $params, 'get', $auth);
  } // getMailgunMailingLists()

  function getMailgunApi() {
    return $this->config->custom->mailgun->api;
  }

  function getMailgunUser() {
    return $this->config->custom->mailgun->user;
  }

  function getMailgunPublicAuth() {
    $auth = array('user'=>$this->getMailgunUser()
                , 'pass'=>$this->getMailgunPublicKey()
                );
    return $auth;
  }

  function getMailgunPrivateAuth() {
    $auth = array('user'=>$this->getMailgunUser()
                , 'pass'=>$this->getMailgunPrivateKey()
                );
    return $auth;
  }

  function getMailgunFrom() {
    $from = null;
    $from .= $this->config->plugin['mailgun-from-name'];
    $from .= ' ';
    $from .= '<';
    $from .= $this->config->plugin['mailgun-from-address'];
    $from .= '>';

    return $from;
  }

  function getMailgunDomain() {
    return $this->config->plugin['mailgun-domain'];
  }

  function getMailgunPublicKey() {
    return $this->config->plugin['mailgun-public-key'];
  }

  function getMailgunPrivateKey() {
    return $this->config->plugin['mailgun-private-key'];
  }

  function curlJSON($url, $params, $method='post', $auth=null) {
    //return $this->curlProxy($url, $params, $method, $auth);
    //return json_decode($this->curlProxy($url, $params, $method, $auth));
    $proxy = $this->curlProxy($url, $params, $method, $auth);
    $curl = json_decode($proxy->response);
    $curl->httpcode = $proxy->httpcode;
    return $curl; 
  }

  function curlProxy($url, $params, $method='post', $auth=null) {
    $result = new stdClass();
    $result->response = false;

    // create a new cURL resource
    $ch = curl_init();
    
    if ( 'post' == $method ) {
      // setup for an http post
      curl_setopt($ch, CURLOPT_POST, 1);
      // 'cause cURL doesn't like multi-dimensional arrays
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    } elseif ( 'get' == $method ) {
      if ( is_array($params) ) {
      $url .= '?' . http_build_query($params);
      }
    } elseif ( 'delete' == $method ) {
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    } elseif ( 'put' == $method ) {
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    }


    // set URL and other appropriate options
    curl_setopt($ch, CURLOPT_URL, $url);
    //curl_setopt($ch, CURLOPT_HEADER, false);

    // follow redirects
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    // set auth params
    if ( is_array($auth) ) {
      //curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);  
      curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); // CURLAUTH_ANY
      curl_setopt($ch, CURLOPT_USERPWD, $auth['user'] . ':' . $auth['pass']);
    }

    // set returntransfer to true to prevent browser echo
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
    $ua = $_SERVER['HTTP_USER_AGENT']; // optional
    if (isset($ua)) {
        curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    }
 
    // grab URL
    $result->response = curl_exec($ch);

    // grab http response code
    $result->httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
     
    // close cURL resource, and free up system resources
    curl_close($ch);

    return $result;
  }

} // SPL_Mailgun_Newsletter

?>
