<?php 

if ( function_exists( 'add_image_size' ) ) {
	// Adding custom image size
	add_image_size( 'start-theme-medium', 420, 225 );

	// Adding custom image size with cropping
	add_image_size( 'start-theme-medium-crop', 420, 225, true );

    // Adding custom image size with fixed width
    add_image_size( 'start-theme-medium-crop-height', 420, 9999 );	
}

//Get image
// if ( has_post_thumbnail() ) {
// 	the_post_thumbnail( 'start-theme-medium', array('class' => 'classname') ); 
// }