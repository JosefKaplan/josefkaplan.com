<?php
/**
 * Functions related to Hungarian languages
 *
 * You can use them in your child theme.
 **/

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

 class Hungarian_Contents {

	
   /*
	* Make hungarian definite article ('a' or 'az')
	* depending on the input
	*
	*@paramter (string) $word : word to get the article;
	*@return   (string)       : only the article. 
	*
	* */

	public static function definite_article( string $word ) {
	   //only works if the language is Hungarian 
	   if ( get_locale() ==='hu_HU' ) {
		   $hungarian_regex = '/^[aáeéiíoóöőuúüű]/i';
		   if (preg_match ( $hungarian_regex, $word ) ) {
			   $article = ' az ';	
		   }
		   else {
			   $article = ' a ';
		   }
	   }
	   return $article;
	}
	
	
    
    /**
 * Determines the difference between two timestamps.
 * Rewrite of WP's function (formatting.php #3219 ) named human_time_diff(); (* @since 1.5.0 , so very old)
 * Because of :
 *          - not acceptable translation of WP
 *          - No need for weeks
 * 
 *
 * @param int $from Unix timestamp from which the difference begins.
 * @param int $to   Optional. Unix timestamp to end the time difference. Default becomes time() if not set.
 * @return string Human readable time difference.
 *
 * @modified 19.1
 */
	public static function get_date_difference( $from, $to = NULL ){
        if ( empty( $to ) ) {
            $to = time();
        }
    
        $diff = (int) abs( $to - $from );
		
        if ( $diff < HOUR_IN_SECONDS ) {
            $minutes = round( $diff / 60 );
            $since = sprintf( _n( '%s minute', '%s minutes', $minutes, 'manduca' ), $minutes);
        }elseif ( $diff < DAY_IN_SECONDS ) {
            $hours= round( $diff / HOUR_IN_SECONDS );
            $since = sprintf( _n( '%s hour', '%s hours', $hours, 'manduca' ), $hours );
        }
        elseif ( $diff < MONTH_IN_SECONDS  && $diff >= DAY_IN_SECONDS ) {
            $days = round( $diff / DAY_IN_SECONDS );
            if ( $days <= 1 )
                $days = 1;
            /* translators: Time difference between two dates, in days. 1: Number of days */
            $since = sprintf( _n( '%s day', '%s days', $days, 'manduca' ), $days );
        } elseif ( $diff < YEAR_IN_SECONDS && $diff >= MONTH_IN_SECONDS ) {
            $months = round( $diff / MONTH_IN_SECONDS );
            if ( $months <= 1 )
                $months = 1;
            /* translators: Time difference between two dates, in months. 1: Number of months */
            $since = sprintf( _n( '%s month', '%s months', $months, 'manduca' ), $months );
        } elseif ( $diff >= YEAR_IN_SECONDS ) {
            $years = round( $diff / YEAR_IN_SECONDS );
            if ( $years <= 1 )
                $years = 1;
            /* translators: Time difference between two dates, in years. 1: Number of years */
            $since = sprintf( _n( '%s year', '%s years', $years, 'manduca' ), $years);
        }
        return $since;
    }
    
    
    public static function hege_style_post_date() {
          return sprintf( '<abbr title="%s">%s</abbr>',
                  esc_attr( get_the_date( 'Y. F j. H:i, l' ) ),
                 self::get_date_difference( get_the_date( 'U' ) )
                );	
       
      }
	
 }