<?php

/* Enqueue styles and scripts */
function theme_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_script('custom-ajax-load', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', true);

    
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'orderby' => 'rand',
        'order' => 'DESC' 
    );

    wp_localize_script('custom-ajax-load', 'ajaxloadmore', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'query_vars' => json_encode($args)
    ));
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');




function register_my_supports() {

    
    add_theme_support( 'post-thumbnails' );

    add_theme_support( 'title-tag' );

    // Ajout menu principal et menu footer
    register_nav_menu( 'main-menu', __( 'Menu principal', 'mota' ) );
    register_nav_menu( 'footer-menu', __( 'Menu footer', 'mota' ) );

    // Affichage CPT Photo
    $labels = array(
        'name' => 'Photos',
        'singular_name' => 'Photo',
        'add_new_item' => 'Ajouter une photo',
        'edit_item' => 'Modifier la photo',
        'new_item' => 'Nouvelle photo',
        'view_item' => 'Voir la photo',
        'search_items' => 'Rechercher parmi les photos',
        'not_found' => 'Aucune photo trouvée',
        'not_found_in_trash' => 'Aucune photo trouvée dans la corbeille',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_rest' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        'menu_position' => 5,
        'menu_icon' => 'dashicons-camera',
    );

    register_post_type( 'photo', $args );
}

add_action( 'after_setup_theme', 'register_my_supports' );


/* chargement photos ajax load more */

function load_more_photos() {
    $paged = $_POST['page'] + 1; 
    $query_vars = json_decode(stripslashes($_POST['query']), true); 
    $query_vars['paged'] = $paged; 
    $query_vars['posts_per_page'] = 8; 
    $query_vars['orderby'] = 'date'; 

    $photos = new WP_Query($query_vars);
    if ($photos->have_posts()) {
        ob_start();
        while ($photos->have_posts()) {
            $photos->the_post();
            get_template_part('template-parts/photo_block', null);
        }
        wp_reset_postdata();

        $output = ob_get_clean(); // Get the buffer and clean it
        echo $output; // Echo the output
    } 
    else {
        ob_clean(); // Clean any previous output
        echo 'no_posts';
    }
        die();
       
}
add_action('wp_ajax_nopriv_load_more', 'load_more_photos');
add_action('wp_ajax_load_more', 'load_more_photos');

/*Filtres*/

add_action('wp_ajax_filter_photos', 'filter_photos_function');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos_function');

function filter_photos_function(){
    
    $filter = $_POST['filter'];
    
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => -1, 
        'tax_query' => array(
            'relation' => 'AND',
        )
    );
    
    // Ajoute chaque filtre à la tax query si elle est définie
    if(!empty($filter['categorie'])){
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field'    => 'slug',
            'terms'    => $filter['categorie'],
        );
    }

    if(!empty($filter['format'])){
        $args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field'    => 'slug',
            'terms'    => $filter['format'],
        );
    }

    if(!empty($filter['annee'])){
        $args['tax_query'][] = array(
            'taxonomy' => 'annee',
            'field'    => 'slug',
            'terms'    => $filter['annee'],
        );
    }
    
    $query = new WP_Query($args);
    
    if($query->have_posts()){
        while($query->have_posts()){
            $query->the_post();
    
            get_template_part('template-parts/photo_block', null);
        }
        wp_reset_postdata();
    } else {
        echo 'Aucune photo correspondant aux critères de filtrage.';
    }
    
    die();
}
