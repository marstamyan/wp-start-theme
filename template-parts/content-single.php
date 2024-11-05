<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package start_theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif; ?>
    </header><!-- .entry-header -->

    <div class="col">
    <div class="card mb-4 box-shadow">
        <?php 
    if ( has_post_thumbnail() ) : ?>
        <?php the_post_thumbnail( 'start-theme-medium', array('class' => 'card-img-top') );  ?>
        <?php endif ?>
        <div class="card-body">
            <p class="card-text"><?php the_excerpt() ?></p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <?php 
                    //Displaying edit post link
                    $current_user = wp_get_current_user();
                    if(current_user_can( 'edit_others_posts', $post->ID ) && ($post->post_author == $current_user->ID))  									
                        edit_post_link(esc_html__('Edit', THEME_NAME), '', '', $id, $class = 'btn btn-sm btn-outline-secondary'); 
                    ?>
                </div>
                <small class="text-muted">
                    <?php
                        //Displaying Publish Dates as how ''Time Ago'
                        $time_diff = human_time_diff( get_post_time('U'), current_time('timestamp') );
                        printf( esc_html__( '%s ago', THEME_NAME ), $time_diff );
                    ?>
                </small>
            </div>
        </div>
    </div>
</div>

   

</article>