<?php
/*
 *footer site info
 *
 * &since 17.3
 **/


    
/*
 * filter of copyright text
 * @since 16.12
 * */

echo apply_filters( 'manduca_copyright_text' , sprintf (
                                                        '<p class="copyright-text">&copy; %1$s, %2$s</p>',
                                                        date( 'Y' ),
                                                        get_bloginfo()
                                                        ) ) ;
?>
        
