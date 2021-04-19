<?php
/**
 * Purea Magazine Theme Customizer Helper Functions
 *
 * @package purea-magazine
 */


/**
* Render callback for site title
* 
* @return void
*/
function purea_magazine_site_title_callback() {
    bloginfo( 'name' );
}

/**
* Render callback for site description
* 
* @return void
*/
function purea_magazine_site_description_callback() {
    bloginfo( 'description' );
}


/**
 * Check if the top bar is enabled or not
 */
function purea_magazine_top_bar_enable( $control ) {
	if ( $control->manager->get_setting( 'purea_magazine_enable_top_bar' )->value() == true ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the top bar social icons is enabled or not
 */
function purea_magazine_top_bar_social_enable( $control ) {
	if ( $control->manager->get_setting( 'purea_magazine_enable_top_bar_social_icons' )->value() == true ) {
		return true;
	} else {
		return false;
	}
}


/**
 * Check if the facebook icon is enabled or not
 */
function purea_magazine_top_bar_facebook_icon_enable( $control ) {
	if ( $control->manager->get_setting( 'purea_magazine_enable_top_bar_facebook_icon' )->value() == true && $control->manager->get_setting( 'purea_magazine_enable_top_bar_social_icons' )->value() == true ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the twitter icon is enabled or not
 */
function purea_magazine_top_bar_twitter_icon_enable( $control ) {
	if ( $control->manager->get_setting( 'purea_magazine_enable_top_bar_twitter_icon' )->value() == true && $control->manager->get_setting( 'purea_magazine_enable_top_bar_social_icons' )->value() == true ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the instagram icon is enabled or not
 */
function purea_magazine_top_bar_instagram_icon_enable( $control ) {
	if ( $control->manager->get_setting( 'purea_magazine_enable_top_bar_instagram_icon' )->value() == true && $control->manager->get_setting( 'purea_magazine_enable_top_bar_social_icons' )->value() == true ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the linkedin icon is enabled or not
 */
function purea_magazine_top_bar_linkedin_icon_enable( $control ) {
	if ( $control->manager->get_setting( 'purea_magazine_enable_top_bar_linkedin_icon' )->value() == true && $control->manager->get_setting( 'purea_magazine_enable_top_bar_social_icons' )->value() == true ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the pinterest icon is enabled or not
 */
function purea_magazine_top_bar_pinterest_icon_enable( $control ) {
	if ( $control->manager->get_setting( 'purea_magazine_enable_top_bar_pinterest_icon' )->value() == true && $control->manager->get_setting( 'purea_magazine_enable_top_bar_social_icons' )->value() == true ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the youtube icon is enabled or not
 */
function purea_magazine_top_bar_youtube_icon_enable( $control ) {
	if ( $control->manager->get_setting( 'purea_magazine_enable_top_bar_youtube_icon' )->value() == true && $control->manager->get_setting( 'purea_magazine_enable_top_bar_social_icons' )->value() == true ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the trending news is enabled or not
 */
function purea_magazine_trending_news_enable( $control ) {
	if ( $control->manager->get_setting( 'purea_magazine_enable_trending_news' )->value() == true ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if the highlight area is enabled or not
 */
function purea_magazine_highlight_area_enable( $control ) {
	if ( $control->manager->get_setting( 'purea_magazine_enable_highlight_area' )->value() == true ) {
		return true;
	} else {
		return false;
	}
}


/**
 * Check if the same category highlight area is enabled or not
 */
function purea_magazine_same_cat_highlight_area_enable( $control ) {
	if( $control->manager->get_setting( 'purea_magazine_enable_highlight_area' )->value() == true) {
		if ( $control->manager->get_setting( 'purea_magazine_is_show_same_cat_highlight_area' )->value() == true ) {
			return true;
		} else {
			return false;
		}
	}
	else {
		return false;
	}
}

/**
 * Check if the same category highlight area is disabled or not
 */
function purea_magazine_same_cat_highlight_area_disable( $control ) {
	if( $control->manager->get_setting( 'purea_magazine_enable_highlight_area' )->value() == true) {
		if ( $control->manager->get_setting( 'purea_magazine_is_show_same_cat_highlight_area' )->value() == false ) {
			return true;
		} else {
			return false;
		}	
	}else {
		return false;
	}
}

/**
 * Check if the single post no sidebar is enabled or not
 */
function purea_magazine_single_post_no_sidebar_enable( $control ) {
	if ( $control->manager->get_setting( 'purea_magazine_blog_single_sidebar_layout' )->value() == "no" ) {
		return true;
	} else {
		return false;
	}
}


/**
 * Check if the single post no sidebar is enabled & full width disabled
 */
function purea_magazine_single_post_no_sidebar_enable_full_width_disable( $control ) {
	if ( $control->manager->get_setting( 'purea_magazine_blog_single_sidebar_layout' )->value() == "no" && $control->manager->get_setting( 'purea_magazine_enable_single_post_full_width' )->value() == false  ) {
		return true;
	} else {
		return false;
	}
}
