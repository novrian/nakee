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
    $content = strip_tags(get_the_content(), '<br>');
    $content = explode(" ", $content, $limit);
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


/**
 * nakee_breadcrumbs()
 * 
 * Template Tags untuk output Yoast Breadcrumbs yang support
 * dengan Twitter Bootstrap
 * 
 * @return void
 */
function nakee_breadcrumbs() {
    if (!function_exists('yoast_breadcrumb')) {
        return null;
    }
    
    $crumbs = yoast_breadcrumb(null, null, false);
    
    // Hilangkan wrapper <span xmlns:v />
    $output = preg_replace("/^\<span xmlns\:v=\"http\:\/\/rdf\.data\-vocabulary\.org\/#\"\>/", "", $crumbs);
    $output = preg_replace("/\<\/span\>$/", "", $output);
    
    // Ambil Crumbs
    $crumb = preg_split("/\40([\\" . BREADCRUMBS_SEP . "]{1,1})\40/", $output);
    
    // Manipulasi string output tiap crumbs
    $crumb = array_map(
        create_function('$crumb', '
            if (preg_match(\'/\<span\40class=\"breadcrumb_last\"/\', $crumb)) {
                return \'<li class="active">\' . $crumb . \'</li>\';
            }
            return \'<li>\' . $crumb . \' <span class="divider">' . BREADCRUMBS_SEP . '</span></li>\';
        '),
        $crumb
    );
    
    // Bangun output HTML
    $output = '<div class="breadcrumbs-container" xmlns:v="http://rdf.data-vocabulary.org/#"\><ul class="breadcrumb">' . implode("", $crumb) . '</ul></div>';
    
    // Print
    echo $output;
}