<?php
/**
 * Displays an accessibility-friendly link to edit a post or page.
 *
 * This also gives us a little context about what exactly we're editing
 * (post or page?) so that users understand a bit more where they are in terms
 * of the template hierarchy and their content. Helpful when/if the single-page
* layout with multiple posts/pages shown gets confusing.
 * @Theme: Manduca - focus on accessibility
 * @since 17.9
 **/
?>

<?php if( is_user_logged_in() ) : ?> 

<div class="edit-link">
    
    <?php manduca_get_svg ( array( 'icon' => 'pencil' ) ); ?>
    
    <a href="<?php echo get_edit_post_link(); ?>">
        <?php _e( 'Edit', 'manduca' ); ?>
        <span class="screen-reader-text">
            "<?php the_title(); ?>"
        </span>
    </a>
</div>

<?php endif; ?>