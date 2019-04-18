<section class="projets" id="projets">
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
    echo '<a href="' . get_permalink() . '"><figure class="'.$figure_class.' '.$size.'">'
    . get_the_post_thumbnail( get_the_ID(), 'full' )
    .'<figcaption><h5>'. get_the_title() . '</h5><p>'. $category . '</p></figcaption></figure></a>';
  endwhile;
  ?>
</section>
