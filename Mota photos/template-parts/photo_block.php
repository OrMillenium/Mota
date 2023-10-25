<?php
// Template Name: Page d'Accueil
?>

<?php get_header(); ?>

<div class="photo-champs">
<?php
// Code pour les taxonomies
$taxonomies = [
    'categorie' => 'CATÉGORIES',
    'format' => 'FORMATS',
    'annee' => 'TRIER PAR'
];

foreach ($taxonomies as $taxonomy => $label) {
    $terms = get_terms($taxonomy);
    if ($terms && !is_wp_error($terms)) {

        echo "<select id='$taxonomy' class='custom-select'>";
        echo "<option value='' disabled selected class='defaultOption'>$label</option>";
        foreach ($terms as $term) {
            echo "<option value='$term->slug' class='term-option'>$term->name</option>"; 
        }
        echo "</select>";
    }
}
?>
</div>

<section  id="photos-container"class="catalogue_block">
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