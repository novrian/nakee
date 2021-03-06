<header class="banner" role="banner">
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <h1 class="brand">
                    <a href="<?php echo home_url(); ?>/">
                        <?php bloginfo('name'); ?>
                    </a>
                </h1>
                <h2 class="hidden"><?php bloginfo('description'); ?></h2>
                <nav class="nav-main nav-collapse" role="navigation">
                    <?php
                    if (has_nav_menu('primary_navigation')) :
                        wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav pull-right'));
                    endif;
                    ?>
                </nav>
            </div>
        </div>

    </div>

    <?php
    /**
     * Banner Process
     */
    $tagline = get_bloginfo('description');
    $header_class = null;
    if (is_nakee_element()) {
        $tagline = MAIN_TAGLINE;
        $header_class = 'nakee-main-header';
    } elseif (is_page('kontak')) {
        $tagline = CONTACT_TAGLINE;
    } elseif (is_404()) {
        $tagline = __('<strong>Ooops!</strong> Not Found', 'roots');
    } else {
        $tagline = BLOG_TAGLINE;
    }
    ?>

    <div class="nakee-header <?php echo stripslashes($header_class); ?>">
        <div class="container">
            <h3><?php echo stripslashes($tagline); ?></h3>
        </div>
    </div>

    <?php // Display Widget - Frontpage Teaser ?>
    <?php if (is_front_page() && is_active_sidebar('frontpage-teaser')) : ?>

    <div class="nakee-front-teaser">
        <div class="container">
            <div class="row-fluid">
                <?php dynamic_sidebar('frontpage-teaser'); ?>
            </div>
        </div>
    </div>

    <?php endif; ?>

    <div class="nakee-banner-border"></div>

</header>
