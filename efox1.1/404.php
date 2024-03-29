<?php
/**
 * The template for displaying 404 pages (Not Found). 
 */

get_header(); ?>


  <div class="content">
				<h1><?php _e( '404 ERROR - Page Not Found', 'twentyten' ); ?></h1>
				<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'twentyten' ); ?></p>
				<?php get_search_form(); ?> 

	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>
     
    </div>

<?php get_footer(); ?>