<?php
/**
 * The template for displaying the footer.
 */
?>




<footer>



<?php wp_nav_menu( array( 'container_class' => 'footer-menu', 'theme_location' => 'footer' ) ); ?>





<div id="address" itemscope itemtype="http://schema.org/Organization">
<a itemprop="url" href="<?php echo site_url(); ?>"><div itemprop="name"><strong><?php echo get_bloginfo('name'); ?></strong></div>
</a>
<ul itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
<?php if(of_get_option('organ_address')) { ?><li itemprop="streetAddress"><?php echo of_get_option('organ_address'); ?></li><?php } ?>
<?php if(of_get_option('organ_address_2')) { ?><li itemprop="streetAddress"><?php echo of_get_option('organ_address_2'); ?></li><?php } ?>
<?php if(of_get_option('organ_po_box')) { ?><li>P.O. Box: <span itemprop="postOfficeBoxNumber"><?php echo of_get_option('organ_po_box'); ?></span></li><?php } ?>
<?php if(of_get_option('organ_city')) { ?><li itemprop="addressLocality"><?php echo of_get_option('organ_city'); ?></li><?php } ?>
<?php if(of_get_option('organ_state')) { ?><li itemprop="addressRegion"><?php echo of_get_option('organ_state'); ?></li><?php } ?>
<?php if(of_get_option('organ_post_code')) { ?><li itemprop="postalCode"><?php echo of_get_option('organ_post_code'); ?></li><?php } ?>
<?php if(of_get_option('organ_country')) { ?><li itemprop="addressCountry"><?php echo of_get_option('organ_country'); ?></li><?php } ?>
</ul>
</div>








<p>&copy; <?php print date('Y'); ?> - <?php echo get_bloginfo('name'); ?></p>
<div class="web-credit">
<p>Website Design by <?php website_developer(); ?></p>
</div>


<?php wp_footer();?> 

<?php if(of_get_option('social_google_plus')) { ?><a href="<?php echo of_get_option('social_google_plus'); ?>" rel="publisher" />Google+</a><?php } ?>



</footer>

</div><!-- end container -->

</body>
</html> 