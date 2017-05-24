<?php session_start(); 
if($_GET['view'] == 'true' && !$_SESSION['viewing']) { session_start(); $_SESSION['viewing'] = 'set'; } 
if ( !is_user_logged_in() && $_GET['view'] !== 'true' && !$_SESSION['viewing'] ) { ?>
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
		<title><?php echo get_bloginfo('name'); ?> - Site Coming Soon</title>
		
		</head>

<body style="margin:30px auto; text-align:center; background-color:#fff;">
<div align="center">
		<img src="<?php echo get_template_directory_uri(); ?>/screenshot.jpg" width="350" height="225" />
		<h1>Website Under Development</h1>
</div>
</body></html>
<?php die; } // insert coming soon message or in development message above.

  

/*
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
require_once dirname( __FILE__ ) . '/inc/options-framework.php';


add_action( 'optionsframework_custom_scripts', 'optionsframework_custom_scripts' );

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});

	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}

});
</script>

<?php
}
  
  

add_action( 'after_setup_theme', 'theme_setup' );

if ( ! function_exists( 'theme_setup' ) ):

function theme_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'theme', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'theme' ),
		'footer' => __( 'Footer Navigation', 'theme' ),
		'secondary' => __( 'Secondary Navigation', 'theme' ),
	) );


}
endif;


/* Excerpt Options 
------------------------------------------- 
- exceprt length
- trim excerpt
- continue reading link
------------------------------------------- */

function theme_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'theme_excerpt_length' );

function trim_excerpt($text) {
  return str_replace(' [&hellip;]','&hellip;',$text);
  return str_replace('[&hellip;]','&hellip;',$text); 
}
add_filter('get_the_excerpt', 'trim_excerpt');

/* Returns a "Continue Reading" link for excerpts */
function theme_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'theme' ) . '</a>';
}


/* Theme Settings
------------------------------------------- 
- remove inline styles on gallery
- remove styles from comments widget
- posted on info
- posted in info
------------------------------------------- */

/* Remove inline styles printed when the gallery shortcode is used. */

add_filter( 'use_default_gallery_style', '__return_false' );

/* Removes the default styles that are packaged with the Recent Comments widget. */
function theme_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'theme_remove_recent_comments_style' );

if ( ! function_exists( 'theme_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function theme_posted_on($author=NULL) { ?>

<span class="posted-on">Posted <span class="post-date"><?php echo get_the_date(); ?></span><?php if($author) { ?> by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a> <?php } ?></span>
<?php }
endif;

if ( ! function_exists( 'theme_posted_in' ) ) :

function theme_posted_in() { 
if ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
?>
<span class="posted-in">Posted in <?php echo get_the_category_list( ', ' ); ?></span>
<?php }
}
endif;


