<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 */
?>
<div id="sidebar" class="cfix">
			<ul>

<?php if ( ! dynamic_sidebar( 'primary-sidebar' ) ) : ?>
	
			<li class="side-search-form">
				<?php get_search_form(); ?>
			</li>

			<li class="side-archives">
				<h3><?php _e( 'Archives', 'twentyten' ); ?></h3>
				<ul>
					<?php wp_get_archives( 'type=monthly' ); ?>
				</ul>
			</li>

		<?php endif; // end primary widget area ?>
			</ul>

<?php
	// A second sidebar for widgets, just because.
	if ( is_active_sidebar( 'secondary-sidebar' ) ) : ?>

			<ul>
				<?php dynamic_sidebar( 'secondary-widget-area' ); ?>
			</ul>

<?php endif; ?>
</div>