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
	echo '<img class="animal hide '.$taille.' '.$animation.' '.$direction.'" style="'.$style.'"src="'.$image.'">';
endwhile;
?>
