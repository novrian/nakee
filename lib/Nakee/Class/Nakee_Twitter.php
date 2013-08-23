<?php
/**
 * Nakee Twitter Interaction
 *
 * @author Novrian Y.F. <me@novrian.info>
 * @copyright (c) 2013, Novrian Y.F.
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL License
 */
require('codebird-php' . DS . 'src' . DS . 'codebird.php');

class Nakee_Twitter {

    /**
     * Nakee Twitter Instance
     *
     * @access private
     * @var object Nakee_Twitter
     */
    private static $_instance;

    /**
     * Codebird Instance
     *
     * @access private
     * @var object Codebird
     */
    private static $_cb;

    /**
     * Authorize Status
     *
     * @access private
     * @var boolean
     */
    private $_authorize = false;

    /**
     * Main Hashtag
     *
     * @access private
     * @var string
     */
    private static $_hashtag = 'web';

    /**
     * Constructor
     */
    private function __construct() {
        $cb = Codebird::getInstance();

        if (!defined('TWITTER_USERNAME')) {
            throw new Exception("Tolong set Twitter Username di config.php");
        }

        if (!defined('TWITTER_CONSUMER_KEY') || !defined('TWITTER_CONSUMER_SECRET')) {
            throw new Exception("Tolong Set Twitter Consumer Key di config.php");
        }

        if (!defined('TWITTER_ACCESS_TOKEN') || !defined('TWITTER_ACCESS_TOKEN_SECRET')) {
            throw new Exception("Tolong set Twitter Access Token di config.php");
        }

        if (!empty($_SESSION['nakee_social']['twitter']['auth_token'])) {
            $this->_authorize = true;
        }

        if (!$this->_authorize) {
            $cb->setConsumerKey(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET);
            $cb->setToken(TWITTER_ACCESS_TOKEN, TWITTER_ACCESS_TOKEN_SECRET);
            $response = $cb->oauth2_token();
            $_SESSION['nakee_social']['twitter']['auth_token'] = $response->access_token;
        }

        self::$_cb = $cb;
    }

    /**
     * Object Getter
     *
     * @access public
     * @return object Nakee_Twitter
     * @static Nakee_Twitter::getInstance()
     */
    public static function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    /**
     * Retrieve Last Tweet
     *
     * @access public
     * @param int $count
     * @return array
     */
    public function getLastTweet($count = 1) {
        $query = array(
            'q' => 'from:' . TWITTER_USERNAME . ' #' . self::$_hashtag,
            'count' => $count,
            'result_type' => 'recent'
        );

        $cb = self::$_cb;
        $response = $cb->search_tweets($query, true);
        return (array)$response;
    }

    /**
     * Retrieve user from Twitter
     *
     * @access public
     * @param  string $username
     * @return array
     */
    public function showUser($username = null) {
        if (empty($username)) {
            $username = TWITTER_USERNAME;
        }

        $q = array(
            'screen_name' => trim($username)
        );
        $cb = self::$_cb;
        $response = $cb->users_show($q, true);
        return (array)$response;
    }

    /**
     * Hashtag Getter
     *
     * @access public
     * @return string
     * @static
     */
    public static function getHashTag() {
        return self::$_hashtag;
    }

    /**
     * Tweet Parse
     *
     * Mem-parse elemen-elemen dalam tweet, seperti hashtag, url, dan mentions
     * dengan cara mengkonversi elemen2 tersebut menjadi link
     *
     * @access public
     * @param  array  $response response dari Codebird Instance
     * @return string
     * @static
     */
    public static function parseTweet($response = array()) {
        if (empty($response)) {
            return false;
        }

        // Split response
        $tweet = $response['statuses'][0];
        $entities = $tweet->entities;
        $meta = $response['metadata'];
        $httpStatus = $response['httpstatus'];

        // base var
        $out = str_replace('#' .self::$_hashtag, '', $tweet->text);

        // Parse Mentions
        if (!empty($entities->user_mentions)) {
            foreach($entities->user_mentions as $mention) {
                $profile = '<a href="http://twitter.com/' . $mention->screen_name . '" target="_blank" rel="nofollow">@' . $mention->screen_name . '</a>';
                $out = str_replace('@' .$mention->screen_name, $profile, $out);
            }
        }

        // Parse Hashtags
        //
        // Mem-parse semua hashtag kecuali Nakee_Twitter::$_hashtag
        if (!empty($entities->hashtags)) {
            foreach($entities->hashtags as $hashtag) {
                if ($hashtag->text == self::$_hashtag) {
                    continue;
                }
                $hashtagLink = '<a href="https://twitter.com/search?q=' . urlencode('#' . $hashtag->text) . '" target="_blank" rel="nofollow">#' . $hashtag->text . '</a>';
                $out = str_replace('#' . $hashtag->text, $hashtagLink, $out);
            }
        }

        // Parse URLs
        if (!empty($entities->urls)) {
            foreach($entities->urls as $url) {
                $link = '<a href="' . $url->url . '" target="_blank" rel="nofollow">' . $url->display_url . '</a>';
                $out = str_replace($url->url, $link, $out);
            }
        }

        return trim($out);
    }

}
