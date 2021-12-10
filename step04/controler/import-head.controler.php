<?php
if(!defined('_ROOT_DIR_ADMIN_')) {
    define('_ROOT_DIR_ADMIN_', dirname(__FILE__, 2));
}

if(!defined('_ROOT_DIR_')) {
    define('_ROOT_DIR_', _ROOT_DIR_ADMIN_.'/public');
}

if(!defined('_CLASS_DIR_')) {
    define('_CLASS_DIR_', _ROOT_DIR_ADMIN_.'/class');
}

$protocol = !empty($_SERVER['HTTPS']) ? 'https' : 'http';

if(!defined('_PROTOCOL_')) {
    define('_PROTOCOL_', $protocol);
}

if(!defined('_ROOT_URL_')) {
    define('_ROOT_URL_', $protocol.'://localhost:3000');
}

/**
 * var pour la DB
 */
if(!defined('_DB_HOST_')) {
    define('_DB_HOST_', 'localhost:3306');
}

if(!defined('_BDD_')) {
    define('_BDD_', 'jobboard');
}

if(!defined('_LOGIN_')) {
    define('_LOGIN_', 'root');
}

if(!defined('_MDP_')) {
    define('_MDP_', '123456');
}
/**
 * fin var DB
 */

/**
 * load all class
 */
function my_autoload ($pClassName) {
		@include(_ROOT_DIR_ADMIN_ . "/class/" . $pClassName . ".class.php");
}
spl_autoload_register("my_autoload");

/**
 * load DB
 */
$pCon = new ConnexionBD();
    $pCon->setVal('bdd', _BDD_);
    $pCon->setVal('login',_LOGIN_);
    $pCon->setVal('mdp', _MDP_);
    $pCon->setVal('hote',_DB_HOST_);
    $pCon->connect();

include(_ROOT_DIR_."/partials/head.php");
include(_ROOT_DIR_."/partials/header.php");