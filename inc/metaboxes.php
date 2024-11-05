<?php 

function muna_post_meta_box() {
    add_meta_box(
        'muna_post_meta_box',
        esc_html__('Post additional info', THEME_NAME),
        'muna_post_meta_box_cb',
        'post'
    );
}

add_action('add_meta_boxes', 'muna_post_meta_box');

function muna_post_meta_box_cb($post_obj) {
    wp_nonce_field( 'muna_action', 'muna_noncename' );
    $read_minutes = get_post_meta( $post_obj->ID, 'read_minutes', true );
    $read_minutes = $read_minutes ? absint($read_minutes) : '';
    $show_in_features = get_post_meta( $post_obj->ID, 'show_in_features', true );
    $show_in_features = $show_in_features ? $show_in_features : ''; ?>

    <table class="meta-table" style="border-collapse: collapse; width:35%; text-align: center">
        <tbody>
            <tr>
                <th>
                    <label for='read_minutes'>
                       <?php esc_html_e('Minutes for read', THEME_NAME); ?>
                    </label>    
                    <td>
                       <input id='read_minutes' name='read_minutes' type='number' class='small-text' value='<?php echo $read_minutes ?>'>
                    </td>                   
                </th>
            </tr>
            <tr>
                <th>
                    <label for='show_in_features'>
                        <?php esc_html_e('Choose as featured post', THEME_NAME); ?>
                    </label>    
                </th>
                <td>
                    <input type='checkbox' name='show_in_features' id='show_in_features' <?php checked('yes', $show_in_features); ?>>
                </td>
            </tr>
        </tbody>
    </table>
<?php }

function save_muna_post_meta_box($post_id) {

    if ( !isset( $_POST['muna_noncename'] ) && !wp_verify_nonce( 'muna_noncename', 'muna_action' ) ) {
        return;
    }

    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
        return;
    }	

    if( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if( isset( $_POST['read_minutes'] ) && $_POST['read_minutes'] !== '' ) {
        $read_minutes = absint( $_POST['read_minutes'] );
        update_post_meta( $post_id, 'read_minutes', $read_minutes );
    }

    else {
        delete_post_meta($post_id, 'read_minutes');
    }

    if( isset( $_POST['show_in_features'] ) && $_POST['show_in_features'] == 'on' ) {
        $show_in_features = 'yes';

        update_post_meta( $post_id, 'show_in_features', $show_in_features );
    }

    else {
        delete_post_meta($post_id, 'show_in_features');
    }
}

add_action( 'save_post', 'save_muna_post_meta_box' );
?>

//get metabox value
//get_post_meta( $id, 'read_minutes', true )