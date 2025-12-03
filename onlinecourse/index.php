<?php
/**
 * Main Entry Point
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('ROOT_PATH', __DIR__);
define('APP_PATH', ROOT_PATH . '/app');
define('CONFIG_PATH', ROOT_PATH . '/config');
define('ASSETS_PATH', ROOT_PATH . '/assets');

// Load configuration
require_once CONFIG_PATH . '/Database.php';

// Load core classes
require_once ROOT_PATH . '/core/Router.php';
require_once ROOT_PATH . '/core/Controller.php';
require_once ROOT_PATH . '/core/Model.php';

// Start session
session_start();

// Initialize router and dispatch
$router = new Router();
$router->dispatch();
?>
