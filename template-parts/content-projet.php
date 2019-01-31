<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package potager
 */
?>

<article id="post-<?php the_ID(); ?>" style="background-image=url('<?php echo $src ?>')" <?php post_class(); ?>>
	<?php
		the_title( '<h1 class="entry-title">', '</h1>' );
	?>
	<div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'potager' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );?>
</article><!-- #post-<?php the_ID(); ?> -->
