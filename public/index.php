<?php 

use Router\Router; 

require '../vendor/autoload.php';

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define ('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);
define('URL', '/Vincent_Lisa_1_repository_git_042023/');
define('QUERY', 'url=');

// constantes for the connection
define('DB_NAME', 'myblog');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PWD', '');

$router = new Router($_GET['url']);

// Route for the HomePage
$router->get('/', 'App\Controllers\HomeController@index');

// Routes for the BlogPage
$router->get('/posts', 'App\Controllers\BlogController@index');
$router->get('/posts/:id', 'App\Controllers\BlogController@show');

// Routes for Authentication
$router->get('/auth', 'App\Controllers\AuthController@auth');
$router->post('/auth', 'App\Controllers\AuthController@login');
$router->post('/auth', 'App\Controllers\AuthController@signup');

$router->run();