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
$args = array(
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
$portfolio = new WP_Query($args);

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
        'title_li' => ''
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

<!--
<h1>Portfolio</h1>
<div class="row">
    <div class="span4">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed arcu sapien, venenatis at adipiscing sed, semper sed velit. Nam urna tortor, porta et tempus sit amet, ultrices a enim. Fusce ut pharetra nisi? Mauris pretium sodales scelerisque. Maecenas sollicitudin quam quam, id ultricies urna. Praesent tincidunt libero egestas massa vestibulum sodales. Ut dui justo, ultrices ut mollis sit amet, suscipit quis dolor. In et orci neque, non volutpat diam.
    </p>
    </div>
    <div class="span4">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed arcu sapien, venenatis at adipiscing sed, semper sed velit. Nam urna tortor, porta et tempus sit amet, ultrices a enim. Fusce ut pharetra nisi? Mauris pretium sodales scelerisque. Maecenas sollicitudin quam quam, id ultricies urna. Praesent tincidunt libero egestas massa vestibulum sodales. Ut dui justo, ultrices ut mollis sit amet, suscipit quis dolor. In et orci neque, non volutpat diam.
    </p>
    </div>
    <div class="span4">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed arcu sapien, venenatis at adipiscing sed, semper sed velit. Nam urna tortor, porta et tempus sit amet, ultrices a enim. Fusce ut pharetra nisi? Mauris pretium sodales scelerisque. Maecenas sollicitudin quam quam, id ultricies urna. Praesent tincidunt libero egestas massa vestibulum sodales. Ut dui justo, ultrices ut mollis sit amet, suscipit quis dolor. In et orci neque, non volutpat diam.
    </p>
    </div>
</div>

<div class="row">
    <div class="span8">
        <h1>Blog</h1>
        <div class="row-fluid">
            <div class="span4" style="background-color: red;">&nbsp;</div>
            <p class="span8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed arcu sapien, venenatis at adipiscing sed, semper sed velit. Nam urna tortor, porta et tempus sit amet, ultrices a enim. Fusce ut pharetra nisi? Mauris pretium sodales scelerisque. Maecenas sollicitudin quam quam, id ultricies urna. Praesent tincidunt libero egestas massa vestibulum sodales. Ut dui justo, ultrices ut mollis sit amet, suscipit quis dolor. In et orci neque, non volutpat diam.
    </p>
        </div>
    </div>
    <div class="span4">
        <h1>Sidebar</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed arcu sapien, venenatis at adipiscing sed, semper sed velit. Nam urna tortor, porta et tempus sit amet, ultrices a enim. Fusce ut pharetra nisi? Mauris pretium sodales scelerisque. Maecenas sollicitudin quam quam, id ultricies urna. Praesent tincidunt libero egestas massa vestibulum sodales. Ut dui justo, ultrices ut mollis sit amet, suscipit quis dolor. In et orci neque, non volutpat diam.
</p>
    </div>
</div>-->
