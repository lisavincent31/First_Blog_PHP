<?php 

namespace App\Controllers;

use App\Models\Post;
use App\Models\User;

class BlogController extends Controller {

    // return the view of all posts in the website
    public function index()
    {
        $post = new Post($this->getDB());
        $posts = $post->all();
       
        return $this->view('blog.index', compact('posts'));
    }

    // return the view for one post 
    public function show(int $id)
    {
        $post = (new Post($this->getDB()))->findById($id);
        $author = (new User($this->getDB()))->findById($post->author);

        return $this->view('blog.post', compact('post', 'author'));
    }
}

?>