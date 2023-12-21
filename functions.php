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

    // wp enqueue scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '5.0.2', 'true');
    wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.js', array(), '5.0.2', 'true');
}
add_action('wp_enqueue_scripts', 'astheme_css_js_file_calling');