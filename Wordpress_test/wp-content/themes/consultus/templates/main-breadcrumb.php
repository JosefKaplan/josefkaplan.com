<section class="theme-page-header-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
				<?php 
                    if(is_home() || is_front_page()) {
                        echo '<div class="page-header-title center-text"><h1 class="text-white">'; echo single_post_title(); echo '</h1></div>';
                    } else{
						if( is_archive() )
						{
							echo '<div class="page-header-title center-text"><h1 class="text-white">';
							if ( is_day() ) :
							/* translators: %1$s %2$s: date */	
							  printf( esc_html__( '%1$s %2$s', 'consultus' ), esc_html__('Archives','consultus'), get_the_date() );  
							elseif ( is_month() ) :
							/* translators: %1$s %2$s: month */	
							  printf( esc_html__( '%1$s %2$s', 'consultus' ), esc_html__('Archives','consultus'), get_the_date( 'F Y' ) );
							elseif ( is_year() ) :
							/* translators: %1$s %2$s: year */	
							  printf( esc_html__( '%1$s %2$s', 'consultus' ), esc_html__('Archives','consultus'), get_the_date( 'Y' ) );
							elseif( is_author() ):
							/* translators: %1$s %2$s: author */	
								printf( esc_html__( '%1$s %2$s', 'consultus' ), esc_html__('All posts by','consultus'), get_the_author() );
							elseif( is_category() ):
							/* translators: %1$s %2$s: category */	
								printf( esc_html__( '%1$s %2$s', 'consultus' ), esc_html__('Category','consultus'), single_cat_title( '', false ) );
							elseif( is_tag() ):
							/* translators: %1$s %2$s: tag */	
								printf( esc_html__( '%1$s %2$s', 'consultus' ), esc_html__('Tag','consultus'), single_tag_title( '', false ) );
							elseif( class_exists( 'WooCommerce' ) && is_shop() ):
							/* translators: %1$s %2$s: WooCommerce */	
								printf( esc_html__( '%1$s %2$s', 'consultus' ), esc_html__('Shop','consultus'), single_tag_title( '', false ));
							elseif( is_archive() ): 
							the_archive_title( '<h1 class="text-white">', '</h1>' ); 
							endif;
							echo '</h1></div>';
						}
						elseif( is_404() )
						{
							echo '<div class="page-header-title center-text"><h1 class="text-white">';
							/* translators: %1$s: 404 */	
							echo( esc_html__( '404', 'consultus' ));
							echo '</h1></div>';
						}
						elseif( is_search() )
						{
							echo '<div class="page-header-title center-text"><h1 class="text-white">';
							/* translators: %1$s %2$s: search */
							printf( esc_html__( '%1$s %2$s', 'consultus' ), esc_html__('Search results for','consultus'), get_search_query() );
							echo '</h1></div>';
						}
						else
						{
							echo '<div class="page-header-title center-text"><h1 class="text-white">'.esc_html( get_the_title() ).'</h1></div>';
						}
                    }// header breadcrumb
                    consultus_page_header_breadcrumbs();						
				?>
				</div>
			</div>
		</div>	
</section>