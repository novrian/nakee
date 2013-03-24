<header class="banner" role="banner">
    <div class="navbar navbar-static-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <h1>
                    <a class="brand" href="<?php echo home_url(); ?>/">
                        <?php bloginfo('name'); ?>
                    </a>
                </h1>
                <h2 class="hide-text"><?php bloginfo('description'); ?></h2>
                <nav class="nav-main nav-collapse" role="navigation">
                    <?php
                    if (has_nav_menu('primary_navigation')) :
                        wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav'));
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
    if (is_front_page() || (get_post_type() === 'nakee_portfolio') || is_archive('nakee_portfolio') || is_page('services')) {
        $tagline = MAIN_TAGLINE;
        $header_class = 'nakee-main-header';
    } elseif (is_page('kontak')) {
        $tagline = CONTACT_TAGLINE;
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
    
    <div class="container">
        <div class="row-fluid">
            <?php dynamic_sidebar('frontpage-teaser'); ?>
        </div>
    </div>
        
    <?php endif; ?>
    
</header>
