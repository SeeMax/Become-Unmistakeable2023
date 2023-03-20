<!doctype html>
<html <?php language_attributes(); ?> class="no-js loader-class">

<head>
  <meta charset="<?php bloginfo('charset'); ?>">

  <?php if ( is_category() ):?>
  <title>Category: <?php single_cat_title();?></title>
  <?php elseif (is_post_type_archive() || is_tax() || is_archive() ):?>
  <?php if(is_author()):?>
  <title>Author: <?php the_author();?></title>
  <?php else:?>
  <title>Archive For: <?php single_cat_title();?></title>
  <?php endif;?>
  <?php else:?>
  <title><?php wp_title(); ?></title>
  <?php endif;?>


  <link href="<?php echo get_template_directory_uri(); ?>/dist/images/favicon.png?v=4" rel="shortcut icon">
  <!-- <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed"> -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php wp_head(); ?>
</head>
<!-- Google tag (gtag.js) -->
<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-XXXXXXXXXX');
</script> -->

<body <?php body_class(); ?>>
  <div class="wrapper">
    <!-- ADD A PRE-LOADEDER -->
    <?php get_template_part( 'partials/_preloader'); ?>
    <header class="header" role="banner">
      <div class="content">
        <div class="header-logo">
          <a class="c-block-fill" href="/"></a>
          <img src="<?php echo get_template_directory_uri(); ?>/dist/images/logo.svg" alt="Logo">
        </div>
        <nav class="main-nav mainNav" role="navigation">
          <div class="main-nav-inner">
            <?php main_theme_nav(); ?>
          </div>
        </nav>
        <div class="mobile-menu menuToggle">
          <span class="hamTop"></span>
          <span class="hamMid"></span>
          <span class="hamBot"></span>
        </div>
      </div>
    </header>