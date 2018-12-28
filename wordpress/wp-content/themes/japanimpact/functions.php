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

wp_enqueue_script('countdown-script', get_template_directory_uri() . '/js/countdown.js', array(), NULL, true ); // , array ( /*deps*/ ), '1.0', true
wp_enqueue_script('comite-fun-script', get_template_directory_uri() . '/js/comite_fun.js', array(), NULL, true ); // , array ( /*deps*/ ), '1.0', true
//wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js'); // , array ( /*deps*/ ), '1.0', true

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
