<?php
//Get the images ids from the post_metadata
$images = acf_photo_gallery('gallerie', $post->ID);
//Check if return array has anything in it
if( count($images) ):
  ?>
  <section class="gallerie-projet"
  data-featherlight-gallery
  data-featherlight-filter="a"
  data-featherlight-close-icon="&nbsp;"
  data-featherlight-next-icon="&nbsp;"
  data-featherlight-previous-icon="&nbsp;"
  >
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
      <figcaption><p><?php echo $caption ?></p></figcaption>
    </figure>
</a>
<?php endforeach; ?>
</section>
<?php endif; ?>
