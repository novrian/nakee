<?php if (!have_posts()) : ?>

    <div class="alert alert-block">
        <h4><?php _e('Ooops', 'roots'); ?></h4>
        <p><?php _e('No results were found.', 'roots'); ?></p>
    </div>
    <?php get_search_form(); ?>

<?php else : ?>

    <?php while (have_posts()) : the_post(); ?>

    <article <?php post_class(); ?>>
        <header>

            <div class="featured-image visible-desktop">
                <figure class="nakee-post-thumbnails">
                    <?php
                    $featured_image = '<img alt="' . nakee_get_title() . '" title="' . nakee_get_title() . '" src="' . home_url() . '/assets/img/featured-thumb.png" />';
                    if (has_post_thumbnail()) {
                        $featured_image = get_the_post_thumbnail(get_the_ID(), 'post-small');
                    }
                    ?>
                    <a href="<?php the_permalink(); ?>" title="<?php echo nakee_get_title(); ?>"><?php echo $featured_image; ?></a>
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
                <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo nakee_get_title(); ?>"><?php echo nakee_get_title(); ?></a></h1>
                <span class="hide-text byline author vcard"><?php echo __('By', 'roots'); ?> <?php echo get_the_author(); ?></a></span>
                <time class="updated" datetime="<?php echo get_the_time('c'); ?>" pubdate><?php echo get_the_date(); ?></time>
            </div>

            <?php unset($categories); ?>

        </header>
        <div class="entry-summary">
            <?php echo nakee_excerpt(); ?>
        </div>
        <div class="clearfix"></div>
    </article>

    <?php endwhile; ?>

    <?php if (function_exists('wp_pagenavi')) : ?>

    <nav class="post-nav">
        <?php nakee_wp_pagenavi(); ?>
    </nav>

    <?php else : ?>

        <?php if ($wp_query->max_num_pages > 1) : ?>
            <nav class="post-nav">
                <ul class="pager">
                    <?php if (get_next_posts_link()) : ?>
                        <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
                    <?php endif; ?>
                    <?php if (get_previous_posts_link()) : ?>
                        <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
                        <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>

    <?php endif; ?>

<?php endif; ?>
