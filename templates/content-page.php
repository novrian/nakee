<?php while (have_posts()) : the_post(); ?>

<section id="page-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header>
        <div class="page-header">
            <h1 class="entry-title"><?php echo nakee_get_title(); ?></h1>
            <div class="entry-meta hidden">
                <time class="hide-text updated" datetime="<?php echo get_the_time('c'); ?>" pubdate><?php echo get_the_date(); ?></time>
                <p class="hide-text byline author vcard"><?php echo __('By', 'roots'); ?> <?php echo get_the_author(); ?></a></p>
            </div>
        </div>
    </header>

    <div class="entry-content">
        <?php the_content(); ?>
    </div>

    <footer>
        <?php if (function_exists('wp_pagenavi') && function_exists('nakee_wp_pagenavi')) : ?>
        <nav class="page-nav">
            <?php nakee_wp_pagenavi('large', null, true); ?>
        </nav>
        <?php else : ?>
            <?php wp_link_pages(array('before' => '<nav class="page-nav">', 'after' => '</nav>')); ?>
        <?php endif; ?>
    </footer>

</section>

<?php endwhile; ?>
