<?php
/**
 * Portfolio Category Taxonomy Template
 * 
 * @author Novrian Y.F. <me@novrian.info>
 * @copyright (c) 2013, Novrian Y.F.
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL License
 */

// Get Breadcrumbs
get_template_part('templates/breadcrumbs');

// Get Page Header
get_template_part('templates/page', 'header');

get_template_part('templates/portfolio', 'archive');

// Reset Query
wp_reset_postdata();