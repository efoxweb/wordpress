<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>






<h1><?php the_heading(); ?></h1>










    <div class="content">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <?php the_content(); ?>
    <?php endwhile; ?>
    </div>




    



    


    

<?php get_footer(); ?>
