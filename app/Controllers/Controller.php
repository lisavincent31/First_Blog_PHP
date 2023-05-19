<?php 

namespace App\Controllers;

use Database\Connection;

abstract class Controller {

    protected $db;

    public function __construct(Connection $db) 
    {
        // if(session_status() === PHP_SESSION_NONE) {
        //     session_start();
        // }
        $this->db = $db;
    }

    // function to return a specific view file
    protected function view(string $path, array $params = null) 
    {
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require VIEWS . $path . '.php';

        $content = ob_get_clean();

        require VIEWS . 'layout.php';
    }

    // function to get the connexion with the database
    protected function getDB()
    {
        return $this->db;
    }
}