<?php
/**
 * Template of site title and blog description 
 *
 *
 * @since 17.1
 * @last modification: 18.10.3
 *
 * */

 /*
  * identify the front page is not so simple: 
    On the site front page, is_front_page() will always return TRUE, regardless of whether the site front page displays the blog posts index or a static page.
    On the blog posts index, is_home() will always return TRUE, regardless of whether the blog posts index is displayed on the site front page or a separate page.
    
*/
 
 
/*  This file is part of WordPress theme named Manduca - focus on accessibility.
 *
	Copyright (C) 2015-2018  Zsolt Edelényi (ezs@web25.hu)

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

 
 ?>

 
<?php $site_title = str_replace (' | ', '<br />', get_bloginfo( 'name' ) )  //replace | with line-break  since @17.4 ; ?>
 
<?php if( is_front_page() && empty( get_query_var('paged'))) : ?>
    
        <div class="site-title">
            <span class="display-site-title"><?php echo $site_title; ?> </span>
        </div>
        
<?php else :  ?>
    <div class="site-title">
        <a href="<?php echo esc_html (home_url( '/' ));  ?>" rel="home">
            <span class="screen-reader-text"><?php _e( 'Jump to homepage' , 'manduca' ) ; ?></span>
            <span class="display-site-title"><?php echo $site_title; ?></span>
        </a>
    </div>

<?php endif; ?>