<?php

/* Enqueue styles */
/* Enqueue styles */
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_script( 'scriptJs', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '1.0', true );

    $ajax_url = admin_url( 'admin-ajax.php' );

    wp_add_inline_script( 'script', "var ajaxurl = '{$ajax_url}';", 'before' );
}

function register_my_supports() {

    // Ajouter la prise en charge des images mises en avant
    add_theme_support( 'post-thumbnails' );

    // Ajouter automatiquement le titre du site dans l'en-tête du site
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

function photos_request() {
    $page = $_POST['page'];
    $offset = ($page - 1) * 12;
    $query = new WP_Query(array(
        'post_type' => 'photo',
        'posts_per_page' => 12,
        'offset' => $offset
    ));

    if($query->have_posts()) {
        $posts = $query->posts;
        wp_send_json($posts);
    } else {
        wp_send_json(false);
    }
    wp_die();
}

add_action( 'after_setup_theme', 'register_my_supports' );
add_action('wp_ajax_request_photos','photos_request');
add_action('wp_ajax_nopriv_request_photos','photos_request');

?>