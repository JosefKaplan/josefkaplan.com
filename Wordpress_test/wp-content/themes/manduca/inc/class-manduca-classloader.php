<?php
/**
 * Autolad classes for Manduca 
 *
 *
 *@see: https://phpbits.in/autoloading-classes-php-7/
 *@since : 17.12.6
 *
 **/
/*
    This file is part of WordPress theme named Manduca - focus on accessibility.
    
    Copyright (C) 2015-2018  Zsolt Edelényi (ezs@web25.hu)
    
    Manduca is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    
    Manduca is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    
    You should have received a copy of the GNU General Public License
    in /assets/docs/licence.txt.  If not, see <https://www.gnu.org/licenses/>.
*/

class Manduca_Classloader {
    
    const UNABLE_TO_LOAD = 'Unable to load class';
    
    protected static $lookup_directories = array();
    
    protected static $registered = 0;





 
    /**
     * Initializes directories array
     * 
     *@param array $dirs
     */
    public function __construct(array $dirs = array() )    {
        self::init($dirs);
    }
 
    
    
    
    /**
     * Adds directories to the existing array of directories
     * 
     *@param array | string $dirs
     */
    public static function add_dirs($dirs)    {
        if (is_array( $dirs ) ) {
            self::$lookup_directories = array_merge(self::$lookup_directories, $dirs);
        } else {
            self::$lookup_directories[] = $dirs;
        }
    }
 
 
 
 
    /**
     * Adds a directory to the list of supported directories
     * Also registers "autoload" as an autoloading method
     *
     *@param array | string $dirs
     */
    public static function init( $dirs = array() )     {
        if ($dirs) {
            self::add_dirs($dirs);
        }
        if (self::$registered == 0) {
            spl_autoload_register(__CLASS__ . '::autoload');
            self::$registered++;
        }
    }
 
    
    
    
    
    /**
     * Locates a class file 
     * 
     *@param string $class
     *@return boolean
     */
    public static function autoLoad( $class ) {

        $success = FALSE;

        /*
         * Has namespace
         **/
        if( false !== strpos( $class , '\\' ) ) {
            
            // autoload only this two namespaces.
            $prefixes = array( 'Web25', 'Manduca' ); 
            $catched = false;
            
            foreach( $prefixes as $prefix ) {
                $len = strlen($prefix);
                if ( strncmp( $prefix, $class, $len) === 0) {
                    $catched = true;
                    break; 
                }
            }
            
            if( $catched ) {
                
                $namespaces = explode( '\\' , $class );
                
                $class_name_wo_namespace   = array_values( array_slice( $namespaces, -1 ) ) [0] ;
                $len=strlen ($class_name_wo_namespace);
                $class_namespace = substr ($class, 0, strlen ($class)-$len);
                $class_namespace = untrailingslashit( $class_namespace );
                
                $filename = self::create_filename( $class_name_wo_namespace ) ;
                $dir = trailingslashit (self::$lookup_directories[ $class_namespace ]);               
                $success = self::loadFile( $dir . $filename);

            }

        }
        
        // No namespace
        else {
        
            $filename = self::create_filename( $class ) ;
        
            foreach (self::$lookup_directories as $namespace => $directory) {
                    
                if( is_integer( $namespace ) && self::loadFile( $directory . $filename) ) {
                
                    $success = TRUE;
                
                    break;
                
                }
                
            }
        }
                
        return $success;
    }
 
 
 
 
 
 
    /**
     * Loads a file
     * 
     *@param string $file
     *@return boolean
     */
    protected static function loadFile($file) {
                    
        if (file_exists($file)) {
                require_once $file;
                return TRUE;
        }
                    
        return FALSE;
    }
    
     public static function add_dir_and_subdirs( $directory ) {
        
        self::collect_subdirectories( $directory );
    }
    
    
    protected static function create_filename( $filename ) {
        
        $filename   = str_replace( '_', '-' , $filename );
        
        $filename   = sprintf( 'class-%s.php',
                              strtolower( $filename )
                );
        
        return $filename;
    }
}
