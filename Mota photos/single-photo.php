<?php
/*
Template Name: Single

*/


get_header();
?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo get_template_directory_uri() . '/js/script.js'; ?>"></script>


        <?php
            $args = array(
                'post_type' => 'photos',
                'posts_per_page' => 1,
                'meta_key'  => 'catalogue_photos',
                'orderby'   => 'meta_value_num',

            );
            $photos_query = new WP_Query($args);
         ?>


    
        <?php
         // AFFICHAGE DES PUBLICATIONS SUR LA PAGE
         while (have_posts()) :
             
             the_post();
        
             get_template_part('template-parts/only-photo');
         endwhile;
         ?>
    



<?php
get_footer();
?>