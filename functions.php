<?php

// output functions

function spl_mail_news_sidebar_content($post) {
	echo wpautop(get_post_meta($post->ID
													, '_spl_mailgun_newsletter_sidebar_content'
													, true 
													));
}

?>