<?php
 /*
  * Display entry header
  * Display the header of the article in two-column format. 
  *
  * Called from excerpt template
  * since @16.8
  * */
 
?>
<?php if ( is_sticky() &&  ! is_paged() ) : ?>
						<div class="featured-post featured-scheme"><?php _e( 'Featured', 'manduca' ) ?></div>
<?php endif; ?>

<div class="columns-mask">
	<div class="columns-wrapper">
		<div class="column-right-wrapper">
			<div class="column-right">
					
	
				<?php if ( is_single() ) :
					printf( '<h1 id="post-%1$s-title" tabindex="0">%2$s</h1>',
						   get_the_ID(),
						   get_the_title()
						  );
					
					elseif( is_search() ) :
					$title = Search_Functions::emphasize( get_the_title(), get_search_query() );

					printf( '<h2 class="entry-title"><a  id="post-%3$s-title" href="%1$s" rel="bookmark">%2$s</a></h2>',
						   esc_url( get_permalink() ),
						   $title,
						   get_the_ID()
						   );
					
					else : 
					printf( '<h2 class="entry-title"><a href="%1$s" id="post-%2$s-title" class="underlined" rel="bookmark">%3$s</a></h2>',
						   get_permalink(),
						   get_the_ID(),
						   get_the_title()
						  );
				endif; // is_single() ?>
				
				<?php do_action( 'manduca_post_subtitle' ); ?>
					
			</div>
		</div>
		
		<div class="column-left">
		
				<?php
				$month 		= esc_html( get_the_date( 'M' ) );
				$day		= esc_html( get_the_date( 'j' ) );
				$date_mask	='<p class="content-date"><time class="entry-date inverse-scheme" datetime="%1$s"><span class="entry-date-month">%4$s</span> <span class="entry-date-day">%3$s</span> <span class="entry-date-year">%2$s</span></time></p>';
	
				if ( strpos ( get_bloginfo( 'language' ), 'hu' ) !== FALSE ) {
						// setlocale(LC_ALL, 'hu_HU.UTF8'); not worki with PHP7 removed @17.10.7
						$short_month_array = array('','jan.','febr.','márc.','ápr.','máj.','jún.','júl.','aug.','szept.','okt.','nov.','dec.');
						$month =$short_month_array[ get_post_time( 'n' ) ] ;
						$day 		.= '.';
						$date_mask	='<p class="content-date inverse-scheme"><time class="entry-date " datetime="%1$s"><span class="entry-date-year">%2$s.</span> <span class="entry-date-month">%4$s</span> <span class="entry-date-day">%3$s</span></time></p>';
	
				}
				
				/*
				 *  Filter of content date of the entry header
				 * @ since 16.8
				 * */
				echo apply_filters( 'manduca_content_date', 
					sprintf( $date_mask,
						esc_attr( get_the_date( 'c' ) ),
						esc_attr( get_the_date( 'Y' ) ),
						$day,
						$month
				   )
				); ?>
		
		</div>
	</div>	
</div>
	
		
	
 