<?php
/*
Template Name: Single

*/


get_header();
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="<?php echo get_template_directory_uri() . '/js/script.js'; ?>"></script>




<?php
$photo_url = get_field('photos');
var_dump(get_field('photos'));
$type = get_field('type');
$reference = get_field('référence');
$categories = get_the_terms(get_the_ID(), 'categorie');
$formats = get_the_terms(get_the_ID(), 'format');
$annees = get_the_terms(get_the_ID(), 'annee');
$nextPost = get_next_post();
$previousPost = get_previous_post();
$thumbnail_url = get_the_post_thumbnail_url($post->ID, 'thumbnail');



?>

<section class="catalogue">
    <div class="gallery_pics" >
        <div class="photo-details">
        <img src="<?php echo $photo_url; ?>" alt="<?php the_title_attribute(); ?>">
        
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
         
         <div class="minPhoto">
    
    
        <a href="<?php echo esc_url(get_permalink()); ?>">
        <img src="<?php echo $thumbnail_url; ?>" alt="Thumbnail">
        </a>
    
       
        </div>
            
            <div class="navArrow">
            
            <img class="arrow arrow-left" data-previous-photo="<?php echo get_permalink($previousPost); ?>" src="<?php echo get_theme_file_uri() .'/assets/img/left.png';?>" alt="photos précèdente" >
            <img class="arrow arrow-right" data-next-photo="<?php echo get_permalink($nextPost); ?>" src="<?php echo get_theme_file_uri() .'/assets/img/right.png';?>" alt="photos suivante" >
            
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