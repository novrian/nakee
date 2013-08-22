<?php
/**
 * maintenance.php
 *
 * File ini digunakan jika Wordpress melakukan maintenance seperti mengupgrade
 * wordpress, ataupun plugin ke versi terbaru
 *
 * Copy file ini ke folder wp-content anda
 * biasanya di
 *     `/wp-content/maintenance.php`
 */

// ============================================================================
// Konstanta Penting
// ============================================================================
define('HOME_URL', 'http://localhost/novrian.info');
define('THEME_URL', HOME_URL . '/content/themes/nakee');
define('THEME_DIR', dirname(__FILE__) . '/themes/nakee');
define('ASSET_URL', HOME_URL . '/assets');

// Get Library
require ABSPATH . WPINC . '/class-wp-walker.php';
require ABSPATH . WPINC . '/category-template.php';
require THEME_DIR . '/lib/Nakee/config.php';
require THEME_DIR . '/lib/Nakee/Class/Nakee_Twitter.php';
require THEME_DIR . '/lib/Nakee/utilities.php';

$twitter = defined('TWITTER_CONSUMER_KEY') && defined('TWITTER_CONSUMER_SECRET');

// Get Twitter Content
if ($twitter) {
    // Get Last Twitter Status
    $nk_twit = Nakee_Twitter::getInstance();
    $statuses = $nk_twit->getLastTweet();

    // Show User
    Codebird::setConsumerKey(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET);
    $cb = Codebird::getInstance();
    $cb->setToken(TWITTER_ACCESS_TOKEN, TWITTER_ACCESS_TOKEN_SECRET);
    Codebird::setBearerToken($cb->oauth2_token()->access_token);
    $users = $cb->users_show(array( 'screen_name' => 'nono_gallankz' ));
}

// Output HTTP Status 503
header('HTTP/1.1 503 Service Temporarily Unavailable', true, 503);
header('Status: 503 Service Temporarily Unavailable');
header('Retry-After: 172800');
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>Bentar beroh, lagi cari selotip &mdash; Novrian</title>
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Modernizr -->
    <script type="text/javascript" src="<?php echo ASSET_URL . '/js/vendor/modernizr-2.6.2.min.js'; ?>"></script>

    <?php // TypeKit Scripts ?>
    <script type="text/javascript" src="//use.typekit.net/kpm6ebn.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
    <?php // Stop TypeKit ?>

    <link rel="shortcut icon" href="<?php echo HOME_URL; ?>/favicon.ico">
    <link rel="apple-touch-icon-precomposed apple-touch-icon" href="<?php echo HOME_URL; ?>/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo HOME_URL; ?>/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo HOME_URL; ?>/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo HOME_URL; ?>/apple-touch-icon-144x144-precomposed.png">

    <link rel="stylesheet" href="<?php echo HOME_URL . '/assets/css/maintenance.css'; ?>" >

    <?php // Selectivizr ?>
    <!--[if (gte IE 6)&(lte IE 8)]>
    <script type="text/javascript" src="<?php echo ASSET_URL . '/js/vendor/selectivizr-min.js'; ?>"></script>
    <noscript><link rel="stylesheet" href="<?php echo ASSET_URL . '/css/ie.css'; ?>" /></noscript>
    <![endif]-->
    <?php // End Selectivizr ?>

</head>
<body class="maintenance-page">
<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
<div class="container">
    <div class="row box">
        <header role="banner">
            <h1>Sori beroh, lagi cari selotip!</h1>
        </header>

        <!-- countdown timer -->
        <div class="countdown"></div>

        <?php if ($twitter && ($statuses['httpstatus'] == 200) && ($users->httpstatus == 200)) : ?>
        <!-- status -->
        <div class="statuses">
            <div class="user">
                <figure class="pic">
                    <a href="<?php echo 'https://twitter.com/' . $users->screen_name; ?>" title="<?php echo '@' . $users->screen_name . ' on Twitter'; ?>" target="_blank">
                        <img src="<?php echo str_replace('_normal', '_bigger', $users->profile_image_url_https); ?>" alt="<?php echo '@' . $users->screen_name . ' Picture'; ?>" >
                    </a>
                </figure>
            </div>
            <div class="tweet">
                <div class="bubble"></div>
                <blockquote><p><?php echo str_replace("#web", "", $statuses['statuses'][0]->text); ?></p></blockquote>
                <?php $time = nakee_relative_time(nakee_tweet_date_to_unix($statuses['statuses'][0]->created_at)); ?>
                <small><?php echo '<a href="https://twitter.com/' . $users->screen_name . '" title="@' . $users->screen_name . ' on Twitter">@' . $users->screen_name . '</a> | ' . $time . ' via <cite title="Twitter">Twitter</cite>'; ?></small>
            </div>
        </div>
    <?php endif; ?>
</div>

<footer role="contentinfo">
    <small><?php echo 'Copyright &copy; ' . date('Y', time()) . ' Novrian Nono. All rights reserved'; ?></small>
</footer>
</div>

<kbd id="timestamp" style="display: none;"><?php echo ($upgrading + 600) * 1000; ?></kbd>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<?php echo '<script>window.jQuery || document.write(\'<script src="' . HOME_URL . '/assets/js/vendor/jquery-1.10.2.min.js"><\/script>\')</script>'; ?>

<script src="<?php echo HOME_URL . '/assets/js/vendor/jquery.countdown.min.js'; ?>" type="text/javascript"></script>
<script src="<?php echo HOME_URL . '/assets/js/vendor/jquery.countdown-id.js'; ?>" type="text/javascript"></script>

<script type="text/javascript">
jQuery(document).ready(function($) {
    // Countdown Configs
    var ts = parseInt($('#timestamp').text());
    var cd_layout = '<div class="jam"><span class="period">{hnn}</span><span class="label">{hl}</span></div><div class="sep">{sep}</div><div class="menit"><span class="period">{mnn}</span><span class="label">{ml}</span></div><div class="sep">{sep}</div><div class="detik"><span class="period">{snn}</span><span class="label">{sl}</span></div>';
    $.countdown.setDefaults($.countdown.regional['id']);
    $.countdown.setDefaults({
        format : "HMS",
        compact : false,
        until : new Date( ts ),
        layout : cd_layout
    // Misc
    });
    $('.countdown').countdown(); // Init Countdown
});
</script>
</body>
</html>
