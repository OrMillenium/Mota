<?php

$photo_url = get_the_post_thumbnail_url(null, "large");
$photo_titre = get_the_title();
$post_url = get_permalink();
$reference = get_field('référence');
$categories = get_the_terms(get_the_ID(), 'categorie');
$categorie_name = $categories[0]->name;
?>


            <div class="related_block">
                <img src="<?php echo esc_url($photo_url); ?>" alt="<?php the_title_attribute(); ?>">

                <div class="overlay">
                    <h2><?php echo esc_html($reference); ?></h2>
                    <h3><?php echo esc_html($categorie_name); ?></h3>

                    <div class="eye-icon">
                        <a href="<?php echo esc_url(get_permalink()); ?>">
                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/icon_eye.svg" alt="voir la photo">
                        </a>
                    </div>
                    <div class="fullscreen-icon">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/fullscreen.svg" alt="Icone fullscreen">
                    </div>
                </div>
            </div>
            
       