<?php
/**
 * Portfolio Post Type Template
 * 
 * @author Novrian Y.F. <me@novrian.info>
 * @copyright (c) 2013, Novrian Y.F.
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL License
 */

// Get Breadcrumbs
get_template_part('templates/breadcrumbs');

// Get Page Header
get_template_part('templates/page', 'header');

/**
 * Query Portfolio Post Type
 * with Sticky value is true
 */
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'nakee_portfolio',
    'posts_per_page' => PORTFOLIO_PER_PAGE,
    'paged' => $paged
);
$portfolio = new WP_Query($args);

get_template_part('templates/portfolio', 'archive');

wp_reset_postdata(); // Reset to Normal Query