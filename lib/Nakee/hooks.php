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
        $suffix .= sprintf('<p><a class="btn btn-primary btn-large" href="%s" title="Yuk, konsultasi sambil ngopi"><i class="icon-user"></i>  Contact Me</a></p>', get_permalink_by_slug('kontak', 'page') . '?ref=' . get_the_ID());
    } else {
        return $content;
    }

    return $content . '<div class="clearfix"></div>' . $suffix;
}
add_filter('the_content', 'nakee_suffix_content');


/**
 * Nakee Image Resize
 *
 * Hooks untuk membuat resize gambar dari atas, tidak dari tengah seperti
 * yang dilakukan pada Wordpress default
 *
 * @author George Stephanis
 * @param  object $payload
 * @param  int $orig_w
 * @param  int $orig_h
 * @param  int $dest_w
 * @param  int $dest_h
 * @param  bool $crop
 * @return bool | array
 * @see http://stephanis.info/2012/06/how-to-change-post-thumbnail-crop-position-in-wordpress-without-hacking-core/
 */
function nakee_image_resize_dimensions( $payload, $orig_w, $orig_h, $dest_w, $dest_h, $crop ) {

    // Change this to a conditional that decides whether you
    // want to override the defaults for this image or not.
    if( false )
        return $payload;

    if ( $crop ) {
    // crop the largest possible portion of the original image that we can size to $dest_w x $dest_h
        $aspect_ratio = $orig_w / $orig_h;
        $new_w = min($dest_w, $orig_w);
        $new_h = min($dest_h, $orig_h);

        if ( !$new_w ) {
            $new_w = intval($new_h * $aspect_ratio);
        }

        if ( !$new_h ) {
            $new_h = intval($new_w / $aspect_ratio);
        }

        $size_ratio = max($new_w / $orig_w, $new_h / $orig_h);

        $crop_w = round($new_w / $size_ratio);
        $crop_h = round($new_h / $size_ratio);

    $s_x = 0; // [[ formerly ]] ==> floor( ($orig_w - $crop_w) / 2 );
    $s_y = 0; // [[ formerly ]] ==> floor( ($orig_h - $crop_h) / 2 );
    } else {
    // don't crop, just resize using $dest_w x $dest_h as a maximum bounding box
        $crop_w = $orig_w;
        $crop_h = $orig_h;

        $s_x = 0;
        $s_y = 0;

        list( $new_w, $new_h ) = wp_constrain_dimensions( $orig_w, $orig_h, $dest_w, $dest_h );
    }

    // if the resulting image would be the same size or larger we don't want to resize it
    if ( $new_w >= $orig_w && $new_h >= $orig_h )
        return false;

    // the return array matches the parameters to imagecopyresampled()
    // int dst_x, int dst_y, int src_x, int src_y, int dst_w, int dst_h, int src_w, int src_h
    return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );

}
add_filter( 'image_resize_dimensions', 'nakee_image_resize_dimensions', 10, 6 );
