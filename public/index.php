<?php
/**
 * Created by PhpStorm.
 * User: nickp666
 * Date: 07/04/15
 * Time: 20:32
 */

set_include_path(get_include_path() . PATH_SEPARATOR . realpath(dirname(__FILE__) . '/../'));

spl_autoload_extensions(".php");
spl_autoload_register();

$router = new vendor\Router();
$router->route();