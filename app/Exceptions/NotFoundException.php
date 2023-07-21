<?php 

namespace App\Exceptions;

use Exception;
use Throwable;

class NotFoundException extends Exception 
{
    public function __construt($message = "", $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    // function to return the 404 not found page if the url is incorrect
    public function error404() 
    {
        http_response_code(404);
        require VIEWS.'errors/404.php';
    }
}