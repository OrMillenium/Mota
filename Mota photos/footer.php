<footer>


    <nav>
        <?php
        
        wp_nav_menu([
          'theme_location' => 'footer-menu'
      ]);
        ?>
</nav>


</footer>


<?php get_template_part('template-parts/modale'); 

 wp_footer(); ?>
</body>
</html>