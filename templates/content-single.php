<?php while (have_posts()) : the_post(); ?>

    <article <?php post_class(); ?>>
        
        <header>
            <h1 class="entry-title"><?php echo nakee_get_title(); ?></h1>
            <figure class="nakee-singlepost-thumbs">
                <a href="<?php the_permalink(); ?>" title="<?php echo nakee_get_title(); ?>"><?php echo (has_post_thumbnail()) ? get_the_post_thumbnail(get_the_ID(), 'post-large') : wp_get_attachment_image($GLOBALS['nakee']['def-featured-img'][rand(0, 3)], 'post-large'); ?></a>
            </figure>
            <?php get_template_part('templates/entry-meta'); ?>
        </header>
        
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
        
        <footer>
            <?php if (function_exists('wp_pagenavi') && function_exists('nakee_wp_pagenavi')) : ?>
                <?php nakee_wp_pagenavi('small', null, true); ?>
            <?php else : ?>
                <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
            <?php endif; ?>
            <section id="<?php echo 'social-share-' . get_the_ID(); ?>" class="single-social">
                <h3><?php echo __('Spread the Word', 'roots'); ?></h3>
                <div class="single-section-container">
                    <strong>Share This</strong>
                </div>
            </section>
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
