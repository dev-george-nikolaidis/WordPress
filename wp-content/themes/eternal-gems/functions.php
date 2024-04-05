<?php

declare(strict_types=1);




function load_assets()
{

    wp_enqueue_script('my-main-script', get_template_directory_uri() . '/assets/js/main.js', [], '1.0.0', true);

}


add_action('wp_enqueue_scripts', 'load_assets');
