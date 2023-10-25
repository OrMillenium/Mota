<?php
$type = get_field('type');
$reference = get_field('référence');
$categories = get_the_terms(get_the_ID(), 'categorie');
$formats = get_the_terms(get_the_ID(), 'format');
$annees = get_the_terms(get_the_ID(), 'annee');
?>

<section class="catalogue">
    <div class="gallery_pics" data-postid="<?php echo get_the_ID(); ?>">
        <div class="photo-details">
            <?php echo get_the_post_thumbnail(); ?>
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
         <div class="nav-photos">
         
             <div class="min-photo" >
             <?php $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>
            <img src="<?php echo $thumbnail_url; ?>" alt="Thumbnail">
            </div>
       
    
             <div class="nav-arrow">
                 <img class="arrow left-arrow" data-image="<?php echo get_field('champ_image_gauche'); ?>" src="<?php echo get_theme_file_uri() . '/assets/img/left.png'; ?>" alt="arrow left">
                 <img class="arrow right-arrow" data-image="<?php echo get_field('champ_image_droite'); ?>" src="<?php echo get_theme_file_uri() . '/assets/img/right.png'; ?>" alt="arrow right">
            </div>
          </div>
    <?php
$thumbnail_url = get_the_post_thumbnail_url(get_the_ID());
$left_image_url = get_field('champ_image_gauche');
$right_image_url = get_field('champ_image_droite');

echo "Thumbnail URL: $thumbnail_url <br>";
echo "Left Image URL: $left_image_url <br>";
echo "Right Image URL: $right_image_url <br>";
?>
    </div>       

</section>

<div class="Title">
    <h3>VOUS AIMEREZ AUSSI</h3>
</div>
<section class="Related">

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
    }
    ?>

</section>
<button id="all_photos">Toutes les photos</button>
<a href="<?php echo home_url(); ?>"></a>






 

    