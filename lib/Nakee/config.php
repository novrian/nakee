<?php
/**
 * File Konfigurasi Nakee
 * 
 * @author Novrian Y.F. <me@novrian.info>
 * @copyright (c) 2013, Novrian Y.F.
 * @license http://www.gnu.org/licenses/gpl.html
 */

// Utility Constant
define('DS', DIRECTORY_SEPARATOR);

// Variabel Tagline
define('MAIN_TAGLINE', "Passionate<br />\n<strong>Web Developer, Web Designer</strong><br />\nFrom Makassar, <b>Indonesia</b>");
define('BLOG_TAGLINE', "Sedikit Jurnal tentang <b>Teknologi Web</b>");
define('CONTACT_TAGLINE', "Konsultasi? Ada Kerjaan untuk Saya? Ngopi Yuk! :)");




// {{{ API CONSTANTS

// Facebook
define('FACEBOOK_USERNAME', 'nono_gallank');

// Twitter
define('TWITTER_USERNAME', 'nono_gallankz');
define('TWITTER_CONSUMER_KEY', 'JlpORYytJIIifXS63F5g');
define('TWITTER_CONSUMER_SECRET', 'Igmct6GMyxN5y1XGoLXIr4tZH0vHEnbcfSrXrcKSU');
define('TWITTER_ACCESS_TOKEN', '40679188-QsmsSj6uQrK0TXTKGBFjyw03BZUA2wlDulzj3j7AM');
define('TWITTER_ACCESS_TOKEN_SECRET', 'lj3YQUsPTnMPBwvwbpt79CZwFuz7HHAZa0uNmXUo8A');

// Github
define('GITHUB_USERNAME', 'novrian');

// RSS
define('FEEDBURNER_URL', 'http://blablabla.com');

// Gravatar Email
define('GRAVATAR_EMAIL', 'me@novrian.info');
define('GRAVATAR_HASH', md5(strtolower(trim(GRAVATAR_EMAIL))));

// }}}




// {{{ WORDPRESS QUERY CONTANTS

define('PORTFOLIO_PER_PAGE', 6);

// }}}




// {{{ ANOTHER CONSTANS & VARIABLES

define('BREADCRUMBS_SEP', '/');     // Breadcrumbs Separator

// Variabel Default Featured Image ID
$GLOBALS['nakee']['def-featured-img'] = array(
    905,
    901,
    878,
    887
);

// }}}
