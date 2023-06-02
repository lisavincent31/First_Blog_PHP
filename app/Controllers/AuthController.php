<?php 

namespace App\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Validation\Validator;

class AuthController extends Controller {

    // return the view of the login form
    public function login()
    {
        return $this->view('auth.login');
    }

    // function to post the login form
    public function loginPost()
    {
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'email' => ['required', 'min:3'],
            'password' => ['required'],
        ]);

        if($errors) {
            $_SESSION['errors'][] = $errors;
            header('Location: ' .URL.'auth/login');
            exit;
        }

        $user = (new User($this->getDB()))->getByEmail($_POST['email']);

        if(password_verify($_POST['password'], $user->password)) {
            $_SESSION['auth'] = (int) $user->isAdmin;
            $_SESSION['user']['id'] = $user->id;
            $_SESSION['user']['firstname'] = $user->firstname;

            if($_SESSION['auth'] == 1) {
                $_SESSION['message'] = 'Vous êtes connecté.';
                return header('Location: ' .URL.'/admin/dashboard?success=true');
            }else{
                $_SESSION['message'] = 'Vous êtes connecté.';
                return header('Location: ' .URL."/?success=true");
            }

        }else{
            $_SESSION['errors']['password'] = ['Mot de passe incorrect.'];
            header('Location: ' .URL.'auth/login');
            exit;
        }
    }

    // return the view of the signup form
    public function signup() 
    {
        return $this->view('auth.signup');
    }

    // function to post the signup form
    public function signupPost() 
    {
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'firstname' => ['required', 'min:3'],
            'lastname' => ['required', 'min:3'],
            'email' => ['required', 'min:3', 'unique'],
            'password' => ['required', 'min:3'],
        ]);

        if($errors) {
            $_SESSION['errors'][] = $errors;
            header('Location: ' .URL.'auth/signup');
            exit;
        }else{
            $user = new User($this->getDB());

            $result = $user->create($_POST);

            if($result) {
                $this->loginPost();
            }
        }
    }

    // function to logout a user and return to the homepage
    public function logout() 
    {
        session_destroy();

        return header('Location: ' .URL.'/');
    }

    // Return the dashboard admin view with all posts, comments and users
    public function admin() 
    {
        $this->isAdmin();
        $posts = (new Post($this->getDB()))->all();
        $comments = (new Comment($this->getDB()))->all();
        $users = (new User($this->getDB()))->all();

        return $this->view('admin.dashboard', compact('posts', 'users', 'comments'));
    }
}