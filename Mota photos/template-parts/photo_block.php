

<div class="Related">
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
        $index = 0; // Initialise l'index à 0 , avant de commencer la boucle
        while ($related_block->have_posts()) {
            $related_block->the_post();
            $photo_url = get_field('photo');
            $reference = get_field('référence');
            $categorie = get_the_terms(get_the_ID(), 'categorie')[0]->name;
            ?>

            <div class="related_block">

<!-- Création de la partie photos apparentées -->
<?php
// Obtient l'URL de la photo associée à l'article
$photo = get_the_post_thumbnail_url(null, "large");

// Obtient le titre de l'article
$photo_titre = get_the_title();

// Obtient l'URL de l'article
$post_url = get_permalink();

// Obtient la référence depuis le champ personnalisé 'référence'
$reference = get_field('référence');

// Obtient les catégories de l'article
$categories = get_the_terms(get_the_ID(), 'categorie');

// Obtient le nom de la première catégorie de l'article
$categorie_name = $categories[0]->name;
?>





                <?php echo get_the_post_thumbnail(null, 'large'); ?>

                <div class="overlay">
                   
                     <h2><?php echo $reference; ?></h2>


                      <h3><?php echo $categorie_name; ?></h3>

                    <div class="eye-icon">
                        <a href="<?php echo esc_url(get_permalink()); ?>">
                            <img src="<?php echo esc_url(get_template_directory_uri()) ?>/assets/img/icon_eye.svg" alt="voir la photo">
                        </a>
                    </div>
                    <div class="fullscreen-icon">
                       
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/fullscreen.svg" alt="Icone fullscreen">
                    </div>
                </div>
            </div>

            <?php
            $index++; // Incrémente l'index pour chaque photo
        }
        wp_reset_postdata();
    }
    ?>
</div>


