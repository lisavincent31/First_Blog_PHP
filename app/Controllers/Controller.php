<?php 

namespace App\Controllers;

use Database\Connection;

abstract class Controller {

    protected $db;
    public $url = "/Vincent_Lisa_1_repository_git_042023/";
    public $views;

    public function __construct(Connection $db) 
    {
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->db = $db;
        $this->views = dirname(__DIR__).'/views/';
    }

    /**
     * Function to return a specific view file
     *
     * @param string $path The path to the view file
     * @param array|null $params Optional parameters to pass to the view
     */
    protected function view(string $path, array $params = null) 
    {
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require $this->views . $path . '.php';

        $content = ob_get_clean();

        require $this->views . 'layout.php';
    }

    /**
     * Function return true if a user is admin
     *
     */
    protected function isAdmin()
    {
        if(isset($_SESSION['auth']) && $_SESSION['auth'] == 1) {
            return true;
        }else{
            $path = $this->url.'auth/login';
            $this->redirect($path);
        }
    }

    /**
     * Function return true if a user is simple user
     *
     */
    protected function isUser()
    {
        if(isset($_SESSION['auth']) && $_SESSION['auth'] == 0) {
            return true;
        }else{
            $path = $this->url.'auth/login';
            $this->redirect($path);
        }
    }

    /**
     * Function to get the connexion with the database
     *
     * @return Connection
     */
    protected function getDB(): Connection
    {
        return $this->db;
    }

    /**
     * Redirect safetly urls
     * 
     * @return void
     */
    function redirect(string $url, int $statusCode=302) 
    {
        header('Location: '.$url, true, $statusCode);
    }
}