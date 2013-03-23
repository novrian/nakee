<?php
/**
 * Nakee Init
 * 
 * Kumpulan fungsi-fungsi yang di-hooks pada init
 * 
 * @author Novrian Y.F. <me@novrian.info>
 * @copyright (c) 2013, Novrian Y.F.
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL License
 */


/**
 * Setting Custom Post Type
 */
function nakee_post_type_settings() {
    
    /**
     * Portfolio Post Type
     */
    register_post_type('nakee_portfolio', array(
        'label' => __('Portfolios', 'roots'),
        'labels' => array(
            'add_new' => _x('Add Portfolios', 'roots'),
            'add_new_item' => _x('Add Portfolios', 'roots'),
            'edit_item' => _x('Edit Portfolios', 'roots'),
            'new_item' => _x('New Portfolios', 'roots'),
            'view_item' => _x('View Portfolios', 'roots')
        ),
        'description' => __('Portfolio post types is use to save all portfolio post.', 'roots'),
        'public' => true,
        'menu_position' => 5,
        'taxonomies' => array(
            'nakee_portfolio_category',
            'nakee_technology'
        ),
        'supports' => array(
            'title',
            'editor',
            'thumbnail'
        ),
        'has_archive' => true,
        'rewrite' => array(
            'slug' => 'portfolio'
        )
    ));
    
}
add_action('init', 'nakee_post_type_settings');


/**
 * Setting Custom Taxonomy
 */
function nakee_taxonomy_settings() {
    
    /**
     * Kategori Portfolio
     */
    register_taxonomy('nakee_portfolio_category', 'nakee_portfolio', array(
        'labels' => array(
            'name' => _x('Portfolio Categories', 'taxonomy general name'),
            'singular_name' => _x('Portfolio Category', 'taxonomy singular name'),
            'all_items' => __('All Portfolio Categories', 'roots'),
            'edit_item' => __('Edit Portfolio Category', 'roots'),
            'view_item' => __('View Portfolio Category', 'roots'),
            'update_item' => __('Update Portfolio Category', 'roots'),
            'add_new_item' => __('Add Portfolio Category', 'roots'),
            'new_item_name' => __('New Portfolio Category', 'roots')
        ),
        'rewrite' => array(
            'slug' => 'kategori-portfolio'
        ),
        'hierarchical' => true
    ));
    
    /**
     * Teknologi Portfolio
     */
    register_taxonomy('nakee_technology', 'nakee_portfolio', array(
        'labels' => array(
            'name' => _x('Technologies', 'taxonomy general name'),
            'singular_name' => _x('Technology', 'taxonomy singular name'),
            'all_items' => __('All Technologies', 'roots'),
            'edit_item' => __('Edit Technology', 'roots'),
            'view_item' => __('View Technology', 'roots'),
            'update_item' => __('Update Technology', 'roots'),
            'add_new_item' => __('Add Technology', 'roots'),
            'new_item_name' => __('New Technology', 'roots')
        ),
        'rewrite' => array(
            'slug' => 'teknologi'
        )
    ));
    
}
add_action('init', 'nakee_taxonomy_settings');


/**
 * Nakee Post Thumbnail Setting
 */
function nakee_thumbnail_settings() {
    set_post_thumbnail_size(100, 100, true);              // Default Thumbnail Size
    add_image_size('portfolio-large', 1200, 619, true);   // Portfolio Large
    add_image_size('portfolio-small', 500, 281, true);    // Portfolio Small
    add_image_size('post-large', 800, 450, true);         // Post Large
    add_image_size('post-small', 250, 250, true);         // Post Small
}
add_action('after_setup_theme', 'nakee_thumbnail_settings');