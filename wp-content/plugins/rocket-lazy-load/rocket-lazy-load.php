<?php
defined( 'ABSPATH' ) or	die( 'Cheatin\' uh?' );

/*
Plugin Name: Rocket Lazy Load
Plugin URI: http://wordpress.org/plugins/rocket-lazy-load/
Description: The tiny Lazy Load script for WordPress without jQuery or others libraries.
Version: 1.0
Author: WP Media
Author URI: http://wp-rocket.me

Copyright 2013 WP Media
	
	This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    
    You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/


/**
 * Add Lazy Load JavaScript in the header
 * No jQuery or other library is required !!
 *
 * @since 1.0
 *
 */

if( !function_exists( 'rocket_lazyload_script' ) ) :
add_action( 'wp_head', 'rocket_lazyload_script', PHP_INT_MAX );
function rocket_lazyload_script()
{

	if( !apply_filters( 'do_rocket_lazyload', true ) )
		return;

	echo '<script type="text/javascript">(function(a,e){function f(){var d=0;if(e.body&&e.body.offsetWidth){d=e.body.offsetHeight}if(e.compatMode=="CSS1Compat"&&e.documentElement&&e.documentElement.offsetWidth){d=e.documentElement.offsetHeight}if(a.innerWidth&&a.innerHeight){d=a.innerHeight}return d}function b(g){var d=ot=0;if(g.offsetParent){do{d+=g.offsetLeft;ot+=g.offsetTop}while(g=g.offsetParent)}return{left:d,top:ot}}function c(){var l=e.querySelectorAll("[data-lazy-original]");var j=a.pageYOffset||e.documentElement.scrollTop||e.body.scrollTop;var d=f();for(var k=0;k<l.length;k++){var h=l[k];var g=b(h).top;if(g<(d+j)){h.src=h.getAttribute("data-lazy-original");h.removeAttribute("data-lazy-original")}}}if(a.addEventListener){a.addEventListener("DOMContentLoaded",c,false);a.addEventListener("scroll",c,false)}else{a.attachEvent("onload",c);a.attachEvent("onscroll",c)}})(window,document);</script>';
}
endif;




/**
 * Replace Gravatar, thumbnails, images in post content and in widget text by LazyLoad
 *
 * @since 1.0
 *
 */

if( !function_exists( 'rocket_lazyload_images' ) ) :
add_filter( 'get_avatar', 'rocket_lazyload_images', PHP_INT_MAX );
add_filter( 'post_thumbnail_html', 'rocket_lazyload_images', PHP_INT_MAX );
add_filter( 'the_content', 'rocket_lazyload_images', PHP_INT_MAX );
add_filter( 'widget_text', 'rocket_lazyload_images', PHP_INT_MAX );
function rocket_lazyload_images( $html )
{

	// Don't LazyLoad if the thumbnail is in admin, a feed or a post preview
	if( is_admin() || is_feed() || is_preview() || empty( $html ) )
		return $html;

	// Don't LazyLoad if the thumbnail has already been run through previously or stop process with a hook
	if ( strpos( $html, 'data-lazy-original' ) || strpos( $html, 'data-no-lazy' ) || !apply_filters( 'do_rocket_lazyload', true ) )
		return $html;

	$html = preg_replace( '#<img([^>]+?)src=[\'"]?([^\'"\s>]+)[\'"]?([^>]*)>#', '<img${1}src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-lazy-original="${2}"${3}><noscript><img${1}src="${2}"${3}></noscript>', $html );

	return $html;
}
endif;



/**
 * Replace WordPress smilies by Lazy Load
 *
 * @since 1.0
 *
 */

if( !function_exists( 'rocket_convert_smilies' ) ) :
remove_filter( 'the_content', 'convert_smilies' );
remove_filter( 'the_excerpt', 'convert_smilies' );
remove_filter( 'comment_text', 'convert_smilies' );

add_filter( 'the_content', 'rocket_convert_smilies' );
add_filter( 'the_excerpt', 'rocket_convert_smilies' );
add_filter( 'comment_text', 'rocket_convert_smilies' );



/**
 * Convert text equivalent of smilies to images.
 *
 * @source convert_smilies() in /wp-includes/formattings.php
 * @since 1.0
 *
 */

function rocket_convert_smilies( $text ) {
	global $wp_smiliessearch;

	$output = '';
	if ( get_option( 'use_smilies' ) && ! empty( $wp_smiliessearch ) ) {
		// HTML loop taken from texturize function, could possible be consolidated
		$textarr = preg_split( '/(<.*>)/U', $text, -1, PREG_SPLIT_DELIM_CAPTURE ); // capture the tags as well as in between
		$stop = count( $textarr );// loop stuff

		// Ignore proessing of specific tags
		$tags_to_ignore = 'code|pre|style|script|textarea';
		$ignore_block_element = '';

		for ( $i = 0; $i < $stop; $i++ ) {
			$content = $textarr[$i];

			// If we're in an ignore block, wait until we find its closing tag
			if ( '' == $ignore_block_element && preg_match( '/^<(' . $tags_to_ignore . ')>/', $content, $matches ) )  {
				$ignore_block_element = $matches[1];
			}

			// If it's not a tag and not in ignore block
			if ( '' ==  $ignore_block_element && strlen( $content ) > 0 && '<' != $content[0] ) {
				$content = preg_replace_callback( $wp_smiliessearch, 'rocket_translate_smiley', $content );
			}

			// did we exit ignore block
			if ( '' != $ignore_block_element && '</' . $ignore_block_element . '>' == $content )  {
				$ignore_block_element = '';
			}

			$output .= $content;
		}
	} else {
		// return default text.
		$output = $text;
	}
	return $output;
}
endif;



/**
 * Convert one smiley code to the icon graphic file equivalent.
 *
 * @source translate_smiley() in /wp-includes/formattings.php
 * @since 1.0
 *
 */

if( !function_exists( 'rocket_translate_smiley' ) ) :
function rocket_translate_smiley( $matches ) {
	global $wpsmiliestrans;

	if ( count( $matches ) == 0 )
		return '';

	$smiley = trim( reset( $matches ) );
	$img = $wpsmiliestrans[ $smiley ];

	/**
	 * Filter the Smiley image URL before it's used in the image element.
	 *
	 * @since 2.9.0
	 *
	 * @param string $smiley_url URL for the smiley image.
	 * @param string $img        Filename for the smiley image.
	 * @param string $site_url   Site URL, as returned by site_url().
	 */
	$src_url = apply_filters( 'smilies_src', includes_url( "images/smilies/$img" ), $img, site_url() );

	// Don't lazy-load if process is stopped with a hook
	if ( apply_filters( 'do_rocket_lazyload', true ) )
	{
		return sprintf( ' <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-lazy-original="%s" alt="%s" class="wp-smiley" /> ', esc_url( $src_url ), esc_attr( $smiley ) );
	}
	else
	{
		return sprintf( ' <img src="%s" alt="%s" class="wp-smiley" /> ', esc_url( $src_url ), esc_attr( $smiley ) );
	}

}
endif;