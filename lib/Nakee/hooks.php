<?php
/**
 * Nakee Hooks
 * 
 * @author Novrian Y.F. <me@novrian.info>
 * @copyright (c) 2013, Novrian Y.F.
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL License
 */


/**
 * Filter untuk menambahkan konten tambahan
 * pada setiap post
 * 
 * @param type $content
 * @return type
 */
function nakee_suffix_content($content) {
    if (get_post_type() == 'nakee_portfolio') {
        $content .= '<p>Ingin menciptakan hal baru seperti ini, silahkan kontak saya menggunakan tombol di bawah :)</p>';
        $content .= sprintf('<a class="contact-link" href="%s" title="Yuk, konsultasi sambil ngopi"><i class="icon-user"></i>  Contact Me</a>', get_permalink_by_slug('kontak', 'page') . '?ref=' . get_the_ID());
    }

    return $content;
}
add_filter('the_content', 'nakee_suffix_content');
