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
define('HOME_URL', 'http://example.com');
define('THEME_URL', HOME_URL . '/wp-content/themes/nakee');
define('ASSET_URL', HOME_URL . '/assets');

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
<html>
<head>
    <meta charset="utf-8">
	<title>Sori, lagi pipis &mdash; Novrian Nono</title>
    <meta name="robots" content="noindex,nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php // TypeKit Scripts ?>
    <script type="text/javascript" src="//use.typekit.net/kpm6ebn.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
    <?php // Stop TypeKit ?>

    <?php // Favicon ?>
    <link rel="apple-touch-icon-precomposed apple-touch-icon favicon shortcut icon" href="<?php echo THEME_URL; ?>/apple-touch-icon.png">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo THEME_URL; ?>/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo THEME_URL; ?>/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo THEME_URL; ?>/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo THEME_URL; ?>/apple-touch-icon-144x144-precomposed.png">
    <?php // Stop Favicon ?>

    <style type="text/css">
    body {
        background: #EDEDED url('assets/img/main-background.png') repeat 0 0 scroll;
    }
    .container { padding: 100px 0 200px; }
    .container h1 {
        -webkit-text-shadow: 0 1px 1px #000;
        -moz-text-shadow: 0 1px 1px #000;
        text-shadow: 0 1px 1px #000;
        font-family: "museo-sans", serif;
        font-size: 95px;
        font-weight: bold;
        text-align: center;
        color: #7CB2E1;
    }
    </style>

</head>
<body class="maintenance-page">
    <!--[if lt IE 7]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->
	<div class="container">
		<h1>Sori beroh, lagi pipis ;)</h1>
	</div>
</body>
</html>
