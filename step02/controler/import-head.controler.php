<?php
if(!defined('_ROOT_DIR_ADMIN_')) {
    define('_ROOT_DIR_ADMIN_', dirname(__FILE__, 2));
}

if(!defined('_ROOT_DIR_')) {
    define('_ROOT_DIR_', _ROOT_DIR_ADMIN_.'/public');
}

$protocol = !empty($_SERVER['HTTPS']) ? 'https' : 'http';

if(!defined('_PROTOCOL_')) {
    define('_PROTOCOL_', $protocol);
}

if(!defined('_ROOT_URL_')) {
    define('_ROOT_URL_', $protocol.'://localhost:3000');
}

include(_ROOT_DIR_."/partials/head.php");
include(_ROOT_DIR_."/partials/header.php");