/* Body Classes
-------------------------------------------------------------- */
function add_slug_body_class( $classes ) {
global $post;
if ( isset( $post )) {
$classes[] = $post->post_type . '-' . $post->post_name;
} 
$classes[] = 'efox';
return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

/* = Remove Parts of Wordpress
-------------------------------------------------------------- */

// Remove WP Generator Tag
remove_action('wp_head', 'wp_generator');

// Remove Tags from Wordpress
function unregister_taxonomy(){
    register_taxonomy('post_tag', array());
}
add_action('init', 'unregister_taxonomy');

// Remove REL=Category tags (does not validate)
function remove_category_list_rel( $output ) {
    // Remove rel attribute from the category list
    return str_replace( ' rel="category"', '', $output );
}
add_filter( 'wp_list_categories', 'remove_category_list_rel' );
add_filter( 'the_category', 'remove_category_list_rel' ); 


// Remove Comments Feeds for Pages 
remove_action('wp_head', 'feed_links', 2); 
add_action('wp_head', 'my_feed_links');

function my_feed_links() {
  if ( !current_theme_supports('automatic-feed-links') ) return;

  // post feed 
  ?>
  <link rel="alternate" type="<?php echo feed_content_type(); ?>" 
        title="<?php printf(__('%1$s %2$s Feed'), get_bloginfo('name'), ' &raquo; '); ?>"
        href="<?php echo get_feed_link(); ?> " />
  <?php 
}


/* Theme Functions
------------------------------------------
- Developer Note
- Format Link
- Output Content
- Get URL 
- Show Post Thumbnail
------------------------------------------ */

function website_developer() { 
if(is_front_page()) {
echo '<a href="http://www.efoxweb.co.uk" title="e-Fox Web Design">e-Fox Web Solutions</a>';
} else {
echo '<a href="http://www.efoxweb.co.uk" title="e-Fox Web Design" rel="nofollow">e-Fox Web Solutions</a>';
}
}

function format_link($link) {
if(strpos($link, 'http://') !== FALSE || strpos($link, 'https://') !== FALSE) {
	$link = str_replace('https://', '', $link);
	$link = str_replace('http://', '', $link);
}
$link = 'http://'.$link;
return $link;
}  

function output_content($content) {
	$txt = apply_filters('the_content', $content);
	$txt = str_replace(']]>', ']]&gt;', $txt);
	echo $txt;
	unset($txt);
}

function get_url() {
  $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
  $url .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
  $url .= $_SERVER["REQUEST_URI"];
  return $url;
}


function show_post_thumbnail( $post_id = null, $size = 'post-thumbnail', $attr = '' ) {
     $post_id = ( null === $post_id ) ? get_the_ID() : $post_id;
     $post_thumbnail_id = get_post_thumbnail_id( $post_id );

     $size = apply_filters( 'post_thumbnail_size', $size );
    
if(empty($attr['class'])) { $attr['class'] = 'entry-image'; }

     if ( $post_thumbnail_id ) {
   
          do_action( 'begin_fetch_post_thumbnail_html', $post_id, $post_thumbnail_id, $size );
          if ( in_the_loop() )
               update_post_thumbnail_cache();
          $html = wp_get_attachment_image( $post_thumbnail_id, $size, false, $attr );

           
          do_action( 'end_fetch_post_thumbnail_html', $post_id, $post_thumbnail_id, $size );

     } else {
          $html = '';
          $img = get_field('default_featured_image','options'); // default featured image location
          if($size !== 'post-thumbnail') { $image = $img['sizes'][$size]; } else { $image = $img['sizes']['thumbnail'];  }
          $html = '<img src="'.$image.'" alt="'.get_the_title($post_id).'" title="'.get_the_title($post_id).'" class="entry-image" />';
        
     }

     return apply_filters( 'post_thumbnail_html', $html, $post_id, $post_thumbnail_id, $size, $attr );
}



/* Sidebars
-------------------------------------------------------------- */

function foxdev_widgets_init() {
	// Primary Sidebar
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'theme' ),
		'id' => 'primary-sidebar',
		'description' => __( 'The primary sidebar', 'theme' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="wtitle">',
		'after_title' => '</h3>',
	) );

	// Secondary Sidebar
	register_sidebar( array(
		'name' => __( 'Secondary Sidebar', 'theme' ),
		'id' => 'secondary-sidebar',
		'description' => __( 'The secondary sidebar', 'theme' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="wtitle">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'foxdev_widgets_init' );

/* ACF Functions 
------------------------------------------
- The Heading
- Get Cat Field
- The Cat Field
- register options 
- Populate field choice (using all links)
------------------------------------------ */

function the_heading($h1='h1') {
if(function_exists('get_field')) {
if(get_field($h1)) { the_field($h1); } else { the_title();}; 
} else {
the_title();
}
}

function get_cat_field($fieldname,$taxonomy=NULL) {

if(function_exists('get_field')) {
$thetermid = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 

if(!$taxonomy) {

$taxonomy = $thetermid->taxonomy;
}

$return = get_field($fieldname,$taxonomy.'_'.$thetermid->term_id); 

return $return;

}

}

function the_cat_field($fieldname,$taxonomy=NULL) {

if(function_exists('get_field')) {
$thetermid = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 

if(!$taxonomy) {

$taxonomy = $thetermid->taxonomy;
}

$return = get_field($fieldname,$taxonomy.'_'.$thetermid->term_id); 

echo $return;

}

}


/* if(function_exists("register_options_page"))
{
    register_options_page('Options');
}

function acf_all_link_list( $field ) // SHOW ALL LINKS
{


$post_types = get_post_types(); 


unset($post_types['revision']);
unset($post_types['nav_menu_item']);
unset($post_types['acf']);
unset($post_types['attachment']);
$field['choices'] = array();

foreach($post_types as $post_type) { // loop through all post types

$post_type_name = str_replace('_','',$post_type); //get the post type name
$post_type_name = ucfirst($post_type_name); 

if($post_type == 'post') {
$blog_page = get_option( 'page_for_posts');
$field['choices'][$post_type_name][$blog_page] = '- Main Blog Page';
} 

if(get_post_type_archive_link( $post_type )) {
$field['choices'][$post_type_name]['post_archive:'.$post_type.'&posts_per_page=-1'] = '- Main '.$post_type_name.' Page'; 
} 

$posts = get_posts( 'post_type='.$post_type ); 

if($posts) :

foreach($posts as $post) :   

$field['choices'][$post_type_name][$post->ID] = $post->post_title;

	endforeach;
	endif;

	$posts = array();
	
}



 
 $choices = array();
 
	// loop through array and add to field 'choices'
	if( is_array($choices) )
	{
		foreach( $choices as $key => $val )
		{
			$field['choices'][$key] = $val;
			
		}
	} 
 
    // Important: return the field
    return $field; 
}

// v4.0.0 and above
add_filter('acf/load_field/name=link_list', 'acf_all_link_list'); */



/* Shortcodes
------------------------------------------
- Telephone Number Shortcode
- Email Address Shortcode
- Sitemap Shortcode
------------------------------------------ */

// Telephone Shortcode [tel]
function sc_post($atts, $content = null) {
       $return = of_get_option('telephone_number');
       return $return;
}
add_shortcode("tel", "sc_post");

// Email Shortcode [email]
function sc_email($atts, $content = null) {
       $return = of_get_option('email_addresss');
       return $return;
}
add_shortcode("email", "sc_email");

// Sitemap Shortcode [sitemap]
function sc_sitemap($atts, $content = null) {
	global $post;
	$pageid = $post->ID; 
       $return = wp_list_pages('title_li=&echo=0&exclude='.$pageid);
       return '<h2 class="sitemap">Sitemap</h2><ul class="sitemap">'.$return.'</ul>';  
}
add_shortcode("sitemap", "sc_sitemap"); 

/* Custom Image Sizes
-------------------------------------------------------------- */
if ( function_exists( 'add_image_size' ) ) {
     //add_image_size( 'slider', 720, 401, true );
}

/* Enque Scripts and Styles
-------------------------------------------------------------- */

		function theme_styles()  
{ 
    /* jQuery ------------------------- */
    wp_enqueue_script('jquery');

    /* Font Awesome ------------------------- */
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css', array(), 'all' );
	wp_enqueue_style( 'font-awesome' );
	
    /* Browser ------------------------- */
	wp_enqueue_script('browser',get_template_directory_uri() . '/js/browser.js'); 
	
	/* Actions ------------------------- */
	//wp_enqueue_script('actions',get_template_directory_uri() . '/js/actions.js',array(), '', true);  
	
	/* Colourbox ------------------------- */
	//wp_register_style( 'colorbox', get_template_directory_uri() . '/colorbox/colorbox.css', array(), 'all' );
    //wp_enqueue_style( 'colorbox' );
	//wp_enqueue_script('colorboxjs',get_template_directory_uri() . '/colorbox/jquery.colorbox.js' );
	
    /* Supersized Background ------------------------- */
	//wp_register_style( 'background', get_template_directory_uri() . '/background/css/supersized.css', array(), 'all' );
	//wp_enqueue_style( 'background' );
	//wp_enqueue_script('supersized',get_template_directory_uri() . '/background/js/supersized.3.2.7.js');
	
	/* Cycle 2 ------------------------- */
	//wp_enqueue_script('cycle',get_template_directory_uri() . '/cycle2/jquery.cycle2.js');

    /* CMS CSS ------------------------- */
    //wp_register_style( 'bm_cms_css', get_template_directory_uri().'/cms-styles.php');
    //wp_enqueue_style( 'bm_cms_css' );

}
add_action('wp_enqueue_scripts', 'theme_styles');

/* Admin Scripts & Styles
------------------------------------------
- Admin Styles CSS
- Menu Parent Icons Automatically
- Menu First and Last Classes
- Icons in WP Backend
- Add Custom WP Sections
------------------------------------------ */

function foxdev_admin_theme_style() {
    wp_enqueue_style('foxdev-admin-theme', get_template_directory_uri() . '/admin-styles.css');
}
add_action('admin_enqueue_scripts', 'foxdev_admin_theme_style');


add_filter( 'wp_nav_menu_objects', 'add_menu_parent_icon' );
function add_menu_parent_icon( $items ) {
	
	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}
	
	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->title = $item->title .'<i class="fa  fa-arrow-circle-o-down"></i>'; 
		}
	}
	
	return $items;    
}


