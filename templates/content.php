<?php if (!have_posts()) : ?>
    <div class="alert">
        <?php _e('Sorry, no results were found.', 'roots'); ?>
    </div>
    <?php get_search_form(); ?>
<?php else : ?>

    <?php while (have_posts()) : the_post(); ?>
    <article <?php post_class(); ?>>
        <header>
            <div class="row-fluid">
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo nakee_get_title(); ?></a></h2>
                <?php get_template_part('templates/entry-meta'); ?>
            </div>
        </header>
        <div class="entry-summary">
            <?php echo nakee_excerpt(); ?>
        </div>
        <div class="clearfix"></div>
    </article>
    <?php endwhile; ?>

    <?php if (function_exists('wp_pagenavi')) : ?>

        <?php nakee_wp_pagenavi(); ?>

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
