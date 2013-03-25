<?php
/**
 * Nakee Social Network API Interaction
 * 
 * @author Novrian Y.F. <me@novrian.info>
 * @copyright (c) 2013, Novrian Y.F.
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL License
 */


require_once locate_template('/lib/Nakee/Class/Nakee_Twitter.php');

/**
 * Display Last Tweet
 * 
 * @param int $count
 * @return type
 */
function nakee_display_last_tweet() {
    $tweet = Nakee_Twitter::getInstance();
    $response = $tweet->getLastTweet();
    
    if ($response['httpstatus'] !== 200) {
        return "<strong class=\"tweet-text\">Bad Connection :(</strong>\n";
    }
    
    foreach($response['statuses'] as $key => $data) {
        $status[$key]['time'] = $data->created_at;
        $status[$key]['relative_time'] = nakee_relative_time(nakee_tweet_date_to_unix($data->created_at));
        $status[$key]['tweet'] = rtrim(str_replace('#' . Nakee_Twitter::getHashtag(), "", $data->text));
    }
    
    $output = "<strong class=\"tweet-text\">" . $status[0]['tweet'] . "</strong><br />\n";
    $output .= "<small class=\"tweet-time\"><time datetime=\"" . $status[0]['time'] . "\" pubdate>" . $status[0]['relative_time'] . "</time></small>";
    
    return $output;
}