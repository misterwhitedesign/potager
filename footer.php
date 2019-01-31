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
	elseif ( $post->post_type == 'projet'):
		//Get the images ids from the post_metadata
 		$images = acf_photo_gallery('gallerie', $post->ID);
 		//Check if return array has anything in it
 		if( count($images) ):
 			?>
 			<section class="gallerie-projet">
 			<?php
 				$index = 0;
 				//Cool, we got some data so now let's loop over it
 				foreach($images as $image):
 						$id = $image['id']; // The attachment id of the media
 						$title = $image['title']; //The title
 						$caption= $image['caption']; //The caption
 						$full_image_url= $image['full_image_url']; //Full size image url
 						$full_image_url = acf_photo_gallery_resize_image($full_image_url, 262, 160); //Resized size to 262px width by 160px height image url
 						$thumbnail_image_url= $image['thumbnail_image_url']; //Get the thumbnail size image url 150px by 150px
 						$url= $image['url']; //Goto any link when clicked
 						$target= $image['target']; //Open normal or new tab
 						$alt = get_field('photo_gallery_alt', $id); //Get the alt which is a extra field (See below how to add extra fields)
 						$class = get_field('photo_gallery_class', $id); //Get the class which is a extra field (See below how to add extra fields)
 						$figure_class = ($index++ % 2 == 0 ? "droite" : "gauche");?>
 		<?php if( !empty($url) ){ ?><a href="<?php echo $url; ?>" <?php echo ($target == 'true' )? 'target="_blank"': ''; ?>><?php } ?>
 				<figure class="<?php echo $figure_class; ?>">
 					<img src="<?php echo $full_image_url; ?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>">
 				</figure>
 		<?php if( !empty($url) ){ ?></a><?php } ?>
 <?php endforeach; ?>
 	</section>
<?php endif; endif;?>

	<footer id="colophon" class="site-footer">
		<p>
			© potager liberté   /  Mentions légales
		</p>
	</footer><!-- #colophon -->
<?php wp_footer(); ?>
</div>
</body>
</html>
