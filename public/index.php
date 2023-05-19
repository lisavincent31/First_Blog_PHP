<?php 

use Router\Router; 

require '../vendor/autoload.php';

$router = new Router($_GET['url']);

$router->get('/', 'App\Controllers\HomeController@index');

$router->run();