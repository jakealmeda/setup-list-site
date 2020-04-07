<?php
/**
 * Plugin Name: Setup List Site
 * Description: This will just list all sites belonging to this multisite
 * Version: 1.0
 * Author: Jake Almeda
 * Author URI: http://smarterwebpackages.com/
 * Network: true
 * License: GPL2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// ALLOW SHORTCODE IN WIDGETS
add_filter( 'widget_text', 'do_shortcode' );

// SHORTCODE
add_shortcode( 'setup-list-sites', 'setup_starter_list_sites' );
function setup_starter_list_sites( $atts ) {
    // $atts['foo'] -> get attribute contents

	// do not run in WP-Admin
    if( is_admin() ) return;

    $s = get_sites();
    //var_dump($s); echo '<hr />';
    for( $x=0; $x<=( count( $s ) - 1 ); $x++ ) {
        
        // assign to variable
        $s_path = $s[ $x ]->path;
        
        // get blog details to get the blogname
		$current_blog_details = get_blog_details( $s[ $x ]->blog_id );
		
        // validate
        if( $s_path == '/' ) {
            $path = 'Main ('.$current_blog_details->blogname.')';
        } else {
            $path = $current_blog_details->blogname;
        }
        
        // set output
    	$out .= '<li><a href="'.get_site_url( $s[ $x ]->blog_id ).'">'.$path.'</a></li>';
    	
    }
    
    // output
	return '<ul>'.$out.'</ul>';

}
