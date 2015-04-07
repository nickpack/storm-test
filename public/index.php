<?php
/**
 * Created by PhpStorm.
 * User: nickp666
 * Date: 07/04/15
 * Time: 20:32
 */
session_start();
set_include_path(get_include_path() . PATH_SEPARATOR . realpath(dirname(__FILE__) . '/../'));
require_once('app/config.php');

spl_autoload_extensions(".php");
spl_autoload_register();

\Facebook\FacebookSession::setDefaultApplication('1642391552643825', '8efe27bee746d4e22dab1a2831b273a8');

$router = new vendor\Router();
$router->route();