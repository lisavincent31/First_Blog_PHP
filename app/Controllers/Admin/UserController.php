<?php 

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\User;
use App\Models\Comment;

class UserController extends Controller 
{
    /**
     * Return the view of all the users for the admin
     *
     */
    public function index() 
    {
        $this->isAdmin();
        $users = (new User($this->getDB()))->all();

        return $this->view('admin.user.index', compact('users'));
    }

    /**
     * Show all users and their comments
     *
     */
    public function show(int $id)
    {
        $this->isAdmin();
        $user = (new User($this->getDB()))->findById($id);
        $comments = (new Comment($this->getDB()))->getByUserId($id);

        return $this->view('admin.user.user', compact('user', 'comments'));
    }

}

?>