<?php
/**
 * Template Name: Projet page layout
 * Template Post Type: projet
 * The template for displaying all single posts
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package potager
 */
get_header();
while ( have_posts() ) :
	the_post();
	get_template_part( 'template-parts/content-projet', get_post_type() );
endwhile; // End of the loop.
get_footer();
