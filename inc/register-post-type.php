<?php 

function programs_register_post_type() {
	register_post_type('programs', array(
		'labels'             => array(
			'name'               => esc_html__('Programs', 'wshop'),  
			'singular_name'      => esc_html__('Program on main', 'wshop'),  
			'add_new'            => esc_html__('Add new', 'wshop'),
			'add_new_item'       => esc_html__('Add new program', 'wshop'),
			'edit_item'          => esc_html__('Edit program', 'wshop'),
			'new_item'           => esc_html__('New program', 'wshop'),
			'view_item'          => esc_html__('View program', 'wshop'),
			'search_items'       => esc_html__('Find program', 'wshop'),
			'not_found'          => esc_html__('Programs not found', 'wshop'),
			'not_found_in_trash' => esc_html__('There is no Program', 'wshop'),
			'parent_item_colon'  => '',
			'menu_name'          => esc_html__('Programs', 'wshop')
		),
		'public'             => false,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => false,
		'exclude_from_search' => true,   
		'show_in_nav_menus'  => false,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-excerpt-view',
		'supports'           => array('title', 'thumbnail', 'editor'),
		'show_in_rest'       => true, 
	));
}

add_action('init', 'programs_register_post_type');

//with taxonomy
add_action('init', function() {
	register_post_type('book', [
		'label' => __('Books', 'txtdomain'),
		'public' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-book',
		'supports' => ['title', 'editor', 'thumbnail', 'author', 'revisions', 'comments'],
		'show_in_rest' => true,
		'rewrite' => ['slug' => 'book'],
		'taxonomies' => ['book_author', 'book_genre'],
		'labels' => [
			'singular_name' => __('Book', 'txtdomain'),
			'add_new_item' => __('Add new book', 'txtdomain'),
			'new_item' => __('New book', 'txtdomain'),
			'view_item' => __('View book', 'txtdomain'),
			'not_found' => __('No books found', 'txtdomain'),
			'not_found_in_trash' => __('No books found in trash', 'txtdomain'),
			'all_items' => __('All books', 'txtdomain'),
			'insert_into_item' => __('Insert into book', 'txtdomain')
		],		
	]);
 
	register_taxonomy('book_genre', ['book'], [
		'label' => __('Genres', 'txtdomain'),
		'hierarchical' => true,
		'rewrite' => ['slug' => 'book-genre'],
		'show_admin_column' => true,
		'show_in_rest' => true,
		'labels' => [
			'singular_name' => __('Genre', 'txtdomain'),
			'all_items' => __('All Genres', 'txtdomain'),
			'edit_item' => __('Edit Genre', 'txtdomain'),
			'view_item' => __('View Genre', 'txtdomain'),
			'update_item' => __('Update Genre', 'txtdomain'),
			'add_new_item' => __('Add New Genre', 'txtdomain'),
			'new_item_name' => __('New Genre Name', 'txtdomain'),
			'search_items' => __('Search Genres', 'txtdomain'),
			'parent_item' => __('Parent Genre', 'txtdomain'),
			'parent_item_colon' => __('Parent Genre:', 'txtdomain'),
			'not_found' => __('No Genres found', 'txtdomain'),
		]
	]);
	register_taxonomy_for_object_type('book_genre', 'book');
 
	register_taxonomy('book_author', ['book'], [
		'label' => __('Authors', 'txtdomain'),
		'hierarchical' => false,
		'rewrite' => ['slug' => 'book-author'],
		'show_admin_column' => true,
		'labels' => [
			'singular_name' => __('Author', 'txtdomain'),
			'all_items' => __('All Authors', 'txtdomain'),
			'edit_item' => __('Edit Author', 'txtdomain'),
			'view_item' => __('View Author', 'txtdomain'),
			'update_item' => __('Update Author', 'txtdomain'),
			'add_new_item' => __('Add New Author', 'txtdomain'),
			'new_item_name' => __('New Author Name', 'txtdomain'),
			'search_items' => __('Search Authors', 'txtdomain'),
			'popular_items' => __('Popular Authors', 'txtdomain'),
			'separate_items_with_commas' => __('Separate authors with comma', 'txtdomain'),
			'choose_from_most_used' => __('Choose from most used Authors', 'txtdomain'),
			'not_found' => __('No Authors found', 'txtdomain'),
		]
	]);
	register_taxonomy_for_object_type('book_author', 'book');
});
