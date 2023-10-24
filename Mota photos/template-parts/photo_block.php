<?php
// Template Name: Page d'Accueil
?>

<?php get_header(); ?>

<?php
// Code pour les taxonomies
$taxonomies = [
    'categorie' => 'Catégories',
    'format' => 'Formats',
    'annee' => 'Années'
];

foreach ($taxonomies as $taxonomy => $label) {
    $terms = get_terms($taxonomy);
    if ($terms && !is_wp_error($terms)) {
        echo "<label for='$taxonomy'>$label:</label>";
        echo "<select id='$taxonomy'>";
        foreach ($terms as $term) {
            echo "<option value='$term->slug'>$term->name</option>";
        }
        echo "</select>";
    }
}
?>

<section class="catalogue_block">
    <?php
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
    );

    $related_photos = new WP_Query($args);

    while ($related_photos->have_posts()) {
        $related_photos->the_post();
        $photo_url = get_field('photo');
        ?>
        <div class="related_block">
            <?php echo get_the_post_thumbnail(); ?>
        </div>
        <?php
    }
   
        wp_reset_postdata();
    
    ?>
    
</section>
<button id="load-more">Charger plus</button>

<?php get_footer(); ?>