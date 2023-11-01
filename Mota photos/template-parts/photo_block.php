<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo get_template_directory_uri() . '/js/script.js'; ?>"></script>



<section class="Related">
  <?php
  $categories = get_the_terms(get_the_ID(), 'categorie');
  if ($categories && !is_wp_error($categories)) {
    $category_ids = wp_list_pluck($categories, 'term_id');


    $args = array(
      'post_type' => 'photo',
      'posts_per_page' => 2,
      'post__not_in' => array(get_the_ID()),
      'tax_query' => array(
        array(
          'taxonomy' => 'categorie',
          'field' => 'term_id',
          'terms' => $category_ids,
        ),
      ),
    );
    $related_block = new WP_Query($args);
    while ($related_block->have_posts()) {
      $related_block->the_post();
      $photo_url = get_field('photo');
      $reference = get_field('référence'); // Obtenez la référence du post
      $categorie = get_the_terms(get_the_ID(), 'categorie')[0]->name; // Obtenez la catégorie du post
      ?>

<div class="related_block">
    <?php echo get_the_post_thumbnail(null, 'large'); ?>

    <div class="overlay">

        <div class=" eye-icon">
              <a href="<?php echo esc_url(get_permalink()); ?>">
                <img src="<?php echo esc_url(get_template_directory_uri()) ?>/assets/img/icon_eye.svg" alt="voir la photo">
              </a>
        </div>
      
        <div class="fullscreen-icon" 
             data-imgurl="<?php echo $photo_url; ?>" 
             data-reference="<?php echo $reference; ?>"
             data-categorie="<?php echo $categorie; ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/fullscreen.svg" alt="Icone fullscreen">
        </div>
            
    </div>
</div>

    <?php
    } 
      
   }
    wp_reset_postdata();
  
  ?>
</section>