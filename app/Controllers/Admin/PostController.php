<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller {

    // return the page of all posts
    public function index()
    {
        $posts = (new Post($this->getDB()))->all();

        return $this->view('admin.post.index', compact('posts'));
    }

    // return the form to create a new post by the admin
    public function create()
    {
        $this->isAdmin();
        $tags = (new Tag($this->getDB()))->all();

        return $this->view('admin.post.form', compact('tags'));
    }

    // create the new post
    public function createPost()
    {
        $this->isAdmin();
        $post = new Post($this->getDB());

        $tags = array_pop($_POST);
        $result = $post->create($_POST, $tags);

        if($result) {
            $_SESSION['success'] = 'L\'article a été créé avec succès.';
            $url = URL.'admin/posts';
            $this->redirect($url);
            // return header('Location: ' . URL . '/admin/posts');
        }
    }

    // return the form to edit a post
    public function edit(int $id) 
    {
        $this->isAdmin();
        $post = (new Post($this->getDB()))->findById($id);
        $tags = (new Tag($this->getDB()))->all();

        return $this->view('admin.post.form', compact('post', 'tags'));
    }
    
    // edit a post
    public function update(int $id) 
    {
        $this->isAdmin();
        $post = new Post($this->getDB());

        $tags = array_pop($_POST);
        $result = $post->update($id, $_POST, $tags);

        if($result) {
            $_SESSION['success'] = 'L\'article a été modifié avec succès.';
            $url = URL.'admin/posts';
            $this->redirect($url);
            // return header('Location: ' . URL . '/admin/posts');
        }
    }

    // delete a post
    public function delete(int $id)
    {
        $this->isAdmin();
        $post = new Post($this->getDB());

        $result = $post->destroy($id);

        if($result) {
            $_SESSION['success'] = 'L\'article a été supprimé avec succès.';
            $url = URL.'admin/posts';
            $this->redirect($url);
            // return header('Location: '. URL .'/admin/posts');
        }
    }
}

?>