<footer>


    <nav>
        <?php
        
        wp_nav_menu([
          'theme_location' => 'footer-menu',
          'container'      => false, 
          ]);
        ?>
</nav>
<?php get_template_part('template-parts/modale'); ?>
<?php get_template_part('template-parts/lightbox'); ?>



</footer>



<?php wp_footer(); ?>
</body>
</html>