// Add First and Last class to all custom wordpress menus 
add_filter( 'wp_nav_menu_objects', 'first_and_last_class' );
function first_and_last_class( $items ) {
	
	$toplev = 0;
	
	foreach ($items as $item) {

	
	$item->title = '<span>'.$item->title.'</span>';
	
	if($item->menu_item_parent == 0) {
	
	if($toplev == 0) { $item->classes[] = 'first'; };
	
	$toplev++;
		
	}
	}
	
	
	 foreach ($items as $item) {
		
	if($item->menu_item_parent == 0) {
		
    $navcount++;
	
	if($toplev == $navcount) { 
	
	$item->classes[] = 'last';
	
	
	}
	}
	} 

	return $items;    
} 

 

/* add custom icons
function qt_add_menu_icons_styles(){ ?>

<style>
#adminmenu .menu-icon-replace div.wp-menu-image:before {
content: "\f313";
}
</style>
  
<?php
}
add_action( 'admin_head', 'qt_add_menu_icons_styles' );
*/
 
/*
// Add Admin Sections to Wordpress Pages

 add_action('admin_menu', 'add_section');

function add_section() {
add_submenu_page('edit.php', 'Section Posts',  'Section Posts', 'manage_options', 'edit.php' );
} 
*/

/* Gravity Forms
------------------------------------------
- Change Gravity Forms Button
------------------------------------------ */

// filter the Gravity Forms button type
add_filter("gform_submit_button", "form_submit_button", 10, 2);
function form_submit_button($button, $form){
    return "<button class='button' id='gform_submit_button_{$form["id"]}'><span>Send Enquiry</span></button>";
}
