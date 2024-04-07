<?php

declare(strict_types=1);


function load_assets()
{

    wp_enqueue_script('my-main-script', get_template_directory_uri() . '/assets/js/main.js', [], '1.0.0', true);
    wp_enqueue_style('my-global-style', get_stylesheet_uri(), [], filemtime(get_stylesheet_directory() . '/style.css'));
    wp_enqueue_style('custom-main', get_template_directory_uri() . '/assets/css/main.css');

}

// register menus
register_nav_menus(
    [
    'top-menu' => 'Top Menu Location',
    'mobile-menu' => 'Mobile menu'
    ]
);


//  register post thumbnails
add_theme_support('post-thumbnails');

// add navigation menus
add_theme_support('menus');

// Hooks
add_action('wp_enqueue_scripts', 'load_assets');
