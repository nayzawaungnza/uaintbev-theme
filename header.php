<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!doctype html>
<html <?php language_attributes() ?>>

<head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php bloginfo('name') ?></title>
    <meta name="description" content="">
    <meta name="<?php bloginfo('author') ?>" content="<?php bloginfo('content') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <?php wp_head(); ?>
</head>

<body <?php body_class('body-class'); ?>>
    <?php get_template_part('inc/template/uaintbev'); ?>

    <?php 
    if (has_nav_menu('header-menu')) {
       wp_nav_menu(array('theme_location'=>'uaintbev-header-menu'));
    }
    ?>