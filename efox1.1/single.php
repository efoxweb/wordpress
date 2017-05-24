<?php
/**
 * The Template for displaying all single posts.
 */

get_header(); ?>

<div id="news-wrapper" class="cfix">
<div id="newsposts" class="cfix">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<article class="singlepost content cfix">
	
	<?php echo get_the_post_thumbnail($page->ID, 'medium', array('class' => 'postimg cfix'));  ?> 

<h1><?php the_title(); ?></h1>

						<?php theme_posted_on(); ?>
                        
                    
 
						<?php the_content(); ?>
						
						<?php theme_posted_in(); ?>
						
					
</article>

  
<?php endwhile; // end of the loop. ?>

</div>

<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>