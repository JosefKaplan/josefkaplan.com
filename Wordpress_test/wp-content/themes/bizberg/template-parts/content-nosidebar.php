<div id="post-<?php the_ID(); ?>" <?php post_class('col-md-4 col-sm-6 col-xs-12 blog-listing no-sidebars'); ?>>

    <div class="blog-post blog-large">
        <article>
            <header class="entry-header">
            	<?php 
            	if( has_post_thumbnail() ){ ?>
                    <a href="<?php the_permalink(); ?>" class="featured_image_link">
    	                <div class="entry-thumbnail">
    	                    <?php 
    	                    the_post_thumbnail( 
    	                    	'large', 
    	                    	array( 
    	                    		'class' => 'img-responsive', 
    	                    		'alt' => esc_attr( get_the_title() ) 
    	                    	) 
    	                    ); ?>
    	                </div>
                    </a>
	                <?php 
	            } 

                $hide_date = bizberg_get_theme_mod( 'hide_post_date' ); 
                $title_margin_top = 'margin-top:0';

                if( $hide_date == false ){ ?>
                    <div class="entry-date">
                    	<a href="<?php echo esc_url( home_url() ); ?>/<?php echo esc_attr( date( 'Y/m' , strtotime( get_the_date() ) ) ); ?>"><?php echo esc_html( get_the_date() ); ?></a>
                    </div>
                    <?php 
                    $title_margin_top = '';
                } ?>

                <h4 class="entry-title" style="<?php echo esc_attr( $title_margin_top ); ?>">
                	<a href="<?php the_permalink(); ?>">
                		<?php the_title(); ?>		
                	</a>
                </h4>
            </header>

            <div class="entry-content">
                <?php the_excerpt(); ?>
            </div>

            <?php 
            $hide_author = get_theme_mod( 'hide_author' , 0 );
            $hide_category = get_theme_mod( 'hide_category' , 0 );
            $hide_comment = bizberg_get_theme_mod( 'hide_comment' );
            $hide_read_time = bizberg_get_theme_mod( 'hide_read_time' );

            if( $hide_author == 1 && $hide_category == 1 && $hide_comment == true && $hide_read_time == true ){
                $hide_meta = 'display:none;';
            } else{
                $hide_meta = 'display:block;';
            }
            ?>

            <div class="entry-meta" style="<?php echo esc_attr( $hide_meta ); ?>">

            	<?php             	

            	if( $hide_author == 0 ){ ?>
	                <span class="entry-author">	                	
	                	<a href="<?php echo esc_url( get_author_posts_url( $post->post_author ) ); ?>">
	                		<i class="fa fa-user"></i> <?php bizberg_get_display_name( $post ); ?>
	                	</a>
	                </span>
	                <?php 
                } 

                if( $hide_category == 0 ){ ?>

	                <span class="entry-category">
	                	<?php bizberg_post_categories( $post , 1 ); ?>
	                </span>

	                <?php 
	            } 

                if( $post->post_type == 'post' && $hide_comment == false ){  ?>

                    <span class="entry-comments">
                        <?php 
                        bizberg_get_comments_number( $post );
                        ?>
                    </span>

                    <?php 
                
                } 

                if( $post->post_type == 'post' && $hide_read_time == false ){  ?>

                    <span class="bizberg_read_time">                                
                        <?php bizberg_blog_read_time( $post ); ?>         
                    </span>

                    <?php 
                    
                } ?>

            </div>

        </article>

    </div>

</div>