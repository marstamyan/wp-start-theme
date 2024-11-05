<?php 

function gym_castomization($wp_customize) {
    //add panel
    $wp_customize->add_panel('gym_panel', array(
        'priority' => 30,
        'capability' => 'edit_theme_options',
        'title' => esc_html__('Gym settings', 'gym'),
        'description' => esc_html__('Page settings', 'gym'),
    ));

    //Text type
    //add section
    $wp_customize->add_section('header_section', array(
        'title' => esc_html__('Header settings', 'gym'),
        'priority' => 30,
        'panel' => 'gym_panel',
        'active_callback' => 'is_front_page',
    ));

    //add field
    $wp_customize->add_setting('header_button_text', array(
        'default' => esc_html__('Register', 'gym'),
        'transport' => 'refresh',
    ));

    //edit functionality (pen icon)
    $wp_customize->selective_refresh->add_partial('header_button_text', array(
        'selector' => '#header-nav__register'
    ));

    //field actions and parameters
    $wp_customize->add_control('header_button_text', array(
        'label' => esc_html__('Header button text', 'gym'),
        'section' => 'header_section',
        'settings' => 'header_button_text',
        'type' => 'text',
    ));

    //Checkbox type
    //add field
    $wp_customize->add_setting('header_button_show', array(
        'default' => true,
        'transport' => 'refresh',
    ));

    //edit functionality (pen icon)
    $wp_customize->selective_refresh->add_partial('header_button_text', array(
        'selector' => '#header-nav__register'
    ));

    //field actions and parameters
    $wp_customize->add_control('header_button_show', array(
        'label' => esc_html__('Show header button', 'gym'),
        'section' => 'header_section',
        'settings' => 'header_button_show',
        'type' => 'checkbox',
    ));

    /* ===== Intro section ===== */
    $wp_customize->add_section('intro_section', array(
        'title' => esc_html__('Intro settings', 'gym'),
        'priority' => 30,
        'panel' => 'gym_panel',
        'active_callback' => 'is_front_page',
    ));

    //add field
    $wp_customize->add_setting('intro_section_suptitle', array(
        'default' => esc_html__('MAKE YOUR', 'gym'),
        'transport' => 'refresh',
    ));
    
        //edit functionality (pen icon)
        $wp_customize->selective_refresh->add_partial('intro_section_suptitle', array(
        'selector' => '#intro-suptitle'
     ));
    
        //field actions and parameters
        $wp_customize->add_control('intro_section_suptitle', array(
        'label' => esc_html__('Intro subtitle text', 'gym'),
        'section' => 'intro_section',
        'settings' => 'intro_section_suptitle',
        'type' => 'text',
    ));

    //add field
    $wp_customize->add_setting('intro_section_title', array(
        'default' => esc_html__('Body Shape', 'gym'),
        'transport' => 'refresh',
    ));
    
        //edit functionality (pen icon)
    $wp_customize->selective_refresh->add_partial('intro_section_title', array(
        'selector' => '#intro-title'
    ));
    
    //field actions and parameters
    $wp_customize->add_control('intro_section_title', array(
        'label' => esc_html__('Intro title text', 'gym'),
        'section' => 'intro_section',
        'settings' => 'intro_section_title',
        'type' => 'text',
    ));

    //add field
    $wp_customize->add_setting('intro_section_text', array(
        'default' => esc_html__('In here we will help you to shape and build your ideal body  and live your life to the fullest.', 'gym'),
        'transport' => 'refresh',
    ));
    
    //edit functionality (pen icon)
    $wp_customize->selective_refresh->add_partial('intro_section_text', array(
        'selector' => '#intro-desc'
    ));
    
    //field actions and parameters
    $wp_customize->add_control('intro_section_text', array(
        'label' => esc_html__('Intro text', 'gym'),
        'section' => 'intro_section',
        'settings' => 'intro_section_text',
        'type' => 'textarea',
    ));

    //Image type
    //add field
    $wp_customize->add_setting('intro_section_img', array(
        //'default' => 'http://gym/wp-content/themes/gym/assets/img/home-img.png',
        'transport' => 'refresh',
        'height' => 474,
        'width' => 548,
    ));
    
    //edit functionality (pen icon)
    $wp_customize->selective_refresh->add_partial('intro_section_img', array(
        'selector' => '#intro-img__block'
    ));
    
    // adding WP_Customize_Image_Control class for image support
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'intro_section_img', array(
        'label' => esc_html__('Choose image for intro', 'gym'),
        'section' => 'intro_section',
        'settings' => 'intro_section_img',
    )));
    
    //partners block
    $wp_customize->add_section('partners_section', array(
        'title' => esc_html__('Partners settings', 'gym'),
        'priority' => 30,
        'panel' => 'gym_panel',
        'active_callback' => 'is_front_page',
    ));

    function partners_section_img($wp_customize, $array) {
        //add field
        $wp_customize->add_setting($array['setting_id'], array(
            //'default' => 'http://gym/wp-content/themes/gym/assets/img/home-img.png',
            'transport' => 'refresh',
            'height' => $array['image_h'],
            'width' => $array['image_w'],
        ));
        
        //edit functionality (pen icon)
        $wp_customize->selective_refresh->add_partial($array['setting_id'], array(
            'selector' => $array['pen_selector']
        ));
        
        // adding WP_Customize_Image_Control class for image support
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $array['setting_id'], array(
            'label' => $array['section_title'],
            'section' => $array['section_id'],
            'settings' => $array['setting_id'],
        )));
    }

    $partner_1 = array(
        'section_title' => esc_html__('Choose partner image (1)', 'gym'),
        'image_w' => 250,
        'image_h' => 70,
        'section_id' => 'partners_section',
        'setting_id' => 'partners_image_1',
        'pen_selector' => '#partners-img-1'
    ); 

    $partner_2 = array(
        'section_title' => esc_html__('Choose partner image (2)', 'gym'),
        'image_w' => 250,
        'image_h' => 70,
        'section_id' => 'partners_section',
        'setting_id' => 'partners_image_2',
        'pen_selector' => '#partners-img-2'
    ); 

    $partner_3 = array(
        'section_title' => esc_html__('Choose partner image (3)', 'gym'),
        'image_w' => 250,
        'image_h' => 70,
        'section_id' => 'partners_section',
        'setting_id' => 'partners_image_3',
        'pen_selector' => '#partners-img-3'
    ); 

    $partner_4 = array(
        'section_title' => esc_html__('Choose partner image (4)', 'gym'),
        'image_w' => 250,
        'image_h' => 70,
        'section_id' => 'partners_section',
        'setting_id' => 'partners_image_4',
        'pen_selector' => '#partners-img-4'
    ); 

    echo partners_section_img($wp_customize, $partner_1);
    echo partners_section_img($wp_customize, $partner_2);
    echo partners_section_img($wp_customize, $partner_3);
    echo partners_section_img($wp_customize, $partner_4);

    //best reason block
    //Text type
    //add section
    $wp_customize->add_section('reasons_section', array(
        'title' => esc_html__('Reasons settings', 'gym'),
        'priority' => 30,
        'panel' => 'gym_panel',
        'active_callback' => 'is_front_page',
    ));

    function reasons_section_number($wp_customize, $array) {
        //add field
        $wp_customize->add_setting($array['setting_id'], array(
            'default' => $array['default'],
            'transport' => 'refresh',
        ));
        
        //edit functionality (pen icon)
        $wp_customize->selective_refresh->add_partial($array['setting_id'], array(
            'selector' => $array['pen_selector']
        ));
        
        // adding WP_Customize_Image_Control class for image support
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $array['setting_id'], array(
            'label' => $array['section_title'],
            'section' => $array['section_id'],
            'settings' => $array['setting_id'],
            'type' => 'text',
        )));
    }

    $reasons_text_1 = array(
        'section_title' => esc_html__('Choose reasons number (1)', 'gym'),
        'default' => '140',
        'section_id' => 'reasons_section',
        'setting_id' => 'reasons_number_1',
        'pen_selector' => '#reasons_number_1'
    ); 

    $reasons_text_2 = array(
        'section_title' => esc_html__('Choose reasons number (2)', 'gym'),
        'default' => '30+',
        'section_id' => 'reasons_section',
        'setting_id' => 'reasons_number_2',
        'pen_selector' => '#reasons_number_2'
    ); 

    $reasons_text_3 = array(
        'section_title' => esc_html__('Choose reasons number (3)', 'gym'),
        'default' => '50+',
        'section_id' => 'reasons_section',
        'setting_id' => 'reasons_number_3',
        'pen_selector' => '#reasons_number_3'
    ); 

    $reasons_text_4 = array(
        'section_title' => esc_html__('Choose reasons number (4)', 'gym'),
        'default' => '70+',
        'section_id' => 'reasons_section',
        'setting_id' => 'reasons_number_4',
        'pen_selector' => '#reasons_number_4'
    ); 

    echo reasons_section_number($wp_customize, $reasons_text_1);
    echo reasons_section_number($wp_customize, $reasons_text_2);
    echo reasons_section_number($wp_customize, $reasons_text_3);
    echo reasons_section_number($wp_customize, $reasons_text_4);
}

