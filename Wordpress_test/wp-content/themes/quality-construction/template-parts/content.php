<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Canyon Themes
 * @subpackage Quality Construction
 */
$description_from = quality_construction_get_option( 'quality_construction_blog_excerpt_option');
$description_length = quality_construction_get_option( 'quality_construction_description_length_option');
$readme_text = quality_construction_get_option( 'quality_construction_read_more_text_blog_archive_option');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
     <div   class="section-14-box wow fadeInUp <?php if(!has_post_thumbnail()) { echo "no-image"; } ?>">
             <div class="date" ><span><?php echo esc_html( get_the_date('M')) ?> </span> - <?php echo esc_html(get_the_date('d')) ?><br><span><?php echo esc_html( get_the_date('Y')) ?></span></div>
             <?php 
                 if(has_post_thumbnail()) {
    	         the_post_thumbnail('full', array('class' => 'img-responsive'));
                 }
    	    ?>
              <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              <div class="row">
                <div class="col-md-12">
                  <div class="text-left comments"><i class="fa fa-user"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"><?php the_author(); ?></a></div>
                </div>
              </div>
               <?php
               echo "<p>";
               if($description_from=='content')
               {
                   echo esc_html( wp_trim_words(get_the_content(),$description_length) );
               }
               else
               {
                   echo esc_html( wp_trim_words(get_the_excerpt(),$description_length) );
               }
               echo "</p>";
               ?>

              <div class="row">
                <div class="col-md-12">
                 <?php 
                  if(!empty($readme_text))
                  {
                 ?>
                    <div class="text-left"><a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php  echo esc_html($readme_text); ?></a></div>
                </div>
               <?php } 
                 wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:','quality-construction'),
                        'after'  => '</div>',
                      ) );
                    ?>
              </div>
       </div>
  </article><!-- #post-## -->







