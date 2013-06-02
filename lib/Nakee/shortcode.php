<?php
/**
 * Nakee Shortcode
 *
 * @author Novrian Y.F. <me@novrian.info>
 * @copyright (c) 2013, Novrian Y.F.
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL License
 */


/**
 * Info Box
 *
 * Membuat box informasi konten
 * Cara penggunaan :
 *	`[nakee_alert type='info']content[/nakee_alert]`
 *
 * @param mixed $atts
 * @param string $content
 * @return string
 */
function nakee_alert_box( $atts, $content=NULL ) {
	//ekstrak variabel atribut
	extract( shortcode_atts( array(
		'type'	=> 'info'
	), $atts ) );

	//jika content kosong, isi dengan &nbsp;
	if ( $content == NULL ) {
		$content = '&nbsp;';
	}

	//output alert box
	$output = '<div class="nakee-alert alert ' . strtolower(esc_attr($type)) . '"><button class="close" data-dismiss="alert">&times;</button>' . do_shortcode($content) . '</div>';
	return $output;
}
add_shortcode('nakee_alert','nakee_alert_box');


/**
 * Example Box Label
 *
 * Label box untuk contoh kode program
 * Cara penggunaan :
 *	`[nakee_example class='class']content[/nakee_example]`
 *
 * @param mixed $atts
 * @param mixed $content
 * @return string
 */
function nakee_example_box( $atts, $content=null ) {
	extract( shortcode_atts( array(
		'class' => 'example_box'
	), $atts ) );
	$output = '<div class="'. strtolower(esc_attr($class)) .' nakee-example-box">'. do_shortcode($content) .'</div>';
	return $output;
}
add_shortcode('nakee_example','nakee_example_box');


/**
 * Inline Social Link
 *
 * Shortcode untuk tombol social pada sidebar
 * `[nakee_social class="optional class"/]`
 *
 * @param mixed $atts
 * @param mixed $content
 * @return string
 */
function nakee_social_link($atts, $content = null) {
    extract( shortcode_atts( array(
        'class' => ''
    ), $atts ) );

    $output = '';

    $output .= "<div class=\"social-link " . esc_attr($class) . "\">";
    $output .= "<ul class=\"inline\">";
    $output .= "<li><a href=\"https://facebook.com/" . FACEBOOK_USERNAME . "\" class=\"facebook url\" title=\"Me on Facebook\"><i class=\"icon-facebook\"></i><span class=\"hide-text\">Me on Facebook</span></a></li>";
    $output .= "<li><a href=\"https://twitter.com/" . TWITTER_USERNAME . "\" class=\"twitter url\" title=\"Follow me on Twitter\"><i class=\"icon-twitter\"></i><span class=\"hide-text\">Follow me on Twitter</span></a></li>";
    $output .= "<li><a href=\"https://github.com/" . GITHUB_USERNAME . "\" class=\"github url\" title=\"My Open Source Project on Github\"><i class=\"icon-github\"></i><span class=\"hide-text\">My Open Source Project on Github</span></a></li>";
    $output .= "</ul>";
    $output .= "</div>";

    return $output;
}
add_shortcode('nakee_social', 'nakee_social_link');


/**
 * Shortcode menampilkan image gravatar
 * Usage:
 *     `[nakee_gravatar u="me@example.com" s="200"]My Avatar[/nakee_gravatar]`
 *
 * @param  mixed $atts
 * @param  mixed $content
 * @return string
 */
function nakee_disp_gravatar($atts, $content = null) {
    extract( shortcode_atts( array(
        'u'     => '',
        'class' => 'img-rounded',
        's'     => 200
    ), $atts ) );

    if (empty($u)) { return null; }

    $desc = "My Pic";
    if (!empty($content)) {
        $desc = esc_attr(do_shortcode($content));
    }

    $avatar = "http://gravatar.com/avatar/" . md5(esc_attr($u)) . "?&s=" . esc_attr($s);

    $out = "<img alt=\"$desc\" class=\"" . esc_attr($class) . "\" title=\"$desc\" src=\"$avatar\" />";

    return $out;
}
add_shortcode('nakee_gravatar', 'nakee_disp_gravatar');


/**
 * Shortcode mengambil Base URL
 * Usage:
 *     `[nakee_base suf="optional suffix" class="optional class"]My Link[/nakee_base]`
 *
 * @param  mixed $atts
 * @param  mixed $content
 * @return string
 */
function nakee_base_url($atts, $content) {
    extract( shortcode_atts( array(
        'suf'   => null,
        'class' => ''
    ), $atts ) );

    $link = WP_BASE . '/' . urlencode(esc_attr($suf));
    if (empty($content) || is_null($content)) { $content = $link; }

    return "<a href=\"$link\" title=\"" . esc_attr(strip_tags($content)) . "\" class=\"url " . esc_attr($class) . "\">$content</a>";
}
add_shortcode('nakee_base', 'nakee_base_url');


/**
 * Filter ini untuk memperbolehkan Shortcode digunakan pada widget Text
 */
add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');
