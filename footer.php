<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package potager
 */

?>
		</div><!-- #content -->
  </div><!-- #page -->
</div><!-- .firstpage-->
	<?php
	if ( is_front_page()) : ?>
		<section class="projets">
			<h2 class="gauche">Projets en cours<br>et passés</h2>
			<?php
			$projets = new WP_Query(array('post_type'=>'projet', 'post_status'=>'publish', 'posts_per_page'=>-1));
			$index = 0;
			while ( $projets->have_posts() ) :
				$projets->the_post();
				$figure_class = ($index++ % 2 == 0 ? "droite" : "gauche");
				echo '<figure class="'.$figure_class.'"><a href="' . get_permalink() . '">'
				. get_the_post_thumbnail( get_the_ID(), 'medium' ).'</a>'
				.'<figcaption><h5>'. get_the_title() . '</h5><p>'. get_the_category()[0]->name. '</p></figcaption></figure>';
			endwhile;
			?>
		</section><?php

	endif;?>
	<footer id="colophon" class="site-footer">
		<p>
			© potager liberté   /  Mentions légales
		</p>
	</footer><!-- #colophon -->
<?php wp_footer(); ?>
</div>
</body>
</html>
