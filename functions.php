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

function spl_news_post_select($post, $id) {
	$select = get_post_meta($post->ID
													, '_spl_mailgun_newsletter_post_select_'.$id
													, true 
													);
	$excerpt = get_post_meta($post->ID
													, '_spl_mailgun_newsletter_post_select_excerpt_'.$id
													, true 
													); 

	if ( !empty($select) ) {
		$attach = get_post($select);
		$permalink = get_permalink($select);
		echo '<p class="lead">'.$attach->post_title.'</p>';

		if ( !empty($excerpt) ) {
			echo wp_trim_excerpt($attach->post_excerpt);
		} else {
			echo wpautop($attach->post_content);
		}

		$anchor = '
		<a href="'.$permalink.'"
				class="btn btn-success">More &rarr;</a>
		';
		echo $anchor;
	}

}

?>