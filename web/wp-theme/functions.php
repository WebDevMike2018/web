<?php

function f_register_sidebars() {
	register_sidebar([
		'name' => 'hero-image',
		'id' => 'sidebar-1',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
	]);
	register_sidebar([
		'name' => 'text-1',
		'id' => 'sidebar-2',
		'before_widget' => '<div class="c4">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => ''
	]);
	register_sidebar([
		'name' => 'text-2',
		'id' => 'sidebar-3',
		'before_widget' => '<div class="c5">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => ''
	]);
}

add_action('widgets_init', 'f_register_sidebars');

function f_register_styles() {
	wp_enqueue_style('header', get_template_directory_uri() . '/assets/css/header.css', [], '1', 'all');
	wp_enqueue_style('footer', get_template_directory_uri() . '/assets/css/footer.css', [], '1', 'all');
	wp_enqueue_style('theme-preview', get_template_directory_uri() . '/style.css', [], '1', 'all');
}

add_action('wp_enqueue_scripts', 'f_register_styles');

function f_menus() {
	$a_locations = [
		'header_nav' => 'header_nav',
		'footer' => 'footer'
	];

	register_nav_menus($a_locations);
}

add_action('init', 'f_menus');

add_theme_support('title_tag');
add_theme_support('post-thumbnails');

?>