<?php

// output functions

function spl_news_sidebar_headline($post) {
	echo get_post_meta($post->ID
													, '_spl_mailgun_newsletter_sidebar_headline'
													, true 
													);
}

function spl_news_sidebar_content($post) {
	echo wpautop(get_post_meta($post->ID
													, '_spl_mailgun_newsletter_sidebar_content'
													, true 
													));
}

function spl_news_post($post, $id) {
	echo $id;
}

?>