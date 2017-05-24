<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> and <header> section
 *
 */
?>
<!DOCTYPE html> 
<!--[if lt IE 7 ]> <html lang="en" class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en"class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8" />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<title>
<?php wp_title( '-', true, 'right' ); ?>
</title>
<meta name="author" content="Rick Middleton, e-Fox Web Solutions" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
<link rel="apple-touch-icon" href="<? echo get_template_directory_uri(); ?>/images/apple-touch-icon@2x.png"> 
<?php wp_head(); ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
</head>

<body <?php body_class(); ?>>

<div class="container cfix">

<header class="cfix">
<a id="logo" href="/"><img src="<?php echo of_get_option('logo'); ?>" alt="Logo" /></a> 

<?php if(of_get_option('social_facebook')|| of_get_option('social_youtube')|| of_get_option('social_twitter')|| of_get_option('social_rss')|| of_get_option('social_pinterest')) { ?>
<ul class="social-media">
<?php if(of_get_option('social_facebook')) { ?><li><a href="<?php echo of_get_option('social_facebook'); ?>"><i class="fa fa-facebook"></i></a></li><?php } ?>
<?php if(of_get_option('social_youtube')) { ?><li><a href="<?php echo of_get_option('social_youtube'); ?>"><i class="fa fa-youtube"></i></a></li><?php } ?>
<?php if(of_get_option('social_twitter')) { ?><li><a href="<?php echo of_get_option('social_twitter'); ?>"><i class="fa fa-twitter"></i></a></li><?php } ?>
<?php if(of_get_option('social_rss')) { ?><li><a href="<?php echo of_get_option('social_rss'); ?>"><i class="fa fa-rss"></i></a></li><?php } ?>
<?php if(of_get_option('social_pinterest')) { ?><li><a href="<?php echo of_get_option('social_pinterest'); ?>"><i class="fa fa-pinterest"></i></a></li><?php } ?> 
</ul>
<?php } ?>



<div class="telnumber">
<?php if(of_get_option('telephone_number')) { ?>
<p><a href="tel:<?php echo str_replace(' ','',of_get_option('telephone_number')); ?>" onclick="_gaq.push(['_trackEvent','Click-to-Call','Contact','<?php echo str_replace(' ','',of_get_option('telephone_number')); ?>']);"><?php echo of_get_option('telephone_number'); ?></a></p>
<?php } ?>
</div>


<a class="button mobile-menu"><i class="fa fa-th-list"></i> Menu</a>


      <nav class="cfix">
   
          <?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
      
      </nav>
	  
	  <script type="text/javascript">

jQuery('.mobile-menu').click(function() {
jQuery('nav').slideToggle('fast', function() {
});
}); 



jQuery('li.menu-item-has-children').addClass('noclick');



var widthl = jQuery(document).width();
  if ( widthl < 960 ) {
jQuery('li.menu-item-has-children.noclick a').click(function(event) { 
if(jQuery(this).parent().parent().hasClass('sub-menu')) { 
} else if(jQuery(this).parent().hasClass('click')) { 
jQuery(this).parent().removeClass('click');
return false;
} else {
jQuery('li.menu-item-has-children').removeClass('click');
jQuery(this).parent().toggleClass('click');
return false;
}
});
} 
</script>
	  
</header>



