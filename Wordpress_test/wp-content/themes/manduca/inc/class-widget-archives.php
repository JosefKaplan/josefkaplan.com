<?php
/**
 * Enhanced archive widget
 *
 * The archive widget (archive by months) may have very long: more hundreds item in select menu.
 *  This is reduced significantly with 2 select menus: year and months. 
 * 
 *@since 19.2
 */

 /*  This file is part of WordPress theme named Manduca - focus on accessibility.
 *
	Copyright (C) 2015-2019  Zsolt Edelényi (ezs@web25.hu)
	Source code is available at https://github.com/batyuvitez/manduca

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    in assets/docs/licence.txt.  If not, see <https://www.gnu.org/licenses/>.
*/


namespace Manduca;

 
class Widget_Archives extends \WP_Widget {
	
   const WIDGET_ID = 'manduca_archive';
	
	protected $archive_array = array();
	
	/**
	 * Sets up a new Archives widget instance.
	 *
	 * @since 2.8.0
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_archive',
			// translators: description of Manduca's accessible archive widget
			'description' => __( 'You have two dropdown: one for years and one for months. This is easy-to use.', 'manduca' ),
			'customize_selective_refresh' => true,
		);
		// translators: name of Manduca's accessible archive widget
		parent::__construct( self::WIDGET_ID, __(' User-friendly archives' , 'manduca' ), $widget_ops);
		
		add_action(
				   'manduca_ajax_call',
				   array( $this, 'get_archive_months')
				   ); 
		
	}

	
	
	
	/**
	 * Outputs the content.
	 *
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Archives widget instance.
	 */
	public function widget( $args, $instance ) {
		global $wp_locale;
				
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'User friendy archives', 'manduca' );
		
		$c = ! empty( $instance['count'] ) ? '1' : '0';
		
		echo $args['before_widget'];
		
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		
		$dropdown_id = "{$this->id_base}-dropdown-{$this->number}";
		$dropdown_html = $this->get_archives(  array('show_post_count'   => $c) ) ;
		
				
		// translators: first (year) select menu's text in archive widget
		$year_select_text = __( 'Select year', 'manduca' );
		
		// translators: second (month) select menus's text in archive widget until no year selected.
		$month_select_text = __( 'First select year', 'manduca');
		?>
		
