<?php

/*
* My Theme Function
*/


//Theme Support Function
function astheme_support(){
    //Theme Title
    add_theme_support('title-tag');

    //Menu Register
    register_nav_menus( array(
        'primary_menu' => __('Primary Menu', 'astheme'),
        'Mobile_menu' => __('Mobile Menu', 'astheme'),
        'footer_menu' => __('Footer Menu', 'astheme')
    ) );
}
add_action( 'after_setup_theme', 'astheme_support');

//Theme CSS and JQuery File calling
function astheme_css_js_file_calling(){

    // wp enqueue style
    wp_enqueue_style( 'astheme-style', get_stylesheet_uri( ));
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '5.0.2', 'all' );
    wp_enqueue_style( 'custom', get_template_directory_uri() . '/assets/css/custom.css', array(), '1.0.0', 'all' );

    //Google fonts
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Poppins:wght@400;500;700&display=swap', false );

    // wp enqueue scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '5.0.2', 'true');
    wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.js', array(), '5.0.2', 'true');
}
add_action('wp_enqueue_scripts', 'astheme_css_js_file_calling');


// Theme Function
function astheme_customizar_register($wp_customize){

    //Header Area
    $wp_customize->add_section('astheme_header_area', array(
        'title'       => __('Header Area', 'astheme'),
        'description' => 'If you interested to update your header area, you can do it here.'
    ));

    $wp_customize->add_setting('astheme_logo', array(
        'default' =>  get_bloginfo( 'template_directory' ) . '/assets/img/Logo.png'
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'astheme_logo', array(
        'label'       => 'Logo Upload',
        'description' => 'If you interested to change or update your logo you can do it.',
        'section'     => "astheme_header_area",
        'setting'     => 'astheme_logo'
    ) ));

    //Menu Position Option
    $wp_customize->add_section('astheme_menu_option', array(
      'title'       => __('Menu Position Option', 'astheme'),
      'description' => 'If you interested to change your menu position area, you can do it here.'
    ));

    $wp_customize->add_setting('astheme_menu_position', array(
        'default' => 'right_menu',
    ));

    $wp_customize->add_control('astheme_menu_position', array(
      'lebel'         => 'Menu Position',
      'description'   => 'Select your menu position.',
      'section'       => 'astheme_menu_option',
      'setting'       => 'astheme_menu_position',
      'type'          => 'radio',
      'choices'       => array(
        'right_menu'  => 'Right Menu',
        'left_menu'   => 'Left Menu',
        'center_menu' => 'Center Menu',
      )) );
}
add_action( 'customize_register', 'astheme_customizar_register');



// Bootstrap 5 wp_nav_menu walker
class bootstrap_5_wp_nav_menu_walker extends Walker_Nav_menu
{
  private $current_item;
  private $dropdown_menu_alignment_values = [
    'dropdown-menu-start',
    'dropdown-menu-end',
    'dropdown-menu-sm-start',
    'dropdown-menu-sm-end',
    'dropdown-menu-md-start',
    'dropdown-menu-md-end',
    'dropdown-menu-lg-start',
    'dropdown-menu-lg-end',
    'dropdown-menu-xl-start',
    'dropdown-menu-xl-end',
    'dropdown-menu-xxl-start',
    'dropdown-menu-xxl-end'
  ];

  function start_lvl(&$output, $depth = 0, $args = null)
  {
    $dropdown_menu_class[] = '';
    foreach($this->current_item->classes as $class) {
      if(in_array($class, $this->dropdown_menu_alignment_values)) {
        $dropdown_menu_class[] = $class;
      }
    }
    $indent = str_repeat("\t", $depth);
    $submenu = ($depth > 0) ? ' sub-menu' : '';
    $output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr(implode(" ",$dropdown_menu_class)) . " depth_$depth\">\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
  {
    $this->current_item = $item;

    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    $li_attributes = '';
    $class_names = $value = '';

    $classes = empty($item->classes) ? array() : (array) $item->classes;

    $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
    $classes[] = 'nav-item';
    $classes[] = 'nav-item-' . $item->ID;
    if ($depth && $args->walker->has_children) {
      $classes[] = 'dropdown-menu dropdown-menu-end';
    }

    $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = ' class="' . esc_attr($class_names) . '"';

    $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
    $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

    $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

    $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
    $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
    $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

    $active_class = ($item->current || $item->current_item_ancestor || in_array("current_page_parent", $item->classes, true) || in_array("current-post-ancestor", $item->classes, true)) ? 'active' : '';
    $nav_link_class = ( $depth > 0 ) ? 'dropdown-item ' : 'nav-link ';
    $attributes .= ( $args->walker->has_children ) ? ' class="'. $nav_link_class . $active_class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="'. $nav_link_class . $active_class . '"';

    $item_output = $args->before;
    $item_output .= '<a' . $attributes . '>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}