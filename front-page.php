<?php
/**
 * Frontpage Template
 *
 * @author Novrian Y.F. <me@novrian.info>
 * @copyright (c) 2013, Novrian Y.F.
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL License
 */

// get breadcrumbs
get_template_part('templates/breadcrumbs');

// get Page Header
get_template_part('templates/page', 'header');

/**
 * Query Portfolio Post Type
 * with Sticky value is true
 */
$portfolio_args = array(
    'post_type' => 'nakee_portfolio',
    'meta_query' => array(
        array(
            'key' => 'sticky',
            'value' => 1,
            'compare' => '=',
            'type' => 'NUMERIC'
        )
    ),
    'posts_per_page' => PORTFOLIO_PER_PAGE
);
$portfolio = new WP_Query($portfolio_args);

get_template_part('templates/portfolio', 'archive');

wp_reset_postdata(); // Reset Query
?>

<section class="portfolio-category">
    <h3 class="hide-text"><?php echo __('Portfolio Category', 'roots'); ?></h3>
    <ul class="inline">
        <li><a href="<?php echo get_post_type_archive_link('nakee_portfolio'); ?>" title="<?php _e('View All Portfolios', 'roots'); ?>"><?php _e('All', 'roots'); ?></a></li>
    <?php wp_list_categories(array(
        'taxonomy' => 'nakee_portfolio_category',
        'hierarchical' => 0,
        'title_li' => '',
        'walker' => new Nakee_Category_Walker()
    )); ?>
    </ul>
</section>

<section id="last-tweet" class="last-tweet-widget">
    <h3 class="hide-text"><?php echo __('Latest Tweet', 'roots'); ?></h3>
    <div class="row-fluid">
        <div class="twitter-logo">
            <span class="hide-text">Twitter Logo</span>
        </div>
        <div class="tweet-container"><?php echo nakee_display_last_tweet(); ?></div>
    </div>
</section>
