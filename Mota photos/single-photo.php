<?php
/*
Template Name: Single

*/


get_header();
?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo get_template_directory_uri() . '/js/script.js'; ?>"></script>


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