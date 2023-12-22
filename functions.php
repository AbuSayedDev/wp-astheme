<?php

/*
* My Theme Function
*/

//Theme Title
add_theme_support('title-tag');

//Theme CSS and JQuery File calling
function astheme_css_js_file_calling(){

    // wp enqueue style
    wp_enqueue_style( 'astheme-style', get_stylesheet_uri( ));
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '5.0.2', 'all' );
    wp_enqueue_style( 'custom', get_template_directory_uri() . '/assets/css/custom.css', array(), '1.0.0', 'all' );

    //Google font
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Poppins:wght@400;500;700&display=swap', false );

    // wp enqueue scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '5.0.2', 'true');
    wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.js', array(), '5.0.2', 'true');
}
add_action('wp_enqueue_scripts', 'astheme_css_js_file_calling');


// Theme Function
function astheme_customizar_register($we_customize){
    $we_customize->add_section('astheme_header_area', array(
        'title'       => __('Header Area', 'astheme'),
        'description' => 'If you interested to update your header area, you can do it here.'
    ));

    $we_customize->add_setting('astheme_logo', array(
        'default' =>  get_bloginfo( 'template_directory' ) . '/assets/img/Logo.png'
    ));

    $we_customize->add_control(new WP_Customize_Image_Control($we_customize, 'astheme_logo', array(
        'label' => 'Logo Upload',
        'description' => 'If you interested to change or update your logo you can do it.',
        'section' => "astheme_header_area",
        'setting' => 'astheme_logo'
    ) ));
}
add_action( 'customize_register', 'astheme_customizar_register');

