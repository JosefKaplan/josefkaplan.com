<?php
/**
 * Define function about sanitation for customizer option
 *
 * @package Mantrabrain
 * @subpackage Mantranews
 * @since 1.0.0
 */

//Text
function mantranews_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

//Check box
function mantranews_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return 0;
	}
}

// Number
function mantranews_sanitize_number( $input ) {
	$output = intval( $input );

	return $output;
}

// site layout
function mantranews_sanitize_site_layout( $input ) {
	$valid_keys = array(
		'fullwidth_layout' => esc_html__( 'Fullwidth Layout', 'mantranews' ),
		'boxed_layout'     => esc_html__( 'Boxed Layout', 'mantranews' )
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

// site layout
function mantranews_sanitize_site_skin( $input ) {
	$valid_keys = array(
		'default' => esc_html__( 'Default Skin', 'mantranews' ),
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

// Switch option (enable/disable)
function mantranews_enable_switch_sanitize( $input ) {
	$valid_keys = array(
		'enable'  => esc_html__( 'Enable', 'mantranews' ),
		'disable' => esc_html__( 'Disable', 'mantranews' )
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

// Switch option for ticker all (enable/disable)
function mantranews_all_page_ticker_enable_switch_sanitize( $input ) {
	$valid_keys = array(
		'yes' => esc_html__( 'Yes', 'mantranews' ),
		'no'  => esc_html__( 'No', 'mantranews' )
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

//switch option (show/hide)
function mantranews_show_switch_sanitize( $input ) {
	$valid_keys = array(
		'show' => esc_html__( 'Show', 'mantranews' ),
		'hide' => esc_html__( 'Hide', 'mantranews' )
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

//Archive page layout
function mantranews_sanitize_archive_layout( $input ) {
	$valid_keys = array(
		'classic' => esc_html__( 'Classic Layout', 'mantranews' ),
		'columns' => esc_html__( 'Columns Layout', 'mantranews' )
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

//Post/Page sidebar layout
function mantranews_page_layout_sanitize( $input ) {
	$valid_keys = array(
		'right_sidebar'     => get_template_directory_uri() . '/core/admin/assets/images/right-sidebar.png',
		'left_sidebar'      => get_template_directory_uri() . '/core/admin/assets/images/left-sidebar.png',
		'no_sidebar'        => get_template_directory_uri() . '/core/admin/assets/images/no-sidebar.png',
		'no_sidebar_center' => get_template_directory_uri() . '/core/admin/assets/images/no-sidebar-center.png'
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

//Footer widget columns
function mantranews_footer_widget_sanitize( $input ) {
	$valid_keys = array(
		'column1' => esc_html__( 'One Column', 'mantranews' ),
		'column2' => esc_html__( 'Two Columns', 'mantranews' ),
		'column3' => esc_html__( 'Three Columns', 'mantranews' ),
		'column4' => esc_html__( 'Four Columns', 'mantranews' )
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

//Related posts type
function mantranews_sanitize_related_type( $input ) {
	$valid_keys = array(
		'category' => esc_html__( 'by Category', 'mantranews' ),
		'tag'      => esc_html__( 'by Tags', 'mantranews' )
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

//Website Skin Sanatize
function mantranews_website_skin_sanitize( $input ) {
	$valid_keys = array(
		'default_skin' => esc_html__( 'Default', 'mantranews' ),
		'dark_skin'    => esc_html__( 'Dark Skin', 'mantranews' ),
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}
//site date format design
function mantranews_sanitize_date_format( $input){
    $valid_keys = array(
        'l, F d, Y' => esc_html__( 'Format 1 (default)', 'mantranews' ),
        'l, Y, F d' => esc_html__( 'Format 2', 'mantranews' ),
        'Y, F d, l' => esc_html__( 'Format 3', 'mantranews' ),
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}
// sanitization of links
function mantranews_links_sanitize() {
	return false;
}

// site title design
function mantranews_sanitize_title_design( $input ) {
    $valid_keys = mantranews_site_title_design();
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

// site title design
function mantranews_sanitize_title_case_design( $input ) {
    $valid_keys = mantranews_site_title_design_case();
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}