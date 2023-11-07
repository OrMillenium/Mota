<?php get_header(); ?>



<section id="header">
    <div class="banner">
        <h1>Photographe event</h1>
        <?php
        $photo_args = array(
            'post_type' => 'photo',
            'posts_per_page' => 1,
            'orderby' => 'rand',
        );

        $photo_query = new WP_Query($photo_args);

        if ($photo_query->have_posts()) {
            while ($photo_query->have_posts()) {
                $photo_query->the_post();
                echo get_the_post_thumbnail(get_the_ID(), 'full'); // Affiche la miniature en taille complète
            }
            wp_reset_postdata();
        }
        ?>
    </div>
</section>

<section id="photo-filters">
    <?php
    // Affichage taxonomies
    $taxonomy = [
        'categorie' => 'CATÉGORIES',
        'format' => 'FORMATS',
        'annee' => 'TRIER PAR',
    ];

    foreach ($taxonomy as $taxonomy_slug => $label) {
        $terms = get_terms($taxonomy_slug);
        if ($terms && !is_wp_error($terms)) {

            echo "<select id='$taxonomy_slug' class='custom-select'>";
            echo "<option value='' disabled selected class='defaultOption'>$label</option>";
            foreach ($terms as $term) {
                echo "<option value='$term->slug' class='term-option'>$term->name</option>";
            }
            echo "</select>";
        }
    }
    ?>
</section>







<section id="photos-container" class="catalogue_block">

<?php
// Récupération de 8 photos aléatoires pour le bloc initial
$args = array(
    'post_type' => 'photo',
    'posts_per_page' => 8,
    'orderby' => 'date',
    'order' => 'ASC',
);
$photo_block = new WP_Query($args);

// Ajout de la variable globale pour le script AJAX
wp_localize_script('custom-ajax-load', 'ajaxloadmore', array(
    'ajaxurl' => admin_url('admin-ajax.php'),
    'query_vars' => json_encode($args)
));

if ($photo_block->have_posts()) :
    
        set_query_var('photo_block_args', array('context' => 'front-page'));
        while ($photo_block->have_posts()) :
            $photo_block->the_post();
        get_template_part('template-parts/photo_block', get_post_format());?>

<?php
        endwhile; 
        wp_reset_postdata(); 
    else :
        echo 'Aucune photo trouvée.';
    endif; 
    ?>



<!-- Bouton Charger plus -->
<div id="photo-block-more">
<button id="load-more" data-page="1" data-url="<?php echo admin_url('admin-ajax.php'); ?>">Charger plus</button>
</div>

</section>
<?php get_footer(); ?>
