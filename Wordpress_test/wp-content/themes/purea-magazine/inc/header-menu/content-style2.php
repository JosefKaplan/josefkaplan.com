<?php
/**
 * Template part for displaying header menu
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package purea-magazine
 */

?>

<?php
	$page_val = is_front_page() ? 'home' : 'page' ;
?>
<header id="<?php echo esc_attr($page_val); ?>-inner" class="elementor-menu-anchor theme-menu-wrapper full-width-menu style2 page" role="banner">
	<?php
		if(true===get_theme_mod('purea_magazine_enable_highlight_area',true) && is_front_page()) {
			?><a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'purea-magazine' ); ?></a><?php
		}
		else{
			?><a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'purea-magazine' ); ?></a><?php
		}
	?>
	<?php
		if(true===get_theme_mod('purea_magazine_enable_top_bar',true)) {
			/**
	        * Hook - purea_magazine_action_top_bar_style2
	        *
	        * @hooked purea_magazine_top_bar_style2 - 10
	        */
	        do_action( 'purea_magazine_action_top_bar_style2' );
		}
	?>
	<div id="header-main" class="header-wrapper">
		<div class="container">
			<div class="clearfix"></div>
			<div class="logo">
       			<?php 
       				if (has_custom_logo()){
	                	purea_magazine_custom_logo();
	                }	                		                	
                ?>
                <?php 
                    $alt_logo=esc_url(get_theme_mod( 'purea_magazine_sticky_logo' ));
                	if(!empty($alt_logo)) {
	                	?>
	                		<a id="logo-alt" class="logo-alt" href="<?php echo esc_url(home_url( '/' )); ?>"><img src="<?php echo esc_url( get_theme_mod( 'purea_magazine_sticky_logo' ) ); ?>" alt="logo"></a>
	                	<?php
	                }		                
	            ?>
                <h1 class="site-title">
			        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			    </h1>
			    <?php
			        $description = get_bloginfo( 'description', 'display' );
			        if ( $description || is_customize_preview() ) { 
			            ?>
			                <p class="site-description"><?php echo $description; ?></p>
			            <?php 
			        }
			    ?>
			</div>
			<div class="top-menu-wrapper">
				<nav class="top-menu" role="navigation" aria-label="<?php esc_attr_e( 'primary', 'purea-magazine' ); ?>">
					<div class="menu-header">
						<span><?php esc_html_e('MENU','purea-magazine'); ?> </span>
				     	<button type="button" class="hd-bar-opener navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
					       	<span class="sr-only"><?php esc_html_e( 'Toggle navigation', 'purea-magazine' ); ?></span>
					      	<span class="icon-bar"></span>
					       	<span class="icon-bar"></span>
					       	<span class="icon-bar"></span>
				     	</button>
				   	</div>
					<div class="navbar-collapse collapse clearfix" id="navbar-collapse-1">
				   		<?php
			                wp_nav_menu( array(			                  	
			                  	'theme_location'    => 'primary',
			                  	'depth'             => 3,
			                  	'container'         => 'ul',
			                  	'container_class'   => 'navigation',
			                  	'container_id'      => 'menu-primary',
			                  	'menu_class'        => 'navigation',
			                  	)
			                );
		             	?>							
				   	</div>
				</nav>
	        </div>
		</div>
		
    </div>
</header>

<!-- Side Bar -->
<section id="hd-left-bar" class="hd-bar left-align mCustomScrollbar" data-mcs-theme="dark">
    <div class="hd-bar-closer">
        <button><span class="qb-close-button"></span></button>
    </div>
    <div class="hd-bar-wrapper">
        <div class="side-menu">
        	<?php
		    	/**
		        * Hook - purea_magazine_action_search_content
		        *
		        * @hooked purea_magazine_search_content - 10
		        */
		        do_action( 'purea_magazine_action_search_content' );
		    ?>
        	<nav role="navigation">
	            <div class="side-navigation clearfix" id="navbar-collapse-2">
			   		<?php
		                wp_nav_menu( array(			                  	
		                  	'theme_location'    => 'primary',
		                  	'depth'             => 3,
		                  	'container'         => 'ul',
		                  	'container_class'   => 'navigation',
		                  	'container_id'      => 'menu-primary-mobile',
		                  	'menu_class'        => 'navigation',
		                  	)
		                );
	             	?>							
			   	</div>
			</nav>
        </div>
    </div>
</section>

<?php
	if(true===get_theme_mod('purea_magazine_enable_trending_news',true)) {

		/**
        * Hook - purea_magazine_action_trending_news
        *
        * @hooked purea_magazine_trending_news - 10
        */
        do_action( 'purea_magazine_action_trending_news' );
	}
?>

<div class="clearfix"></div>
<div id="content" class="elementor-menu-anchor"></div>

<?php
	if(true===get_theme_mod('purea_magazine_enable_highlight_area',true)) {
		/**
	    * Hook - purea_magazine_action_highlight_area
	    *
	    * @hooked purea_magazine_highlight_area - 10
	    */
	    do_action( 'purea_magazine_action_highlight_area' );
	}
?>
<div class="container">