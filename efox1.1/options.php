<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {



	$options = array();
	

	$imagepath =  get_template_directory_uri() . '/images/';

	$options[] = array(
		'name' => __('Company Details', 'options_framework_theme'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Logo', 'options_framework_theme'),
		'desc' => __('Upload website logo.', 'options_framework_theme'),
		'id' => 'logo',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('Telephone Number', 'options_framework_theme'),
		'desc' => __('Main Telephone Number', 'options_framework_theme'),
		'id' => 'telephone_number',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Email Address', 'options_framework_theme'),
		'desc' => __('Main Email Address', 'options_framework_theme'),
		'id' => 'email_address',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Address', 'options_framework_theme'),
		'type' => 'heading');
		
				
	$options[] = array(
		'name' => __('Organization Address', 'options_framework_theme'),
		'desc' => __('First Line', 'options_framework_theme'),
		'id' => 'organ_address',
		'std' => '',
		'type' => 'text');
		
						
	$options[] = array(
		'name' => __('Organization Address line 2', 'options_framework_theme'),
		'desc' => __('Second Line', 'options_framework_theme'),
		'id' => 'organ_address_2',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Organization PO Box', 'options_framework_theme'),
		'desc' => __('PO Box Number', 'options_framework_theme'),
		'id' => 'organ_po_box',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Organization City', 'options_framework_theme'),
		'desc' => __('Town / City', 'options_framework_theme'),
		'id' => 'organ_city',
		'std' => '',
		'type' => 'text');
		
				
	$options[] = array(
		'name' => __('Organization State / Region', 'options_framework_theme'),
		'desc' => __('State / Region', 'options_framework_theme'),
		'id' => 'organ_state',
		'std' => '',
		'type' => 'text');
						
	$options[] = array(
		'name' => __('Organization Post Code', 'options_framework_theme'),
		'desc' => __('Post Code', 'options_framework_theme'),
		'id' => 'organ_post_code',
		'std' => '',
		'type' => 'text');
								
	$options[] = array(
		'name' => __('Organization Country', 'options_framework_theme'),
		'desc' => __('Country', 'options_framework_theme'),
		'id' => 'organ_country',
		'std' => '',
		'type' => 'text');
		
		
	/* Social Media */	
		
	$options[] = array(
	'name' => __('Social Media', 'options_framework_theme'),
	'type' => 'heading');
		
				
	$options[] = array(
		'name' => __('Facebook URL', 'options_framework_theme'),
		'desc' => __('Full Facebook address', 'options_framework_theme'),
		'id' => 'social_facebook',
		'std' => '',
		'type' => 'text');
		
					
	$options[] = array(
		'name' => __('Youtube URL', 'options_framework_theme'),
		'desc' => __('Full Youtube address', 'options_framework_theme'),
		'id' => 'social_youtube',
		'std' => '',
		'type' => 'text');
				
	$options[] = array(
		'name' => __('Twitter URL', 'options_framework_theme'),
		'desc' => __('Full Twitter address', 'options_framework_theme'),
		'id' => 'social_twitter',
		'std' => '',
		'type' => 'text');
		
			$options[] = array(
		'name' => __('Feed URL', 'options_framework_theme'),
		'desc' => __('Full RSS URL', 'options_framework_theme'),
		'id' => 'social_rss',
		'std' => '',
		'type' => 'text');
		
				
			$options[] = array(
		'name' => __('Pinterest URL', 'options_framework_theme'),
		'desc' => __('Full Pinterest URL', 'options_framework_theme'),
		'id' => 'social_pinterest',
		'std' => '',
		'type' => 'text');
		
			
			$options[] = array(
		'name' => __('Google Plus URL', 'options_framework_theme'),
		'desc' => __('Google Plus URL', 'options_framework_theme'),
		'id' => 'social_google_plus',
		'std' => '',
		'type' => 'text');

	return $options;
}