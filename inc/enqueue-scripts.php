<?php 

function start_theme_scripts() {
	wp_enqueue_style( 'start-theme-style', get_stylesheet_uri(), array(), THEME_VERSION );
	wp_enqueue_style( 'start-theme-bootstrap-style', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), THEME_VERSION );
    wp_enqueue_style( 'start-theme-custom-style', get_template_directory_uri() . '/assets/css/custom.css', array(), THEME_VERSION );

	wp_enqueue_script( 'start-theme-script', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), THEME_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

    //add jQuery other version 
    if (!is_admin()) {
        // Remove default WordPress jQuery
        wp_deregister_script('jquery');
        // Register new jQuery script via Google Library    
        wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', false, '3.6.0');
        // Enqueue the script   
        wp_enqueue_script('jquery');
    }
}
add_action( 'wp_enqueue_scripts', 'start_theme_scripts' );