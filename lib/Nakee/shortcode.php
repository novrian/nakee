<?php
/**
 * Nakee Debug Utility
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
 *	`[n2_alert_box type='info']content[/n2_alert_box]`
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
	$output = '<div class="nakee-alert alert ' . strtolower($type) . '"><button class="close" data-dismiss="alert">&times;</button>' . do_shortcode($content) . '</div>';
	return $output;
}
add_shortcode('nakee_alert','nakee_alert_box');


/**
 * Example Box Label
 *
 * Label box untuk contoh kode program
 * Cara penggunaan :
 *	`[n2_example class='class']content[/n2_example]`
 * 
 * @param mixed $atts
 * @param mixed $content
 * @return string
 */
function nakee_example_box( $atts, $content=null ) {
	extract( shortcode_atts( array(
		'class' => 'example_box'
	), $atts ) );
	$output = '<div class="'. $class .' nakee-example-box">'. do_shortcode($content) .'</div>';
	return $output;
}
add_shortcode('nakee_example','nakee_example_box');