		<select id="manduca-archive-year-dropdown" name="manduca-archive-year-dropdown" >
		 <option value="" disabled selected><?php echo $year_select_text; ?></option>
		<?php
			foreach( $dropdown_html as $year => $months ) {
				printf( '<option value ="%1$s">%1$s</option>', $year );
			}
		?>
		</select>
		
		
		<select id="manduca-archive-month-dropdown" name="manduca-archive-month-dropdown" >
			<option disabled selected><?php echo $month_select_text; ?></option>
		</select>
		<button id="manduca_archive-month-submit"><?php _e( 'Filter posts', 'manduca' ) ?></button>
		
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Handles updating settings for the current Archives widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget_Archives::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, array( 'title' => '') );
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		
		return $instance;
	}

	
	
	/**
	 * Outputs the settings form for the Archives widget.
	 * Copied from WordPress' archive widget
	 * 
	 *
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => 0 ) );
		$title = sanitize_text_field( $instance['title'] );
		?>
		<p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'manduca' ); ?></label>
         <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
      </p>
		
		<?php
	}
    
    
    
    /**
     * Return archive links based on type and format.
     * Copy of wp_get_archives in general-template.php and modified.  
     *
     * @see get_archives_link()
     * @global wpdb     
     * @global wp_locale
     *
     * @param string|array $args {
     *     Default archive links arguments. Optional.
     *
     *     @type string|int $limit           Number of links to limit the query to. Default empty (no limit).
     *     @type string     $before          Markup to prepend to the beginning of each link. Default empty.
     *     @type string     $after           Markup to append to the end of each link. Default empty.
     *     @type bool       $show_post_count Whether to display the post count alongside the link. Default false.
     *     @type string     $order           Whether to use ascending or descending order. Accepts 'ASC', or 'DESC'.
     *                                       Default 'DESC'.
     *     @type string     $post_type       Post type. Default 'post'.
     * }
     * @return string|void String when retrieving.
     */
    public function get_archives( $args = '' ) {
        global $wpdb, $wp_locale;
    
        $defaults = array(
            'limit' => '',
            'order' => 'DESC',
            'post_type' => 'post'
        );
    
        $r = wp_parse_args( $args, $defaults );
    
        $post_type_object = get_post_type_object( $r['post_type'] );
        if ( ! is_post_type_viewable( $post_type_object ) ) {
            return;
        }
        $r['post_type'] = $post_type_object->name;
    
        if ( ! empty( $r['limit'] ) ) {
            $r['limit'] = absint( $r['limit'] );
            $r['limit'] = ' LIMIT ' . $r['limit'];
        }
    
        $order = strtoupper( $r['order'] );
        if ( $order !== 'ASC' ) {
            $order = 'DESC';
        }
    
        $where = $wpdb->prepare( "WHERE post_type = %s AND post_status = 'publish'", $r['post_type'] );
    
    
        $output = array();
        $last_changed = wp_cache_get_last_changed( 'posts' );
    
        $limit = $r['limit'];
        
        $query = "
                SELECT
                    YEAR(post_date) AS `year`,
                    MONTH(post_date) AS `month`,
                    count(ID) as posts
                FROM $wpdb->posts
                $where
                GROUP BY YEAR(post_date),
                MONTH(post_date)
                ORDER BY post_date $order $limit";
        $key = md5( $query );
        $key = "wp_get_archives:$key:$last_changed";
        if ( ! $results = wp_cache_get( $key, 'posts' ) ) {
            $results = $wpdb->get_results( $query );
            wp_cache_set( $key, $results, 'posts' );
        }
        
        if ( $results ) {    
            $years = array();
            foreach ( (array) $results as $result ) {
                $year = $result->year;
                if( !in_array( $year, $years ) ){
                    $years[] = $year;
                }
            }
			
		 //translators: second select menu's text in archive widget is year is selected:
		$month_text_year_selected = __( 'Select month', 'manduca' );
            foreach( $years as $year ){
               $current_year = array();
               foreach ( (array) $results as $result ) {
                    if( $result->year ===$year ) {                
                        $url = get_month_link( $year, $result->month );
                        if ( 'post' !== $r['post_type'] ) {
                            $url = add_query_arg( 'post_type', $r['post_type'], $url );
                        }
                        /* translators: 1: month name, 2: 4-digit year */
                        $text = $wp_locale->get_month( $result->month );
                        //$output[ $year ][] = get_archives_link( $url, $text, 'option', $r['before'], $r['after'] );
						$current_year[] = sprintf( '<option value="%1$s">%2$s</option>', $result->month, $text );
                    }
                }
				$current_year[] = sprintf( '<option value="" disabled selected>%s</option>',
										  sprintf( $month_text_year_selected, $year )
									);
				$output[ $year ] = array_reverse( $current_year );
            }
        }
                    
        return $output;
    
    }
	
	
	
	
	/*
	 *This method is called with ajax
	 *displays the html of the month select menu
	 */
	public function get_archive_months(){  
		check_ajax_referer( 'manduca-ajax', 'hash', false );
		global $wpdb, $wp_locale;
    
        $defaults = array(
            'limit' => '',
            'order' => 'DESC',
            'post_type' => 'post'
        );
    
        $r = $defaults;
    
        $post_type_object = get_post_type_object( $r['post_type'] );
        if ( ! is_post_type_viewable( $post_type_object ) ) {
            return;
        }
        $r['post_type'] = $post_type_object->name;
    
        if ( ! empty( $r['limit'] ) ) {
            $r['limit'] = absint( $r['limit'] );
            $r['limit'] = ' LIMIT ' . $r['limit'];
        }
    
        $order = strtoupper( $r['order'] );
        if ( $order !== 'ASC' ) {
            $order = 'DESC';
        }
    
        $where = $wpdb->prepare( "WHERE post_type = %s AND post_status = 'publish'", $r['post_type'] );
    
    
        $output = array();
        $last_changed = wp_cache_get_last_changed( 'posts' );
    
        $limit = $r['limit'];
        
        $query = "
                SELECT
                    YEAR(post_date) AS `year`,
                    MONTH(post_date) AS `month`,
                    count(ID) as posts
                FROM $wpdb->posts
                $where
                GROUP BY YEAR(post_date),
                MONTH(post_date)
                ORDER BY post_date $order $limit";
        $key = md5( $query );
        $key = "wp_get_archives:$key:$last_changed";
        if ( ! $results = wp_cache_get( $key, 'posts' ) ) {
            $results = $wpdb->get_results( $query );
            wp_cache_set( $key, $results, 'posts' );
        }
        
        if ( $results ) {    
            $years = array();
            foreach ( (array) $results as $result ) {
                $year = $result->year;
                if( !in_array( $year, $years ) ){
                    $years[] = $year;
                }
            }
			
		 //translators: second select menu's text in archive widget is year is selected:
		$month_text_year_selected = __( 'Months in %s', 'manduca' );
            foreach( $years as $year ){
               $current_year = array();
               foreach ( (array) $results as $result ) {
                    if( $result->year ===$year ) {                
                        $url = get_month_link( $year, $result->month );
                        if ( 'post' !== $r['post_type'] ) {
                            $url = add_query_arg( 'post_type', $r['post_type'], $url );
                        }
                        /* translators: 1: month name, 2: 4-digit year */
                        $text = $wp_locale->get_month( $result->month );
                        //$output[ $year ][] = get_archives_link( $url, $text, 'option', $r['before'], $r['after'] );
						$current_year[] = sprintf( '<option value="%1$s">%2$s</option>', $result->month, $text );
                    }
                }
				$current_year[] = sprintf( '<option value="" disabled selected>%s</option>',
										  sprintf( $month_text_year_selected, $year )
									);
				$output[ $year ] = array_reverse( $current_year );
            }
        }
                    
		
		$this->archive_array = $this->get_archives();
		
		if( isset( $output[ $_REQUEST[ 'year' ] ] ) ){
			echo implode( ' ',  $output[ $_REQUEST[ 'year' ] ] ) ;
		}
		die();
	}

   /*
    * The is_active_widget has bugs, this should be used instead.
    *
    *@return bool : true if this widget is active. 
    * */
	public static function is_this_widget_active(){
	  foreach( wp_get_sidebars_widgets() as $sidebars) {
		 foreach( $sidebars as $widget ){
			if( false !== strpos( $widget, self::WIDGET_ID ) ){
			   return true;
			}
		 }
	  }
	  return false;
	}
	
}
