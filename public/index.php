<?php 

use Router\Router; 
use App\Exceptions\NotFoundException;

require '../vendor/autoload.php';

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define ('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);
define ('URL', "/Vincent_Lisa_1_repository_git_042023/");
define('QUERY', 'url=');

// Constantes for the connection
define('DB_NAME', 'lisavncnt_personal_blog');
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
$router->get('/auth/login', 'App\Controllers\AuthController@login');
$router->post('/auth/login', 'App\Controllers\AuthController@loginPost');
$router->get('/auth/signup', 'App\Controllers\AuthController@signup');
$router->post('/auth/signup', 'App\Controllers\AuthController@signupPost');
$router->get('/logout', 'App\Controllers\AuthController@logout');

// Routes for Dashboards
$router->get('/admin/dashboard', 'App\Controllers\AuthController@admin');

// Routes for manage the posts
$router->get('/admin/posts', 'App\Controllers\Admin\PostController@index');
$router->get('/admin/posts/create', 'App\Controllers\Admin\PostController@create');
$router->post('/admin/posts/create', 'App\Controllers\Admin\PostController@createPost');
$router->get('/admin/posts/edit/:id', 'App\Controllers\Admin\PostController@edit');
$router->post('/admin/posts/edit/:id', 'App\Controllers\Admin\PostController@update');
$router->post('/admin/posts/delete/:id', 'App\Controllers\Admin\PostController@delete');

// Routes for manage the comments post
$router->get('/admin/comments/', 'App\Controllers\Admin\CommentController@index');
$router->get('/admin/comments/:id', 'App\Controllers\Admin\CommentController@accept');
$router->get('/admin/comments/delete/:id', 'App\Controllers\Admin\CommentController@delete');
// Route for create a comment for a specific post
$router->post('/posts/:id/comment/create', 'App\Controllers\Admin\CommentController@commentPost');

// Routes to see all users and its comments
$router->get('/admin/users', 'App\Controllers\Admin\UserController@index');
$router->get('/admin/users/:id', 'App\Controllers\Admin\UserController@show');

// Route for contact form
$router->post('/contact', 'App\Controllers\MailController@send');

try {
    $router->run();
} catch(NotFoundException $e) {
    return $e->error404();
}