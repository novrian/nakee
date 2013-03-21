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
 * @link https://groups.google.com/d/topic/roots-theme/1JIXgbZvt1E/discussion Roots Theme Google Group
 */
function roots_cpt_active_menu($menu) {
    global $post;
    if ('nakee_portfolio' === get_post_type()) {
        $menu = str_replace('active', '', $menu);
        $menu = str_replace('menu-portfolio', 'menu-portfolio active', $menu);
    }
    return $menu;
}
add_filter('nav_menu_css_class', 'roots_cpt_active_menu', 400);