
<?php
/*
Template Name: Single
*/

get_header();
?>

<?php
$photo_url = get_field('photos');
$type = get_field('type');
$reference = get_field('référence');
$categories = get_the_terms(get_the_ID(), 'categorie');
$formats = get_the_terms(get_the_ID(), 'format');
$annees = get_the_terms(get_the_ID(), 'annee');
$categorie_name = $categories[0]->name;
$nextPost = get_next_post();
$previousPost = get_previous_post();

// Définissez les URLs des vignettes pour le post précédent et suivant
$previousThumbnailURL = $previousPost ? get_the_post_thumbnail_url($previousPost->ID, 'thumbnail') : '';
$nextThumbnailURL = $nextPost ? get_the_post_thumbnail_url($nextPost->ID, 'thumbnail') : '';
?>

<section class="catalogue">
    <div class="gallery_pics" >
        <div class="photo-details">
           
            <div class="photo-container">
                     <img   src="<?php echo $photo_url; ?>" alt="<?php the_title_attribute(); ?>">
                          <div class="overlaySingle">
                               <div class="fullscreen-icon" data-full="<?php echo esc_url($photo_url); ?>" data-category="<?php echo esc_attr($categorie_name); ?>" data-reference="<?php echo esc_attr($reference); ?>">
                                     <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/fullscreen.svg" alt="Icone fullscreen">
                               </div>
                           </div>
            </div> 
        
            <div class="frame">
                <h2><?php echo get_the_title(); ?></h2>
                <div class="photo-champs">
                    <p>Référence: <?php echo $reference; ?></p>
                    <p>Type: <?php echo $type; ?></p>
                </div>
                <div class="taxonomies">
                    <?php
                    $taxonomies = [
                        ['label' => 'Formats', 'data' => $formats],
                        ['label' => 'Catégories', 'data' => $categories],
                        ['label' => 'Années', 'data' => $annees]
                    ];
                    ?>
                    <?php foreach ($taxonomies as $taxonomy) : ?>
                        <div class="pair">
                            <p><?php echo $taxonomy['label']; ?>:</p>
                            <div class="values">
                                <?php foreach ($taxonomy['data'] as $item) : ?>
                                    <?php echo $item->name; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="contenairContact"> 
            <div class="contact"> 
              <p> Cette photo vous intéresse ? </p>
              <button id="contact-btn" data-reference="<?php echo $reference; ?>">Contact</button>
            </div>

            <div class="navPhotos">
    
             <!-- Conteneur pour la miniature -->
                 <div class="minPhoto" id="minPhoto">
                 <!-- La miniature sera chargée ici par JavaScript -->
                </div>
                 
                <div class="navArrow">
    
                 <?php if (!empty($previousPost)) : ?>
                     <img class="arrow arrow-left" src="<?php echo get_theme_file_uri() . '/assets/img/left.png'; ?>" alt="Photo précédente" data-thumbnail-url="<?php echo $previousThumbnailURL; ?>" data-target-url="<?php echo esc_url(get_permalink($previousPost->ID)); ?>">
                <?php endif; ?>

                 <?php if (!empty($nextPost)) : ?>
                    <img class="arrow arrow-right" src="<?php echo get_theme_file_uri() . '/assets/img/right.png'; ?>" alt="Photo suivante" data-thumbnail-url="<?php echo $nextThumbnailURL; ?>" data-target-url="<?php echo esc_url(get_permalink($nextPost->ID)); ?>">
                 <?php endif; ?>
            </div>
        
    </div>       
    
</section>



             <div class="Title">
                 <h3>VOUS AIMEREZ AUSSI</h3>
             </div>
            <div class="related">

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
                                 $photo_url = get_the_post_thumbnail_url(null, "large");
                                 $reference = get_field('référence');
                                 $categorie_name = isset($categories[0]) ? $categories[0]->name : '';
            ?>
                                     <?php  get_template_part('template-parts/photo_block'); ?>

                                    <?php
                                }
        wp_reset_postdata();
    } else {
        echo '<p>No related photos found.</p>';
    }
    ?>

</div>
     <button id="all_photos">
         <a href="<?php echo home_url(); ?>#photos-container">Toutes les photos</a>
    </button>

  
<?php get_footer(); ?>