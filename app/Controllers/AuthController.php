<?php 
namespace App\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Validation\Validator;

class AuthController extends Controller
{
    /**
     * Return the view of the login form
     * @return
     */
    public function login()
    {
        return $this->view('auth.login');
    }

    /**
     * Function to post the login form
     *
     * @return void
     */
    public function loginPost()
    {
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'email' => ['required', 'min:3', 'html'],
            'password' => ['required', 'html', 'min:3'],
        ]);

        if($errors) {
            $_SESSION['errors'][] = $errors;
            $url = $this->url.'auth/login';
            $this->redirect($url);
        }

        $user = (new User($this->getDB()))->getByEmail($_POST['email']);

        if(password_verify($_POST['password'], $user->password)) {
            $_SESSION['auth'] = (int) $user->isAdmin;
            $_SESSION['user']['id'] = $user->id;
            $_SESSION['user']['firstname'] = $user->firstname;

            if($_SESSION['auth'] == 1) {
                $_SESSION['message'] = 'Vous êtes connecté.';
                $url = $this->url.'admin/dashboard?success=true';
                $this->redirect($url);
            }else{
                $_SESSION['message'] = 'Vous êtes connecté.';
                $url = $this->url.'?success=true';
                $this->redirect($url);
            }

        }else{
            $_SESSION['errors']['password'] = ['Mot de passe incorrect.'];
            $url = $this->url.'auth/login';
            $this->redirect($url);
        }
    }

    /**
     * Return the view of the signup form
     * @return
     */
    public function signup()
    {
        return $this->view('auth.signup');
    }

    /**
     * Function to post the signup form
     *
     * @return void
     */
    public function signupPost()
    {
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'firstname' => ['required', 'min:3', 'html'],
            'lastname' => ['required', 'min:3', 'html'],
            'email' => ['required', 'min:3', 'unique', 'html'],
            'password' => ['required', 'min:3', 'html'],
        ]);

        if($errors) {
            $_SESSION['errors'][] = $errors;
            $url = $this->url.'auth/signup';
            $this->redirect($url);
        }else{
            $user = new User($this->getDB());

            $result = $user->create($_POST);

            if($result) {
                $this->loginPost();
            }
        }
    }

    /**
     * Function to logout a user and return to the homepage
     *
     * @return void
     */
    public function logout()
    {
        session_destroy();

        $url = $this->url;
        $this->redirect($url);
    }

    /**
     * Return the dashboard admin view with all posts, comments and users
     * @return
     */
    public function admin()
    {
        $this->isAdmin();
        $posts = (new Post($this->getDB()))->all();
        $comments = (new Comment($this->getDB()))->all();
        $users = (new User($this->getDB()))->all();

        return $this->view('admin.dashboard', compact('posts', 'users', 'comments'));
    }
}