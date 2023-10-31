<?php get_header(); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo get_template_directory_uri() . '/js/script.js'; ?>"></script>

<?php
$photo_args = array(
    'post_type' => 'photo',
    'posts_per_page' => 1,
    'orderby'   => 'rand',
);

$photo_query = new WP_Query($photo_args);

if ($photo_query->have_posts()) {
    while ($photo_query->have_posts()) {
        $photo_query->the_post();
        ?>
        <section id="header">
            <div class="banner">
                <h1>Photographe event</h1>
                <?php
                echo get_the_post_thumbnail(get_the_ID(), 'full'); // Affiche la miniature en taille complète
                ?>
            </div>
	        <?php
    }
wp_reset_postdata();
}
?>
       
         </section> 


<div class="photo-filters">
<?php
// Affichage taxonomies
$taxonomies = [
    'categorie' => 'CATÉGORIES',
    'format' => 'FORMATS',
    'annee' => 'TRIER PAR'
];

foreach ($taxonomies as $taxonomy => $label) {
    $terms = get_terms($taxonomy);
    if ($terms && !is_wp_error($terms)) {

        echo "<select id='$taxonomy' class='custom-select' >";
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

<?php
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'orderby' => 'rand',
    );
    $related_block = new WP_Query($args);

    if ($related_block->have_posts()) {
        while ($related_block->have_posts()) {
            $related_block->the_post();
            $photo_url = get_field('photo');
            ?>

            <div class="related_block"
                 data-imgurl="<?php echo $photo_url; ?>"
                 data-reference="<?php the_title(); ?>"
                 data-categorie="<?php echo $category_name; ?>">
                 

                <?php echo get_the_post_thumbnail(get_the_ID(), 'large'); ?>
                <div class="overlay">
                    <img class="eye-icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon_eye.svg"
                         alt="Icone oeil">
                    <img class="fullscreen-icon"
                         src="<?php echo get_template_directory_uri(); ?>/assets/img/fullscreen.svg"
                         alt="Icone fullscreen">
                </div>
            </div>

        <?php
        }
        wp_reset_postdata();
    }
    ?>
</section>

<div>
    <button id="load-more">Charger plus</button>
</div>

<?php get_footer(); ?>
    


