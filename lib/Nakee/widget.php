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
        $item_out[] = '<abbr title="' . $title . '" data-toggle="tooltip" data-placement="top"><i class="technology-icon nakee-' . strtolower($nmspace) . '-icon"></i><span class="hide-text">' . $title . '</span></abbr>';
    }
    
    $output = '<section id="technology-widget" class="technology-widget">';
    $output .= implode("", $item_out);
    $output .= '</section>';
    
    return $output;
}