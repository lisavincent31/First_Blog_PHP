<?php 

namespace App\Controllers;

use App\Models\User;
use App\Validation\Validator;

class AuthController extends Controller {

    // get the auth page with the login and signup forms
    public function auth()
    {
        return $this->view('auth.index');
    }

    // post the login form
    public function login()
    {
        echo 'login function';
    }

    // post the signup form
    public function signup()
    {

    }
}

?>