<?php

// output functions

function spl_news_sidebar_headline($post) {
  echo get_post_meta($post->ID
                    ,'_spl_mailgun_newsletter_sidebar_headline'
                    ,true 
                    );
}

function spl_news_sidebar_content($post) {
  echo apply_filters('the_content', get_post_meta($post->ID
                    ,'_spl_mailgun_newsletter_sidebar_content'
                    ,true 
                    ));
}

function spl_news_post_select($post, $id) {
  $select = get_post_meta($post->ID
                          ,'_spl_mailgun_newsletter_post_select_'.$id
                          ,true 
                        );
  $excerpt = get_post_meta($post->ID
                          ,'_spl_mailgun_newsletter_post_select_excerpt_'.$id
                          ,true 
                          ); 

  if ( !empty($select) ) {
    $attach = get_post($select);
    $permalink = get_permalink($select);
    echo '<p class="lead"><a href="'.$permalink.'">'.$attach->post_title.'</a></p>';

    if ( !empty($excerpt) ) {
      if (!empty($attach->post_excerpt)) { 
        echo wpautop($attach->post_excerpt);
      } else {
        echo wpautop(wp_trim_words($attach->post_content, 80));
      }
    } else {
      echo wpautop($attach->post_content);
    }
    $anchor = '
    <p>
    <a href="'.$permalink.'"
        class="btn btn-success">Read More &rarr;</a>
    </p>
    ';
    echo $anchor;
  }

}

?>