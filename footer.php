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
	if ( is_front_page()) : ?>
		<section class="projets">
			<h2 class="gauche">Projets en cours<br>et passés</h2>
			<?php
			$projets = new WP_Query(array('post_type'=>'projet', 'post_status'=>'publish', 'posts_per_page'=>-1));
			$index = 0;
			while ( $projets->have_posts() ) :
				$projets->the_post();
				$size = get_figure_size(get_field("taille_imagette",$id));
				$figure_class = ($index++ % 2 == 0 ? "droite" : "gauche");
				$categories =  get_the_category();
				$category = $categories[0]->name;
				if (count($categories) > 1){
					$category = $category . ' / ' . $categories[1]->name;
				}
				echo '<figure class="'.$figure_class.' '.$size.'"><a href="' . get_permalink() . '">'
				. get_the_post_thumbnail( get_the_ID(), 'medium' ).'</a>'
				.'<figcaption><h5>'. get_the_title() . '</h5><p>'. $category . '</p></figcaption></figure>';
			endwhile;
			?>
		</section><?php
	elseif ( $post->post_type == 'projet'):
		//Get the images ids from the post_metadata
 		$images = acf_photo_gallery('gallerie', $post->ID);
 		//Check if return array has anything in it
 		if( count($images) ):
 			?>
 			<section class="gallerie-projet" data-featherlight-gallery data-featherlight-filter="a">
 			<?php
				$req_dimensions = array(500, 500);
				$max_dimensions = get_max_dimensions ($images);
 				$index = 0;
 				//Cool, we got some data so now let's loop over it
 				foreach($images as $image):
 						$id = $image['id']; // The attachment id of the media
 						$title = $image['title']; //The title
 						$caption= $image['caption']; //The caption
 						$full_image_url = $image['full_image_url']; //Full size image url
						$size = get_figure_size(get_field("taille_imagette", $id));
 						$url= $image['url']; //Goto any link when clicked
 						$target= $image['target']; //Open normal or new tab
 						$alt = get_field('photo_gallery_alt', $id); //Get the alt which is a extra field (See below how to add extra fields)
 						$figure_class = ($index++ % 2 == 0 ? "droite" : "gauche")." ".$size;?>
 		<a class="gallery" href="#<?php echo $id; ?>">
 				<figure id="<?php echo $id; ?>" class="<?php echo $figure_class; ?>">
 					<img src="<?php echo $full_image_url; ?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>">
 				</figure>
 		</a>
 <?php endforeach; ?>
 	</section>
<?php endif; endif;?>

	<footer id="colophon" class="site-footer">
		<p>
			© potager liberté   /  Mentions légales
		</p>
	</footer>
<?php wp_footer(); ?>
</div>
<?php
$animaux = new WP_Query(array('post_type'=>'animal', 'post_status'=>'publish', 'posts_per_page'=>-1));
$index = 0;
$possible_direction = ['go-right','go-left','go-down','go-up','bounce','riseturn','bumpturn'];
$fixed_direction = array('martin'=>'go-down','puce'=>'bounce','hirondelle'=>'riseturn','sifilet'=>'bumpturn');
while ( $animaux->have_posts() ) :
	$animaux->the_post();
	$image = get_field("image",$id);
	$animation = get_field("animation",$id);
	$required_direction = $fixed_direction[$animation];
  $direction =  $required_direction != NULL ? $required_direction : $possible_direction[rand(0,4)];
	$style = in_array($direction, ['go-right','go-left','bumpturn']) ? 'top: ' : 'left: ';
	$style = $style.rand(5,95).'%;';
	$style = $style.'animation-delay: '.rand(0,5).'s';
	$taille = get_field("taille",$id);
	echo '<img class="animal '.$taille.' '.$animation.' '.$direction.'" style="'.$style.'"src="'.$image.'">';
endwhile;
?>
<script src="//code.jquery.com/jquery-latest.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/detect_swipe/2.1.1/jquery.detect_swipe.min.js"></script>
<script src="//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
<script src="//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.gallery.min.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