add_action('customize_register', 'gym_castomization');


function ski_castomization($wp_customize)
{
    //Adding PANEL
    $wp_customize->add_panel('intro_panel', array(
        'title' => esc_html__('Intro', 'ski'),
        'description' => esc_html__('Site intro info', 'ski'),
        'priority' => 10,
    ));
	
	//Adding SECTION
    $wp_customize->add_section('intro_title', array(
        'title' => esc_html__('Intro Title', 'ski'),
        'description' => esc_html__('Write intro title', 'ski'),
        'priority' => 10,
        'panel' => 'intro_panel',
    ));

    $wp_customize->add_setting('intro_title_text', array(
        'default' => esc_html__('SKI & SNOWBOARD SCHOOL!!!)', 'ski'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('intro_title_text', array(
        'label' => esc_html__('Write intro title', 'ski'),
        'section' => 'intro_title',
        'settings' => 'intro_title_text',
        'type' => 'text',
    ));

    //pen
    $wp_customize->selective_refresh->add_partial('intro_title_text', array(
        'selector' => '#promo-suptitle'
    ));    

    //Intro button bg color (Color Picker)
    $wp_customize->add_section('intro_button_bg', array(
        'title' => esc_html__('Intro Button Color', 'ski'),
        'description' => esc_html__('Choose intro button background color', 'ski'),
        'priority' => 10,
        'panel' => 'intro_panel',
    ));

    $wp_customize->add_setting('intro_button_bg_color', array(
        'default' => '#ff690f',
        'transport' => 'refresh',
    ));
	
	//Adding Color Picker
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'intro_button_bg_color',
            array(
                'label'      => esc_html__('Intro Button Background Color', 'ski'),
                'section'    => 'intro_button_bg',
                'settings'   => 'intro_button_bg_color',
            )
        )
    );

    $wp_customize->selective_refresh->add_partial('intro_button_bg_color', array(
        'selector' => '#intro-btn'
    ));
	
	//Image control
	$wp_customize->add_section('intro_bg_img_section', array(
        'title' => esc_html__('Intro Background Image', 'ski'),
        'description' => esc_html__('Choose intro bg image', 'ski'),
        'priority' => 10,
        'panel' => 'intro_panel',
    ));

    $wp_customize->add_setting('intro_bg_img', array(
        'default' => 'http://ski/wp-content/uploads/2021/12/header-bg.png',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'intro_bg_img',
            array(
                'label' => esc_html__('Choose intro bg image', 'ski'),
                'section' => 'intro_bg_img_section',
                'settings' => 'intro_bg_img'
            )
        )
    );

    $wp_customize->selective_refresh->add_partial('intro_bg_img', array(
        'selector' => '.promo-block'
    ));
	
	//offers show BOOLEAN SHOW/HIDE
    $wp_customize->add_section('offer_show_section', array(
        'title' => esc_html__('Disable offer section', 'ski'),
        'description' => esc_html__('Disable offer section', 'ski'),
        'priority' => 10,
        'panel' => 'offer_panel',
    ));

    $wp_customize->add_setting('offer_show', array(
        'default' => 'show',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('offer_show', array(
        'label' => esc_html__('Choose for disable offer section', 'ski'),
        'section' => 'offer_show_section',
        'settings' => 'offer_show',
        'type' => 'radio',
        'choices' => array(
            'show' => esc_html__('Show offers section', 'ski'),
            'hide' => esc_html__('Disable offers section', 'ski')
        ),
    ));

    $wp_customize->selective_refresh->add_partial('offer_show', array(
        'selector' => '#offer'
    ));
	
	//call
	if(get_theme_mod('offer_show') == 'show')
		
	//CODE editor block HTML 
	$wp_customize->add_section('contacts_address_section', array(
        'title' => esc_html__('Contacts Address Section', 'ski'),
        'description' => esc_html__('Write your address', 'ski'),
        'priority' => 10,
        'panel' => 'contacts_panel',
    ));

    $wp_customize->add_setting('contacts_address', array(
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Code_Editor_Control($wp_customize, 'contacts_address', array(
        'label'     => 'HTML code block',
        'code_type' => 'text/html',
        'settings'  => 'contacts_address',
        'section'   => 'contacts_address_section',
    )));
	
    $wp_customize->selective_refresh->add_partial('contacts_address', array(
        'selector' => '.contacts-address'
    ));
}

add_action('customize_register', 'ski_castomization');
