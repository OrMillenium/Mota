
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
                                <div class="fullscreen-iconSingle"  >
                                     <img src="<?php echo get_template_directory_uri(); ?>/assets/img/fullscreen.svg" alt="Icone fullscreen">
                                </div>
                           </div>
            </div> 
        
            <div class="frame">
                <h2><?php echo get_the_title(); ?></h2>
                <div class="photo-champs">
                    <p>Type: <?php echo $type; ?></p>
                    <p>Référence: <?php echo $reference; ?></p>
                </div>
                <div class="taxonomies">
                    <?php
                    $taxonomies = [
                        ['label' => 'Catégories', 'data' => $categories],
                        ['label' => 'Formats', 'data' => $formats],
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
            <button id="contact-btn"  data-reference="<?php echo $reference; ?>">Contact</button>
        </div>

        <div class="navPhotos">
            <!-- Conteneur pour la miniature de la photo précédente -->
            <?php if ($previousThumbnailURL) : ?>
                <div class="minPhoto minPhoto-left">
                    <a href="<?php echo esc_url(get_permalink($previousPost->ID)); ?>">
                        <img src="<?php echo $previousThumbnailURL; ?>" alt="<?php echo esc_attr(get_the_title($previousPost->ID)); ?>">
                    </a>
                </div>
            <?php endif; ?>
            
            <!-- Conteneur pour la miniature de la photo suivante -->
            <?php if ($nextThumbnailURL) : ?>
                <div class="minPhoto minPhoto-right">
                    <a href="<?php echo esc_url(get_permalink($nextPost->ID)); ?>">
                        <img src="<?php echo $nextThumbnailURL; ?>" alt="<?php echo esc_attr(get_the_title($nextPost->ID)); ?>">
                    </a>
                </div>
            <?php endif; ?>

            <div class="navArrow">
                <!-- Flèche gauche pour la photo précédente -->
                <?php if (!empty($previousPost)) : ?>
                    <img class="arrow arrow-left" src="<?php echo get_theme_file_uri() . '/assets/img/left.png'; ?>" alt="Photo précédente" data-previous-photo="<?php echo esc_url(get_permalink($previousPost->ID)); ?>">
                <?php endif; ?>
                
                <!-- Flèche droite pour la photo suivante -->
                <?php if (!empty($nextPost)) : ?>
                    <img class="arrow arrow-right" src="<?php echo get_theme_file_uri() . '/assets/img/right.png'; ?>" alt="Photo suivante" data-next-photo="<?php echo esc_url(get_permalink($nextPost->ID)); ?>">
                <?php endif;?>
            </div>
                   </div>
        
       
         
    </div>       
    
    


</section>

<div class="Title">
    <h3>VOUS AIMEREZ AUSSI</h3>
</div>

<?php echo get_template_part('template-parts/photo_block'); ?>


<button id="all_photos">
    <a href="<?php echo home_url(); ?>#photos-container">Toutes les photos</a>
</button>


<?php get_footer(); ?>