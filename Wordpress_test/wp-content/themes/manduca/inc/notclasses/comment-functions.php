<?php

 /*  This file is part of WordPress theme named Manduca - focus on accessibility.
 *
	Copyright (C) 2015-2019  Zsolt Edelényi (ezs@web25.hu)

    Manduca is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    in /assets/docs/licence.txt.  If not, see <https://www.gnu.org/licenses/>.
*/


/**
 * Defines the callback function for use with wp_list_comments(). This function controls
 * how comments are displayed.
 *
 * @since Manduca 1.0
*/
if ( ! function_exists( 'manduca_comment' ) ) :
 
function manduca_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	//echo '<pre>' ;print_r ($comment );echo '</pre>';
	if ( $comment->comment_type !== 'pingback' && $comment->comment_type !== 'trackback'  ) :
		
	global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
						get_comment_author_link(),
						( $comment->user_id === $post->post_author ) ? '<span>' .__( 'Author', 'manduca' ) .'</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						sprintf( __( 'Date: %1$s: %2$s', 'manduca' ),
								get_comment_date(),
								get_comment_time()
								)
					);
				?>
			</header>

			<?php if ( '0' == $comment->comment_approved ) { ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Comment is awaiting for apporval.', 'manduca' ) ?></p>
			<?php } ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'manduca' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply more-link link-button">
				<?php comment_reply_link( array_merge(
									$args,
									array(
										  'reply_text' => __( 'Reply', 'manduca' ),
										  'before' => manduca_get_svg( array( 'icon' => 'mail-reply' ) ),
										  'depth' => $depth,
										  'max_depth' => $args['max_depth']
										  )
									) ); ?>
			</div>
		</article>
	<?php
		
	endif; // end comment_type check
}
endif;



/**
 * Adds the functionality to count comments by type, eg. comments, pingbacks, tracbacks.
 * Based on the code at WPCanyon (http://wpcanyon.com/tipsandtricks/get-separate-count-for-comments-trackbacks-and-pingbacks-in-wordpress/)
 * 
 *  
 * @since Manduca 17.2
*/

if ( ! function_exists( 'manduca_get_comment_count' ) ) :

function manduca_comment_count( $type = 'comments', $oneText = '', $moreText = '' ){
	
	$result = manduca_get_comment_count( $type );

    if( $result == 1  )
		return str_replace( '%', $result, $oneText );
	elseif( $result > 1 )
		return str_replace( '%', $result, $moreText );
	else
		return false;
}
endif;



/**
 * Adds the functionality to count comments by type, eg. comments, pingbacks, tracbacks. Return the number of comments, but do not print them.
 * Based on the code at WPCanyon (http://wpcanyon.com/tipsandtricks/get-separate-count-for-comments-trackbacks-and-pingbacks-in-wordpress/)
 * 
 * 
 * @since Manduca 17.2
*/
if ( ! function_exists( 'manduca_get_comment_count' ) ) :

function manduca_get_comment_count( $type = 'comments', $only_approved_comments = true, $top_level = false ){
	if ( ! get_the_ID() ) return;
	if 		( $type == 'comments' ) 	$type_sql = 'comment_type = ""';
	elseif 	( $type == 'pings' )		$type_sql = 'comment_type != ""';
	elseif 	( $type == 'trackbacks' ) 	$type_sql = 'comment_type = "trackback"';
	elseif 	( $type == 'pingbacks' )	$type_sql = 'comment_type = "pingback"';
	
	$approved_sql = $only_approved_comments ? ' AND comment_approved="1"' : '';
	$top_level_sql = ( $top_level ) ? ' AND comment_parent="0" ' : '';
        
	global $wpdb;

    $result = $wpdb->get_var( '
        SELECT
            COUNT(comment_ID)
        FROM
            ' . $wpdb->comments . '
        WHERE
            ' . $type_sql . $approved_sql . $top_level_sql . ' AND 
            comment_post_ID= ' . get_the_ID() );
	
	return $result;
}
endif;