<?php
/**
 * This file adds the Full Width page template to the Mobile First Theme.
 *
 * @author Brian Gardner
 * @package Mobile First Theme
 * @subpackage Customizations
 * Template Name: Full Width
 */


// Based on https://sridharkatakam.com/full-width-page-template-in-genesis-for-beaver-builder/
add_filter( 'body_class', 'mobile_first_add_full_width_body_class' );
/**
 * Adds a css class to the body element
 *
 * @param  array $classes the current body classes
 * @return array $classes modified classes
 */
function mobile_first_add_full_width_body_class( $classes ) {
	$classes[] = 'fl-builder-full';
	return $classes;
}

if ( is_front_page() ) {
	//* Remove site header elements
	remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
	remove_action( 'genesis_header', 'genesis_do_header' );
	remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );
}

//* Remove breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

/**
 * Add attributes for site-inner element.
 *
 * @since 2.0.0
 *
 * @param array $attributes Existing attributes.
 *
 * @return array Amended attributes.
 */
add_filter( 'genesis_attr_site-inner', 'mobile_first_attributes_site_inner' );
function mobile_first_attributes_site_inner( $attributes ) {
	$attributes['role']     = 'main';
	$attributes['itemprop'] = 'mainContentOfPage';
	return $attributes;
}
// Remove div.site-inner's div.wrap
add_filter( 'genesis_structural_wrap-site-inner', '__return_empty_string' );
// Display Header
get_header();
// Display Content
the_post(); // sets the 'in the loop' property to true.
the_content();
// Display Footer
get_footer();
