<?php
/**
 * Nakee Widget
 * 
 * Kumpulan fungsi-fungsi yang berhubungan dengan Widget
 * 
 * @author Novrian Y.F. <me@novrian.info>
 * @copyright (c) 2013, Novrian Y.F.
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL License
 */


/**
 * Technology Widget
 */
function display_technology($items = array()) {
    if (!is_array($items)) {
        return null;
    }
    
    foreach($items as $nmspace => $title) {
        $item_out[] = '<li><abbr title="' . $title . '" rel="tooltip" data-toggle="tooltip" data-placement="top"><i class="technology-icon nakee-' . strtolower($nmspace) . '-icon"></i><span class="hide-text">' . $title . '</span></abbr></li>';
    }
    
    $output = '<section id="technology-widget" class="technology-widget">';
    $output .= '<ul>';
    $output .= implode("", $item_out);
    $output .= '</ul>';
    $output .= '</section>';
    
    return $output;
}
