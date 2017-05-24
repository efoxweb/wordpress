<?php
/**
 * The loop that displays posts.
 */
?>

<?php /* Display navigation to next/previous pages when applicable if no WP Page Navi */ ?>

<?php if ( $wp_query->max_num_pages > 1 && !function_exists('wp_pagenavi')) : ?>
		<?php next_posts_link( __( '&larr; Older posts', 'twentyten' ) ); ?>
		<?php previous_posts_link( __( 'Newer posts &rarr;', 'twentyten' ) ); ?>
<?php endif; ?> 


<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
		<h1><?php _e( 'Not Found', 'twentyten' ); ?></h1>
		<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyten' ); ?></p>
		<?php get_search_form(); ?>

<?php endif; ?>

<?php
	/* Start the Loop.
	 *
	 * In Twenty Ten we use the same loop in multiple contexts.
	 * It is broken into three main parts: when we're displaying
	 * posts that are in the gallery category, when we're displaying
	 * posts in the asides category, and finally all other posts.
	 *
	 * Additionally, we sometimes check for whether we are on an
	 * archive page, a search page, etc., allowing for small differences
	 * in the loop on each template without actually duplicating
	 * the rest of the loop that is shared.
	 *
	 * Without further ado, the loop:
	 */ ?>
<?php while ( have_posts() ) : the_post(); ?>



<?php /* How to display all posts. */ ?>
<article class="singlepost content fix">
<?php if(has_post_thumbnail()) { ?> 
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo get_the_post_thumbnail($page->ID, 'thumbnail', array('class' => 'postimg cfix'));  ?></a>
<?php } ?>
        <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
	    <?php theme_posted_on(); ?> 

	<?php if ( is_archive() || is_search()  || is_home()) : // Only display excerpts for archives and search. ?>
			<?php the_excerpt(); ?>
	<?php else : ?> 
			<?php the_content( __( 'Continue reading &rarr;', 'twentyten' ) ); ?>
	<?php endif; ?>

				<?php if ( count( get_the_category() ) ) : ?>
                <div class="posted-in">
					<?php printf( __( 'Posted in %2$s', 'twentyten' ), '', get_the_category_list( ', ' ) ); ?>
                </div>
			
				<?php endif; ?>
		

</article>
	

<?php endwhile; // End the loop. Whew. ?>

<?php 
if(function_exists('wp_pagenavi')) {
	wp_pagenavi();
} ?> 
