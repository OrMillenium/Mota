
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <?php wp_head(); ?>
</head>

 <?php wp_body_open(); ?>

<body <?php body_class(); ?>>
    
   <header class="site-header">
   
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Logo.svg" alt="Logo">
   


    <nav role="navigation" class="Menu">
        <?php
        
        wp_nav_menu([
          'theme_location' => 'main-menu',
          
      ]);
        ?>
    </nav>

    <div class="toggle_btn ">
       <span> </span>
    </div> 

  </header>
 
   
    



