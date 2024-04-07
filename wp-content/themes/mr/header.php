<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <?php  the_title();?>
</head>


<body>
    <header>
        <?php    wp_nav_menu([ 'theme_location' => 'top-menu' ,'menu_class' => 'top-menu'  ])?>
    </header>