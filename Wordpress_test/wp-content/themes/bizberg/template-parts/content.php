<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bizberg
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class('col-sm-12 col-xs-12 blog-listing'); ?>>

    <div class="blog-post blog-large blog-grid bizberg-list">

        <article>

            <div class="row">

            	<?php 
            	$sidebar_settings = get_theme_mod( 'sidebar_settings' , 1 );
            	$image_size = ( $sidebar_settings == 3 ? 'bizberg_blog_list_no_sidebar_1' : 'bizberg_blog_list' );

            	
            	if( has_post_thumbnail() ){

                    $post_image_id = get_post_thumbnail_id();
                    $image_attributes = wp_get_attachment_image_src( $post_image_id , 'medium_large' );

                    $post_image_url = '';
                    if( !empty( $image_attributes[0] ) ){
                        $post_image_url = $image_attributes[0];
                    } ?>

                    <div class="col-xs-5 list_image_wrapper"> 
        	            <header class="entry-header">
                            <a href="<?php the_permalink(); ?>" class="featured_image_link">
            	                <div class="entry-thumbnail" style="background-image: url( <?php echo esc_url( $post_image_url ); ?> )">
                                    <div class="image-overlay"></div>
            	                </div>	    
                            </a>     
        	            </header>
                    </div>

    	           	<?php 	           	
    	        } 

                $hide_date = bizberg_get_theme_mod( 'hide_post_date' ); ?>

                <div class="<?php echo ( has_post_thumbnail() ? 'col-xs-7' : 'col-xs-12' ); ?>"> 
                    <div class="entry-content">

                        <?php 
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
                        
                        <?php 
                        the_excerpt();

                        $hide_author = get_theme_mod( 'hide_author' , 0 );
                        $hide_category = get_theme_mod( 'hide_category' , 0 );
                        $hide_comment = bizberg_get_theme_mod( 'hide_comment' );
                        $hide_read_time = bizberg_get_theme_mod( 'hide_read_time' );

                        if( $hide_author == 1 && $hide_category == 1 && $hide_comment == true && $hide_read_time == true ){
                            $hide_meta = 'display:none;';
                        } else{
                            $hide_meta = 'display:block;';
                        } ?>

                        <div class="entry-meta" style="<?php echo esc_attr( $hide_meta ); ?>">

                            <?php                            

                            if( $hide_author == 0 ){ ?>
                                <span class="entry-author">                                    
                                    <a href="<?php echo esc_url( get_author_posts_url( $post->post_author ) ); ?>">
                                        <i class="far fa-user"></i>  <?php bizberg_get_display_name( $post ); ?>
                                    </a>
                                </span>
                                <?php 
                            } 

                            /**
                            * @param $category (boolean/string)
                            * if return false, no category is defined
                            * if string, dispaly the category
                            */

                            $category =  bizberg_post_categories( $post,1,false,false );
                            if( $hide_category == 0 && $category != false ){ ?>

                                <span class="entry-category">
                                    <?php echo wp_kses_post( $category ); ?>
                                </span>

                                <?php 
                            } 

                            if( $post->post_type == 'post' && $hide_comment == false ){ ?>

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
                        
                    </div>
                </div>

            </div>

        </article>
    </div>
</div>