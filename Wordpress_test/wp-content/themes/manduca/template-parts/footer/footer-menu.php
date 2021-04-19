<?php
/*
 *Footer site info
 *
 * for duplicating HTML5 and ARIA landmark:
 * @see: https://dequeuniversity.com/assets/html/jquery-summit/html5/slides/landmarks.html
 *
 * &since 17.3
 **/

    
    // Translators: name of the footer menu for screen-reader users. 
    $menu_name = __( 'Footer navigation', 'manduca' );
    ?>
    
    <?php if ( has_nav_menu( 'footer' ) ) : ?>
        
        <nav id="footer-navigation"
             class="footer-navigation"
             role="navigation">
            <h3 class="screen-reader-text"><?php echo $menu_name; ?></h3>       
            
            <?php
                echo wp_nav_menu(array (
                    'echo' => false,
                    'fallback_cb' => '__return_false',
                    'container'       	=> false,
                    'theme_location' 	=> 'footer',
                    'menu_class' 		=> 'footer-menu',
                    'depth'             => 1    //only one level should be included in footer menu
                ) );
            ?>

        </nav>
    
    <?php endif; ?>
