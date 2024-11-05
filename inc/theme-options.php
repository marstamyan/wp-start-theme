<?php 

    add_action('admin_menu', 'muna_admin_menu');
    function muna_admin_menu() {
        $hook_suffix = add_menu_page(
            esc_html__('Muna theme options', THEME_NAME),
            esc_html__('Muna options', THEME_NAME),
            'manage_options',
            'muna-options',
            'muna_options_cb',
            'dashicons-admin-settings',
            7
        );

        add_action("admin_print_scripts-{$hook_suffix}", "muna_admin_menu_scripts");
        add_action('admin_init', 'muna_custom_settings');
    }

    function muna_options_cb() { ?>
        <div class="wrap">
            <?php echo '<h1>' . get_admin_page_title() . '</h1>'; 
            settings_errors();
            ?>
            <form action="options.php" method="POST">  
                <?php settings_fields( 'muna_options_group' ); ?>
                <?php do_settings_sections( 'muna-options' ); ?> 
                <?php submit_button(); ?>  
	        </form> 
        </div>     
       
    <?php }


    function muna_custom_settings() {
        register_setting( 'muna_options_group', 'main_post_id', 'intval' );

        add_settings_section(
            'muna_options_section',
            esc_html__( 'Muna theme admin settings', THEME_NAME ),
            'settings_section_cb',
            'muna-options'
        );

        add_settings_field('post_in_main_page', esc_html__( 'Choose post article', THEME_NAME ), 'muna_settings_field_cb', 'muna-options', 'muna_options_section', array('label_for' => 'choosed_post'));
    }    

    function muna_admin_menu_scripts() {
        wp_enqueue_style( 'muna_admin_menu_css', get_template_directory_uri() . '/assets/css/admin-options.css');
        wp_enqueue_script( 'muna_admin_menu_js', get_template_directory_uri() . '/assets/js/admin-options.js', array(
            'jquery',
            'jquery-ui-autocomplete',
        ), false, true );
        wp_localize_script( 'muna_admin_menu_js', 'obj', array(
            'nonce' => wp_create_nonce( 'muna_ajax_nonce' )
        ) );
    }

    //settings section text info
    function settings_section_cb() {
        //echo 'Choose post';
    }

    function muna_settings_field_cb() {
        $main_post_id = absint( get_option('main_post_id') );
        $main_post_title = '';
        if($main_post_id) {
            $main_post = get_post($main_post_id);
            $main_post_title = !empty($main_post) ? $main_post->post_title : ''; 
        }
        ?>
        <input type="text" class="regular-text" id="choosed_post" name="choosed_post" value="<?php echo $main_post_title ?>">
        <?php if(isset($main_post_title) && $main_post_title !== '') : ?>
            <p class="description" id="choose_post_id"><?php echo esc_html__('Chossed post is: [', THEME_NAME) . $main_post_title . ']<span class="dashicons dashicons-trash"></span>'?></p>
        <?php endif; ?>    
       
        <input type="hidden" id="main_post_id" name="main_post_id" value="<?php echo $main_post_id  ?>">
        <?php
    }

/**
 * AJAX functions
 */
add_action( 'wp_ajax_main_post_action', function () {
 
    check_ajax_referer( 'muna_ajax_nonce' );
    $search_term = isset( $_GET['term'] ) ? $_GET['term'] : null;
    
    if( $search_term ) {       
        $main_posts = get_posts(array(
            's' => $search_term,
            'numberposts' => 10,
        ));
    }   
    if( $main_posts ) {
        $result = [];        
        foreach( $main_posts as $main_post ) {
            $res['label'] = $main_post->post_title;
            $res['id'] = $main_post->ID;
            $result[] = $res;
        }

        echo json_encode( $result );
    }

    //echo $search_term ;
    wp_die();

} );

?>

<script>
    jQuery( document ).ready(function($) {

$('#choosed_post').autocomplete({
    source: ajaxurl + '?action=main_post_action&_wpnonce=' + obj.nonce,
    minLength: 2,
    delay: 500,
    select:function(event,ui){
        $('#main_post_id').val(ui.item.id);
        
    }
});

$('.wrap').on('click', '.dashicons-trash', function(target){
    $('#choose_post_id').remove();
    $('#choosed_post').val('');
    $('#main_post_id').val('');
    var btn = $(this).find('#submit');
    $('.wrap').find('#submit').click();
})

});

</script>