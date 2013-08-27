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
    $content = strip_tags(get_the_content(false), '<br>');
    $content = strip_shortcodes($content);

    if (!trim($content)) {
        return null;
    }

    $content = explode(" ", $content, $limit);
    $content = array_map('trim', $content);
    $excerpt = str_replace("\r", " ", $content);
    $excerpt = str_replace("\n", " ", $content);

    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
    }

    $excerpt = '<p>' . implode(" ", $excerpt) . '&hellip;</p>' . nakee_excerpt_more(null);

    return $excerpt;
}
// Remove Roots Related Excerpt Filter
remove_filter('excerpt_length', 'roots_excerpt_length');
remove_filter('excerpt_more', 'roots_excerpt_more');


/**
 * Nakee Custom Excerpt More
 *
 * @param string
 * @return string
 */
function nakee_excerpt_more($more) {
    return (is_nakee_element()) ? null : '<a href="' . get_permalink() . '" class="more-link">' . __('Continued  &raquo;', 'roots') . '</a>';
}


/**
 * Twitter Bootstrap Pagenavi
 *
 * This is tweaks function to display WP-Pagenavi markup that displayed like
 * Twitter Bootstrap Pagination.
 *
 * Do not fille the pagenavi's options below:
 * - Text For Number Of Pages
 * - Text For `First` / `Last Page`
 * - Text For `Previous ...` / `Next ...`
 *
 * Usage:
 * Just put this code on your theme's function.php
 *
 * @author Novrian Nono <me@novrian.info>
 * @param string $size Bootstrap Pagination Size: `normal | small | large | mini`
 * @param string $position Bootstrap Pagination Position: `left | centered | right`
 * @param boolean $post set it to true on multipart post
 * @param object WP_Query Object if you use custom query
 */
function nakee_wp_pagenavi($size = null, $position = null, $post = false, $queryArgs = null) {
    if (!function_exists('wp_pagenavi')) {
        return null;
    }

    $class[] = "pagination"; // Set Main Class

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
    $before = "<div class=\"" . implode(" ", $class) . "\"><ul>";
    $after = "</ul></div>";

    // Build Args
    $args = array(
        'before' => $before,
        'after' => $after
        );

    // Cloning untuk wp_link_pages()
    if ($post) {
        $args['type'] = 'multipart';
    }

    if ($queryArgs) {
        $args['query'] = $queryArgs;
    }

    return wp_pagenavi($args);
}

/**
* This is filter that help above template tags
*/
function nakee_pagenavi_filter($html) {
    $out = str_replace('<div class=\'wp-pagenavi\'>', '', $html);
    $out = str_replace('</div></ul></div>', '</ul></div>', $out);
    $out = str_replace('<a ', '<li><a ', $out);
    $out = str_replace('</a>', '</a></li>', $out);
    $out = str_replace('<span', '<li><a href="#"><span', $out);
    $out = str_replace('</span>', '</span></a></li>', $out);
    $out = preg_replace('/<li><a href="#"><span class=[\'|"]pages[\'|"]>([0-9]+) of ([0-9]+)<\/span><\/a><\/li>/', '', $out);
    $out = preg_replace('/<li><a href="#"><span class=[\'|"]extend[\'|"]>([^\n\r<]+)<\/span><\/a><\/li>/', '<li class="disabled"><a href="#">&hellip;</a></li>', $out);
    $out = str_replace('<li><a href="#"><span class=\'current\'', '<li class="active disabled"><a href="#"><span class="current"', $out);

    return $out;
}
add_filter('wp_pagenavi', 'nakee_pagenavi_filter', 10, 2);


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
            $output .= '<li class="span4 related-post-item">';

            $output .= '<a href="' . get_permalink() . '" title="' . nakee_get_title() . '">';
            $output .= (has_post_thumbnail())
                ? get_the_post_thumbnail(null, 'post-small')
                : '<img alt="' . nakee_get_title() . '" title="' . nakee_get_title() . '" src="' . home_url() . '/assets/img/featured-thumb.png" />' ;
            $output .= '<strong>' . nakee_get_title() . '</strong>';
            $output .= '</a>';

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


/**
 * nakee_title()
 *
 * Template Tags untuk override roots_title()
 *
 * @return void
 */
function nakee_title() {
    if (is_front_page()) {
        echo __('Portfolios', 'roots');
    } elseif (is_archive()) {
        $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
        if (is_tax('nakee_portfolio_category')) {
            printf(__('Work on %s', 'roots'), $term->name);
        } elseif (is_tax('nakee_technology')) {
            printf(__('%s Technology', 'roots'), $term->name);
        } elseif (is_post_type_archive('nakee_portfolio')) {
            echo __('Portfolios', 'roots');
        } elseif (is_day()) {
            printf(__('Daily Archives: %s', 'roots'), get_the_date());
        } elseif (is_month()) {
            printf(__('Monthly Archives: %s', 'roots'), get_the_date('F Y'));
        } elseif (is_year()) {
            printf(__('Yearly Archives: %s', 'roots'), get_the_date('Y'));
        } elseif (is_author()) {
            printf(__('Author Archives: %s', 'roots'), get_the_author());
        } else {
            single_cat_title(__('Posts on ', 'roots'));
        }
    } else {
        echo roots_title();
    }
}


/**
 * is_nakee_element
 *
 * Conditional Tag untuk menampilkan elemen penting dalam layout
 *
 * @return boolean
 */
function is_nakee_element() {
    global $post;
    if (
        is_front_page()
        || (get_post_type() === 'nakee_portfolio')
        || is_post_type_archive('nakee_portfolio')
        || is_tax('nakee_portfolio_category')
        || is_tax('nakee_technology')
        || is_page('services')
        || is_page('about') ) {
        return true;
    }

    return false;
}
