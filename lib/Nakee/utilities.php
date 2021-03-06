<?php
/**
 * Nakee Utilites Function
 *
 * @author Novrian Y.F. <me@novrian.info>
 * @copyright (c) 2013, Novrian Y.F.
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL License
 */

// Load Class
require_once 'Class' . DS . 'Nakee_Category_Walker.php';

/**
 * Nakee Custom Relative Date
 *
 * @link http://stackoverflow.com/questions/2690504/php-producing-relative-date-time-from-timestamps Usman Ungur
 * @param int $secs
 * @return string
 */
function nakee_relative_time($ts) {
    if (!ctype_digit($ts))
        $ts = strtotime($ts);

    $diff = time() - $ts;
    if ($diff == 0)
        return 'sekarang';
    elseif ($diff > 0) {
        $day_diff = floor($diff / 86400);
        if ($day_diff == 0) {
            if ($diff < 60)
                return 'barusan';
            if ($diff < 120)
                return '1 menit yang lalu';
            if ($diff < 3600)
                return floor($diff / 60) . ' menit yang lalu';
            if ($diff < 7200)
                return '1 jam yang lalu';
            if ($diff < 86400)
                return floor($diff / 3600) . ' jam yang lalu';
        }
        if ($day_diff == 1)
            return 'Kemarin';
        if ($day_diff < 7)
            return $day_diff . ' hari yang lalu';
        if ($day_diff < 31)
            return ceil($day_diff / 7) . ' minggu yang lalu';
        if ($day_diff < 60)
            return 'bulan lalu';
        return date('F Y', $ts);
    }
    else {
        $diff = abs($diff);
        $day_diff = floor($diff / 86400);
        if ($day_diff == 0) {
            if ($diff < 120)
                return 'dalam 1 menit';
            if ($diff < 3600)
                return 'dalam ' . floor($diff / 60) . ' menit';
            if ($diff < 7200)
                return 'dalam 1 jam';
            if ($diff < 86400)
                return 'dalam ' . floor($diff / 3600) . ' jam';
        }
        if ($day_diff == 1)
            return 'Besok';
        if ($day_diff < 4)
            return date('l', $ts);
        if ($day_diff < 7 + (7 - date('w')))
            return 'minggu depan';
        if (ceil($day_diff / 7) < 4)
            return 'dalam ' . ceil($day_diff / 7) . ' minggu';
        if (date('n', $ts) == date('n') + 1)
            return 'bulan depan';
        return date('F Y', $ts);
    }
}

/**
 * Convert Twitter Date to UNIX Timestamp
 *
 * @link http://stackoverflow.com/questions/6823537/best-way-to-change-twitter-api-datetimes-to-a-timestamp
 * @param string $date
 * @return int
 */
function nakee_tweet_date_to_unix($date) {
    if (!class_exists("DateTime")) {
        return null;
    }

    $out_date = new DateTime($date);
    $out_date->setTimezone(new DateTimeZone("Asia/Makassar"));

    return $out_date->format("U");
}

/**
 * Returns the permalink for a page based on the incoming slug.
 *
 * @author	Tom McFarlin
 * @param 	string	$slug	The slug of the page to which we're going to link.
 * @return	string			The permalink of the page
 * @see		http://tommcfarlin.com/permalink-by-slug/
 * @since	1.0
 */
function get_permalink_by_slug($slug, $post_type = '') {

    // Initialize the permalink value
    $permalink = null;

    // Build the arguments for WP_Query
    $args = array(
        'name' => $slug,
        'max_num_posts' => 1
    );

    // If the optional argument is set, add it to the arguments array
    if ($post_type) {
        $args = array_merge($args, array('post_type' => $post_type));
    }

    // Run the query (and reset it)
    $query = new WP_Query($args);
    if ($query->have_posts()) {
        $query->the_post();
        $permalink = get_permalink(get_the_ID());
    }
    wp_reset_postdata();

    return $permalink;
}
