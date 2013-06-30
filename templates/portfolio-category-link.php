<?php
/**
 * Portfolio Category Link
 * 
 * @author Novrian Y.F. <me@novrian.info>
 * @copyright (c) 2013, Novrian Y.F.
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL License
 */
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