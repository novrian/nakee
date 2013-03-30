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
 * @param boolean $post WP Link Pages Switch
 */
function nakee_wp_pagenavi($size = null, $position = null, $post = false) {
    $class[] = "pagination";    // Set Main Class
    
    // Pagination Size Class
    if (!$size) {
        $size = '';
    }    
    $class[] = (!$size) ? '' : "pagination-" . $size;
    
    // Pagination Position, default LEFT
    if (!$position) {
        $position = 'left';
    }    
    $class[] = "pagination-" . $position;
    
    // Set Before & After Output
    $before = "<nav id=\"main-pagination\"><div class=\"" . implode(" ", $class) . "\"><ul>";
    $after = "</ul></div>";
    
    // Build Args
    $args = array(
        'before' => $before,
        'after' => $after
    );
    
    // Cloning untuk wp_link_pages()
    if ($post) {
        $args = array_merge($args, array(
            'type' => 'multipart'
        ));
    }
    
    return wp_pagenavi($args);
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


/**
 * nakee_related_posts
 * 
 * Template Tags untuk menampilkan Related Posts pada Loop Single Post
 * 
 * @param int $count
 * @return void
 */
function nakee_related_posts($count = 3) {
    global $post;
    
    // Ambil Tags
    $tags = get_the_tags($post->ID);
    
    // Buat Query Random Post: Default Query
    $related = new WP_Query(array(
        'posts_per_page' => $count - 1,
        'orderby' => 'rand'
    ));
    
    if ($tags) {
        // Display Related Posts
        
        $tagID = array_keys($tags); // Ambil Tag ID
        
        // Buat Query
        $newQuery = new WP_Query(array(
            'tag__in' => $tagID,
            'post__not_in' => array( $post->ID ),
            'posts_per_page' => $count,
            'orderby' => 'rand'
        ));
        
        // Jika Post dalam Tag yg ditemukan ada
        // Maka buat variabel $related
        if ($newQuery->have_posts()) {
            $related = $newQuery;
            wp_reset_query();
        }
    }
    
    $output = "";
    
    // Output Related Posts
    if ($related->have_posts()) {
        $output .= '<ul class="inline row-fluid">';
        
        while ($related->have_posts()) {
            $related->the_post();
            $output .= '<li class="span4">';
            $output .= '<div class="related-post-item">';
            $output .= '<figure>';
            $output .= '<a href="' . get_permalink() . '" title="' . nakee_get_title() . '">';
            $output .= (has_post_thumbnail())
                ? get_the_post_thumbnail(null, 'post-small')
                : wp_get_attachment_image($GLOBALS['nakee']['def-featured-img'][rand(0,3)], 'post-small') ;
            $output .= '</a>';
            $output .= '<figcaption><strong><a href="' . get_permalink() . '" title="' . nakee_get_title() . '">' . nakee_get_title() . '</a></strong></figcaption>';
            $output .= '</figure>';
            $output .= '</div>';
            $output .= '</li>';
        }
        
        $output .= '</ul>';
    } else {
        // Tidak ada Related Posts di temukan
        $output .= '<div class="alert">';
        $output .= __('<strong>Sorry!</strong> No Related Posts Found', 'roots');
        $output .= '</div>';
    }
    
    // Reset Query
    wp_reset_query();
    
    // Print Output
    print $output;
}