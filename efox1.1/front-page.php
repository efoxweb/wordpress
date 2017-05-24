<?php
/**
 * Template Name: Homepage
 *
 * A custom page template for only the homepage
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.

 */

get_header(); ?>	


    <div class="content">
    <h1><?php the_heading(); ?></h1> 
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <?php the_content(); ?>
    <?php endwhile; ?>
    </div>




<div class="latest-news cfix">
<h3><a href="/news" title="News">Latest News</a></h3>
   
    <?php query_posts('cat=1&showposts=1'); if (have_posts()) : while (have_posts()) : the_post(); ?>
    

    <p class="news-heading"><span class="post-date"><?php echo get_the_date(); ?></span> - <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
    
      <div class="newsdesc">
        <?php the_excerpt(); ?>
    </div>
    <?php endwhile; else:?>
    <p class="newsheading">There is currently no news to show </p>
    <?php ; endif; ?>
    <?php wp_reset_query(); ?>



</div>  



<?php get_footer() ?>
