<?php 

use Router\Router; 

require '../vendor/autoload.php';

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define ('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);

$router = new Router($_GET['url']);

$router->get('/', 'App\Controllers\HomeController@index');

$router->run();