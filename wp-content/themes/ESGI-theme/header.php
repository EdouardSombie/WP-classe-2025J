<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
  /* déclenchement du hook d'action wp_head */
  wp_head();
  ?>
</head>

<body <?php body_class(); ?>>
  <header class="site-header">
    <?php
    if (has_nav_menu('main-menu')) {
      wp_nav_menu(array(
        'theme_location' => 'main-menu',
        'container' => 'nav',
        'container_class' => 'main-navigation'
      ));
    }

    ?>
  </header>