<?php
/**
 * Add accordion script to page and customize
 *
 * This function should be added to footer when needed. 
 *
 * @ Theme: Manduca - focus on accessibility
 * &since 17.9.5
 *
 * 
 * Remark: The is_page_template WP function do not work (why?),
 * consequeintly I could not enquing scripts.
 * This is the reason I add directly to this page. 
 * 	
 */

class Accordion{
		  public $accordion_args;
		  
		  public function __construct( $args ) {
					$this->accordion_args = $args;
		  }
		  
		  public function add_hook_to_wp(){
					add_action( 'wp_enqueue_scripts', array(  $this, 'accordion' ) , 990 );
					
					
		  }
		  
		  public function accordion() {
				  wp_enqueue_style( 'manduca-accordion-style', get_template_directory_uri() . '/assets/css/accordion.css'  );
				  wp_enqueue_script( 'manduca-accordion-script', get_template_directory_uri() . '/assets/js/accordion.js', array( 'jquery' ), '', 'true'); 
				  wp_localize_script( 'manduca-accordion-script', 'manducaAccordionArgs', $this->accordion_args );	  
		  }
		  
		
 }