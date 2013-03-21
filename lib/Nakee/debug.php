<?php
/**
 * Nakee Debug Utility
 * 
 * @author Novrian Y.F. <me@novrian.info>
 * @copyright (c) 2013, Novrian Y.F.
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL License
 */


/**
 * Debugging Action
 * 
 * @copyright (c) rarst.net
 * @link http://www.rarst.net/script/debug-wordpress-hooks/
 */
function dump_hook($tag, $hook) {
    ksort($hook);

    echo "<pre>>>>>>\t$tag<br>";

    foreach ($hook as $priority => $functions) {

        echo $priority;

        foreach ($functions as $function)
            if ($function['function'] != 'list_hook_details') {

                echo "\t";

                if (is_string($function['function']))
                    echo $function['function'];

                elseif (is_string($function['function'][0]))
                    echo $function['function'][0] . ' -> ' . $function['function'][1];

                elseif (is_object($function['function'][0]))
                    echo "(object) " . get_class($function['function'][0]) . ' -> ' . $function['function'][1];
                else
                    print_r($function);

                echo ' (' . $function['accepted_args'] . ') <br>';
            }
    }

    echo '</pre>';
}

function list_hooks($filter = false) {
    global $wp_filter;

    $hooks = $wp_filter;
    ksort($hooks);

    foreach ($hooks as $tag => $hook)
        if (false === $filter || false !== strpos($tag, $filter))
            dump_hook($tag, $hook);
}

function list_hook_details($input = NULL) {
    global $wp_filter;

    $tag = current_filter();
    if (isset($wp_filter[$tag]))
        dump_hook($tag, $wp_filter[$tag]);

    return $input;
}

function list_live_hooks($hook = false) {
    if (false === $hook)
        $hook = 'all';

    add_action($hook, 'list_hook_details', -1);
}