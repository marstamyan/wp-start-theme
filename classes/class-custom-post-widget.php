<?php

class Custom_Post_Widget extends WP_Widget {

    public function __construct() {
        $widget_options = array(
            'classname' => 'muna_post_widget',
            'description' => esc_html__('muna_post_widget', THEME_NAME),
        );
        parent::__construct( 'muna_post_widget', 'Custom Post Widget', $widget_options );
    }

    // front
    public function widget( $args, $instance ) {
        
        $widget_posts_count = (int)$instance[ 'widget_posts_count' ];
        $widget_cat = (int)$instance[ 'widget_cat' ];
        $widget_posts = get_posts( array ( 
            'category' => $widget_cat,
            'numberposts' => $widget_posts_count,
        ));

        //echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title']; ?>

        
        <ol class="list-featured">	
        <?php 
        if($widget_posts) :
        foreach($widget_posts as $post) : 
            setup_postdata($post);
        ?>			
            <li>
                <span>
                    <h6 class="font-weight-bold">
                        <a href="<?php the_permalink(); ?>" class="text-dark"><?php echo $post->post_title; ?></a>
                    </h6>
                    <p class="text-muted">
                    <small class="d-block"><a class="text-muted"
                                href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_the_author(); ?></a> <?php echo esc_html__('in category', THEME_NAME) . ' '; the_category(', ') ?></small>
                    </p>
                </span>
            </li>
            <?php endforeach; wp_reset_postdata(); endif; ?>
        </ol>        
        <?php echo $args['after_widget'];
        

    }

    public function form( $instance ) {
        $cats = get_categories();        
        $widget_cat = ! empty( $instance['widget_cat'] ) ? $instance['widget_cat'] : '';
        $widget_posts_count = ! empty( $instance['widget_posts_count'] ) ? $instance['widget_posts_count'] : 0;
        ?>
        <p>
            <p><label for="<?php echo $this->get_field_id( 'widget_cat' ); ?>">Category:</label></p>    
            <select id="<?php echo $this->get_field_id( 'widget_cat' ); ?>"
                name="<?php echo $this->get_field_name( 'widget_cat' ); ?>">
                <option value="">Select category name</option>
                <?php foreach($cats as $cat) : ?>
                <option <?php selected($widget_cat, $cat->term_id) ?> value="<?php echo $cat->term_id; ?>">
                    <?php echo $cat->name; ?></option>
                <?php endforeach; ?>
            </select>
        </p>    
        <p>
            <p><label for="<?php echo $this->get_field_id( 'widget_posts_count' ); ?>">Posts count:</label></p>
            <input class="small-text" type="number" id="<?php echo $this->get_field_id( 'widget_posts_count' ); ?>"
                name="<?php echo $this->get_field_name( 'widget_posts_count' ); ?>" value="<?php echo esc_attr( $widget_posts_count ); ?>" /><br>
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance[ 'widget_cat' ] = strip_tags( $new_instance[ 'widget_cat' ] );
        $instance[ 'widget_posts_count' ] = strip_tags( $new_instance[ 'widget_posts_count' ] );

        return $instance;
    }

}

function wpschool_register_widget() {
    register_widget( 'Custom_Post_Widget' );
}
add_action( 'widgets_init', 'wpschool_register_widget' );


//call

<?php if(is_active_sidebar( 'muna_right_sidebar' )) : ?>            
    <?php get_sidebar('right'); ?>            
<?php endif; ?>
<div class="col-md-4 pl-4">        
    <h5 class="font-weight-bold spanborder"><span>
        <?php 
        global $wp_registered_sidebars;
        esc_html_e( $wp_registered_sidebars['muna_right_sidebar']['name'] ); ?></span></h5>
    <?php                 
        dynamic_sidebar( 'muna_right_sidebar' );
    ?>         
</div>