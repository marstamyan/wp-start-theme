<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package start_theme
 */

?>
<div class="col-md-4">
    <div class="card mb-4 box-shadow">
        <?php 
    if ( has_post_thumbnail() ) : ?>
        <?php the_post_thumbnail( 'start-theme-medium-crop', array('class' => 'card-img-top') );  ?>
        <?php else : $img = wp_get_attachment_image_src(1022, 'thumb') ?>
        <img src="<?php echo $img[0] ?>" alt="thumb" class="card-img-top">
        <?php endif ?>
        <div class="card-body">
            <h3><?php the_title() ?></h3>
            <p class="card-text"><?php the_excerpt() ?></p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <a href="<?php the_permalink() ?>" class="btn btn-sm btn-outline-secondary">View</a>
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