<?php

function register_my_menu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' );


// add custom css and js
function EnqueueMyStyles() {
    // wp_enqueue_style('my-custom-style', get_template_directory_uri() . '/css/my-custom-style.css', false, '20150320');
    //
    // wp_enqueue_style('my-google-fonts', '//fonts.googleapis.com/css?family=PT+Serif+Caption:400,400italic', false, '20150320');

    //wp_enqueue_style('my-main-style', get_stylesheet_uri(), false, '20150320');

        wp_enqueue_script('countdown-script', get_template_directory_uri() . '/js/countdown.js'); // , array ( /*deps*/ ), '1.0', true
        //wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js'); // , array ( /*deps*/ ), '1.0', true

}
add_action('wp_enqueue_scripts', 'EnqueueMyStyles');



/**CUSTOM HEADER**/
function themename_custom_header_setup() {
    $args = array(
        'default-image'      => get_template_directory_uri() . '/img/affiche.jpg',
        'default-text-color' => '000',
        'width'              => 2000,
        'height'             => 600
    );
    add_theme_support( 'custom-header', $args );
}
add_action( 'after_setup_theme', 'themename_custom_header_setup' );

// Register Custom Navigation Walker
require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
