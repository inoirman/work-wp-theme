<?php
/**
*
* @package wfs-tattoo
*
	========================
		FRONT-END ENQUEUE FUNCTIONS
	========================
**/

function wfs_load_scripts(){
	

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.2', 'all' );
	wp_enqueue_style( 'main-css', get_template_directory_uri() . '/css/style.css', array(), '1.0.0', 'all' );
	wp_enqueue_style( 'pt-sans', 'http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic&subset=latin,cyrillic,cyrillic-ext,latin-ext' );
	wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
	
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery' , get_template_directory_uri() . '/js/jquery.min.js', false, '1.12.4', true );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.2', true );
	wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true );
	
}
add_action( 'wp_enqueue_scripts', 'wfs_load_scripts' );

function wfs_load_admin_scripts( $hook ){
	wp_register_script( 'wfs-admin-script', get_template_directory_uri() . '/js/wfs-admin.js', array('jquery'), '1.0.0', true );
	wp_enqueue_media();
	wp_enqueue_script( 'wfs-admin-script' );
}
add_action( 'admin_enqueue_scripts', 'wfs_load_admin_scripts' );
