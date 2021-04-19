<?php
/**
 * Modify links and make it more accessibile  
 * Add ARIA, screen-reader-text and svg icons to links
 *
 *
 *@see https://www.w3.org/WAI/GL/wiki/Using_aria-label_for_link_purpose
 *@since 17.9.6
 * */

 /*  This file is part of WordPress theme named Manduca - focus on accessibility.
 *
	Copyright (C) 2015-2019  Zsolt Edelényi (ezs@web25.hu)

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

namespace Manduca;


  
Class Link_Functions {
   
   // The links use this class are ignored
   const NOT_SIGNED = 'not-signed';
   
   protected $dom, $aria_labels, $classes;
   
   public function __construct () {
         // filters have high (late) priority to make sure that any markup plugins have done their HTML. 
         add_filter( 'the_content', array( $this , 'filter_links' ) , 999 );
         add_filter( 'the_excerpt', array( $this , 'filter_links' ) , 999 );
         add_filter( 'comment_text', array( $this , 'filter_links' ) , 999 );
         add_filter( 'widget_text', array( $this , 'filter_links' ) , 999 );
         add_filter( 'wp_list_pages', array( $this , 'filter_links' ) , 999 );
         add_filter( 'wp_list_categories', array( $this , 'filter_links' ) , 999 );
         add_filter( 'wp_tag_cloud', array( $this , 'filter_links' ) , 999 );
         //wp-archive has no filter, but Manduca has its own accessible widget for it.
   }
   
 
   
    /*
     * Filter the content of different parts of webpage (main,widget etc. )
     *
     * Comments:
     *     None of any Firefox version reads the aria-label attribute in Windows/JAWS. Therefore I still apply screen-reader text.
     *     Other browser sometimes read aria-label before the value of element, which is not satisfactory. 
     * 
     * @param string $content : HTMl markup of content to be modified. 
     * @return $string : modified HTML markup
     * 
    */
    public function filter_links( $content ) {
         // In the rare case that DOMDocument is not available we cannot reliably sniff content and so we assume legacy.
         if ( ! class_exists( '\DOMDocument' ) ) 
            return $content;
		
        libxml_use_internal_errors( true );
        $this->dom = new \DOMDocument;
        $content = mb_convert_encoding (
                  $content,
                  'HTML-ENTITIES',
                  'UTF-8'
                  );
          
        if( empty ( $content ) ) {
         return ;
        }
        
        
        $this->dom->encoding = 'utf-8'; //@see: https://stackoverflow.com/questions/6573258/domdocument-and-special-characters
        $this->dom->loadHTML( $content ); 
        libxml_use_internal_errors( false );
                            
        foreach ( $this->dom->getElementsByTagName('a') as $node) {
         
        
             /*If role="button", do not insert anything.
              *@since 19.1
              ***/
             if( 'button' === $node->getAttribute( 'role' )  ){
                continue;
             }
             
            /*
             *Set variables for the current cycle
             **/
            $href		    = $node->getAttribute( 'href' );
            $link_text 	    = $node->nodeValue;
            $link_text      = preg_replace('/[\x00-\x1F\x7F]/u', '', $link_text);  // filter invisible chars. 
            $this->aria_labels = array();
            $external_link  = false;
            // some people uses PHP < 5.6
            if( $node->getAttribute( 'class' ) )   {
                $this->classes = explode( ' ' , $node->getAttribute( 'class' ) ) ;
            }
            else{
                $this->classes        = array();    
            }
            if( in_array( self::NOT_SIGNED , $this->classes) ) {
               continue;
            }
            
           
           
             
            /*
             * Start analyzation
             **/
             if( ! $this->check_if_valid_link( $href ) ){
              continue;
             }

             
             
             /* Search for img child-node
              * and add role="presentation to it
              * The necessary text will be in aria-label
              * */
             $has_img_child = false;
             $child_nodes = $node->childNodes;
             foreach( $child_nodes as $child_node) {
                if( 'img' == $child_node->nodeName ) {
                   $has_img_child = true;
                   $attrs = $child_node->attributes;
                   foreach( $attrs  as $attr ) {
                      if( 'alt' == $attr->name) {
                         $alt_text = $attr->value ;
                        }
                    }
                }
            }
            
            
            
             if( $has_img_child ) {
                if( !isset( $alt_text ) || '' == $alt_text ) {
                    $post_title= get_the_title();
                    
                    if( ! empty( $post_title) ) {
                     //Translators: %s = title of post. This is an aria-label to a link  which has a children of an image, and image has no alt text. 
                     $this->aria_labels[] = sprintf( __( 'Image to the post titled: %s' , 'manduca' ),
                            $post_title
                           );
                    
                 } 
                unset( $post_title );
                }
                else{
                    //Translators: %s = alt text of image. This is an aria label to a link which has a children of an image.
                    $this->aria_labels[] = $alt_text;
                    
                    unset( $alt_text);
                }
                $this->classes[] ='attachment-link';
            }
             
            /*
             * URL schemes (eg. mailto, tel etc.)
            /* */
             elseif( false !== strpos( $href, ':' ) && 4 < strlen( $href ) && false === strpos( $href , 'http' ) ) {
                $node = $this->add_icon_to_url_schemes( $node, $href );
             }
        
        
            /*
             *Change self-link to <span>
             **/          
             elseif( $this->check_if_self_link( $href ) ) {
                $parent_node = 	$node->parentNode;
                $span_element 	= $this->dom->createElement( 'span', $node->nodeValue );
                $span_element->setAttribute(
                 'class',
                 'self-link'
                );
                
                $screen_reader_text = $this->dom->createElement(
                    'span',
                     // translators: this is the text read by screen readers only in case of you are in a html element referring to current page. 
                     $screen_reader_text =  __( 'Current page', 'manduca' ). ' '
                    );
                $screen_reader_text->setAttribute(
                    'class',
                    'screen-reader-text'
                 );
                $span_element 	= $this->dom->createElement( 'span', $node->nodeValue );
                $parent_node->insertBefore( $screen_reader_text, $node);
                $parent_node->insertBefore( $span_element, $node );
                $parent_node->removeChild( $node );
            }
            
            /*
             * Different types of If external =(outgoing link)
              */
            elseif( !$this->check_if_internal_link( $href ) ) {
                $external_link = true;
                $this->classes[] ='extlink';
                
                //Google map link
                    if( false !== strpos( $href, 'goo.gl/maps' ) || false !== strpos( $href, 'google.hu/maps' ) ) {
                    
                    //Translatos: add aria label to links to google maps. 
                    $this->aria_labels[] = __( 'open map', 'manduca' );
                                        
                 }
                
                 //all other external link
                 else{
                     //Translators: add screen-reader-text to external link.  
                     $this->aria_labels[] = __( 'external' , 'manduca' );
                     $node->appendChild( $this->create_svg_node( 'extlink') );
                     
                 }
                 
            } //end of external-link
                 
                 
            /*
             * Opens in new window (target="_blank")
             **/
            if( '_blank' == $node->getAttribute( 'target' ) ) {
                  /*
                   *Add rel=noopener to links open in new window
                   *@see: https://dev.to/ben/the-targetblank-vulnerability-by-example
                   @since 18.11, filter: 19.1
                   */
                  $rel = apply_filters( 'manduca_link_rel' , 'noopener noreferrer' );
                  if( ! empty( $rel ) && $external_link ){ 
                     $node->setAttribute(
                        'rel',
                        $rel
                     );
                     
                  }
               
                  $this->classes[] ='target-blank';
             } 
            
            if( false !== strpos( $href, '.' ) && 3 < strlen( $href ) ) {
               $len=strlen ($href);
               $use_tooltip=FALSE;
               foreach ($this->get_file_extensions_array() as $ext => $xx ){
                  if (substr ($href,-strlen ($ext))===$ext) {
                     $node = $this->add_icon_to_static_files( $node, $href );
                     $use_tooltip=TRUE;      
                     break;
                  }
               }
            }
            
            
            
            /*
             * End process of one link.
             * Add children to nodes (aria-label, tooltip)
             **/
            $this->add_new_window_signs( $node );
            if( !empty( $this->aria_labels ) ) {
               
                if( empty( $link_text ) ){
                    $info_text = implode( ', ', $this->aria_labels);
                }
                else{
                    $info_text = sprintf( '%s (%s)',
                                  $link_text,
                                  implode( ', ', $this->aria_labels)
                                  );
                }
                
                        
                $node->setAttribute( 'aria-label', $info_text);
                if (isset ($use_tooltip) && $use_tooltip) {
                  $node->appendChild( $this->create_tooltip_node( implode( ', ', $this->aria_labels ) ) );
                  $this->classes[] ='use-tooltipa';
                }
            }
                
            if( !empty( $this->classes ) ) {                
                $node->setAttribute( 'class', implode( ' ' , $this->classes ) ) ;
            }
      }
      
                
        /*
         *End the process.
         *save Html and exit
         **/
        $final_html 	= $this->dom->saveHtml();
        $search			= array(
                   '<html>',
                   '</html>',
                   '<body>',
                   '</body>'
                   );
        $replace		= array('', '', '', '');
        $final_html		= str_replace( $search, $replace,  $final_html );
        $regex			= '/^<!DOCTYPE.+?>/';
        
        $final_html		= preg_replace(
             $regex,
             '',
             $final_html
             );
        
        /* DomDocument needed html_entity_decode
        *@sicne 19.2
        **/
        
        return html_entity_decode( $final_html ) ;
   }
    
    
    /*
     *Add svg icon to nodes
    */
    protected function add_icon_to_static_files( $node, $href ) {
        $file_extension_array 	= $this->get_file_extensions_array();
        foreach( $file_extension_array as $extension => $data ) {	
            $needle 	= sprintf( '.%s' ,$extension );
            $needle_len	= strlen( $needle );
            $href_part	= substr( $href, - $needle_len, $needle_len );
            if( $href_part == $needle ) {
                $this->aria_labels[] = $data[ 'text' ];
                $node->appendChild( $this->create_svg_node( $data[ 'icon' ] ) ) ;
                //tooltip introduced in 19.2
                $node->setAttribute(
                           'class',
                           'use-tooltip'
                        );
                $this->create_tooltip_node( $data[ 'text' ] );
            }
        }
      
      return $node;
    }
       
   
    /*
     *Add icon and tooltip to node
     *
     *@param (object) $node
     *@param (string)
     **/
    protected function add_icon_to_url_schemes( $node, $href ) {
        $url_scheme_array 	= $this->get_url_scheme();
        foreach( $url_scheme_array as $scheme => $data ) {	
            $needle 	= sprintf( '%s:' ,$scheme );
            $needle_len	= strlen( $needle );
            $href_part	= substr( $href, 0, $needle_len );
            if( $href_part == $needle ) {
                $this->aria_labels[] = $data[ 'text' ];
            }
        }
        return $node;
   }
   
   
    protected function check_if_valid_link( $url ) {
     if( 0 == strlen( $url ) )  {
      return false;
     }
     
     if( 1 == strlen( $url )) {
        if( '/' != $url[0] )  {
       return false;
        }
     }
     
     return true;
    }
   
   
   
   
   /*
    *Check if url is internal link
    *
    *@param string $url : URL to examine and decide if it's an internal-link or not.
    *@return bool       : true - if it is internal link,
    *                     false - if it is external link. 
    **/
   protected function check_if_internal_link( $url ) {
    
    $url = str_replace( '\\', '/' , $url );
    if( '/' ==  $url[0] ) {
     return true;
    }
    // pl. './valami'
    elseif( '.' ==  $url[0] ) {
     return true;
    }
    elseif( 'index.php?' == substr( $url, 0, 10 ) ) {  
       return true;
    }
    $correct_domain_array 	= parse_url( $url );
         
   if( isset( $correct_domain_array[ 'scheme' ] ) ) {
     $url = str_ireplace( $correct_domain_array[ 'scheme' ], '' , $url );
    }
  
    if( isset( $correct_domain_array[ 'host' ] ) ){
       $correct_domain	= $correct_domain_array[ 'host' ];
    }
    else {
     
      $regex = '%^(?:www\.)?(.*?)\.(?:com|au\.uk|co\.in|net|org|hu|gov)$%'; //https://stackoverflow.com/questions/569137/how-to-get-domain-name-from-url
      if( 1 == preg_match( $regex, $url , $result ) ) {
          $correct_domain = $result[1];
      }
      else {
         // e.g. 'wp-content/uploads/img.jpg'
         return true;
      }
    }
    
    $home_parse_array = parse_url( home_url() );  //@since 18.7.2	   
    $home_host 			= $home_parse_array[ 'host' ];
     
    if( function_exists ( 'idn_to_utf8' ) ) {
        $home_host 		= idn_to_utf8( $home_host ); // some server does not have this function . See. http://www.queryadmin.com/1491/call-undefined-function-idn_to_utf8/
        $correct_domain	= idn_to_utf8( $correct_domain );
    }
    if( $home_host  == $correct_domain ) {
       return true ;	
    }
    return false;
   }
   
   /*
    *Create svg node to the dom document.
    *
    *@uses $GLOBALS[ 'svg_icons' ]
    *
    *@param (string) name of svg icon close is the default icon if it is empty
    *
    *@return false 
    *
    **/
   protected function create_svg_node( $svg = 'close' ) {
    if( !isset( $GLOBALS[ 'svg_icons' ][ $svg ] ) ) {
     $svg = 'close';
    }
    
     $svg_array = $GLOBALS[ 'svg_icons' ][ $svg ] ;
     $svg_node 	= $this->dom->createElement( 'svg' );
        
    //aria-hidden attributum
    $svg_attr = $this->dom->createAttribute( 'aria-hidden' );
    $svg_attr->value = 'true' ;
    $svg_node->appendChild( $svg_attr ) ; 
    $svg_attr = $this->dom->createAttribute( 'class' );
    $svg_attr->value = sprintf( 'icon-%s',
           $svg
          );
    $svg_node->appendChild( $svg_attr ) ; 
    
    //viewbox attr. 
    $svg_attr = $this->dom->createAttribute( 'viewbox' );
    $svg_attr->value = $svg_array[ 'viewBox' ];
    $svg_node->appendChild( $svg_attr ) ; 
    
    
    // path child
    $svg_path = $this->dom->createElement( 'path' );
    $svg_path_attr = $this->dom->createAttribute( 'd' );
    $svg_path_attr->value = $svg_array[ 'path' ]	;
    $svg_path->appendChild( $svg_path_attr );
    $svg_node->appendChild( $svg_path );
    return $svg_node;
   }
   
   protected function check_if_self_link( $href ) {
    $href	= rtrim( urldecode( $href ) ,'/' ) ;
    global $wp;
    $current_url	= home_url( $wp->request );
    $current_url	= urldecode( $current_url );
    $current_url 	=  rtrim ( $current_url, '/' );
    
    if( $href == $current_url ) {
     return true;
    }
    return false;
   }
   
   
   /*
    *Returns the available extensions (doc, xls, etc.
    *
    *@return array : data ofextensions
   */
   protected function get_file_extensions_array() {
    $extenstion_array = array(
      'docx'		=> array(
       'text' 	=> __( 'MS Word document', 'manduca' ),
       'icon'	=> 'word'
       ),
      'doc'		=> array(
       'text' 	=> __( 'MS Word document', 'manduca' ),
       'icon'	=> 'word'
       ),
      'odt'		=> array(
       'text' 	=> __( 'MS Word document', 'manduca' ),
       'icon'	=> 'word'
       ),
      'xls'		=> array(
       'text'		=> __( 'MS Excel document', 'manduca' ),
       'icon'		=> 'excel'
       ),
      'xlsx'		=> array(
       'text'		=> __( 'MS Excel document', 'manduca' ),
       'icon'		=> 'excel'
       ),
      
      'pdf'		=> array(
       'text'		=> __( 'PDF document', 'manduca' ),
       'icon'		=> 'pdf'
       ),
      'epub'	=> array(
       'text'		=> __( 'Electronic book' , 'manduca' ),
       'icon'		=> 'epub'
       )
      );
    /*
     *filter manduca_extenstion_array
     */
     return apply_filters( 'manduca_extenstion_array' , $extenstion_array );
   }
   
   
   
   
   
   protected function get_url_scheme(){
    $url_schemes = array(
     'mailto'	=> array(
       //translator aria label for epub and other electronic book type link
       'text'		=> __( 'Send email' , 'manduca' ),
       'icon'		=> 'at'
       ),
     'tel'	=> array(
       //translator aria label for epub and other electronic book type link
       'text'		=> __( 'Call on phone' , 'manduca' ),
       'icon'		=> 'phone'
       )
    );
    /*
     *filter manduca_url_sheme_array
     *Filter the aria label texts and icons added to the links of schemes (mailto, tel )
     **/    
    return apply_filters( 'manduca_url_scheme_array' , $url_schemes );
   }
   
   
   
   
   
   /*
    * Add screen-reader text to $parent_node
    *(not used yet)
    *
    * @param string  $screen_reader_text : the text to add. 
    * @param domNode class               : $partent_node
    *
    * @return domNode class;
    **/
   protected function create_screen_reader_text_node ( $screen_reader_text ) {
         $node = $this->dom->createElement(
             'span',
              $screen_reader_text
             );
         $node->setAttribute(
             'class',
             'screen-reader-text'
          );
              
       return $node;
   }
   
    /*
    * Add tooltip to $parent_node
    *
    * @param string  $tooltip:          the text to add. 
    * @param domNode class               : $partent_node
    *
    * @return domNode class;
    **/
    protected function create_tooltip_node ($tooltip) {
         $node = $this->dom->createElement(
             'span',
              $tooltip
             );
         $node->setAttribute(
             'class',
             'tooltip'
          );
              
       return $node;
    }
    
    
    
    
    
    /*
     *Add new windows icon and aria-label
     *@since 19.3
     **/
      protected function add_new_window_signs( $node ) {
         $needed = false;
         if( in_array( 'target-blank', $this->classes) ) {
               $needed = true;   
         }
         if( isset( $_COOKIE[ 'linkTarget'] ) && 'self' === $_COOKIE[ 'linkTarget'] ) {
               $needed = false;
         }
         if( isset( $_COOKIE[ 'linkTarget'] ) && 'blank' === $_COOKIE[ 'linkTarget'] ) {
               $needed = true;
         }
         
         if( $needed ) {   
            //Translators: add screen-reader-text if links open in new window. 
            $this->aria_labels[] = __( 'opens a new window' , 'manduca' ) ;
            $node->appendChild( $this->create_svg_node( 'new-window') );
         }
         return $node;
      }
 }