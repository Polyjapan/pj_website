<?php

function register_my_menu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' );


// add custom css and js
function EnqueueMyStyles() {

wp_enqueue_script('jquery', get_template_directory_uri() . '/vendor/jquery-3.3.1.slim.min.js', array(), NULL, false ); // , array ( /*deps*/ ), '1.0', true
wp_enqueue_script('popper', get_template_directory_uri() . '/vendor/popper.min.js', array(), NULL, false ); // , array ( /*deps*/ ), '1.0', true
wp_enqueue_script('boostrap-script', get_template_directory_uri() . '/vendor/bootstrap/bootstrap.min.js', array(), array('jquery', 'popper'), false ); // , array ( /*deps*/ ), '1.0', true

wp_enqueue_script('comite-fun-script', get_template_directory_uri() . '/js/comite_fun.js', array(), NULL, false ); // , array ( /*deps*/ ), '1.0', true

wp_enqueue_style('fontawesome-style','https://use.fontawesome.com/releases/v5.5.0/css/all.css', array(), null); // , array ( /*deps*/ ), '1.0', true
// wp_enqueue_style('boostrap-style', get_template_directory_uri() . '/vendor/bootstrap/bootstrap.min.css', array(), null); // , array ( /*deps*/ ), '1.0', true
// wp_enqueue_style('mystyle', get_template_directory_uri() . '/style.css', array(), null); // , array ( /*deps*/ ), '1.0', true

// wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js'); // , array ( /*deps*/ ), '1.0', true

}
add_action('wp_footer', 'EnqueueMyStyles');


//
//
// /**CUSTOM HEADER**/
// function themename_custom_header_setup() {
//     $args = array(
//         'default-image'      => get_template_directory_uri() . '/img/affiche.jpg',
//         'default-text-color' => '000',
//         'width'              => 2000,
//         'height'             => 600
//     );
//     add_theme_support( 'custom-header', $args );
// }
// add_action( 'after_setup_theme', 'themename_custom_header_setup' );


// Register Custom Navigation Walker
require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';

function custom_get_page_link($nameorid){
	if(!function_exists('pll_the_languages')) return site_url($nameorid);

	$post_id = false;
	if(is_numeric($nameorid)){
		$post_id = $nameorid;
	}else{
		$post = get_page_by_path($nameorid, OBJECT, array('post','page','dossier','document'));
		if($post){
			$post_id = $post->ID;
		}
	}
	if($post_id){
		$post_id_lang = pll_get_post($post_id);
		if($post_id_lang){
			return get_permalink($post_id_lang);
		}
		return get_permalink($post_id);
	}else{
		return site_url($nameorid);
	}
}

define('EXCERPT_RARELY', '{[}]');
define('EXCERPT_BR', nl2br(PHP_EOL));

function wp_trim_excerpt_custom($text = '')
{
    add_filter('the_content', 'wp_trim_excerpt_custom_mark', 6);

    // get through origin filter
    $text = wp_trim_excerpt($text);

    remove_filter('the_content', 'wp_trim_excerpt_custom_mark');

    return wp_trim_excerpt_custom_restore($text);
}

function wp_trim_excerpt_custom_mark($text)
{
    $text = nl2br($text);
    return str_replace(EXCERPT_BR, EXCERPT_RARELY, $text);
}

function wp_trim_excerpt_custom_restore($text)
{
    return str_replace(EXCERPT_RARELY, EXCERPT_BR, $text);
}

// remove default filter
remove_filter('get_the_excerpt', 'wp_trim_excerpt');

// add custom filter
add_filter('get_the_excerpt', 'wp_trim_excerpt_custom');

// support for thumbnails
add_theme_support('post-thumbnails');