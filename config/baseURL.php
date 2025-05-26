<?php
// config/config.php

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$path = "/git-project/penjadwalan-kegiatan-sekolah/";

if (!defined("BASE_URL")) {
    define("BASE_URL", filter_var($protocol . $host . $path, FILTER_SANITIZE_URL));
}
