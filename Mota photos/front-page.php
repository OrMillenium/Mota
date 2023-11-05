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

<div class="photo-filters">
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
</div>



<section id="photos-container" class="catalogue_block">

<?php echo get_template_part('template-parts/photo_block'); ?>
</section>

</section>
<div>
    <button id="load-more">Charger plus</button>
</div>

<?php get_footer(); ?>
