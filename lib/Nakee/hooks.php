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
    if (get_post_type() == 'post' && is_single()) {
        $suffix = '<p>' . __('Jika ada tanggapan, kritik, saran, maupun pertanyaan tentang artikel ini, silahkan <a href="#disqus_thread">meninggalkan komentar</a> anda. Silahkan menginput email anda pada form di bawah ini untuk menerima update jurnal terbaru dari saya. :)', 'roots') . '</p>';
        $suffix .= '<form  class="subscribe-form form-search" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open(\'http://feedburner.google.com/fb/a/mailverify?uri=NovrianBlog\', \'popupwindow\', \'scrollbars=yes,width=550,height=520\');return true">';
        $suffix .= '<div class="input-append">';
        $suffix .= '<input class="input-xlarge search-query" type="text" name="email" placeholder="' . __('Email anda', 'roots') . '" ><input type="hidden" value="NovrianBlog" name="uri" ><input type="hidden" name="loc" value="en_US" >';
        $suffix .= '<button type="submit" class="btn btn-primary">' . __('Langganan', 'roots') . '</button>';
        $suffix .= '</div>';
        $suffix .= '</form>';
    } elseif (get_post_type() == 'nakee_portfolio') {
        $suffix = '<p>Ingin menciptakan hal baru seperti ini, silahkan kontak saya menggunakan tombol di bawah :)</p>';
        $suffix .= sprintf('<a class="contact-link" href="%s" title="Yuk, konsultasi sambil ngopi"><i class="icon-user"></i>  Contact Me</a>', get_permalink_by_slug('kontak', 'page') . '?ref=' . get_the_ID());
    }

    return $content . '<div class="clearfix"></div>' . $suffix;
}
add_filter('the_content', 'nakee_suffix_content');
