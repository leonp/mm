<?php

// Start all functions
add_action('after_setup_theme','mm_startup');

function mm_startup() {
	
    // launching operation cleanup
    add_action('init', 'mm_head_cleanup');
	
    // remove WP version from RSS
    add_filter('the_generator', 'mm_rss_version');
	
    // remove injected css for recent comments widget
    add_filter( 'wp_head', 'mm_remove_wp_widget_recent_comments_style', 1 );
	
    // clean up comment styles in the head
    add_action('wp_head', 'mm_remove_recent_comments_style', 1);
	
    // additional post related cleaning
    add_filter( 'img_caption_shortcode', 'mm_cleaner_caption', 10, 3 );
    add_filter('get_image_tag_class', 'mm_image_tag_class', 0, 4);
    add_filter('get_image_tag', 'mm_image_editor', 0, 4);
    add_filter( 'the_content', 'mm_img_unautop', 30 );

} /* end mm_startup */


// Clean up wp head
// Thanks to Bones
// http://themble.com/bones/

function mm_head_cleanup() {
	
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
	
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	
	// index link
	remove_action( 'wp_head', 'index_rel_link' );
	
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
	
	// remove WP version from css
	add_filter( 'style_loader_src', 'mm_remove_wp_ver_css_js', 9999 );
	
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'mm_remove_wp_ver_css_js', 9999 );

}


// remove WP version from RSS
function mm_rss_version() { return ''; }


// remove WP version from scripts
function mm_remove_wp_ver_css_js( $src ) {

    if ( strpos( $src, 'ver=' ) )
	
        $src = remove_query_arg( 'ver', $src );
		
    return $src;
	
}


// remove injected CSS for recent comments widget
function mm_remove_wp_widget_recent_comments_style() {

   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
   
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
	  
   }
   
}


// remove injected CSS from recent comments widget
function mm_remove_recent_comments_style() {

  global $wp_widget_factory;
  
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
  
}


// remove injected CSS from gallery
// function mm_gallery_style($css) {

// return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
  
// }


// Customized the output of caption. You can remove the filter to restore back to the WP default output.
function mm_cleaner_caption( $output, $attr, $content ) {

	/* We're not worried abut captions in feeds, so just return the output here. */
	if ( is_feed() )
		return $output;

	/* Set up the default arguments. */
	$defaults = array(
		'id' => '',
		'align' => 'alignnone',
		'width' => '',
		'caption' => ''
	);

	/* Merge the defaults with user input. */
	$attr = shortcode_atts( $defaults, $attr );

	/* If the width is less than 1 or there is no caption, return the content wrapped between the [caption]< tags. */
	if ( 1 > $attr['width'] || empty( $attr['caption'] ) )
		return $content;

	/* Set up the attributes for the caption <div>. */
	$attributes = ' class="figure ' . esc_attr( $attr['align'] ) . '"';

	/* Open the caption <div>. */
	$output = '<figure' . $attributes .'>';

	/* Allow shortcodes for the content the caption was created for. */
	$output .= do_shortcode( $content );

	/* Append the caption text. */
	$output .= '<figcaption class="secondary">' . $attr['caption'] . '</figcaption>';

	/* Close the caption </div>. */
	$output .= '</figure>';

	/* Return the formatted, clean caption. */
	return $output;
	
}


// Clean the output of attributes of images in editor. Courtesy of SitePoint. http://www.sitepoint.com/wordpress-change-img-tag-html/
function mm_image_tag_class($class, $id, $align, $size) {

	$align = 'align' . esc_attr($align);
	return $align;
	
} /* end mm_image_tag_class */


// Remove width and height in editor, for a better responsive world.
function mm_image_editor($html, $id, $alt, $title) {

	return preg_replace(array(
			'/\s+width="\d+"/i',
			'/\s+height="\d+"/i',
			'/alt=""/i'
		),
		array(
			'',
			'',
			'',
			'alt="' . $title . '"'
		),
		$html);
		
} /* end mm_image_editor */


// Wrap images with figure tag. Courtesy of Interconnectit http://interconnectit.com/2175/how-to-remove-p-tags-from-images-in-wordpress/
function mm_img_unautop($pee) {

    $pee = preg_replace('/<p>\\s*?(<img.*?>|<img.*?>)?\\s*<\\/p>/s', '<figure>$1</figure>', $pee);
    return $pee;
	
} /* end mm_img_unautop */

?>