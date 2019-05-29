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
			</div>
	  </div>
	</div>
	<?php
	if ( is_front_page()) :
		include 'galleries/projets.php';
	elseif ( $post->post_type == 'projet'):
		include 'galleries/gallerie-projet.php';
	endif;
	include 'mentionslegales.php';
	wp_footer(); ?>
</div>
<?php include 'animaux.php' ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-38769084-6"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'UA-38769084-6'); </script> 
<script src="//code.jquery.com/jquery-latest.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/detect_swipe/2.1.1/jquery.detect_swipe.min.js"></script>
<script src="//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
<script src="//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.gallery.min.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
