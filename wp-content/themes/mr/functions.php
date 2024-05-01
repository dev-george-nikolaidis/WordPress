<?php

declare(strict_types=1);


function load_assets()
{
    wp_enqueue_script('my-main-script', get_template_directory_uri() . '/assets/js/main.js', [], '1.0.0', true);
    wp_enqueue_style('my-global-style', get_stylesheet_uri(), [], filemtime(get_stylesheet_directory() . '/style.css'));
    wp_enqueue_style('custom-main', get_template_directory_uri() . '/assets/css/main.css');
}




function my_sidebars()
{

    register_sidebar(
        [
        'name' => 'Sidebar',
        'id' => 'sidebar-1',
        'description' => 'Standard Sidebar',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>'
        ]
    );
}


function create_custom_post_type()
{
    $args = [
        'label' => 'Custom Post',
        'labels' => [
            'name' => 'Custom Posts',
            'singular_name' => 'Custom Post'
        ],
        'menu_icon' => 'dashicons-editor-customchar',
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail']
    ];

    register_post_type('custom-post', $args);
};





// register menus
register_nav_menus(
    [
    'top-menu' => 'Top Menu Location',
    'mobile-menu' => 'Mobile menu'
    ]
);

// custom image size example
add_image_size('hero-image', 800, 400, false);

//  register post thumbnails
add_theme_support('post-thumbnails');

// add navigation menus
add_theme_support('menus');

// Hooks
add_action('wp_enqueue_scripts', 'load_assets');
add_action('widgets_init', 'my_sidebars');
add_action('init', 'create_custom_post_type');

// add support for post formats ?
add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio', 'status']);

// add support for widgets
add_theme_support('widgets');
