<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title><?php echo nakee_wp_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>

    <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">

    <?php // TypeKit Scripts ?>
    <script type="text/javascript" src="//use.typekit.net/kpm6ebn.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
    <?php // Stop TypeKit ?>

    <?php // Favicon ?>
    <link rel="apple-touch-icon-precomposed apple-touch-icon favicon shortcut icon" href="<?php echo home_url() . '/' . THEME_PATH; ?>/apple-touch-icon.png">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo home_url() . '/' . THEME_PATH; ?>/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo home_url() . '/' . THEME_PATH; ?>/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo home_url() . '/' . THEME_PATH; ?>/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo home_url() . '/' . THEME_PATH; ?>/apple-touch-icon-144x144-precomposed.png">
    <?php // Stop Favicon ?>

    <?php // Selectivizr ?>
    <!--[if (gte IE 6)&(lte IE 8)]>
    <script type="text/javascript" src="<?php echo home_url() . '/assets/js/vendor/selectivizr-min.js'; ?>"></script>
    <noscript><link rel="stylesheet" href="<?php echo home_url() . '/assets/css/ie.css'; ?>" /></noscript>
    <![endif]-->
    <?php // End Selectivizr ?>
</head>
