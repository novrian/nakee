<?php while (have_posts()) : the_post(); ?>

    <article <?php post_class(); ?>>

        <header class="single-meta">

            <div class="featured-image">
                <figure class="nakee-post-thumbnails">
                    <?php echo (has_post_thumbnail()) ? get_the_post_thumbnail(get_the_ID(), 'post-large') : '<img alt="' . nakee_get_title() . '" title="' . nakee_get_title() . '" src="' . WP_BASE . '/assets/img/featured.png" />'; ?>
                </figure>
            </div>
            <div class="entry-meta">
                <?php
                $get_categories = get_the_category();
                if ($get_categories) {
                    foreach($get_categories as $key => $cat) {
                        $categories[] = '<a href="' . get_category_link($cat->cat_ID) . '" rel="tag" title="' . sprintf(__('View posts on %s', 'roots'), $cat->name) . '">' . $cat->name . '</a>';
                    }
                }
                ?>
                <span class="entry-category"><?php printf(__('About %s', 'roots'), implode(", ", $categories)); ?></span>
                <h1 class="entry-title"><?php echo nakee_get_title(); ?></h1>
                <span class="hide-text byline author vcard"><?php echo __('By', 'roots'); ?> <?php echo get_the_author(); ?></a></span>
                <time class="updated" datetime="<?php echo get_the_time('c'); ?>" pubdate><?php echo get_the_date(); ?></time>
            </div>

        </header>

        <div class="entry-content">
            <?php the_content(); ?>
            <div class="clearfix"></div>
        </div>

        <footer>
            <?php if (function_exists('wp_pagenavi') && function_exists('nakee_wp_pagenavi')) : ?>
                <?php nakee_wp_pagenavi('small', null, true); ?>
            <?php else : ?>
                <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
            <?php endif; ?>

            <?php get_template_part('templates/social-share'); ?>

        </footer>

    </article>

    <aside id="<?php echo 'related-to-' . get_the_ID(); ?>" class="nakee-related-posts">
        <h3><?php echo __('Related Posts', 'roots'); ?></h3>
        <div class="single-section-container">
            <?php nakee_related_posts(); ?>
        </div>
    </aside>

    <nav class="post-nav">
        <ul class="pager">
            <li class="previous"><?php previous_post_link('%link', '&larr; %title'); ?></li>
            <li class="next"><?php next_post_link('%link', '%title &rarr;'); ?></li>
        </ul>
    </nav>

    <?php comments_template('/templates/comments.php'); ?>

<?php endwhile; ?>
