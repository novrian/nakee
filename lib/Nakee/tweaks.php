<?php
/**
 * Nakee Tweaks
 * 
 * Kumpulan fungsi-fungsi Tweaking Roots Theme
 * 
 * @author Novrian Y.F. <me@novrian.info>
 * @copyright (c) 2013, Novrian Y.F.
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL License
 */


/**
 * Fix nav menu active classes for custom post types
 * 
 * @link http://wordpress.stackexchange.com/questions/30417/removing-all-classes-from-nav-menu-except-current-menu-item-and-current-menu-par StackOverflow
 */
function nakee_navmenu_css($classes, $item) {
    global $post;
    $slug = sanitize_title($item->title);
    
    if (get_post_type() == 'nakee_portfolio' || is_post_type_archive('nakee_portfolio') || is_page('services')) {
        if ($slug == 'portfolio') {
            $classes[] = 'current-menu-item';
        } else {
            $classes = (array)get_post_meta($item->ID, '_menu_item_classes', true);
        }
    } else {
        $classes = array_filter(
            $classes,
            create_function('$class', 'return in_array($class, array("current-menu-item", "current-menu-parent", "current-menu-ancestor", "current_page_item", "current_page_parent", "current_page_ancestor"));')
        );
        $classes = array_merge($classes, get_post_meta($item->ID, '_menu_item_classes', true));
    }
    
    return $classes;
}
add_filter('nav_menu_css_class', 'nakee_navmenu_css', 5, 2);