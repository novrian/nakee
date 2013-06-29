<?php
/**
 * Portfolio Archive Template Part
 *
 * @author Novrian Y.F. <me@novrian.info>
 * @copyright (c) 2013, Novrian Y.F.
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL License
 */


// Make $portfolio Available
global $portfolio, $wp_query;

/**
 * Jika $portfolio tidak ada
 * assign variabel $wp_query ke variabel $portfolio
 */
if (!isset($portfolio) || empty($portfolio)) {
    $portfolio = $wp_query;
}

?>

<?php if ($portfolio->have_posts()) : ?>

<div class="row-fluid">

    <?php $result = 0; ?>
    <?php $total_post = $portfolio->post_count; ?>
    <?php while($portfolio->have_posts()) : $portfolio->the_post(); ?>

        <?php if ($result % 3 === 0) : ?>
</div>
<div class="row-fluid">
        <?php endif; ?>
    <div class="span4">
        <article id="<?php the_ID(); ?>" <?php post_class(); ?>>
            <header>
                <figure id="<?php the_ID(); ?>-portfolio" class="nakee-portfolio-figure small-figure">
                    <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink(); ?>" title="<?php echo nakee_get_title(); ?>"><?php echo get_the_post_thumbnail(get_the_ID(), 'portfolio-small', array(
                        'class' => 'img-polaroid',
                        'alt' => 'Portfolio : ' . get_the_title(),
                        'title' => 'Portfolio : ' . get_the_title()
                    )); ?></a>
                    <?php else : ?>
                    <a href="<?php the_permalink(); ?>" title="<?php echo nakee_get_title(); ?>"><img class="img-polaroid" src="<?php echo home_url() . '/assets/img/no-portfolio-500x281.png' ?>" alt="<?php echo nakee_get_title(); ?>" title="<?php echo nakee_get_title(); ?>" /></a>
                    <?php endif; ?>
                </figure>
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Portfolio: <?php echo nakee_get_title(); ?>"><?php echo nakee_get_title(); ?></a></h2>
                <div class="entry-meta hide-text"><time datetime="<?php echo get_the_date('Y-m-d'); ?>" pubdate><?php echo get_the_date(); ?></time></div>
            </header>
            <div class="entry-summary">
                <?php echo nakee_excerpt(20); ?>
            </div>
            <footer>
                <div class="entry-category hide-text"><?php the_terms($post->ID, 'nakee_portfolio_category', __('Portfolio Categories: '), ',', ''); ?></div>
                <address class="author vcard hide-text">
                    <span class="fn"><?php echo get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name'); ?></span>
                    <span class="nickname"><?php the_author_meta('nickname'); ?></span>
                </address>
            </footer>
        </article>
    </div>
        <?php $result++; ?>


    <?php endwhile; ?>
</div>

    <?php // Pagenavi ?>
    <?php if (function_exists('wp_pagenavi')) : ?>

        <?php nakee_wp_pagenavi('large', 'centered', false, $portfolio); ?>

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


<?php else : ?>

<div class="alert alert-block">
    <h4><?php _e('Sorry', 'roots'); ?></h4>
    <p><?php _e('Portfolio belum tersedia', 'roots'); ?></p>
</div>

<?php endif; ?>
