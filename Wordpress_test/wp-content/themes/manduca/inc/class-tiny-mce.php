<?php
/**
 * Add tinyMCE functions, stylesheets
 *
 * @ Theme: Manduca - focus on accessibility
 *
 **/
 
class Tiny_Mce {
	
	public function add_hooks_to_wp() {
		
		// Add accessible format options to TinyMCE. 
		add_filter( 'tiny_mce_before_init', array ( $this, 'tinymce_formats' ) );
	
		//Add tiny MCE 2 core buttons that's disabled by default and stylebutton
		add_filter( 'mce_buttons_2', array( $this, 'core_buttons' ) );
				   
		// Add ediotor stylesheet to tiny mce
		add_action( 'admin_init', array( $this, 'editor_css' ) );
		
	}
	
	
   function tinymce_formats( $init_array ) {
	   
	   // Define the style_formats array
	   $style_formats = array(  
		   // Each array child is a format with it's own settings
		   array(  
			   'title' => __( 'Highlight-2' , 'manduca' ) ,
			   'block' => 'div',  
			   'classes' => 'highlight-1 inverse2',
			   'wrapper' => true,
			   
		   ),  
		   array(  
			   'title' => __( 'Highlight-1' , 'manduca' ) ,  
			   'block' => 'div',  
			   'classes' => 'highlight-2 inverse3',
			   'wrapper' => true,
		   ),
		   array(  
			   'title' => __( 'Quotation' , 'manduca' ),  
			   'inline' => 'q',  
			   'wrapper' => true,
		   ),
			   array(  
			   'title' => __( 'Abbreviation' , 'manduca' ),  
			   'inline' => 'abbr',  
			   'wrapper' => true,
		   )
	   );
	   
	   $init_array['style_formats'] = json_encode( $style_formats );
	   
	   // replace block formats with elements helps bulding an accessibile content
		   $block_formats 			= 'Paragraph=p; ' .__( 'Heading 2', 'manduca' ) .'=h2; ';
		   $block_formats 			.= __( 'Heading 3', 'manduca' ) .'=h3; ';
		   $block_formats 			.= __( 'Preformatted', 'manduca' ) .'=pre; ';
		   $block_formats			.= __( 'Blockquote', 'manduca') .'=blockquote;';
		   
		   $init_array[ 'block_formats' ] = $block_formats;
			   
	   return $init_array;  
   }
   
	
   function core_buttons( $buttons ) {	
	   $buttons[] = 'superscript';
	   $buttons[] = 'subscript';
	   array_unshift( $buttons, 'styleselect' );
	   return $buttons;
   }
   
   function editor_css() {
	   add_editor_style( '/assets/css/manduca-tinymce.css' );    
   }  
}