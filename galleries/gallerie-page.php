<?php
$images = acf_photo_gallery('gallerie', $post->ID);
if( count($images) ):?>
<section class="side-gallery">
  <?php foreach($images as $image):
      $id = $image['id']; // The attachment id of the media
      $title = $image['title']; //The title
      $caption= $image['caption']; //The caption
      $full_image_url = $image['full_image_url']; //Full size image url
      $size = get_figure_size(get_field("taille_imagette", $id));
      $url= $image['url']; //Goto any link when clicked
      $target= $image['target']; //Open normal or new tab
      $alt = get_field('photo_gallery_alt', $id); //Get the alt which is a extra field (See below how to add extra fields)?>
  <figure id="<?php echo $id; ?>">
    <img src="<?php echo $full_image_url; ?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>">
  </figure>
  <?php endforeach; ?>
</section>
<?php endif; ?>
