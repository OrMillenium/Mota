<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mota
 */

get_header();
?>

<main id="primary" class="site-main">

<?php

if (have_posts()) :

	if (is_home() && !is_front_page()) :
?>
		<header>
			<h1 class="page-title screen-reader-text"><?php single_posts_title(); ?></h1>
		</header>
<?php

/* AFFICHAGE DES PUBLICATIONS SUR LA PAGE */
	endif;

	while (have_posts()) :
		the_post();

		get_template_part('template-parts/content');

	endwhile; 
?>


<?php endif; ?>

</main><!-- #main -->

<?php
//get_sidebar();
get_footer();
