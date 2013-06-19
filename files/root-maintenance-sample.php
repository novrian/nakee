<?php
/**
 * maintenance.php
 *
 * File ini digunakan ketika anda mengaktifkan mode maintenance website secara
 * keseluruhan, seperti yang berada pada panduan htaccess-sample
 *
 * Simpan file ini pada web root anda, biasanya terletak pada :
 *     `/home/user/public_html`
 * atau
 *     `/home/user/www`
 */

// Lokasi folder wp-content anda
define('CONTENT_DIR', dirname(__FILE__) . '/wp-content');

// Ambil file maintenance.php pada folder wp-content
require_once CONTENT_DIR . '/maintenance.php';
