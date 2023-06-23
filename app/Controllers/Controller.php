<?php 

namespace App\Controllers;

use Database\Connection;

abstract class Controller {

    protected $db;
    public $url = "/Vincent_Lisa_1_repository_git_042023/";
    // public $views = dirname(__DIR__).'/views/';

    public function __construct(Connection $db) 
    {
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->db = $db;
        // $this->url = $url;
    }

    /**
     * Function to return a specific view file
     *
     * @return void
     */
    protected function view(string $path, array $params = null) 
    {
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require VIEWS . $path . '.php';

        $content = ob_get_clean();

        require VIEWS . 'layout.php';
    }

    /**
     * Function return true if a user is admin
     *
     * @return void
     */
    protected function isAdmin()
    {
        if(isset($_SESSION['auth']) && $_SESSION['auth'] == 1) {
            return true;
        }else{
            $path = $this->url.'auth/login';
            $this->redirect($path);
            // header('Location: ' .URL.'auth/login');
        }
    }

    /**
     * Function return true if a user is simple user
     *
     * @return void
     */
    protected function isUser()
    {
        if(isset($_SESSION['auth']) && $_SESSION['auth'] == 0) {
            return true;
        }else{
            $path = $this->url.'auth/login';
            $this->redirect($path);
            // header('Location: ' .URL.'auth/login');
        }
    }

    /**
     * Function to get the connexion with the database
     *
     * @return void
     */
    protected function getDB()
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