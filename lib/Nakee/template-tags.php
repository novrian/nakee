<?php
/**
 * Nakee Custom Template Tags
 * 
 * @author Novrian Y.F. <me@novrian.info>
 * @copyright (c) 2013, Novrian Y.F.
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL License
 */


/**
 * Custom Get The Title
 */
function nakee_get_title() {
    global $post;
    $title = get_the_title();
    if (empty($title)) {
        return __('Untitled', 'roots');
    }
    
    return $title;
}


/**
 * Custom Excerpt
 * 
 * @link http://www.itsabhik.com/wordpress-custom-excerpt-length/ Base on Abhik work, Thanks
 */
function nakee_excerpt($limit = POST_EXCERPT_LENGTH) {
    $content = explode(" ", get_the_content(), $limit);
    $content = array_map('trim', $content);
    $excerpt = str_replace("\r", " ", $content);
    $excerpt = str_replace("\n", " ", $content);
    
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . roots_excerpt_more(null);
    } else {
        $excerpt = implode(" ", $excerpt);
    }
    
    return $excerpt;
}
// Remove Roots Related Excerpt Filter
remove_filter('excerpt_length', 'roots_excerpt_length');
remove_filter('excerpt_more', 'roots_excerpt_more');


/**
 * Custom WP-Pagenavi Nakee
 * 
 * @param string $size Pagination Size. Values: `normal | small | large | mini`
 * @param string $position Pagination Aligned Position. Values: `left
 *   | centered | right`
 */
function nakee_wp_pagenavi($size = null, $position = null) {
    $class[] = "pagination";
    if (!$size) {
        $size = '';
    }
    
    $class[] = (!$size) ? '' : "pagination-" . $size;
    
    if (!$position) {
        $position = 'left';
    }
    
    $class[] = "pagination-" . $position;
    
    $before = "<nav id=\"main-pagination\"><div class=\"" . implode(" ", $class) . "\"><ul>";
    $after = "</ul></div>";
    
    return wp_pagenavi(array(
        'before' => $before,
        'after' => $after
    ));
}