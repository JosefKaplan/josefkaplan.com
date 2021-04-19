<?php
/**
 * Custom Search Form
 *
 * @package Canyon Themes
 * @subpackage Quality Construction
 */
global  $quality_construction_placeholder_option;
?>
<div class="search-block">
    <form action="<?php echo esc_url( home_url() )?>" class="searchform search-form" id="searchform" method="get" role="search">
        <div>
            <label for="menu-search" class="screen-reader-text"></label>
            <?php
            $quality_construction_placeholder_text = '';
             $quality_construction_placeholder_option = quality_construction_get_option( 'quality_construction_post_search_placeholder_option');
            if ( !empty( $quality_construction_placeholder_option) ):
                $quality_construction_placeholder_text = 'placeholder="'.esc_attr ( $quality_construction_placeholder_option ). '"';
            endif; ?>
            <input type="text" <?php echo $quality_construction_placeholder_text ;?> class="blog-search-field" id="menu-search" name="s" value="<?php echo get_search_query();?>">
            <button class="searchsubmit fa fa-search" type="submit" id="searchsubmit"></button>
        </div>
    </form>
</div>